<script setup>
import { defineProps, defineEmits, ref } from 'vue';
import { Form, Field, ErrorMessage, } from 'vee-validate';
import * as yup from 'yup';
import { post } from "@/assets/js/utilities/httpClient/httpClient";
import Cookies from "js-cookie";
import { endLoading, startLoading } from '@/assets/js/utilities/loading';
import { useToast } from "vue-toastification";
const toast = useToast();
const props = defineProps({
    uniqueKey: String,
    otpEnable: Boolean
});

const sendTokenBtnRef=ref(null);
const submitBtnRef=ref(null);
const schema = yup.object({
    password: yup.string().required('رمز عبور الزامی است.')
});

const emit = defineEmits(["goToCard"]);

const goToCard = (cardName) => {
    if (props.otpEnable) {
        emit("goToCard", cardName);
    } else {
        toast("otp not enable", "danger");
    }
};

const handleSubmit = async (values) => {
    const data={
        password: values.password,
        unique_key: props.uniqueKey,
        auth_type: "password"
    }
    try {
        startLoading(submitBtnRef.value);
        const response = await post("/v3/auth/auth", data);
        if (response.status !== false && response.status !== undefined) {
            Cookies.set("token", response.auth.token,{domain:"lsp.test"});
            endLoading(submitBtnRef.value);
            toast.success("شما با موفقیت لاگین شدین");
            const redirectPath = response.redirect_path;
            window.location.href = `${redirectPath}`;
          
        } else {
            endLoading(submitBtnRef.value);
            toast.error(response.message.text, "danger");
        }
    } catch (error) {
        console.error(error);
    }
};

 const sendToken = async (uniqueKey) => {
    try {
      startLoading(sendTokenBtnRef.value)
        const response = await post("/v3/auth/send-token",{unique_key:uniqueKey});
        if (response.status !== false) {
            endLoading(sendTokenBtnRef.value);
            toast.success("کد ارسال شد");
            goToCard('otpCard')
        } else {
            endLoading(sendTokenBtnRef.value);
            toast.error(response.message.text);
        }
    } catch (error) {
        console.log(error);
    }
};

</script>

<template>
  <Form  @submit="handleSubmit" :validation-schema="schema" class="card wizard-item">
    <div class="header d-flex align-items-center">
      <button @click="() => goToCard('preLogin')" type="button" class="icon sm lg white btn-circle wizard-cta m-0">
        <i class="si-arrow-right-r"></i>
      </button>
      <h3 class="card-heading">ورود به وبسایت</h3>
    </div>

    <div>
      <div class="inputs auth-inputs">
        <div class="input lg align-items-center">
          <Field name="password" type="password" class="ltr password-input"/>
            <label>رمز عبور</label>         
        </div>
        <ErrorMessage class="error-message" name="password" />
      </div>

      <button ref="submitBtnRef" type="submit" class="btn-primary w-100 btn-submit">
        <span>ورود</span><i class="si-arrow-left-r"></i>
      </button>

      <button ref="sendTokenBtnRef" @click="() =>sendToken(uniqueKey)" type="button" class="btn-outline-primary w-100">
        <i class='si-comment-text-r'></i>
        ارسال کد یک بارمصرف
      </button>
    </div>
  </Form>
</template>

<style scoped>
.password-input {
    border-left: solid 1px var(--input-group-child-border) !important;
}
</style>
