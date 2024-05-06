$(document).ready(function () {

    function debounce(func, delay) {
        let timeout;
        return function () {
            const context = this;
            const args = arguments;
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                func.apply(context, args);
            }, delay);
        };
    }

    function setCookie(cookieName, cookieValue, expirationDays) {
        var d = new Date();
        d.setTime(d.getTime() + (expirationDays * 24 * 60 * 60 * 1000));
        var expires = "expires=" + d.toUTCString();
        document.cookie = cookieName + "=" + cookieValue + ";" + expires + ";path=/";
    }

    function validateFullName(fullName) {
        if (fullName.trim() === '') {
            return "Please fill in your full name";
        } else if (!/^[a-zA-Z\s]+$/.test(fullName)) {
            return "Full name can only contain letters and spaces.";
        } else if (fullName.length <= 1) {
            return "The full name must be longer than 1 character.";
        }
        return '';
    }

    function validateUsername(username) {
        if (username.trim() === '') {
            return "Username must not be empty.";
        } else if (!/^[a-zA-Z0-9_]+$/.test(username)) {
            return "Username can only contain letters, numbers.";
        } else if (username.length < 5 || username.length > 100) {
            return "Username length must be over 5 characters";
        } else if (/\s$/.test(username)) {
            return "The username cannot end with whitespace.";
        }
        return '';
    }

    function validateEmail(email) {
        if (email.trim() === '') {
            return "Email must not be empty.";
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            return "Please provide a valid email address.";
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
            return "The password should contain at least one uppercase letter, one special character and a number.";
        }
        return '';
    }

    $('#usernameInput').on('input', debounce(function () {
        var username = $(this).val();
        var errorMessage = validateUsername(username);
        $('#usernameError').text(errorMessage);
    }, 1000));

    $('#emailInput').on('input', debounce(function () {
        var email = $(this).val();
        var errorMessage = validateEmail(email);
        $('#emailError').text(errorMessage);
    }, 1000));

    $('#passwordInput').on('input', debounce(function () {
        var password = $(this).val();
        var errorMessage = validatePassword(password);
        $('#passwordError').text(errorMessage);
    }, 1000));

    $('#fullNameInput').on('input', debounce(function () {
        var fullName = $(this).val();
        var errorMessage = validateFullName(fullName);
        $('#fullNameError').text(errorMessage);
    }, 1000));

    $('#gender').on('change', function () {
        var gender = $(this).val();
        var errorMessage = gender ? '' : "Gender must be selected.";
        $('#genderError').text(errorMessage);
    });

    $('#confirmPasswordInput').on('input', function () {
        var confirmPassword = $(this).val();
        var password = $('#passwordInput').val();
        var errorMessage = '';

        if (confirmPassword.trim() === '') {
            errorMessage = "Confirm password cannot be empty.";
        } else if (confirmPassword !== password) {
            errorMessage = "Passwords do not match.";
        } else {
            errorMessage = validatePassword(confirmPassword);
        }

        $('#confirmPasswordError').text(errorMessage);
    });

    $('#agreeTerms').on('change', function () {
        var isChecked = $(this).prop('checked');
        var errorMessage = isChecked ? '' : "You must agree to the terms and conditions.";
        $('#termsError').text(errorMessage);
    });

    $('#submitButton').on('click', function () {

        var username = $('#usernameInput').val();
        var password = $('#passwordInput').val();

        var usernameError = validateUsername(username);
        $('#usernameError').text(usernameError);

        var passwordError = validatePassword(password);
        $('#passwordError').text(passwordError);

        if (usernameError !== '' || passwordError !== '') {
            return;
        }

        if ($('#emailInput').length === 0) {

            $.ajax({
                type: 'POST',
                url: '../../models/auth/auth_login.php',
                data: {
                    username: username,
                    password: password,
                    submit: true
                },
                success: function (data) {
                    if (data.includes('Logged in successfully')) {
                        $('#resultMessage').html('<span style="color: green;">' + data + '</span>');
                        setCookie('loggedInUser', username, 7);
                        setTimeout(function () {
                            window.location.href = '../../views/home/home.php';
                        }, 2000);
                    } else {
                        $('#resultMessage').html('<span style="color: red;">' + data + '</span>');
                    }
                }
            });
        } else {
            var fullName = $('#fullNameInput').val();
            var email = $('#emailInput').val();
            var gender = $('#gender').val();
            var confirmPassword = $('#confirmPasswordInput').val();
            var termsChecked = $('#agreeTerms').prop('checked');

            var fullNameError = validateFullName(fullName);
            $('#fullNameError').text(fullNameError);

            var emailError = validateEmail(email);
            $('#emailError').text(emailError);

            var confirmPasswordError = '';
            if (confirmPassword.trim() === '') {
                confirmPasswordError = "Confirm password cannot be empty.";
            } else if (confirmPassword !== password) {
                confirmPasswordError = "Passwords do not match.";
            } else {
                confirmPasswordError = validatePassword(confirmPassword);
            }
            $('#confirmPasswordError').text(confirmPasswordError);

            var genderError = gender ? '' : "Gender must be selected.";
            $('#genderError').text(genderError);

            var termsError = termsChecked ? '' : "You must agree to the terms and conditions.";
            $('#termsError').text(termsError);

            if (fullNameError === '' && emailError === '' && confirmPasswordError === '' && genderError === '' && termsError === '') {
                var postData = {
                    fullName: fullName,
                    username: username,
                    email: email,
                    gender: gender,
                    password: password,
                    submit: true
                };

                $.ajax({
                    type: 'POST',
                    url: '../../models/auth/auth_register.php',
                    data: postData,
                    success: function (data) {
                        if (data.includes('Create a successful account')) {
                            $('#resultMessage').html('<span style="color: green;">' + data + '</span>');
                            setTimeout(function () {
                                window.location.href = '../../views/auth/SignIn.html';
                            }, 2000);
                        } else {
                            $('#resultMessage').html('<span style="color: red;">' + data + '</span>');
                        }
                    }
                });
            }
        }
    });
});

