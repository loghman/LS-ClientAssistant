$(function () {
  $("[data-drm-text]").each(function (index, elm) {
    let _elm = $(elm),
      drmText = _elm.data("drm-text"),
      options = {
        time: 5000,
        styles: {
          color: "red",
          fontSize: "14px",
          fontStyle: "bold",
          opacity: 0.2,
          zIndex: 100,
          position: "absolute",
          cursor: "default",
          "-webkit-user-select": "none",
          "-ms-user-select": "none",
          "user-select": "none",
        },
      };

    _elm.append("<span class='drm-text'>" + drmText + "</span>");
    let drmElm = _elm.find(".drm-text");
    drmElm.css(options.styles);

    setInterval(function () {
      // Get parent dimensions
      let parentWidth = _elm.width();
      let parentHeight = _elm.height();

      if (parentHeight === 0) {
        let paddingTop = parseFloat(_elm.css("padding-top")) || 0;
        let paddingBottom = parseFloat(_elm.css("padding-bottom")) || 0;
        parentHeight = paddingTop + paddingBottom;
      }

      let elemWidth = drmElm.outerWidth();
      let elemHeight = drmElm.outerHeight();

      let maxLeft = parentWidth - elemWidth;
      let maxBottom = parentHeight - elemHeight;

      let leftPos = Math.random() * Math.max(0, maxLeft);
      let bottomPos = Math.random() * Math.max(0, maxBottom);

      drmElm.css({
        left: leftPos + "px",
        bottom: bottomPos + "px",
      });
    }, options.time);
  });
});
