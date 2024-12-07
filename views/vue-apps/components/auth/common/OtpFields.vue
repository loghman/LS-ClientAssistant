<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import InputOtp from 'primevue/inputotp';
import { checkDeviceType } from '@/js/utilities/common';
const props = defineProps({
  fieldName: String,
});
const isMobileDevice = ref(false);
const otpCode = ref('');
const emit = defineEmits(['setOtpCode']);

const handleChangeOtp = (e) => {
    emit('setOtpCode',otpCode.value );
};
const handleKeyDown = (event) => {
  const isBackspace = event.key === 'Backspace';
  const currentInput = event.target;
  const currentIndex = [...currentInput.parentNode.children].indexOf(
    currentInput,
  );

  if (isBackspace && currentIndex > 0) {
    const previousInput = currentInput.parentNode.children[currentIndex - 1];

    if (currentInput.value === '') {
      previousInput.focus();

      event.preventDefault();
    } else {
      otpCode.value =
        otpCode.value.slice(0, currentIndex - 1) +
        otpCode.value.slice(currentIndex);
      currentInput.value = '';
      previousInput.focus();
      event.preventDefault();
    }
  } else if (isBackspace && currentIndex == 0) {
    currentInput.value = '';
  }
};
onMounted(() => {
  isMobileDevice.value = checkDeviceType();
  window.addEventListener('resize', checkDeviceType);
});
onUnmounted(() => {
  window.removeEventListener('resize', checkDeviceType);
});
</script>

<template>
  <div class="ltr">
    <InputOtp
      v-if="isMobileDevice"
      v-model="otpCode"
      @change="handleChangeOtp"
      @keydown="handleKeyDown"
      :length="6"
      integerOnly
    />
    <InputOtp v-else v-model="otpCode" @change="handleChangeOtp" :length="6" />
  </div>
</template>
