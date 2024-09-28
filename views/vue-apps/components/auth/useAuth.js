
export const lspDomain = window.location.hostname;
export const lspOrigin = window.location.origin;

export const exposedEnvVariables = import.meta.env;
export const showIframe = exposedEnvVariables.SHOW_IFRAME === 'true' ? true : false;

const appUrl = exposedEnvVariables.APP_URL ? exposedEnvVariables.APP_URL : lspOrigin;
const apiBaseUrl = exposedEnvVariables.API_BASE_URL ? exposedEnvVariables.API_BASE_URL : `${appUrl}/api`;
///in clients clientUrl is the url of its panel
const clientUrl = exposedEnvVariables.CLIENT_URL ? exposedEnvVariables.CLIENT_URL : lspOrigin;

export const URLS = {
    CLIENT_URL: clientUrl,
    API_BASE_URL: apiBaseUrl,
    APP_URL: appUrl,
}

export const expireDays = (expireAt) => {
    const currentDate = new Date();
    const expirationDate = new Date(expireAt);
    const timeDifference = expirationDate - currentDate;
    const expiresInDays = timeDifference / (1000 * 60 * 60 * 24);
    return expiresInDays;
};