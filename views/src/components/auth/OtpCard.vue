<script setup>
import { defineProps, defineEmits, ref } from 'vue';
import Cookies from "js-cookie";
import { Form } from 'vee-validate';
import { endLoading, startLoading } from '@/assets/js/utilities/loading';
import { post } from '@/assets/js/utilities/httpClient/httpClient';
import { toEnNumber } from '@/assets/js/utilities/common';
import { useToast } from "vue-toastification";
const toast = useToast();
const props = defineProps({
    uniqueKey: String
});
const reSendTokenBtnRef = ref(null);
const otpCode = ref(Array(6).fill(''));
const submitVerifFormBtn = ref(null);
const emit = defineEmits(["goToCard"]);

const goToCard = () => {
    emit("goToCard", "loginCard");
}

const handleInput = (value, index, e) => {
    const otpInputs = document.querySelectorAll('.jump-next');
    otpCode.value[index] = value;
    if (index < otpInputs.length - 1) {
        otpInputs[index + 1].focus();
    } else {
        const lastValue=(otpInputs[otpInputs.length - 1]).value;
        if (!lastValue) {
            return; 
        }
        handleSubmit();
    }

}
const handleBackspace = (value, index, e) => {
    const otpInputs = document.querySelectorAll('.jump-next');
    if (e.which === 8 && index > 0) {
        otpCode.value[index] = '';
        otpInputs[index - 1].focus();
        return;
    }
}

const handlePaste = (e) => {
    e.preventDefault();
    const clipboardData = e.clipboardData || window.clipboardData;
    const pastedText = clipboardData.getData('text');

    const digits = toEnNumber(pastedText).replace(/\D/g, '').split('').slice(0, 6);

    const otpInputs = document.querySelectorAll('.jump-next');

    for (let i = 0; i < Math.min(digits.length, otpInputs.length); i++) {
        otpCode.value[i] = digits[i];
    }

    otpInputs[Math.min(digits.length, otpInputs.length) - 1].focus();
    handleSubmit();
}

const handleSubmit = async () => {
    const otpValue = otpCode.value.join('');
    const data = { unique_key: props.uniqueKey, password: otpValue, auth_type: "otp" }
    try {
        startLoading(submitVerifFormBtn.value)
        const response = await post("/v3/auth/auth", data);
        if (response.status !== false) {
            Cookies.set("token", response.auth.token, { expires: 365 });
            endLoading(submitVerifFormBtn.value);
            toast.success("شما با موفقیت لاگین شدین");
            const redirectPath = response.redirect_path;
            window.location.href = `${redirectPath}`;
        } else {
            endLoading(submitVerifFormBtn.value);
            toast.error(response.message.text, "danger");
        }
    } catch (error) {
        console.log(error);
    }
}

const resendCode = async () => {
    try {
        startLoading(reSendTokenBtnRef.value)
        const response = await post("/v3/auth/send-token", { unique_key: props.uniqueKey });
        if (response.status !== false) {
            endLoading(reSendTokenBtnRef.value);
            toast.success("کد مجددا ارسال شد");
        } else {
            endLoading(reSendTokenBtnRef.value);
            toast.error(response.message.text, "danger");
        }
    } catch (error) {
        console.log(error);
    }
}

</script>

<template>
    <Form class="card wizard-item">
        <div class="header d-flex align-items-center">
            <button type="button" class="icon sm lg white btn-circle wizard-cta m-0" @click="goToCard">
                <i class="si-arrow-right-r"></i>
            </button>
            <h3 class="title">ثبت کد تایید</h3>
        </div>
        <div class="">
            <small class="t-small mt-neg-12">کد فرستاده شده برای
                ( <span class="user-login">{{ uniqueKey }}</span> ) را وارد کنید</small>
            <div class="inputs number ltr">
                <input v-for="(input, index) in Array(6).fill('')" :key="index" v-model="otpCode[index]" type="text"
                    inputmode="numeric" maxlength="1" class="text-center jump-next en-number" placeholder="-"
                    @input="(e) => handleInput(otpCode[index], index, e)" @paste="handlePaste"
                    @keyup="(e) => handleBackspace(otpCode[index], index, e)" />
            </div>
            <button ref="submitVerifFormBtn" type="button" class="btn-primary w-100 btn-submit" @click="handleSubmit">
                <span>ورود</span><i class="si-arrow-left-r"></i>
            </button>
            <button ref="reSendTokenBtnRef" type="button" class="btn-outline-primary w-100 send-code" @click="resendCode">
                <i class='si-comment-text-r'></i>
                <span>ارسال مجدد (</span>
                <span><span class="text-danger-85" data-start="120" data-jsc="countdown">120</span> ثانیه</span>
                <span>)</span>
            </button>
        </div>
    </Form>
</template>
