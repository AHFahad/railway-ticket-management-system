<?php  
session_start();
?>
<html>
<head>
<title>Login Form Design</title>
    <link rel="stylesheet" type="text/css" href="style/loginStyle.css">
    </head>
<body>
     <div class="loginbox">
         <h1>Change Password Customer</h1>
    <?php if (isset($_SESSION['message'])): ?>
    
    
    <?php endif ?>
    
        
        <form method="post" name="chngpwd" action="service/customerService.php">
          <table >
            <tr height="50">
            <td>Old Password :</td>
            <td><input type="password" name="opwd" id="opwd"></td>
            </tr>
            <tr height="50">
            <td>New Passowrd :</td>
            <td><input type="password" name="npwd" id="npwd"></td>
            </tr>
            <tr height="50">
            <td>Confirm Password :</td>
            <td><input type="password" name="cpwd" id="cpwd"></td>
            </tr>
            <tr>
            
            <td><input type="submit" name="Change" value="Change Passowrd" /></td>
            </tr>
         </table>
            
        </form>
        
    </div>
  <script type="text/javascript">
        function valid()
        {
        if(document.chngpwd.opwd.value=="")
        {
        alert("Old Password Filed is Empty !!");
        document.chngpwd.opwd.focus();
        return false;
        }
        else if(document.chngpwd.npwd.value=="")
        {
        alert("New Password Filed is Empty !!");
        document.chngpwd.npwd.focus();
        return false;
        }
        else if(document.chngpwd.cpwd.value=="")
        {
        alert("Confirm Password Filed is Empty !!");
        document.chngpwd.cpwd.focus();
        return false;
        }
        else if(document.chngpwd.npwd.value!= document.chngpwd.cpwd.value)
        {
        alert("Password and Confirm Password Field do not match  !!");
        document.chngpwd.cpwd.focus();
        return false;
        }
        return true;
        }
</script>
</body>
    
    

</html>