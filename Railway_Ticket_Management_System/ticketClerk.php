<!DOCTYPE html>
<?php  
session_start();
include('service/db.php');

    $tname="";
    $taddress="";
    $tmobile="";
    $temail="";
    $tpassword="";
    $tdob="";
	$tid = 0;
	$update = false;
 ?>

<!--

// to get na infromation of whitch data has been edited..
-->
<?php 
	if (isset($_GET['edit'])) {
		$tid = $_GET['edit'];
		$update = true;
		$record =executeSQL( "SELECT * FROM ticketclerk WHERE tid=$tid");

		{
			$n = mysqli_fetch_array($record);
			$tname = $n['tname'];
			$taddress = $n['taddress'];
            $tmobile=$n['tmobile'];
            $temail=$n['temail'];
            //$tpassword=$n['tpassword'];
            $tdob=$n['tdob'];
            
		}
	}
?>




<html>
<head>
	<title>edit ticket clerk</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">

</head>
<body>
<!--    header load-->
    <?php
    include('adminHeader.php');
    ?>
<!--    //show messeage update....-->
    
    <?php if (isset($_SESSION['message'])): ?>
        <div class="msg">
            <?php 
                echo $_SESSION['message']; 
                unset($_SESSION['message']);
            ?>
        </div>
    <?php endif ?>
    
<!--    //show the list...-->
    
    <?php 
       
        $results = executeSQL("SELECT * FROM ticketclerk"); 
    ?>

<table>
	<thead>
		<tr>
            <th>ID</th>
			<th>Name</th>
			<th>Address</th>
            <th>email</th>
            <th>mobile</th>
            <th>date of birth</th>
            
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
            <td><?php echo $row['tid']; ?></td>
			<td><?php echo $row['tname']; ?></td>
			<td><?php echo $row['taddress']; ?></td>
            <td><?php echo $row['temail']; ?></td>
            <td><?php echo $row['tmobile']; ?></td>
            <td><?php echo $row['tdob']; ?></td>
			<td>
				<a href="ticketClerk.php?edit=<?php echo $row['tid']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="service/ticketClerkService.php?del=<?php echo $row['tid']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>
    
    
<!--    //show input form.....-->
    
	<form method="post" action="service/ticketClerkService.php" >
        
        
        <input type="hidden" name="tid" value="<?php echo $tid; ?>">
        
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="tname" value="<?php echo $tname; ?>">
		</div>
		<div class="input-group">
			<label>Address</label>
			<input type="text" name="taddress" value="<?php echo $taddress; ?>">
		</div>
        <div class="input-group">
			<label>Password</label>
			<input type="password" name="tpassword" value="<?php echo $tpassword; ?>">
		</div>
        <div class="input-group">
			<label>Email</label>
			<input type="text" name="temail" value="<?php echo $temail; ?>">
		</div>
        <div class="input-group">
			<label>Mobile</label>
			<input type="text" name="tmobile" value="<?php echo $tmobile; ?>">
		</div>
        <div class="input-group">
			<label>date of birth</label>
			<input type="date" name="tdob" value="<?php echo $tdob; ?>">
		</div>
		<div class="input-group">
            
			<?php if ($update == true): ?>
                <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
            <?php else: ?>
                <button class="btn" type="submit" name="save" >Save</button>
            <?php endif ?>
            
		</div>
	</form>
    
</body>
</html>