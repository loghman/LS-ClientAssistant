<script setup>
import {
  ref,
  onMounted,
  onUnmounted,
  watch,
} from "vue";
import { endLoading, startLoading } from "@/js/utilities/loading";
import { post } from "@/js/utilities/httpClient/httpClient";
import Cookies from "js-cookie";
import { Form } from "vee-validate";
import { authApi } from "@/js/utilities/apiPath";
import { lspDomain } from "./useAuth";
import Button from "./common/Button.vue";
import { useOtpManagment } from "./useOtpManagment";
import { useAuthStore } from "../../stores/authStore";
import { deleteTokenCookies } from "@/js/utilities/logout";
import OtpFields from "./common/OtpFields.vue";
import { toastErrorMessages } from "@/js/utilities/error-handler";
import { toastSuccessMessage } from "@/js/utilities/success-handler";

const props = defineProps({
  prevCard: String,
  help: String,
});
const { expireAt, uniqueKey } = useAuthStore();
const reSendTokenBtnRef = ref(null);
const otpCode = ref("");
const submitVerifFormBtn = ref(null);
const emit = defineEmits(["goToCard"]);
const pathName = window.location.pathname;

const {
  countDownTimer,
  resetOtpInputs,
  isBtnDisabled,
  startCountDown,
  resendCode,
  clearOtpInterval,
} = useOtpManagment();
const goToCard = (cardName, uniqueKey, verifideField) => {
  emit("goToCard", { cardName, uniqueKey, verifideField });
};

const handleSetOtp = (otp) => {
  otpCode.value = otp;
  if (otpCode.value.length === 6) {
    handleSubmit();
  }
};

const handleSubmit = async () => {
  const otpValue = otpCode.value;
  const data = { unique_key: uniqueKey, password: otpValue, auth_type: "otp" };
  try {
    startLoading(submitVerifFormBtn.value);
    const response = await post(authApi.AUTH, data);
    if (response.status === true) {
      if (props.prevCard === "onboarding_card") {
        goToCard("onboarding_card", "", uniqueKey);
        toast("تایید شد");
        return;
      }

      deleteTokenCookies();
      Cookies.set("token", response.result.auth.token, {
        expires: expireAt,
        domain: lspDomain,
      });
      endLoading(submitVerifFormBtn.value);
      toastSuccessMessage(response);
      Cookies.remove("currentCard");
      Cookies.remove("uniqueKey");
      const redirectPath = response.result.redirect_path;
      if (pathName.includes("/pwa/auth")) {
        window.location.href = getBackUrl();
      } else {
        window.location.href = getBackUrl();
      }
    } else {
      endLoading(submitVerifFormBtn.value);
      toastErrorMessages(response);
    }
  } catch (error) {
    console.log(error);
  }
};

onMounted(() => {
  startCountDown();
});
onUnmounted(() => {
  clearOtpInterval();
});
watch(
  () => resetOtpInputs.value,
  () => {
    otpCode.value = "";
  }
);
</script>

<template>
  <Form autocomplete="off" class="card form-card">
    <div class="header d-flex align-items-center">
      <Button text="بازگشت" className="outlined sm hover-anim" @handleClick="goToCard(prevCard)"
        iconClass="si-arrow-right-r mb-0  fs-20"></Button>
    </div>
    <div class="fields-frame">
      <small class="t-small mt-neg-12">کد فرستاده شده برای
        <span class="user-login"> {{ uniqueKey }} </span> را وارد کنید</small>
      <OtpFields @setOtpCode="handleSetOtp" />

      <button ref="submitVerifFormBtn" type="button" class="btn-primary w-100 btn-submit" @click="handleSubmit">
        <span>ادامه</span><i class="si-arrow-left-r"></i>
      </button>
      <button :disabled="isBtnDisabled" ref="reSendTokenBtnRef" type="button"
        class="btn-outline-primary w-100 send-code" @click="resendCode(uniqueKey, reSendTokenBtnRef)">
        <i class="si-comment-text-r"></i>
        <span>ارسال مجدد (</span>
        <span><span class="text-danger-85 countdown-num">{{
          countDownTimer
        }}</span>
          ثانیه</span>
        <span>)</span>
      </button>

      <Button v-if="prevCard === 'priority_one_card'" text="ورود با رمز ثابت" className="disabeled w-100 mt-2"
        @handleClick="goToCard('pass_card')" iconClass="si-arrow-left-r mb-0  fs-20"></Button>

      <small v-if="props.help" class="help-text">
        {{ props.help }}
      </small>
    </div>
  </Form>
</template>
