<script setup>
import { defineProps, defineEmits } from "vue";
import { Form, Field, ErrorMessage } from 'vee-validate';
import { createValidationSchema } from "./createValidation";
import { useToast } from "vue-toastification";
const toast = useToast();
const props = defineProps({
    AuthLabel: String,
    loginFields: Array,
    uniqueKey: String,
    verifFields:String
});
const emit = defineEmits(["goToCard", "update:uniqueKey"]);

const schema = createValidationSchema(props.loginFields);

const onPreLoginSubmit = async (values) => {
    emit("update:uniqueKey",values[props.verifFields])
    emit("goToCard", "loginCard");
};
function onInvalidSubmit({ values, errors, results }) {
  toast.error("لطفا فرم را بادقت پر کنید.",'warrning')
}
</script>

<template>
    <Form @submit="onPreLoginSubmit" :validation-schema="schema" @invalid-submit="onInvalidSubmit" class="card">
        <i class="icon si-tablet-r"></i>
        <h3 class="title">{{ AuthLabel }}</h3>
        <div class="">
            <div class="inputs auth-inputs" v-for="field in loginFields">
                <div class="input lg">
                    <Field :name="field.name" class="ltr en-number" />
                    <label>{{ field.configs.label }}</label>
                </div>
                <ErrorMessage class="error-message" :name="field.name" />
            </div>
            <button type="submit" class="btn-primary w-100">
                <span>ورود</span><i class="si-arrow-left-r"></i>
            </button>
        </div>
    </Form>
</template>
