(function ($) {
    let showPassword = 0;

    $('.btn-show-pass').on('click', function(){
        if(showPassword === 0) {
            $(this).next('input').attr('type','text');
            $(this).find('i').removeClass('fa-eye');
            $(this).find('i').addClass('fa-eye-slash');
            showPassword = 1;
        } else {
            $(this).next('input').attr('type','password');
            $(this).find('i').removeClass('fa-eye-slash');
            $(this).find('i').addClass('fa-eye');
            showPassword = 0;
        }
    });
})(jQuery);