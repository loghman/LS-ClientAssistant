<script setup>
import { defineProps, defineEmits, ref, defineComponent, onMounted } from "vue";
import { Form,  ErrorMessage, Field } from 'vee-validate';
import { createRetriveValidationSchema } from "./createValidation.js";
import Button from "./common/Button.vue";
import OtpInputs from "./common/OtpInputs.vue";
import InputGroup from "./common/InputGroup.vue";
import { useOtpManagment } from "./useOtpManagment.js";
import { useAuthManagment } from "./useAuthManagment.js";
import { useAuthStore } from "../../stores/authStore.js";
import { authApi } from "@/js/utilities/apiPath.js";

const props = defineProps({
    cardName: String,
    prevCard: String,
    clientUrl: String,
});
const {uniqueKey}=useAuthStore();
const reSendTokenBtnRef = ref(null);
const otpCode = ref(Array(6).fill(''));
const code = ref('');
const submitBtnRef = ref(null);

defineComponent({
    components: {
        Button,
    },
});
const emit = defineEmits(["goToCard"]);
const goToCard = (cardName, uniqueKey) => {
    emit("goToCard", { cardName, uniqueKey });
}
const {countDownTimer,isBtnDisabled,startCountDown,resendCode}=useOtpManagment();
const {authRequest}=useAuthManagment(props.clientUrl);
const schema = createRetriveValidationSchema();

function onInvalidSubmit({values}) {
    toast("لطفا فرم را بادقت پر کنید.", 'warning');
}

const handleSetOtp=(data)=>{
    otpCode.value=data;
    code.value=otpCode.value.join('');
}

const handleSubmitForm= async (values)=>{
    const data = { ...values, unique_key: uniqueKey }
    authRequest('put',authApi.RETRIVEPASS,data,submitBtnRef)
}
onMounted(()=>{
    startCountDown()
})
</script>

<template>
    <Form autocomplete="off" @submit="(values) => handleSubmitForm(values)" 
        @invalid-submit="onInvalidSubmit" 
        :validation-schema="schema"
        class="card">
        <i class="icon si-lock-2-opened"></i>
        <div>
            <div class="header d-flex align-items-center">
           <Button text="بازگشت" className="outlined sm hover-anim" @handleClick="goToCard(prevCard)" iconClass="si-arrow-right-r mb-0  fs-20"></Button>
        </div>
            <div class="inputs auth-inputs">
                <div class="fields-frame">
                    <small class="t-small mt-neg-12 fs-12 text-warning">ابتدا کد فرستاده شده برای
                        ( {{ uniqueKey }} ) را وارد کنید</small>
                    <OtpInputs @setOtpcode="handleSetOtp"></OtpInputs>
                     <Field type="hidden"   name="code" v-model="code"/>
                    <ErrorMessage class="error-message" name="otp-code" />
                    <button :disabled="isBtnDisabled" ref="reSendTokenBtnRef" type="button" class="btn-outline-primary w-100 send-code" @click="resendCode(uniqueKey,reSendTokenBtnRef)">
                        <i class='si-comment-text-r'></i>
                        <span>دریافت مجدد (</span>
                        <span><span class="text-danger-85">{{ countDownTimer }}</span> ثانیه</span>
                        <span>)</span>
                    </button>
                    <small class="t-small">
                        سپس رمز عبور جدید را وارد کنید:
                    </small>
                    <InputGroup type="password" :showforgetButton="false"  fieldName="password" labelText="رمز عبور" ></InputGroup>

                    <InputGroup type="password" :showforgetButton="false" fieldName="repeat_password" labelText="تکرار رمز عبور"  ></InputGroup>

                    <button ref="submitBtnRef" type="submit" class="btn-primary w-100 btn-submit">
                        <span>ادامه</span><i class="si-arrow-left-r"></i>
                    </button>
                </div>
            </div>
        </div>
    </Form>
</template>

