<script setup>
import { defineEmits, onMounted, ref, watch } from 'vue';

const props = defineProps({
    otpCode: String,
    resetOtpInputs:Boolean
});
const emit= defineEmits(['setOtpcode']);
const otpCode = ref(Array(6).fill(''));
const otpInputsRef = ref([]);
const otpInputsLength=ref(0);
const handleSetOtp=()=>{
    emit("setOtpcode",otpCode.value)
}

const handleInput = (value, index, e) => {
    otpCode.value[index] = value;
    if (index < otpInputsLength.value - 1) {
        otpInputsRef.value[index + 1].focus();
    } else {
        const lastValue = $(otpInputsRef.value[otpInputsLength.value - 1]).val();
        if (!lastValue) {
            return;
        }
        handleSetOtp();
    }

}
const handleBackspace = (value, index, e) => {
    if (e.which === 8 && index > 0) {
        otpCode.value[index] = '';
        otpInputsRef.value[index - 1].focus();
        return;
    }
}

const handlePaste = (e) => {
    e.preventDefault();
    const clipboardData = e.clipboardData || window.clipboardData;
    const pastedText = clipboardData.getData('text');

    const digits = (pastedText).replace(/\D/g, '').split('').slice(0, 6);
    const minNum=Math.min(digits.length, otpInputsLength.value);

    for (let i = 0; i < minNum ; i++) {
        otpCode.value[i] = digits[i];
    }

    otpInputsRef.value[minNum - 1].focus();
    handleSetOtp();
}
watch(()=>props.resetOtpInputs,(prev)=>{
    otpCode.value=Array(6).fill('');
})
// Focus on the first input field when the component mounts
onMounted(() => {
    if (otpInputsRef.value.length> 0) {
        otpInputsRef.value[0].focus();
        otpInputsLength.value=otpInputsRef.value.length;
    }
});
</script>

<template>
    <div class="inputs number ltr">
        <input ref="otpInputsRef" autocomplete="off" v-for="(input, index) in Array(6).fill('')" :key="index" v-model="otpCode[index]" type="text"
            inputmode="numeric" maxlength="1" class="text-center jump-next en-number" placeholder="-"
            @input="(e) => handleInput(otpCode[index], index, e)" @paste="handlePaste"
            @keyup="(e) => handleBackspace(otpCode[index], index, e)" />
    </div>
</template>
