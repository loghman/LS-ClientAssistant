import { route } from 'ziggy-js';

export const authApi={
    SETTING:route('v3.auth.setting-get'),
    LOGIN:route('v3.auth.login'),
    AUTH:route('v3.auth.auth'),
    REGISTER:route('v3.auth.register'),
}