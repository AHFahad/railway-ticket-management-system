<?php  
session_start();
?>
<html>
<head>
<title>Login Form Design</title>
    <link rel="stylesheet" type="text/css" href="style/loginStyle.css">
<body>
     <div class="loginbox">
         <h1>Ticket Clerk Login</h1>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['message']; 
                
                unset($_SESSION['message']);
            ?>
        </div>
    
    <?php endif ?> 
        <form method="post" action="service/ticketClerkService.php">
            <p>ID:</p>
            <input type="text" name="tid" >
            <p>Password:</p>
            <input type="password" name="tpassword" >
            <input type="submit" name="Login" >
        </form>
        <a href="CustomerLogin.php">Back</a><br>
    </div>

</body>
</head>
</html>