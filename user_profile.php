<?php 
    session_start();

    if (!isset($_SESSION['auth']) && !$_SESSION['auth']){
        header("Location: main_page.php");
    }

    

?>
<p>Hello, <?=$_SESSION['name']?></p>
<button class="exit-btn" type="submit">Exit</button>
<script src=js/jquery.js></script>
<script src=js/exit_button.js></script>