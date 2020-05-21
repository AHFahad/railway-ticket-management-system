<!DOCTYPE html>
<?php  
session_start();
include('service/db.php');

    $sname="";
    $slocation="";
    $sstatus=false;
//    $cemail="";
//    $cpassword="";
//    $cdob="";
	$sid = 0;
	$update = false;
 ?>

<!--

// to get na infromation of whitch data has been edited..
-->
<?php 
	if (isset($_GET['edit'])) {
		$sid = $_GET['edit'];
		$update = true;
		$record =executeSQL( "SELECT * FROM station WHERE sid=$sid");

		{
			$n = mysqli_fetch_array($record);
			$sname = $n['sname'];
			$slocation = $n['slocation'];
            $sstatus=$n['sstatus'];
//            $cemail=$n['cemail'];
            //$cpassword=$n['cpassword'];
//            $cdob=$n['cdob'];
            
		}
	}
?>




<html>
<head>
	<title>station</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">

</head>
<body>
    <!--    header declaration-->
    <?php
    include('ticketClerkHeader.php');
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
       
        $results = executeSQL("SELECT * FROM station"); 
    ?>

<table>
	<thead>
		<tr>
            <th>ID</th>
			<th>Station Name</th>
			<th>Location</th>
            <th>status</th>
<!--
            <th>mobile</th>
            <th>date of birth</th>
-->
            
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
            <td><?php echo $row['sid']; ?></td>
			<td><?php echo $row['sname']; ?></td>
			<td><?php echo $row['slocation']; ?></td>
            
<!--            <td><?php echo $row['cemail']; ?></td>-->
            <td><?php 
                    if($row['sstatus']==1)
                        echo "Active" ;
                    else{
                        echo "Not Active";
                    }
                
                
                ?></td>
            
<!--            <td><?php echo $row['cdob']; ?></td>-->
			<td>
				<a href="station.php?edit=<?php echo $row['sid']; ?>" class="edit_btn" >Edit</a>
			</td>
<!--
			<td>
				<a href="service/stationService.php?del=<?php echo $row['sid']; ?>" class="del_btn">Delete</a>
			</td>
-->
		</tr>
	<?php } ?>
</table>
    
    
<!--    //show input form.....-->
    
	<form method="post" action="service/stationService.php" >
        
        
        <input type="hidden" name="sid" value="<?php echo $sid; ?>">
        
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="sname" value="<?php echo $sname; ?>">
		</div>
		<div class="input-group">
			<label>Location</label>
			<input type="text" name="slocation" value="<?php echo $slocation; ?>">
		</div>
        
        
        
        
        <div class="input-group">
			<label>status</label>
            
                <select name="sstatus" >
                  <option value=1 <?php if($sstatus==1){echo "selected";} ?> >Active</option>
                  <option value=0 <?php if($sstatus==0){echo "selected";} ?> >Not Active</option>
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