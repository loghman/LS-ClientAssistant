<script setup>
import Loading from "vue-loading-overlay";
import PreLogin from "../components/auth/PreLogin.vue";
import LoginCard from "../components/auth/LoginCard.vue";
import OtpCard from "../components/auth/OtpCard.vue";
import { defineComponent, ref, onBeforeMount } from "vue";
import { useToast } from "vue-toastification";
import { get } from "@/assets/js/utilities/httpClient/httpClient";
import RegisterCard from "../components/auth/RegisterCard.vue";
const toast = useToast();
defineComponent({
    components: {
        Loading,
        PreLogin,
        LoginCard, OtpCard, RegisterCard
    },
});
////refs////
const isLoading = ref(false);
const activeTab = ref(1);
const authSetting = ref({
    LoginFields: Array,
    RegisterationFields: Array,
    AuthLabel: String,
    OTP: {
        enable: true,
        code_len: 6
    }
});
const currentCard = ref("preLogin");
const uniqueKey = ref('');

const getAuthSEtting = async () => {
    try {
        isLoading.value = true;
        const response = await get("/v3/auth/setting");
        authSetting.value = response;
        isLoading.value = false;
    } catch (error) {
        isLoading.value = false;
        toast('خطایی رخ داده')
        console.log(error);
    }
};
const goToCard = (cardName) => {
    currentCard.value = cardName;
}
const setActiveTab = (tab) => {
    activeTab.value = tab;
}
onBeforeMount(() => {
    getAuthSEtting();
})
</script>
<template>
    <div class="section-auth">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxxl-4 col-xxl-5 col-xl-6 col-lg-7 col-md-9">
                    <div class="card" data-jsc="tabs">
                        <div class="card-info flex-row justify-content-center">
                            <a class="item right" @click="() => setActiveTab(1)" :class="[activeTab == 1 ? 'active' : '']">
                                <div class="text d-flex">
                                    <span class="title">ورود به سایت</span>
                                </div>
                            </a>
                            <a class="item left" @click="() => setActiveTab(2)" :class="[activeTab == 2 ? 'active' : '']">
                                <div class="text d-flex">
                                    <span class="title">ثبت نام</span>
                                </div>
                            </a>
                        </div>
                        <!-- /////login tab -->
                        <div class="content tab-content" :class="[activeTab == 1 ? 'active' : '']">
                            <Loading v-model:active="isLoading" :can-cancel="false" :is-full-page="true"
                                :backgroundColor="'var(--primary)'" :color="'var(--primary)'" />
                            <div v-if="!isLoading">

                                <PreLogin v-if="currentCard === 'preLogin'" :uniqueKey="uniqueKey"
                                    :loginFields="authSetting.LoginFields"
                                    :verifFields="authSetting.VerificationFields[0]" :AuthLabel="authSetting.AuthLabel"
                                    @goToCard="goToCard" v-model:unique-key="uniqueKey">
                                </PreLogin>

                                <LoginCard v-if="currentCard === 'loginCard'" @goToCard="goToCard"
                                    :otpEnable="authSetting.OTP.enable" :uniqueKey="uniqueKey">
                                </LoginCard>

                                <OtpCard :uniqueKey="uniqueKey" v-if="currentCard === 'otpCard'" @goToCard="goToCard">
                                </OtpCard>

                            </div>
                        </div>
                        <!-- /////register tab -->
                        <RegisterCard v-if="!isLoading" :activeTab="activeTab"
                            :verifFields="authSetting.VerificationFields[0]"
                            :regisFields="authSetting.RegisterationFields"></RegisterCard>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<style >
.auth-inputs {
    display: flex;
    flex-direction: column;
    gap: 0 !important;
}
.error-message {
        padding: 0;
        color: var(--danger);
        font-size: 14px;
    }
</style>