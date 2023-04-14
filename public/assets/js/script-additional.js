$(document).ready(function(){
    setTimeout(()=> {
        $('.toast-notification').css('display', 'none');
    }, 15000);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            // 'Authorization': '{{session()->get('token_jwt')}}',
        }
    });

    $('#hide_password').on('click', function(){
        if($(this).hasClass('fa-eye-slash')){
            $(this).removeClass('fa-eye-slash');
            $(this).addClass('fa-eye');
            $(this).siblings().attr('type', 'text');
        } else{
            $(this).removeClass('fa-eye');
            $(this).addClass('fa-eye-slash');
            $(this).siblings().attr('type', 'password');
        }
    })
})
