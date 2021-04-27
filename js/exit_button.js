$('.exit-btn').click(function (e) {
    
    e.preventDefault();

    let buttonClick = true;

    $.ajax({
        url: 'vendor/exit.php',
        type: 'POST',
        dataType: 'json',
        data: {
            event: buttonClick
        }, 
        success (data){
            if (data.status){
                document.location.href = 'main_page.php';
            }
        }
    });
});