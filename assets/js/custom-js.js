jQuery(document).ready(function ($) {
//var productVariations = $('#pa_color').attr('attribute_pa_color');
    $('.custom-order').on('click', function () {
        var productVariations = $('#form-custom-order').find('.form-custom-order-attr').text();
        $('#your-attr').val(productVariations);
        var productVariationsTitle = $('#form-custom-order').find('.form-custom-order-title').text();
        $('#your-title').val(productVariationsTitle);
    console.log(productVariations);
    });
    $('.custom-order').magnificPopup({
        type: 'inline',
        preloader: false,
        focus: '#name',

        // When elemened is focused, some mobile browsers in some cases zoom in
        // It looks not nice, so we disable it:
        callbacks: {
            beforeOpen: function() {
                if($(window).width() < 700) {
                    this.st.focus = false;
                } else {
                    this.st.focus = '#name';
                }

            }
        }
    });
});