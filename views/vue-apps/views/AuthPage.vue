<script setup>
import Loading from "vue-loading-overlay";
import OtpCard from "../components/auth/OtpCard.vue";
import PriorityOneCard from "../components/auth/PriorityOneCard.vue";
import PriorityTwoCard from "../components/auth/PriorityTwoCard.vue";
import { defineComponent, ref, onBeforeMount } from "vue";
import { get } from "@/js/utilities/httpClient/httpClient";
import { expireDays } from "../components/auth/useAuth";
import PassCard from "../components/auth/PassCard.vue";
import RetriveCard from "../components/auth/RetriveCard.vue";
import { useAuthStore } from "../stores/authStore";
import Cookies from "js-cookie";
import { authApi } from "@/js/utilities/apiPath";
import { useAuthManagment } from "../components/auth/useAuthManagment";
import { toastErrorMessages } from "@/js/utilities/error-handler";
import ErrorMsg from "../components/auth/common/ErrorMsg.vue";

defineComponent({
  components: {
    Loading,
    OtpCard,
    PriorityOneCard,
    PriorityTwoCard,
    ErrorMsg
  },
});

const authStore = useAuthStore();
////refs////
const showErrorMsg = ref(false);
const isLoading = ref(true);
const authSetting = ref(null);
const currentInitial = Cookies.get("currentCard")
  ? Cookies.get("currentCard")
  : "priority_one_card";
const currentCard = ref(currentInitial);
const prevCard = ref("priority_one_card");
let otpHelp = ref("");
const { checkLogin, checkLoginLoading } = useAuthManagment();

const getAuthSetting = async () => {
  await checkLogin();
  try {
    const response = await get(authApi.SETTING);
    if (response.status === true) {
      authSetting.value = response.result;
      authStore.setExpireAt(expireDays(authSetting.value.expireAt));
      isLoading.value = false;

      otpHelp = authSetting.value?.loginFields.priority1.help;
      if (authSetting.value?.loginFields.priority2.authType === "otp") {
        otpHelp = authSetting.value?.loginFields.priority2.help;
      }
    } else {
      toastErrorMessages(response);
      isLoading.value = false;
      showErrorMsg.value = true;
    }
  } catch (error) {
    isLoading.value = false;
    console.log(error);
  } finally {
    isLoading.value = false;
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
};

onBeforeMount(() => {
  getAuthSetting();
});
</script>

<template>
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
          <ErrorMsg v-if="showErrorMsg"></ErrorMsg>
          <!-- /////login cards -->
          <div v-else class="content align-items-center">
            <div v-if="isLoading" class="card p-2 d-flex justify-content-center">
              <Loading v-model:active="isLoading" :can-cancel="false" :is-full-page="true"
                :backgroundColor="'var(--primary)'" :color="'var(--primary)'" />
            </div>
            <div v-else>
              <PriorityOneCard  v-if="currentCard === 'priority_one_card'"
                :priority1="authSetting?.loginFields.priority1" :authTitle="authSetting.authTitle"
                @goToCard="setCurrentCard">
              </PriorityOneCard>
              <PriorityTwoCard v-if="currentCard === 'priority_two_card'" 
                :authTitle="authSetting.authTitle" :priority2="authSetting?.loginFields.priority2"
                @goToCard="setCurrentCard">
              </PriorityTwoCard>
              <OtpCard v-if="currentCard === 'otpCard'" :prevCard="prevCard"
                @goToCard="setCurrentCard" :help="otpHelp">
              </OtpCard>
              <PassCard v-if="currentCard === 'pass_card'" :prevCard="prevCard"
                :priority1="authSetting?.loginFields.priority1" @goToCard="setCurrentCard"
                @resetPrevCard="() => (prevCard.value = 'priority_one_card')" >
              </PassCard>
              <RetriveCard v-if="currentCard === 'retrive_card'" :prevCard="prevCard" @goToCard="setCurrentCard"
                >
              </RetriveCard>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
