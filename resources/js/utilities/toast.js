export const toast = function (
    message,
    type = "success",
    ttl = 5000,
    position,
    top = 40
  ) {
    // const topDistance=top?top:0
    $("body").append(
      `<span style="top:${top}px" class="response-wrapper mt-1 toast-top-right  ${type} active">${message}</span>`
    );
  
    setTimeout(function () {
      let wrapper = $("body > .response-wrapper");
  
      wrapper.fadeOut();
      wrapper.remove();
    }, ttl);
  };
  
  window.toast = toast;
  