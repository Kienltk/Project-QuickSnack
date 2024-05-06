$(document).ready(function () {
    var isRegister = $('#emailInput').length > 0;

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
        var fullName = $('#fullNameInput').val();
        var username = $('#usernameInput').val();
        var email = $('#emailInput').val();
        var gender = $('#gender').val();
        var password = $('#passwordInput').val();
        var confirmPassword = $('#confirmPasswordInput').val();
        var termsChecked = $('#agreeTerms').prop('checked');
        var hasError = false;


        var fullNameError = validateFullName(fullName);
        $('#fullNameError').text(fullNameError);
        if (fullNameError !== '') {
            hasError = true;
        }

        var usernameError = validateUsername(username);
        $('#usernameError').text(usernameError);
        if (usernameError !== '') {
            hasError = true;
        }

        if ($('#emailInput').length > 0) {
            var emailError = validateEmail(email);
            $('#emailError').text(emailError);
            if (emailError !== '') {
                hasError = true;
            }
        }

        var passwordError = validatePassword(password);
        $('#passwordError').text(passwordError);
        if (passwordError !== '') {
            hasError = true;
        }

        var confirmPasswordError = '';
        if (confirmPassword.trim() === '') {
            confirmPasswordError = "Confirm password cannot be empty.";
        } else if (confirmPassword !== password) {
            confirmPasswordError = "Passwords do not match.";
        } else {
            confirmPasswordError = validatePassword(confirmPassword);
        }
        $('#confirmPasswordError').text(confirmPasswordError);
        if (confirmPasswordError !== '') {
            hasError = true;
        }

        var genderError = gender ? '' : "Gender must be selected.";
        $('#genderError').text(genderError);
        if (genderError !== '') {
            hasError = true;
        }


        var termsError = termsChecked ? '' : "You must agree to the terms and conditions.";
        $('#termsError').text(termsError);
        if (termsError !== '') {
            hasError = true;
        }

        if (!hasError) {
            var postData = {
                fullName: fullName,
                username: username,
                email: email,
                gender: gender,
                password: password,
                submit: true
            };

            if ($('#emailInput').length > 0) {
                postData.email = email;
            }

            $.ajax({
                type: 'POST',
                url: '../../models/auth/auth_register.php',
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

