$(function () {
    $('[data-drm-text]').each(function (index, elm) {
        let _elm = $(elm),
            drmText = _elm.data('drm-text'),
            options = {
                time: 2500,
                styles: {
                    color: "red",
                    fontSize: "14px",
                    fontStyle: "bold",
                    opacity: 0.4,
                    position: "absolute",
                    cursor: "default",
                    "-webkit-user-select": "none",
                    "-ms-user-select": "none",
                    "user-select": "none",
                },
            };

        _elm.append("<span class='drm-text'>" + drmText + "</span>");
        let drmElm = _elm.find('.drm-text');
        drmElm.css(options.styles);

        setInterval(function () {
            let leftNum = Math.random() * 100,
                signLeft = leftNum < 50 ? '+' : '-',
                bottomNum = Math.random() * 100,
                signBottom = bottomNum < 50 ? '+' : '-';

            drmElm.css({
                left: "calc(" + leftNum + "% " + signLeft + " " + drmElm.width() + "px)",
                bottom: "calc(" + bottomNum + "% " + signBottom + " " + drmElm.height() + "px)",
            });
        }, options.time);
    });
});
