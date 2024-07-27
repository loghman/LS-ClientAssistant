<script setup>
import { defineProps, ref, defineComponent, computed, onMounted, watch } from "vue";
import { Form, Field, ErrorMessage } from 'vee-validate';
import { authApi, publicApi } from "@/assets/js/utilities/apiPath.js";
import { post, put } from "@/assets/js/utilities/httpClient/httpClient.js";
import { endLoading, startLoading } from "@/assets/js/utilities/loading.js";
import DatePicker from 'vue3-persian-datetime-picker';
import { createFieldsValidationSchema } from "./createValidation.js";
import AutoComplete from "primevue/autocomplete";
import { useOnboardingManagment } from "./useOnboardingManagment.js";
import { exposedEnvVariables, URLS } from "./useAuth.js";
import axios from "axios";
import InputGroup from "./common/InputGroup.vue";

defineComponent({
    components: {
        DatePicker, AutoComplete,InputGroup
    }
});
const props = defineProps({
    registrationFields: Object,
    userInfo: Object,
    apiKey: String,
    currentVerifideField: String
});
const customAxios = axios.create({
  baseURL: exposedEnvVariables.API_BASE_URL.replace('/api', ''), // Set your base URL here
});
const emit = defineEmits(["goToCard"]);

const goToCard = (cardName, uniqueKey) => {
    emit("goToCard", { cardName, uniqueKey });
};
const schema = createFieldsValidationSchema(props.registrationFields);
const submitBtnRef = ref(null);
const confirmEmailBtn = ref(null);
const confirmMobileBtn = ref(null);
const date = ref('');
const mobile = ref('');
const password = ref('');
const email = ref('');
const isEmailVerified = ref(false);
const isMobileVerified = ref(false);
const file = ref(null);
const fileInput = ref(null);
const selectedGender = ref('');
const selectedCity = ref();
const cityCode = ref(0)
const genders = ref([
    { name: 'مرد', code: 'm' },
    { name: 'زن', code: 'f' },
]);
const cities = ref([]);
const citiesList = ref([]);
const excludedFields = ['avatar_url', 'birth_date', 'gender', 'mobile', 'email', 'city', 'password'];
const shouldShowField = computed(() => field => !excludedFields.includes(field.name));
const { handleUploadFile, avatarUrl, uploadPercent } = useOnboardingManagment(props.apiKey);

const handleSelectGender = (e) => {
    selectedGender.value = e.target.value;
};
const handleAvatarChange = async (event) => {
    file.value = event.target.files[0];
    if (file.value) {
        await handleUploadFile(file.value, props.userInfo.id, 'users');
        resetFileInput()
    }
};
const resetFileInput = () => {
    if (fileInput.value) {
        fileInput.value.value = '';
    }
};
const handleSubmitForm = async (values, actions) => {
    try {
        startLoading(submitBtnRef.value);
        const response = await put(authApi.ONBOARDING, values);
        if (response.status) {
            endLoading(submitBtnRef.value);
            toast(response.message.text);
            let redirectPath = response.result.redirect_path;
            if (redirectPath == undefined) {
                redirectPath = URLS.APP_URL;
            }
            window.location.href = `${redirectPath}`;
        } else {
            endLoading(submitBtnRef.value);
            toast(response.message.text, "danger");
            response.errors.forEach(error => {
                actions.setFieldError(error.field, error.message)
            });
        }
    } catch (error) {
        console.log(error);
    }
};
const sendToken = async (uniqueKey) => {
    const unique_key = uniqueKey;
    try {
        const response = await post(authApi.SENDTOKEN, { unique_key });
        if (response.status) {
            endLoading(confirmEmailBtn.value);
            endLoading(confirmMobileBtn.value);
            toast("کد ارسال شد");
            goToCard('otpCard', unique_key);
        } else {
            endLoading(confirmEmailBtn.value);
            endLoading(confirmMobileBtn.value);
            toast(response.message.text, "danger");
        }
    } catch (error) {
        console.log(error);
    }
};
const handleConfirmMobile = (e) => {
    e.preventDefault();
    startLoading(confirmMobileBtn.value);
    sendToken(mobile.value);
};
const handleConfirmEmail = (e) => {
    e.preventDefault();
    startLoading(confirmEmailBtn.value);
    sendToken(email.value);
};
const searchCities = async (event) => {
    try {
        const response = await customAxios.get(publicApi.GETCITIES, { params: { s: event.query } });
        if (response.data.success) {
            citiesList.value = response.data.data.data.data;
            cities.value = response.data.data.data.data.map(item => {
                return item.value;
            });
        } else {
            toast('خطا', 'danger');
        }
    } catch (error) {
        console.error(error);
    }
};

onMounted(() => {
    const { birth_date, email: userEmail, mobile: userMobile, gender, city, email_verified, mobile_verified, avatar_url } = props.userInfo;
    if (props.userInfo) {
        date.value = birth_date?.main;
        email.value = userEmail ? userEmail : '';
        mobile.value = userMobile ? userMobile : '';
        selectedGender.value = gender ? gender : '';
        cityCode.value = city ? city :null;
        isEmailVerified.value = email_verified;
        isMobileVerified.value = mobile_verified;
        avatarUrl.value = avatar_url?.main.url;
    }
});
watch(selectedCity, (newCity) => {
    if (newCity) {
        const c = citiesList.value.find((c) => c.value == newCity);
        cityCode.value = c ? c.key : undefined;
    }
});
watch(() => props.currentVerifideField, (newVal) => {
    if (newVal === email.value) {
        isEmailVerified.value = true;
    } else if (newVal === mobile.value) {
        isMobileVerified.value = true;
    }
});
</script>

