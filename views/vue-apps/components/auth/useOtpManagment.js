import { ref } from "vue";
import { post } from "@/assets/js/utilities/httpClient/httpClient";
import { endLoading, startLoading } from "@/assets/js/utilities/loading";
import { authApi } from "@/assets/js/utilities/apiPath";

export const useOtpManagment = () => {
    const countDownTimer = ref(120);
    const intervalId = ref(null);
    const resetOtpInputs = ref(false);
    const isBtnDisabled = ref(true);
    const startCountDown = () => {
        if (intervalId.value) {
            clearInterval(intervalId.value);
        }
        intervalId.value = setInterval(() => {
            if (countDownTimer.value > 0) {
                countDownTimer.value -= 1;
            } else {
                clearInterval(intervalId.value);
                isBtnDisabled.value = false;
            }
        }, 1000);
    };
    const clearOtpInterval=()=>{
        clearInterval(intervalId.value);
    }
    const resendCode = async (uniqueKey,reSendTokenBtnRef) => {
        resetOtpInputs.value=!resetOtpInputs.value;
        try {
            startLoading(reSendTokenBtnRef.value)
            const response = await post(authApi.SENDTOKEN, { unique_key: uniqueKey });
            if (response.status) {
                endLoading(reSendTokenBtnRef.value);
                toast("کد ورود، مجددا ارسال شد");
                countDownTimer.value=120;
                isBtnDisabled.value=true;
                startCountDown();
            } else {
                endLoading(reSendTokenBtnRef.value);
                toast(response.message.text, "danger");
            }
        } catch (error) {
            console.log(error);
        }
    }
    return {
        countDownTimer,resetOtpInputs,
        isBtnDisabled,startCountDown,resendCode,clearOtpInterval
    };
};
