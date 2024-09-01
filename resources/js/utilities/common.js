const mobileBreakPoint= 768;

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
  target.append(iframe);
};

export const secondsToTimeFormat = (time) => {
  const seconds = Math.floor(time);
  const pad = (num) => String(num).padStart(2, "0");
  const hours = Math.floor(seconds / 3600);
  const minutes = Math.floor((seconds % 3600) / 60);
  const remainingSeconds = seconds % 60;

  return `${pad(hours)}:${pad(minutes)}:${pad(remainingSeconds)}`;
};

export const checkDeviceType = () => {
  return (
    /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(
      navigator.userAgent
    ) || window.innerWidth <= mobileBreakPoint
  );
};
