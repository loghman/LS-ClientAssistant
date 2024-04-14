import Cookies from "js-cookie";

export const postData = (iframe, data, target) => {
  if (iframe) {
    iframe.contentWindow.postMessage(data, target);
  } else {
    console.error("Iframe not found.");
  }
};
export const createIframe = (target, src) => {
  const iframe = document.createElement("iframe");
  iframe.id = "client_iframe";
  iframe.src = src;
  iframe.width = "1";
  iframe.height = "1";
  document.addEventListener("DOMContentLoaded", (event) => {
    target.appendChild(iframe);
  });
};
const handleMessageEvent = (e) => {
  if (e.origin !== e.data.origin) {
    return;
  } else if (e.data.token) {
    Cookies.set("token", e.data.token);
  }
};

export const addMessageEventListener = () => {
  window.addEventListener("message", handleMessageEvent);
};

export const removeMessageEventListener = () => {
  window.removeEventListener("message", handleMessageEvent);
};
export const toEnNumber = function (number) {
  if (number == undefined) {
    return "";
  }
  var str = number.toString().trim();
  if (str == "") {
    return "";
  }

  str = str.replace(/۰/g, 0);
  str = str.replace(/۱/g, 1);
  str = str.replace(/۲/g, 2);
  str = str.replace(/۳/g, 3);
  str = str.replace(/۴/g, 4);
  str = str.replace(/۵/g, 5);
  str = str.replace(/۶/g, 6);
  str = str.replace(/۷/g, 7);
  str = str.replace(/۸/g, 8);
  str = str.replace(/۹/g, 9);

  return str;
};
