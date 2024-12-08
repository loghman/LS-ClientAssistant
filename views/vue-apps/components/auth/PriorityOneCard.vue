<script setup>
import { ref } from "vue";
import { Form } from 'vee-validate';
import { createValidationSchema } from "./createValidation.js";
import { useAuthManagment } from "./useAuthManagment.js";
import Button from "./common/Button.vue";
import InputGroup from "./common/InputGroup.vue";
import FormHeader from "./common/FormHeader.vue";

const props = defineProps({
    authTitle: String,
    priority1: Object,
});

const emit = defineEmits(["goToCard"]);

const submitBtnRef = ref(null);
const sendTokenBtnRef = ref(null);

const schema = createValidationSchema(props.priority1);

const goToCard = (cardName, uniqueKey) => {
    emit("goToCard", { cardName, uniqueKey });
}
const goToRetrive = (data) => {
    emit("goToCard", { cardName: data.cardName, uniqueKey: data.uniqueKey });
}
const { sendToken } = useAuthManagment(submitBtnRef, goToCard);
const handleGoToPassCard = (values) => {
    goToCard('pass_card', values.uniqueKey)
}
function onInvalidSubmit() {
    toast("لطفا فرم را بادقت پر کنید.", 'warning');
}

</script>

<template>
    <Form v-if="priority1.authType === 'otp'" @submit="(values) => sendToken(values,sendTokenBtnRef.buttonRef)" @invalid-submit="onInvalidSubmit"
        :validation-schema="schema" class="card form-card" autocomplete="off">
        <!-- :title="authTitle" -->
        <FormHeader></FormHeader>
        <div class="fields-frame">
            <div class="auth-inputs">
                <InputGroup fieldName="uniqueKey" :showforgetButton="false" :labelText="priority1.field.configs.label"
                    iconClass="si-user-r fs-20"></InputGroup>
            </div>
            <Button ref="sendTokenBtnRef" type="submit" text="ورود" className="btn-primary w-100"
                iconClass="si-comment-text-r mb-0  fs-20"></Button>
        </div>
    </Form>
    <Form v-else @submit="(values) => handleGoToPassCard(values)" :validation-schema="schema"
        @invalid-submit="onInvalidSubmit" class="card form-card">
        <!-- :title="authTitle" -->
        <FormHeader></FormHeader>
        <div class="fields-frame">
            <div class="auth-inputs">
                <!-- :labelText="priority1.field.configs.placeholder" -->
                <InputGroup  :priority="priority1.authType" fieldName="uniqueKey"  @goToRetrive="goToRetrive" labelText="مثلا:09123456789" iconClass="si-user-r fs-20"></InputGroup>
            </div>

            <button ref="submitBtnRef" type="submit" class="btn-primary w-100 btn-submit">
                <span>ورود</span><i class="si-arrow-left-r"></i>
            </button>
        </div>
    </Form>
</template>
