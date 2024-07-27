import { exposedEnvVariables } from "../../../components/auth/useAuth";

const apiBaseUrl = exposedEnvVariables.API_BASE_URL;

export const authApi = {
    SETTING: `${apiBaseUrl}v3/auth/setting`,
    LOGIN: `${apiBaseUrl}v3/auth/login`,
    AUTH: `${apiBaseUrl}v3/auth/auth`,
    REGISTER: `${apiBaseUrl}v3/auth/register`,
    LOGOUT: `${apiBaseUrl}v3/auth/logout`,
    SENDTOKEN: `${apiBaseUrl}v3/auth/send-token`,
    ONBOARDING: `${apiBaseUrl}v3/auth/onboarding`,
    PROFILE: `${apiBaseUrl}v3/user`,
    RETRIVEPASS: `${apiBaseUrl}v3/auth/reset-password`
};
export const publicApi={
    GETCITIES:'core/city/get-for-select'
}
export const uploadApi=(apiName,parameters)=>{
    return `client/v3/core/media/store/${parameters.entityType}/${parameters.entityId}`
}
