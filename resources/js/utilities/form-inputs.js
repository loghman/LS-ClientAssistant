$(document).on('focus', '.input input, .input textarea', function () {
    $(this).closest('.input').addClass('focus');
});

$(document).on('focusout', '.input input, .input textarea', function () {
    let _this = $(this);
    _this.closest('.input').removeClass('focus');
    if (_this.val() == '') {
        _this.closest('.input').removeClass('not_empty');
    } else {
        _this.closest('.input').addClass('not_empty');
    }
});