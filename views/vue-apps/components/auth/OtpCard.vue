<script setup>
import { defineProps, defineEmits, ref, onMounted, onUnmounted } from 'vue';
import { endLoading, startLoading } from "@/js/utilities/loading";
import { post } from "@/js/utilities/httpClient/httpClient";
import Cookies from "js-cookie";
import { Form } from 'vee-validate';
import { authApi } from '@/js/utilities/apiPath';
import { postData } from '@/js/utilities/common';
import { lspDomain, lspOrigin } from './useAuth';
import Button from './common/Button.vue';
import { useOtpManagment } from './useOtpManagment';
import OtpInputs from './common/OtpInputs.vue';
import { useAuthStore } from '../../stores/authStore';
import { deleteTokenCookies } from '@/js/utilities/logout';
const clientIframe=document.getElementById('client_iframe');
const props = defineProps({
    prevCard: String,
    clientUrl: String,
    help: String,
});
const {expireAt,uniqueKey}=useAuthStore();
const reSendTokenBtnRef = ref(null);
const otpCode = ref(Array(6).fill(''));
const submitVerifFormBtn = ref(null);
const emit = defineEmits(["goToCard"]);
const {countDownTimer,resetOtpInputs,isBtnDisabled,startCountDown,resendCode,clearOtpInterval}=useOtpManagment()
const goToCard = (cardName,uniqueKey,verifideField) => {
    emit("goToCard", {cardName,uniqueKey,verifideField});
}

const handleSetOtp=(data)=>{
    otpCode.value=data;
    handleSubmit()
}
const handleSubmit = async () => {
    const otpValue = otpCode.value.join('');
    const data = { unique_key: uniqueKey, password: otpValue, auth_type: "otp" }
    try {
        startLoading(submitVerifFormBtn.value)
        const response = await post(authApi.AUTH, data);
        if (response.status) {
            if(props.prevCard==='onboarding_card'){
               goToCard('onboarding_card','',uniqueKey);
               toast("تایید شد"); 
               return
            }

            deleteTokenCookies()
            Cookies.set("token", response.result.auth.token,{expires: expireAt,domain:lspDomain});
            endLoading(submitVerifFormBtn.value);
            postData(clientIframe,{token:response.result.auth.token,origin:lspOrigin},props.clientUrl)   
            toast(response.message.text);
            Cookies.remove("currentCard");
            Cookies.remove("uniqueKey");
            const redirectPath = response.result.redirect_path;
            window.location.href = `${redirectPath}`;
        } else {
            endLoading(submitVerifFormBtn.value);
            toast(response.message.text, "danger");
        }
    } catch (error) {
        console.log(error);
    }
}

onMounted(()=>{
    startCountDown()
})
onUnmounted(()=>{
    clearOtpInterval()
})
</script>

<template>
    <Form autocomplete="off" class="card wizard-item">
        <div class="header d-flex align-items-center">
            <Button text="بازگشت" className="outlined sm hover-anim" @handleClick="goToCard(prevCard)" iconClass="si-arrow-right-r mb-0  fs-20"></Button>
        </div>
        <div class="fields-frame">
            <small class="t-small mt-neg-12">کد فرستاده شده برای
                ( <span class="user-login">{{ uniqueKey }}</span> ) را وارد کنید</small>
            <OtpInputs @setOtpcode="handleSetOtp" :resetOtpInputs="resetOtpInputs"></OtpInputs>
            <button ref="submitVerifFormBtn" type="button" class="btn-primary w-100 btn-submit" @click="handleSubmit">
                <span>ادامه</span><i class="si-arrow-left-r"></i>
            </button>
            <button :disabled="isBtnDisabled" ref="reSendTokenBtnRef" type="button" class="btn-outline-primary w-100 send-code" @click="resendCode(uniqueKey,reSendTokenBtnRef)">
                <i class='si-comment-text-r'></i>
                <span>ارسال مجدد (</span>
                <span><span class="text-danger-85">{{ countDownTimer }}</span> ثانیه</span>
                <span>)</span>
            </button>
            
            <Button v-if="prevCard==='priority_one_card'" text="ورود با رمز ثابت" className="disabeled w-100 mt-2" @handleClick="goToCard('pass_card')"
                iconClass="si-arrow-left-r mb-0  fs-20"></Button> 

            <small v-if="props.help" class="help-text">
                {{ props.help }}
            </small>
        </div>
    </Form>
</template>
