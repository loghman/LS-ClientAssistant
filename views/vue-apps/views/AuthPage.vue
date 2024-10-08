<script setup>
import Loading from "vue-loading-overlay";
import OtpCard from "../components/auth/OtpCard.vue";
import PriorityOneCard from "../components/auth/PriorityOneCard.vue";
import PriorityTwoCard from "../components/auth/PriorityTwoCard.vue";
import { defineComponent, ref, onBeforeMount } from "vue";
import { get } from "@/js/utilities/httpClient/httpClient";
import { URLS, expireDays, showIframe } from "../components/auth/useAuth";
import PassCard from "../components/auth/PassCard.vue";
import RetriveCard from "../components/auth/RetriveCard.vue";
import { useAuthStore } from "../stores/authStore";
import Cookies from "js-cookie";
import { authApi } from "@/js/utilities/apiPath";
import { useAuthManagment } from "../components/auth/useAuthManagment";


defineComponent({
    components: {
        Loading,
        OtpCard,
        PriorityOneCard,
        PriorityTwoCard,
    },
});

const authStore = useAuthStore();
////refs////
const isLoading = ref(false);
const clientUrl = ref(URLS.CLIENT_URL)
const authSetting = ref({
    loginFields: {
        priority1: {
            help: "",
            authType: "",
            field: {
                name: "",
                validation: {
                    pattern: "",
                    message: ""
                },
                configs: {
                    placeholder: "",
                    label: "",
                    require: true
                }
            }
        },
        priority2: {
            authType: "",
            field: {
                name: "",
                validation: [],
                configs: {
                    placeholder: "",
                    label: "",
                    require: false
                }
            }
        }
    },
    authTitle: "",
    otp: {
        enable: true,
        codeLen: 6
    },
    expireAt: ""
});
const currentInitial = Cookies.get('currentCard') ? Cookies.get('currentCard') : "priority_one_card"
const currentCard = ref(currentInitial);
const prevCard = ref('priority_one_card');
let otpHelp = ref('');
const defaultError = 'متاسفانه مشکلی پیش آمده است. لطفا مجدد تلاش کنید.';
const { checkLogin, checkLoginLoading } = useAuthManagment();

const getAuthSetting = async () => {
    await checkLogin();
    try {
        isLoading.value = true;
        const response = await get(authApi.SETTING);
        if (response.status) {
            authSetting.value = response.result;
            authStore.setExpireAt(expireDays(authSetting.value.expireAt))
            isLoading.value = false;

            otpHelp = authSetting.value.loginFields.priority1.help;
            if (authSetting.value.loginFields.priority2.authType == 'otp') {
                otpHelp = authSetting.value.loginFields.priority2.help;
            }

        } else {
            const err = response.message.text ? response.message.text : defaultError;
            toast(err, 'danger');
            isLoading.value = false;
        }
    } catch (error) {
        isLoading.value = false;
        toast(defaultError);
        console.log(error);
    }
};

const setCurrentCard = (data) => {
    prevCard.value = currentCard.value;
    currentCard.value = data.cardName;
    Cookies.set("currentCard", data.cardName);
    if (data.uniqueKey) {
        Cookies.set("uniqueKey", data.uniqueKey);
        authStore.setUniqueKey(data.uniqueKey);
    }
}

onBeforeMount(() => {
    getAuthSetting();
});

</script>

<template>
    <iframe v-if="showIframe" :src="clientUrl" frameborder="0" id="client_iframe" width="1" height="1"
        sandbox="allow-scripts allow-same-origin"></iframe>
    <Loading v-if="checkLoginLoading" class="w-100 d-flex justify-content-center" width="100px" height="100px"
        v-model:active="checkLoginLoading" :can-cancel="false" :is-full-page="true" :backgroundColor="'var(--primary)'"
        :color="'var(--secondary-7)'" />
    <div v-else class="container">
        <div class="row justify-content-center">
            <div class="col-xxxl-4 col-xxl-5 col-xl-6 col-lg-7 col-md-9">
                <div class="card">
                    <div class="card-info flex-row justify-content-center">
                        <a class="item right active">
                            <div class="text d-flex">
                                <span class="title">ورود <small class="fs-16 fw-700 px-1"> | </small> عضویت</span>
                            </div>
                        </a>
                    </div>
                    <!-- /////login cards -->
                    <div class="content align-items-center">
                        <Loading v-model:active="isLoading" :can-cancel="false" :is-full-page="true"
                            :backgroundColor="'var(--primary)'" :color="'var(--primary)'" />
                        <div v-if="!isLoading">
                            <PriorityOneCard :clientUrl="clientUrl" v-if="currentCard === 'priority_one_card'"
                                :priority1="authSetting.loginFields.priority1" :authTitle="authSetting.authTitle"
                                @goToCard="setCurrentCard">
                            </PriorityOneCard>
                            <PriorityTwoCard v-if="currentCard === 'priority_two_card'" :clientUrl="clientUrl"
                                :authTitle="authSetting.authTitle" :priority2="authSetting.loginFields.priority2"
                                @goToCard="setCurrentCard">
                            </PriorityTwoCard>
                            <OtpCard v-if="currentCard === 'otpCard'" :clientUrl="clientUrl" :prevCard="prevCard"
                                @goToCard="setCurrentCard" :help="otpHelp">
                            </OtpCard>
                            <PassCard v-if="currentCard === 'pass_card'" :prevCard="prevCard"
                                :priority1="authSetting.loginFields.priority1" @goToCard="setCurrentCard"
                                @resetPrevCard="() => prevCard.value = 'priority_one_card'" :clientUrl="clientUrl">
                            </PassCard>
                            <RetriveCard v-if="currentCard === 'retrive_card'" :prevCard="prevCard"
                                @goToCard="setCurrentCard" :clientUrl="clientUrl">
                            </RetriveCard>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
