<!DOCTYPE html>
<?php  
session_start();
include('service/db.php');
    $toid = 0;
    $trid="";
    $todate="";
    $tobookedseat="";
//    $trstarttime="";
//    $trendtime="";
//    $trstartstation=0;
//
//    $trendstation=0; 
//    $trstatus=0;

	
	$update = false;
 ?>

<!--

// to get na infromation of whitch data has been edited..
-->





<html>
<head>
	<title>CRUD: CReate, Update, Delete PHP MySQL</title>
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
       
        $results = executeSQL("SELECT * FROM totalBookedSeatByDate"); 
    ?>

<table>
	<thead>
		<tr>
            <th>ID</th>
			<th>Date</th>
			<th>Train ID</th>
            <th>Train Name</th>
            <th>total booked seat</th>
            
            
<!--			<th colspan="2">Action</th>-->
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
            <td><?php echo $row['toid']; ?></td>
            <td><?php echo $row['todate']; ?></td>
			<td><?php echo $row['trid']; ?></td>
            <td>
                <?php
                $trid=$row['trid'];
                $result=executeSQL("SELECT * FROM train WHERE trid = $trid");
                    
                $result = mysqli_fetch_array($result);
                                                       
                echo $result["trname"];
                ?>
                
            </td>
            
            <td><?php echo $row['tobookedseat']; ?></td>
            
<!--
            
			<td>
				<a href="train.php?edit=<?php echo $row['toid']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="service/trainService.php?del=<?php echo $row['toid']; ?>" class="del_btn">Delete</a>
			</td>
-->
		</tr>
	<?php } ?>
</table>
    
    
<!--    //show input form.....-->
    
	<form method="post" action="service/trainScheduleService.php" >
        
        
        <input type="hidden" name="toid" value="<?php echo $toid; ?>">
        
		
		<div class="input-group">
			<label>Date</label>
			<input type="date" name="todate" value="<?php echo $todate; ?>">
		</div>
        
       
        
        
        <div class="input-group">
			<label>Select Train </label>

            
            
            
            <select name="trid">
                    <?php 

                    $result = executeSQL("SELECT * FROM train");

                    while ($row = $result->fetch_assoc())
                    {
                        if($row['trstatus']==1){
                            $selected="";
//                        if($row['sid']==$trstartstation){
//                            $selected="selected";
//                            echo "selected";
//                        }
//                        else{
//                            $selected="";
//                        }
                        
                    
                         
                        echo '<option value="'.$row['trid'].'" '.$selected.' ">'.$row['trname'].'</option>';
                            
                        }
                        
                    }
                    ?>

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