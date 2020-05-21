<!DOCTYPE html>
<?php  
session_start();
include('service/db.php');

    $cname="";
    $caddress="";
    $cmobile="";
    $cemail="";
    $cpassword="";
    $cdob="";
	$cid = 0;
	$update = false;
    $cstatus=false;
 ?>

<!--

// to get na infromation of whitch data has been edited..
-->
<?php 
	if (isset($_GET['edit'])) {
		$cid = $_GET['edit'];
		$update = true;
		$record =executeSQL( "SELECT * FROM customer WHERE cid=$cid");

		{
			$n = mysqli_fetch_array($record);
			$cname = $n['cname'];
			$caddress = $n['caddress'];
            $cmobile=$n['cmobile'];
            $cemail=$n['cemail'];
            //$cpassword=$n['cpassword'];
            $cdob=$n['cdob'];
             $cstatus=$n['cstatus'];
            
		}
	}
?>




<html>
<head>
	<title>customer</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">

</head>
<body>
    
    <!--    header declaration-->
    <?php
    include('ticketClerkHeader.php');
    ?>
    
    
<!--    //show messeage ....-->
    
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
       
        $results = executeSQL("SELECT * FROM customer"); 
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
             <th>status</th>
            
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
            <td><?php echo $row['cid']; ?></td>
			<td><?php echo $row['cname']; ?></td>
			<td><?php echo $row['caddress']; ?></td>
            <td><?php echo $row['cemail']; ?></td>
            <td><?php echo $row['cmobile']; ?></td>
            <td><?php echo $row['cdob']; ?></td>
            
            
            <td><?php 
                    if($row['cstatus']==1)
                        echo "Active" ;
                    else{
                        echo "Not Active";
                    }
                
                
                ?></td>
            
            
            
            
            
            
            
			<td>
				<a href="customer.php?edit=<?php echo $row['cid']; ?>" class="edit_btn" >Edit</a>
			</td>
<!--
			<td>
				<a href="service/customerService.php?del=<?php echo $row['cid']; ?>" class="del_btn">Delete</a>
			</td>
-->
		</tr>
	<?php } ?>
</table>
    
    
<!--    //show input form.....-->
    
	<form method="post" action="service/customerService.php" >
        
        
        <input type="hidden" name="cid" value="<?php echo $cid; ?>">
        
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="cname" value="<?php echo $cname; ?>">
		</div>
		<div class="input-group">
			<label>Address</label>
			<input type="text" name="caddress" value="<?php echo $caddress; ?>">
		</div>
        <div class="input-group">
			<label>Password</label>
			<input type="password" name="cpassword" value="<?php echo $cpassword; ?>">
		</div>
        <div class="input-group">
			<label>Email</label>
			<input type="text" name="cemail" value="<?php echo $cemail; ?>">
		</div>
        <div class="input-group">
			<label>Mobile</label>
			<input type="text" name="cmobile" value="<?php echo $cmobile; ?>">
		</div>
        <div class="input-group">
			<label>date of birth</label>
			<input type="date" name="cdob" value="<?php echo $cdob; ?>">
		</div>
        
        <div class="input-group">
			<label>status</label>
            
                <select name="cstatus" >
                  <option value=1 <?php if($cstatus==1){echo "selected";} ?> >Active</option>
                  <option value=0 <?php if($cstatus==0){echo "selected";} ?> >Not Active</option>
                </select>
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