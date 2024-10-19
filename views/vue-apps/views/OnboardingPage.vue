<script setup>
import Loading from "vue-loading-overlay";
import { defineComponent, ref, onBeforeMount } from "vue";
import {
    authApi,
} from "@/js/utilities/apiPath";
import {
    get,
} from "@/js/utilities/httpClient/httpClient";
import { useAuthStore } from "../stores/authStore"; 
import OnboardingForm from "../components/auth/OnboardingForm.vue";
import OtpCard from "../components/auth/OtpCard.vue";
import ErrorMsg from "../components/auth/common/ErrorMsg.vue";

defineComponent({
    components: {
        Loading,
        OtpCard,
        ErrorMsg
    },
});
const props = defineProps({
    apiKey: String,
});
const authStore = useAuthStore();

////refs////
const showErrorMsg = ref(false);
const isLoading = ref(false);
const currentVerifideField = ref('');
const authSetting = ref({
    registrationFields: {},
    OTP: {
        enable: true,
        codeLen: 6
    }
});
const userInfo = ref(null);
const currentCard = ref("onboarding_card");

const getAuthSetting = async () => {
    try {
        isLoading.value = true;
        const response = await get(authApi.SETTING);
        const userInfoRes = await get(authApi.PROFILE);
        if (response.status && userInfoRes.status) {
            authSetting.value = response.result;
            userInfo.value = userInfoRes.result;
            isLoading.value = false;
        } else {
            isLoading.value = false;
            showErrorMsg.value = true;
        }
    } catch (error) {
        isLoading.value = false;
        console.log(error);
    }
};

const setCurrentCard = (data) => {
    currentCard.value = data.cardName;

    if(data.verifideField){
        currentVerifideField.value=data.verifideField;
    }
    if (data.uniqueKey) {
        authStore.setUniqueKey(data.uniqueKey);
    }
}

onBeforeMount(() => {
    getAuthSetting();
})

</script>

<template>
    <div class="container on-boarding-page">
        <div class="row justify-content-center">
            <div class="col-xl-6 col-lg-7 col-md-9">
                <div class="card">
                    <div class="card-info flex-row justify-content-center">
                        <a class="item right active">
                            <div class="text d-flex">
                                <span class="title">تکمیل اطلاعات</span>
                            </div>
                        </a>
                    </div>
                    <ErrorMsg v-if="showErrorMsg"></ErrorMsg>
                    <!-- /////onboarding card -->
                    <div v-else class="content pt-0">
                        <Loading v-model:active="isLoading" :can-cancel="false" :is-full-page="true"
                            :backgroundColor="'var(--primary)'" :color="'var(--primary)'" />
                        <div v-if="!isLoading">
                            <OnboardingForm
                             v-show="currentCard === 'onboarding_card'"
                             :apiKey="apiKey"
                             :userInfo="userInfo" @goToCard="setCurrentCard"
                             :registrationFields="authSetting.registrationFields"
                             :currentVerifideField="currentVerifideField"
                            />
                            <OtpCard prevCard="onboarding_card"  v-if="currentCard === 'otpCard'"
                                @goToCard="setCurrentCard">
                            </OtpCard>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
