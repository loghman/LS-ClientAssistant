<script setup>
import { defineProps, defineEmits, ref } from "vue";
import { Form, Field, ErrorMessage } from 'vee-validate';
import {  createValidationSchema } from "./createValidation.js";
import { useAuthManagment } from "./useAuthManagment.js";
import Button from "./common/Button.vue";
import InputGroup from "./common/InputGroup.vue";

const props = defineProps({
    authTitle: String,
    priority2: Object,
    clientUrl: String,
});

const sendTokenBtnRef = ref(null);
const submitBtnRef = ref(null);

const emit = defineEmits(["goToCard"]);

const schema = createValidationSchema(props.priority2);

const goToCard = (cardName, uniqueKey) => {
    emit("goToCard", { cardName, uniqueKey });
}

const { sendToken } = useAuthManagment(props.clientUrl, submitBtnRef, sendTokenBtnRef, goToCard);
const handleGoToPassCard=(values)=>{
    goToCard('pass_card',values.uniqueKey)
}
function onInvalidSubmit({ values, errors, results }) {
    toast("لطفا فرم را بادقت پر کنید.",'warning');
}
</script>

<template>
    <Form v-if="priority2.authType === 'password'" @submit="(values) => handleGoToPassCard(values)"
        @invalid-submit="onInvalidSubmit" :validation-schema="schema" class="card" autocomplete="off">
        <i class="icon si-tablet-r"></i>
        <h3 class="title">{{ authTitle }}</h3>
        <div class="fields-frame">
            <div class="inputs auth-inputs">
                <InputGroup fieldName="uniqueKey" :labelText="priority2.field.configs.placeholder" iconClass="si-user-r fs-20"></InputGroup>
            </div>
            <button ref="submitBtnRef" type="submit" class="btn-primary w-100 btn-submit">
                <span>ورود</span><i class="si-arrow-left-r"></i>
            </button>
            <small v-if="priority2.help" class="help-text">
                {{ priority2.help }}
            </small>
        </div>
    </Form>
    <Form v-if="priority2.authType === 'otp'" @submit="(values) => sendToken(values)" @invalid-submit="onInvalidSubmit"
        :validation-schema="schema" class="card">
        <i class="icon si-tablet-r"></i>
        <h3 class="title">{{ authTitle }}</h3>
        <div class="fields-frame">
            <div class="inputs auth-inputs">
                <InputGroup fieldName="uniqueKey" :showforgetButton="false" :labelText="priority2.field.configs.label" iconClass="si-user-r fs-20"></InputGroup>
            </div>
            <Button ref="sendTokenBtnRef" type="submit" text="ورود" className="btn-primary w-100"
            iconClass="si-comment-text-r mb-0  fs-20"></Button>
            <Button text="ورود با رمز ثابت" className="disabeled w-100"
            @handleClick="goToCard('priority_one_card')" iconClass="si-arrow-left-r mb-0  fs-20"></Button>
            <small v-if="priority2.help" class="help-text">
                {{ priority2.help }}
            </small>
        </div>
    </Form>
</template>

