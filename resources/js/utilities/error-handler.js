import { messages } from './static-messages';

export const toastErrorMessages = (response) => {
  if (response.errors) {
    response.errors.forEach((err, index) => {
      toast(err.message, 'danger', 1500, 'top-left', index * 70 + 40);
    });
  } else {
    toast(
      response.message ? response.message : messages.SOMETHING_WENT_WRONG,
      'danger',
    );
  }
};