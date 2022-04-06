<?php
    if (session_status() == PHP_SESSION_NONE) session_start();
    if(isset($_SESSION["userIDTesting"])){
      $name = $_SESSION["name"];  
    }
      require_once('links.php');
?>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #6ceaf9;">
    <a class="navbar-brand d-lg-none" href="#"><img class = "logo-image" src="images/exam.png"></a>
    <?php 
            if(isset($_SESSION["userIDTesting"])){
    ?>
        <div>
            <span><a href="logout.php"><img class = "logout-mobile" src="images/logout2.png"></a></span>
        </div>
    <?php }?>
    
    <div class="collapse navbar-collapse" id="myNavbarToggler7">
        <ul class="navbar-nav mx-auto">
            
            <a class="d-none d-lg-block" href="#"><img class = "logo-image" src="images/exam.png"></a>
            
        </ul>
        <?php 
            if(isset($_SESSION["userIDTesting"])){
        ?>
        <div>
            <span><a href="logout.php"><img class = "logout" src="images/logout2.png"></a></span>
        </div>
        <?php }?>
    </div>
</nav>