<template>
    <Form @submit="handleSubmitForm" :validation-schema="schema" class="card">
        <div class="alert light">کاربر گرامی جهت استفاده از خدمات سایت باید اطلاعات حساب کاربری خود را تکمیل کنید.</div>
        <div class="fields-container">
            <div v-for="(field, index) in registrationFields" :key="index" class="inputs auth-inputs">
                <div v-if="field.name === 'gender'" class="input-group">
                    <label for="gender">{{ field.configs.label ?? 'جنسیت' }}</label>
                    <select @change="handleSelectGender" name="gender" id="gender" class="select-gender">
                        <option v-for="gender in genders" :key="gender.code"
                            :selected="gender.code === selectedGender ? true : false" :value="gender.code">{{
                                gender.name }}
                        </option>
                    </select>
                    <field name="gender" type="hidden" v-model="selectedGender" />

                </div>
                <div v-if="field.name === 'city'" class="input-group city-input">
                    <AutoComplete class="px-0" option-label="name" v-model="selectedCity" :suggestions="cities"
                        @complete="searchCities" placeholder="جستجوی شهر...">
                        <template #option="slotProps">
                            <div class="d-flex align-items-center p-1">
                                <i class="icon si-hashtag-circle-r p-1"></i>
                                <div>{{ slotProps.option }}</div>
                            </div>
                        </template>
                    </AutoComplete>
                    <field name="city" type="hidden" v-model="cityCode" />
                </div>
                <div class="need-confirm-container" v-if="field.name === 'avatar_url'">
                    <div class="input-group avatar-input">
                        <label class="btn  position-relative justify-content-start">
                            <i class="icon si-cloud-upload-r upload-icon mt-0"></i>
                            {{ field.configs.placeholder ? field.configs.placeholder : "عکس کاربر" }}
                            <input @change="handleAvatarChange" ref="fileInput" :name="field.name" accept="image/*"
                                type="file" class="d-none" />
                            <div v-if="uploadPercent > 0" class="upload-progress media">
                                <div id="progress_bar_percent" class="progress-percent"> % {{ uploadPercent }}
                                </div>
                                <div id="progress_bar" class="progress">
                                    <div class="progress-bar" style="--bg: var(--primary)"
                                        :style="{ width: uploadPercent + '%' }" v-if="uploadPercent > 0"></div>
                                </div>
                            </div>
                        </label>
                    </div>
                    <img alt="user-avatar" class="avatar xxl" :src="avatarUrl">
                    <field name="avatar_url" type="hidden" v-model="avatarUrl" />
                </div>
                <div v-if="field.name === 'birth_date'">
                    <date-picker :placeholder="field.configs.label ?? 'تاریخ تولد...'" name="birth_date" v-model="date">
                    </date-picker>
                    <field name="birth_date" type="hidden" v-model="date" />
                </div>
                <div class="need-confirm-container" v-if="field.name === 'email'">
                    <div class="input lg">
                        <Field autocomplete="off" @input="() => isEmailVerified = false" :name="field.name"
                            v-model="email" class="ltr en-number" />
                        <label>{{ field.configs.label }}</label>
                    </div>
                    <div class="open-confirmation">
                        <div v-if="isEmailVerified" class="verified-icon text-success fw-700"><i class="fs-22 fw-800 icon si-check-r"></i>
                        </div>
                        <button v-else ref="confirmEmailBtn" type="button" class="btn btn-primary"
                            @click="handleConfirmEmail">تایید
                            ایمیل</button>
                    </div>
                </div>
                <div class="need-confirm-container" v-if="field.name === 'mobile'">
                    <div class="input lg">
                        <Field autocomplete="off" @input="() => isMobileVerified = false" :name="field.name"
                            v-model="mobile" class="ltr en-number" />
                        <label>{{ field.configs.label }}</label>
                    </div>
                    <div class="open-confirmation">
                        <div v-if="isMobileVerified" class="verified-icon text-success fw-700"><i
                                class="fs-22 fw-800 icon si-check-r"></i>
                        </div>
                        <button v-else ref="confirmMobileBtn" type="button" class="btn btn-primary"
                            @click="handleConfirmMobile">تایید
                            موبایل</button>
                    </div>
                </div>
                <InputGroup v-if="field.name === 'password'" :showforgetButton="false" :hasErrorField="false" fieldName="password" type="password" :labelText="field.configs.label" ></InputGroup>
                <div v-if="shouldShowField(field)" class="input lg"
                    :class="[field.name === 'display_name' ? 'focus' : '']">
                    <Field autocomplete="off" :name="field.name"
                        :class="[field.name === 'display_name' ? 'rtl' : 'ltr']"
                        :value="userInfo[field.name] ? userInfo[field.name] : ''" />
                    <label>{{ field.configs.label }}</label>
                </div>
                <ErrorMessage class="error-message" :name="field.name" />
            </div>
            <button ref="submitBtnRef" type="submit" class="submit-onboarding-btn btn-primary w-100">
                ثبت اطلاعات
            </button>
        </div>
    </Form>
</template>
