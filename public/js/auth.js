$(document).ready(function () {
    var isRegister = $('#emailInput').length > 0;
    function validateUsername(username) {
        if (username.trim() === '') {
            return "Username must not be empty.";
        } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
            return "Username can only contain letters, numbers.";
        } else if (username.length < 5 || username.length > 100) {
            return "The username length must be between 5 and 100 characters.";
        } else if (/\s$/.test(username)) {
            return "The username cannot end with whitespace.";
        }
        return '';
    }

    function validateEmail(email) {
        if (email.trim() === '') {
            return "Email must not be empty.";
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            return "Invalid email address.";
        }
        return '';
    }

    function validatePassword(password) {
        if (password.length === 0) {
            return "Password must not be empty.";
        } else if (password.length < 8) {
            return "The password must be at least 8 characters long.";
        } else if (password.length > 16) {
            return "The password cannot exceed 16 characters.";
        } else if (/\s/.test(password)) {
            return "The password cannot contain spaces.";
        } else if (!/[A-Z]/.test(password) || !/[^\w\s]/.test(password) || !/\d/.test(password)) {
            return "The password must contain at least one uppercase letter, one special character, and one number.";
        }
        return '';
    }

    $('#usernameInput').on('input', function () {
        var username = $(this).val();
        var errorMessage = validateUsername(username);
        $('#usernameError').text(errorMessage);
    });

    $('#emailInput').on('input', function () {
        var email = $(this).val();
        var errorMessage = validateEmail(email);
        $('#emailError').text(errorMessage);
    });

    $('#passwordInput').on('input', function () {
        var password = $(this).val();
        var errorMessage = validatePassword(password);
        $('#passwordError').text(errorMessage);
    });

    $('#submitButton').on('click', function () {
        var username = $('#usernameInput').val();
        var email = $('#emailInput').val();
        var password = $('#passwordInput').val();
        var hasError = false;

        if (username.trim() === '') {
            $('#usernameError').text("Username cannot be empty.");
            hasError = true;
        }

        if ($('#emailInput').length > 0) {
            if (email.trim() === '') {
                $('#emailError').text("Email cannot be empty.");
                hasError = true;
            }
        }

        if (password.trim() === '') {
            $('#passwordError').text("Password cannot be empty.");
            hasError = true;
        }

        if (!hasError) {
            var postData = {
                username: username,
                password: password,
                submit: true
            };

            if ($('#emailInput').length > 0) {
                postData.email = email;
            }

            $.ajax({
                type: 'POST',
                url: '../../models/auth/auth_' + ($('#emailInput').length > 0 ? 'register' : 'login') + '.php',
                data: postData,
                success: function (data) {
                    if (isRegister) {
                        if (data.includes('Create a successful account')) {
                            $('#resultMessage').html('<span style="color: green;">' + data + '</span>');
                        } else {
                            $('#resultMessage').html('<span style="color: red;">' + data + '</span>');
                        }
                    } else {
                        if (data.includes('Logged in successfully')) {
                            $('#resultMessage').html('<span style="color: green;">' + data + '</span>');
                        } else {
                            $('#resultMessage').html('<span style="color: red;">' + data + '</span>');
                        }
                    }
                }
            })
        }
    });
});
