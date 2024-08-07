$(function () {
    function setCookie(name, value) {
        document.cookie = name + "=" + (value || "");
    }
    
    const handleMessageEvent = (e) => {
        if (e.data.token) {
            setCookie("token", e.data.token);
        }
    };

    const addMessageEventListener = () => {
        window.addEventListener("message", handleMessageEvent);
    };
    
    addMessageEventListener();
});
