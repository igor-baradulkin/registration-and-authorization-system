$('.login-btn').click(function (e) {
    
    e.preventDefault();

    let login = $('input[name="login"]').val();
    let password = $('input[name="password"]').val();

    $.ajax({
        url: 'vendor/autorization_process.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        }, 
        success (data){
            if (data.status){
                document.location.href = 'user_profile.php';
            }
            else if (!data.status){
                let message = data.message;

                $('p[class="autorization-message"]').text(`${message}`);
                $('#autorization-form')[0].reset();
            }
        }
    });
});