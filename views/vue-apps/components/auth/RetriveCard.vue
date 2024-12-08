<script setup>
import {
  ref,
  defineComponent,
  onMounted,
  watch,
} from "vue";
import { Form, ErrorMessage, Field } from "vee-validate";
import { createRetriveValidationSchema } from "./createValidation.js";
import Button from "./common/Button.vue";
import InputGroup from "./common/InputGroup.vue";
import { useOtpManagment } from "./useOtpManagment.js";
import { useAuthManagment } from "./useAuthManagment.js";
import { useAuthStore } from "../../stores/authStore.js";
import { authApi } from "@/js/utilities/apiPath.js";
import OtpFields from "./common/OtpFields.vue";

const props = defineProps({
  cardName: String,
  prevCard: String,
});
const { uniqueKey } = useAuthStore();
const reSendTokenBtnRef = ref(null);
const code = ref("");
const submitBtnRef = ref(null);

defineComponent({
  components: {
    Button,
  },
});
const emit = defineEmits(["goToCard"]);
const goToCard = (cardName, uniqueKey) => {
  emit("goToCard", { cardName, uniqueKey });
};
const {
  countDownTimer,
  isBtnDisabled,
  startCountDown,
  resendCode,
  resetOtpInputs,
} = useOtpManagment();
const { authRequest } = useAuthManagment();
const schema = createRetriveValidationSchema();

const handleSetCode = (otp) => {
  code.value = otp;
};

function onInvalidSubmit() {
  toast("لطفا فرم را بادقت پر کنید.", "warning");
}

const handleSubmitForm = async (values) => {
  const data = { ...values, unique_key: uniqueKey };
  authRequest("put", authApi.RETRIVEPASS, data, submitBtnRef);
};
onMounted(() => {
  startCountDown();
});
watch(
  () => resetOtpInputs.value,
  () => {
    code.value = "";
  }
);
</script>

<template>
  <Form
    autocomplete="off"
    @submit="(values) => handleSubmitForm(values)"
    @invalid-submit="onInvalidSubmit"
    :validation-schema="schema"
    class="card form-card"
  >
    <i class="icon si-lock-2-opened"></i>
    <div>
      <div class="header d-flex align-items-center">
        <Button
          text="بازگشت"
          className="outlined sm hover-anim"
          @handleClick="goToCard(prevCard)"
          iconClass="si-arrow-right-r mb-0  fs-20"
        ></Button>
      </div>

      <div class="fields-frame">
        <div class="auth-inputs gap-3">
          <small class="t-small mt-neg-12 fs-12"
            >ابتدا کد فرستاده شده برای ( {{ uniqueKey }} ) را وارد کنید</small
          >
          <OtpFields @setOtpCode="handleSetCode" />
          <Field type="hidden" name="code" v-model="code" />
          <ErrorMessage class="error-message" name="otp-code" />
          <button
            :disabled="isBtnDisabled"
            ref="reSendTokenBtnRef"
            type="button"
            class="btn-outline-primary w-100 send-code"
            @click="resendCode(uniqueKey, reSendTokenBtnRef)"
          >
            <i class="si-comment-text-r"></i>
            <span>دریافت مجدد (</span>
            <span
              ><span class="text-danger-85 countdown-num">{{
                countDownTimer
              }}</span>
              ثانیه</span
            >
            <span>)</span>
          </button>
          <small class="t-small">
            پس از ورود کد بالا رمز جدیدتان را وارد نمایید:
          </small>
          <InputGroup
            type="password"
            :showforgetButton="false"
            fieldName="password"
            labelText="رمز عبور"
            labelClass="right-30"
          ></InputGroup>

          <InputGroup
            type="password"
            :showforgetButton="false"
            fieldName="repeat_password"
            labelText="تکرار رمز عبور"
            labelClass="right-30"
          ></InputGroup>

          <button
            ref="submitBtnRef"
            type="submit"
            class="btn-primary w-100 btn-submit"
          >
            <span>ادامه</span><i class="si-arrow-left-r"></i>
          </button>
        </div>
      </div>
    </div>
  </Form>
</template>
