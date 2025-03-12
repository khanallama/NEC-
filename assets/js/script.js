$(document).ready(function() {
    $('#confirm_password').on('keyup', function() {
        var password = $('#password').val();
        var confirmPassword = $('#confirm_password').val();
        if (password !== confirmPassword) {
            $('#confirm_password').css('border', '2px solid red');
        } else {
            $('#confirm_password').css('border', '2px solid green');
        }
    });
});
