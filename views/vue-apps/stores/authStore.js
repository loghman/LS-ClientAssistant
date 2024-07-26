// stores/authStore.js
import { defineStore } from 'pinia';
import { ref } from 'vue';
import Cookies from "js-cookie";

export const useAuthStore = defineStore('auth', () => {
    const uniqueKeyInitial=Cookies.get('uniqueKey')?Cookies.get('uniqueKey'):""
    const uniqueKey = ref(uniqueKeyInitial);
    const expireAt = ref(0);
    const setUniqueKey = (key) => {
        uniqueKey.value = key;
    };

    const setExpireAt = (expireTime) => {
        expireAt.value = expireTime;
    };

    return {
        uniqueKey,
        expireAt,
        setUniqueKey,
        setExpireAt,
    };
});
