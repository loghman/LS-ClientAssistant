export const toastSuccessMessage = (response) => {
    if (response.message) {
      toast(response.message);
    }
  };