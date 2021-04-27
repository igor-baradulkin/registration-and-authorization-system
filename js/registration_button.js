$('.reg-btn').click(function (e) {

    e.preventDefault();

    let login = $('input[name="login"]').val();
    let password = $('input[name="password"]').val();
    let email = $('input[name="email"]').val();
    let confirmPassword = $('input[name="confirm_password"]').val();
    let name = $('input[name="name"]').val();

    $.ajax({
        url: 'vendor/registration_process.php',
        type: 'POST',
        dataType: 'json',
        data: {
            name: name,
            login: login,
            email: email,
            password: password,
            confirm_password: confirmPassword
        },
        success (data) {
            if (data.status){
                document.location.href = 'user_profile.php';
            }
            else if (!data.status && data.errorType === 1){
                data.errorsList.forEach(function (value) {
                    let typeError = value.split(":")[0];
                    let message = value.split(":")[1];
                    $(`p[class="${typeError}"]`).text(` ${message}`);
                });

                $('#registration-form')[0].reset();
            }
            else if (!data.status && data.errorType === 2){
                let message = data.errorMessage;

                $('p[class="registration-message"]').text(`${message}`);
            }
        }
    });
});