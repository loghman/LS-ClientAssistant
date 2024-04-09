import Cookies from "js-cookie";

export const postData=(iframe,data,target)=>{
    if (iframe) {
        iframe.contentWindow.postMessage(data,target);
      } else {
        console.error('Iframe not found.');
      }
   
}            
export const createIframe=(target,src)=>{
    const iframe = document.createElement("iframe");
    iframe.id="client_iframe";
    iframe.src = src;
    iframe.width='1';
    iframe.height='1';
    target.append(iframe);
}
const handleMessageEvent = (e) => {
    if (e.origin !== e.data.origin) {
        return;
    } else if (e.data.token) {
         Cookies.set("token", e.data.token);
    }
};

export const addMessageEventListener = () => {
    window.addEventListener('message', handleMessageEvent);
};

export const removeMessageEventListener = () => {
    window.removeEventListener('message', handleMessageEvent);
};
