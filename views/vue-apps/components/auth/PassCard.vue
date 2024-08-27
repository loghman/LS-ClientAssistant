<script setup>
import { defineProps, defineEmits, ref, defineComponent, computed } from "vue";
import { Form } from 'vee-validate';
import { createValidationSchema } from "./createValidation.js";
import { useAuthManagment } from "./useAuthManagment.js";
import Button from "./common/Button.vue";
import Label from "./common/Label.vue";
import InputGroup from "./common/InputGroup.vue";
import { useAuthStore } from "../../stores/authStore.js";

const props = defineProps({
    authTitle: String,
    priority1: Object,
    clientUrl: String,
    prevCard: String,
});
defineComponent({
    components: {
        Button,
    },
});
const sendTokenBtnRef = ref(null);
const uniqueKeyErrorMsg = ref('');
const {uniqueKey}=useAuthStore();
const labelText=`رمز عبور  ${uniqueKey}  را وارد کنید.`
const emit = defineEmits(["goToCard"]);
const goToCard =async (cardName) => {
     emit("goToCard", { cardName, uniqueKey });
}
const handleGoToCard= async (cardName)=>{
    if (cardName==='otpCard') {
      const response=  await sendToken({uniqueKey:uniqueKey});
      if (!response.status) {
        uniqueKeyErrorMsg.value=response.errors;
        return;
      }
     }
     emit("goToCard", { cardName, uniqueKey });

}
const goToRetrive = (data) => {
    emit("goToCard", { cardName:data.cardName, uniqueKey:data.uniqueKey });
}
const submitBtnRef = ref(null);
const otpBtnCard= computed(()=>{
    return props.priority1.authType === 'otp'?'priority_one_card':'otpCard'
})
const schema = createValidationSchema('password');
const { handleSubmitWithPassword,sendToken } = useAuthManagment(props.clientUrl,submitBtnRef, sendTokenBtnRef, goToCard);

function onInvalidSubmit() {
    toast("لطفا فرم را بادقت پر کنید.", 'warning');
}
</script>

<template>
    <Form @submit="(values,actions) => handleSubmitWithPassword({ ...values, uniqueKey: uniqueKey },actions)"
        :validation-schema="schema" @invalid-submit="onInvalidSubmit" class="card form-card" autocomplete="off">
        <div>
            <Button :notBtn="true" text="بازگشت" className="outlined sm hover-anim" @handleClick="goToCard(prevCard!=='retrive_card'?prevCard:'priority_one_card')"
                iconClass="si-arrow-right-r mb-0  fs-20"></Button>
            <div class="fields-frame pass-frame">
                <Label :text="labelText" iconClass="si-lock-2 mb-0 fs-22"></Label>
                <div class="auth-inputs">
                    <InputGroup @goToRetrive="goToRetrive" fieldName="password" type="password" labelText="رمز عبور" labelClass="right-30"></InputGroup>
                </div>
                <InputGroup fieldName="unique_key" :justErrorMessage="true"></InputGroup>
                <button ref="submitBtnRef" type="submit" class="btn-primary w-100 btn-submit">
                    <span>ادامه</span><i class="si-arrow-left-r"></i>
                </button>
                <Button  ref="sendTokenBtnRef" type="button" text="ورود با استفاده از کد یک بارمصرف" className="disabeled w-100 mt-2"
                    @click="handleGoToCard(otpBtnCard)" iconClass="si-comment-text-r mb-0  fs-20"></Button>
                    <div v-if="uniqueKeyErrorMsg" class="d-flex flex-column gap-1 justify-content-center">
                        <span v-for="error in uniqueKeyErrorMsg"  class="error-message">{{ error.message }}</span>
                    </div>

            </div>
        </div>
    </Form>
</template>
