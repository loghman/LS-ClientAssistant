// useAuth.js
import { post, put, get } from "@/js/utilities/httpClient/httpClient.js";
import Cookies from "js-cookie";
import { endLoading, startLoading } from "@/js/utilities/loading.js";
import { postData } from "@/js/utilities/common.js";
import { authApi } from "@/js/utilities/apiPath.js";
import { lspDomain, lspOrigin, showIframe } from "./useAuth.js";
import { useAuthStore } from "../../stores/authStore.js";
import { messages } from "@/js/utilities/static-messages.js";
import { deleteTokenCookies } from "@/js/utilities/logout.js";
import { ref } from "vue";
import { toastSuccessMessage } from "@/js/utilities/success-handler.js";
import { toastErrorMessages } from "@/js/utilities/error-handler.js";
export const useAuthManagment = (
  clientUrl,
  submitBtnRef,
  sendTokenBtnRef,
  goToCard
) => {
  const clientIframe = document.getElementById("client_iframe");
  const { expireAt } = useAuthStore();
  const pathName = window.location.pathname;
  const checkLoginLoading = ref(false);
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

        deleteTokenCookies();

        Cookies.set("token", auth.token, {
          expires: expireAt,
          domain: lspDomain,
        });

        endLoading(btnRef.value);

        if (showIframe) {
          postData(
            clientIframe,
            { token: auth.token, origin: lspOrigin },
            clientUrl
          );
        }

        toastSuccessMessage(response);
        Cookies.remove("currentCard");
        Cookies.remove("uniqueKey");

        const redirectPath = response.result.redirect_path;

        if (pathName.includes("/pwa/auth")) {
          window.location.href = "/pwa/dashboard";
        } else {
          window.location.href = `${redirectPath}`;
        }
      } else {
        endLoading(btnRef.value);
        toastErrorMessages(response);
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
        toastSuccessMessage(response);
        if (values.retrivePass) {
          goToCard("retrive_card", unique_key);
        } else {
          goToCard("otpCard", unique_key);
        }
      } else {
        endLoading(sendTokenBtnRef.value);
        sendTokenBtnRef.value.$el?.classList.remove("spinner-left");
        toastErrorMessages(response);
      }
      return response;
    } catch (error) {
      console.log(error);
    }
  };
  const checkLogin = async () => {
    const token = Cookies.get("token");
    if (token && pathName.includes("/pwa/auth")) {
      try {
        checkLoginLoading.value = true;
        const userInfo = await get(authApi.PROFILE);
        if (userInfo.status) {
          window.location.href = "/pwa/dashboard";
        } else {
          toast(messages.LOGIN_AGAIN, "danger");
          deleteTokenCookies();
          window.location.href = "/pwa/auth";
          checkLoginLoading.value = false;
        }
      } catch (error) {
        console.log(error);
      }
    }
  };
  return {
    handleSubmitWithPassword,
    sendToken,
    goToCard,
    checkLoginLoading,
    authRequest,
    checkLogin,
  };
};
