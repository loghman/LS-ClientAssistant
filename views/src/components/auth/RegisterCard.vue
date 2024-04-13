<script setup>
import { defineComponent, defineProps, onMounted,ref } from 'vue';
import { Form, Field, ErrorMessage, } from 'vee-validate';
import Cookies from "js-cookie";
import { endLoading, startLoading } from '@/assets/js/utilities/loading';
import { post } from '@/assets/js/utilities/httpClient/httpClient';
import { createValidationSchema } from './createValidation';

defineComponent({
    components: {
    }
})
const props = defineProps({
    regisFields: Array,
    verifFields:String,
    activeTab:Number
});
const submitRegisRef=ref(null);
const schema=createValidationSchema(props.regisFields);



const handleSubmit=async (values)=>{
   
    const data={
    unique_key: values[props.verifFields],
    password: values.password,
    auth_type: "password",
    display_name: values.display_name
}
    try {
        startLoading(submitRegisRef.value);
        const response = await post("/v3/auth/register", data);
        if (response.status !== false) {
            Cookies.set("token", response.auth.token);
            endLoading(submitRegisRef.value);
            toast("شما با موفقیت ثبت نام شدین");
            const redirectPath = response.redirect_path;
            window.location.href = `${redirectPath}`;
        } else {
            endLoading(submitRegisRef.value);
            toast(response.message.text, "danger");
        }
    } catch (error) {
        console.log(error);
    }
}

</script>

<template>
    <Form @submit="handleSubmit" :validation-schema="schema" class="content tab-content" :class="[activeTab==2?'active':'']">

        <i class="icon si-tablet-r"></i>
        <h3 class="title">ثبت نام</h3>

        <div class="inputs auth-inputs" v-for="field in regisFields">
            <div class="input lg">
                <Field :type="field.name" class="ltr " :name="field.name"  autocomplete="new"/>
                <label>{{ field.configs.label }}</label>
            </div>
            <ErrorMessage class="error-message" :name="field.name" />
        </div>
        
        <button ref="submitRegisRef" type="submit" class="btn-primary w-100 btn-submit">
            <span>ثبت نام</span><i class="si-arrow-left-r"></i>
        </button>

    </Form>
</template>
