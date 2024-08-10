<script setup>
import { Field, ErrorMessage } from 'vee-validate';
import { onMounted, ref } from 'vue';
import { useAuthManagment } from '../useAuthManagment';
import { useAuthStore } from '../../../stores/authStore';


const props = defineProps({
    fieldName: String,
    type: String,
    labelText: String,
    iconClass: String,
    labelClass: String,
    priority: String,
    showforgetButton: {
        Boolean,
        default: true
    },
    justErrorMessage: {
        Boolean,
        default: false
    },
    hasErrorField: {
        Boolean,
        default: true
    }

});
const { uniqueKey } = useAuthStore();
const showPass = ref('si-eye-r');
const fieldValInit = uniqueKey;
const fieldVal = ref(fieldValInit)
const sendTokenBtnRef = ref(null);
const inputRef = ref(null);
const handleShowPass = () => {
    showPass.value = showPass.value === 'si-eye-r' ? 'si-eye-slash-r' : 'si-eye-r'
}
const emit = defineEmits(["goToRetrive"]);
const goToCard = (cardName, uniqueKey) => {
    emit("goToRetrive", { cardName, uniqueKey });
}
const { sendToken } = useAuthManagment('', '', sendTokenBtnRef, goToCard);

const handleGoToRetriveCard = () => {
    if (props.priority === 'password') {
        if (fieldVal.value.trim().length<=1) {
            toast("موبایل یا ایمیل خود را وارد نمایید و سپس دکمه فراموش کردم را بزنید.", "danger")
            return
        }
        sendToken({ uniqueKey: fieldVal.value, retrivePass: true })
    } else {
        sendToken({ uniqueKey: uniqueKey, retrivePass: true })
    }
}
onMounted(() => {
    if (inputRef.value) {
        inputRef.value.focus();
    }
})
</script>

<template>
    <div v-if="!justErrorMessage" class="input auth-field lg">
        <i v-if="iconClass" class="icon d-none d-sm-inline" :class="iconClass"></i>
        <template v-if="type === 'password'">
            <i @click="handleShowPass" class="icon pass-icon  fs-20" :class="showPass"></i>
            <Field autocomplete="new-password" :name="fieldName" :type="showPass === 'si-eye-r' ? 'password' : 'text'"
                class="ltr en-number" />
        </template>
        <Field v-else :name="fieldName" v-model="fieldVal" v-slot="{ field }">
            <input v-bind="field" :type="type" autocomplete="off" ref="inputRef" class="field-input ltr en-number" />
        </Field>
        <label class="field-label" :class="labelClass">{{ labelText }}</label>
        <a v-if="showforgetButton" ref="sendTokenBtnRef" @click="handleGoToRetriveCard" className="btn i-forget">
            فراموش کردم
        </a>
    </div>
    <ErrorMessage v-if="hasErrorField" class="error-message" :name="fieldName" />
</template>