<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <h1>Registration</h1>
    <form id="registration-form">
        <input type="text" name="login" placeholder="Login">
        <p class="invalid-login"></p>
        <input type="password" name="password" placeholder="Password">
        <p class="invalid-password"></p>
        <input type="password" name="confirm_password" placeholder="Confrim password">
        <p class="unmatch-pass"></p>
        <input type="text" name="email" placeholder="Email">
        <p class="invalid-email"></p>
        <input type="text" name="name" placeholder="Name">
        <p class="invalid-name"></p>
        <button class="reg-btn" id="submit-form" type="submit">Registration</button>
        <div id="noJsBanner">Enable JavaScript!</div>
        <noscript>
            <style type="text/css">
                #submit-form {
                    display: none; 
                }

                #noJsBanner
                {
                    display: block;
                }
            </style>
    </noscript>
    </form>
    <p class="registration-message"></p>
    <script src=js/jquery.js></script>
    <script src=js/registration_button.js></script>
</body>
</html>