import { toEnNumber } from "../number-formatters";
import { otpInput, updateOtpInput } from "../otp";
 const verificationCard=$('#otp_verification_card');
$(function () {
    const otpInputs =verificationCard.find('.jump-next-input');
    const otpInputsNum = otpInputs.length;
    otpInputs.on("paste", function (event) {
        if ($(this).is(':focus')) {
            const pastedData = (event.originalEvent || event).clipboardData.getData('text');
            const otpDigits = toEnNumber(pastedData).replace(/\D/g, '').split('').slice(0, otpInputsNum);
            for (let i = 0; i < otpDigits.length; i++) {
                    otpInputs[i].value = otpDigits[i];
            }

            if (otpDigits.length > 0 && otpDigits.length <= otpInputsNum) {
                otpInputs[otpDigits.length - 1].focus();
            }

            updateOtpInput();
        
            if (otpInput.val().length == 6) {
               
            }
        }
    });
});
