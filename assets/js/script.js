$(document).ready(function () {

    function hasErrors(formId) {
        return (
            $(`#${formId} .error-message:visible`).length > 0
        );
    }

    function updateSubmitButton(formId, buttonId) {
        if (hasErrors(formId)) {
            $(`#${buttonId}`).prop('disabled', true);
        } else {
            $(`#${buttonId}`).prop('disabled', false);
        }
    }


    $('#username').on('keyup', function () {
        var username = $(this).val();
        if (username.length < 3) {
            $(this).css('border', '2px solid red');
            $('#username-error').text('Username must be at least 3 characters long.').show();
        } else {
            $(this).css('border', '2px solid green');
            $('#username-error').hide();
        }
        updateSubmitButton('registration-form', 'register-button');
    });

    $('#email').on('keyup', function () {
        var email = $(this).val();
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            $(this).css('border', '2px solid red');
            $('#email-error').text('Please enter a valid email address.').show();
        } else {
            $(this).css('border', '2px solid green');
            $('#email-error').hide();
        }

        if ($(this).closest('form').attr('id') === 'registration-form') {
            updateSubmitButton('registration-form', 'register-button');
        } else {
            updateSubmitButton('login-form', 'login-button');
        }
    });


    $('#password').on('keyup', function () {
        var password = $(this).val();
        if (password.length < 6) {
            $(this).css('border', '2px solid red');
            $('#password-error').text('Password must be at least 6 characters long.').show();
        } else {
            $(this).css('border', '2px solid green');
            $('#password-error').hide();
        }

        if ($(this).closest('form').attr('id') === 'registration-form') {
            updateSubmitButton('registration-form', 'register-button');
        } else {
            updateSubmitButton('login-form', 'login-button');
        }
    });

    $('#confirm_password').on('keyup', function () {
        var password = $('#password').val();
        var confirmPassword = $(this).val();
        if (password !== confirmPassword) {
            $(this).css('border', '2px solid red');
            $('#confirm-password-error').text('Passwords do not match.').show();
        } else {
            $(this).css('border', '2px solid green');
            $('#confirm-password-error').hide();
        }
        updateSubmitButton('registration-form', 'register-button');
    });

    $('#profile_picture').on('change', function () {
        var file = $(this).val();
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(file)) {
            $(this).css('border', '2px solid red');
            $('#profile-picture-error').text('Please upload a valid image file (jpg, jpeg, png, gif).').show();
        } else {
            $(this).css('border', '2px solid green');
            $('#profile-picture-error').hide();
        }
        updateSubmitButton('registration-form', 'register-button');
    });

    $('#register-button').prop('disabled', true);
    $('#login-button').prop('disabled', true);
});