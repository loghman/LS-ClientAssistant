<script setup>
import { defineEmits, ref, watch } from 'vue';

const props = defineProps({
    otpCode: String,
    resetOtpInputs:Boolean
});
const emit= defineEmits(['setOtpcode']);
const otpCode = ref(Array(6).fill(''));
const handleSetOtp=()=>{
    emit("setOtpcode",otpCode.value)
}

const handleInput = (value, index, e) => {
    const otpInputs = document.querySelectorAll('.jump-next');
    otpCode.value[index] = value;
    if (index < otpInputs.length - 1) {
        otpInputs[index + 1].focus();
    } else {
        const lastValue = $(otpInputs[otpInputs.length - 1]).val();
        if (!lastValue) {
            return;
        }
        handleSetOtp();
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

    const digits = (pastedText).replace(/\D/g, '').split('').slice(0, 6);

    const otpInputs = document.querySelectorAll('.jump-next');

    for (let i = 0; i < Math.min(digits.length, otpInputs.length); i++) {
        otpCode.value[i] = digits[i];
    }

    otpInputs[Math.min(digits.length, otpInputs.length) - 1].focus();
    handleSetOtp();
}
watch(()=>props.resetOtpInputs,(prev)=>{
    otpCode.value=Array(6).fill('');
})
</script>

<template>
    <div class="inputs number ltr">
        <input autocomplete="off" v-for="(input, index) in Array(6).fill('')" :key="index" v-model="otpCode[index]" type="text"
            inputmode="numeric" maxlength="1" class="text-center jump-next en-number" placeholder="-"
            @input="(e) => handleInput(otpCode[index], index, e)" @paste="handlePaste"
            @keyup="(e) => handleBackspace(otpCode[index], index, e)" />
    </div>
</template>
