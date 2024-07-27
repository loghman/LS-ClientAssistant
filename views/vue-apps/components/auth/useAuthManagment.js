// useAuth.js
import { post, put } from "@/assets/js/utilities/httpClient/httpClient.js";
import Cookies from "js-cookie";
import { endLoading, startLoading } from "@/assets/js/utilities/loading.js";
import { postData } from "@/assets/js/utilities/common.js";
import { authApi } from "@/assets/js/utilities/apiPath.js";
import { lspDomain, lspOrigin } from "./useAuth.js";
import { useAuthStore } from "../../stores/authStore.js";
import { deleteTokenCookies } from "@/assets/js/utilities/logout.js";
export const useAuthManagment = (
    clientUrl,
    submitBtnRef,
    sendTokenBtnRef,
    goToCard
) => {
    const clientIframe = document.getElementById("client_iframe");
    const { expireAt } = useAuthStore();
    const authRequest = async (method, url, data, btnRef, actions) => {
        try {
            startLoading(btnRef.value);
            let response;
            if (method === "post") {
                response = await post(url, data);
            } else if (method === "put") {
                response = await put(url, data);
            } else {
                throw new Error(`Unsupported method: ${method}`);
            }

            if (response.status) {
                const { auth } = response.result;

                deleteTokenCookies()

                Cookies.set("token", auth.token, {
                    expires: expireAt,
                    domain: lspDomain,
                });

                endLoading(btnRef.value);

                postData(
                    clientIframe,
                    { token: auth.token, origin: lspOrigin },
                    clientUrl
                );

                toast(response.message.text);
                Cookies.remove("currentCard");
                Cookies.remove("uniqueKey");

                const redirectPath = response.result.redirect_path;

                window.location.href = `${redirectPath}`;
                
            } else {
                endLoading(btnRef.value);
                toast(response.message.text, "danger");
                response.errors?.forEach((error) => {
                    actions.setFieldError(error.field, error.message);
                });
            }
        } catch (error) {
            console.error(error);
            endLoading(btnRef.value);
        }
    };
    const handleSubmitWithPassword = async (values, actions) => {
        const data = {
            password: values.password,
            unique_key: values.uniqueKey,
            auth_type: "password",
        };
        authRequest("post", authApi.AUTH, data, submitBtnRef, actions);
    };
    const sendToken = async (values) => {
        const unique_key = values.uniqueKey;
        try {
            startLoading(sendTokenBtnRef.value);
            sendTokenBtnRef.value.$el?.classList.add("spinner-left");
            const response = await post(authApi.SENDTOKEN, { unique_key });
            if (response.status) {
                endLoading(sendTokenBtnRef.value);
                sendTokenBtnRef.value.$el?.classList.remove("spinner-left");
                toast(response.message.text);
                if (values.retrivePass) {
                    goToCard("retrive_card", unique_key);
                } else {
                    goToCard("otpCard", unique_key);
                }
            } else {
                endLoading(sendTokenBtnRef.value);
                sendTokenBtnRef.value.$el?.classList.remove("spinner-left");
                toast(response.message.text, "danger");
            }
            return response;
        } catch (error) {
            console.log(error);
        }
    };
    return {
        handleSubmitWithPassword,
        sendToken,
        goToCard,
        authRequest,
    };
};
