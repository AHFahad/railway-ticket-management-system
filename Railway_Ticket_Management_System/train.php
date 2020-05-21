<!DOCTYPE html>
<?php  
session_start();
include('service/db.php');

    $trname="";
    $trprice="";
    $trseatcapacity="";
    $trstarttime="";
    $trendtime="";
    $trstartstation=0;

    $trendstation=0; 
    $trstatus=0;

	$trid = 0;
	$update = false;
 ?>

<!--

// to get na infromation of whitch data has been edited..
-->
<?php 
	if (isset($_GET['edit'])) {
		$trid = $_GET['edit'];
		$update = true;
		$record =executeSQL( "SELECT * FROM train WHERE trid=$trid");

		{
			$n = mysqli_fetch_array($record);
			$trname = $n['trname'];
			$trprice = $n['trprice'];
            $trseatcapacity=$n['trseatcapacity'];
            $trstarttime=$n['trstarttime'];
            $trendtime=$n['trendtime'];
            $trstartstation=$n['trstartstation'];
            $trendstation=$n['trendstation'];
            $trstatus=$n['trstatus'];
            echo $trstartstation;
            
		}
	}
?>




<html>
<head>
	<title>edit train</title>
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
       
        $results = executeSQL("SELECT * FROM train"); 
    ?>

<table>
	<thead>
		<tr>
            <th>ID</th>
			<th>Name</th>
			<th>Ticket price</th>
            <th>Train Seat Capacity</th>
            <th>Train start time</th>
            <th>Train end time</th>
            <th>Train start station</th>
            <th>Train end station</th>
            <th>Status</th>
            
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
            <td><?php echo $row['trid']; ?></td>
			<td><?php echo $row['trname']; ?></td>
			<td><?php echo $row['trprice']; ?></td>
            <td><?php echo $row['trseatcapacity']; ?></td>
            <td><?php echo $row['trstarttime']; ?></td>
            <td><?php echo $row['trendtime']; ?></td>
            
            
            <td>
                <?php
                $stationid=$row['trstartstation'];
                $result=executeSQL("SELECT * FROM station WHERE sid = $stationid");
                    
                $result = mysqli_fetch_array($result);
                                                       
                echo $result["sname"];
                ?>
                
            </td>
            
            
            
            
            <td>
                     
                <?php
                $stationid=$row['trendstation'];
                $result=executeSQL("SELECT * FROM station WHERE sid = $stationid");
                    
                $result = mysqli_fetch_array($result);
                                                       
                echo $result["sname"];
                ?>
                
            
            
            
            
            </td>
            
            <td><?php 
                    if($row['trstatus']==1)
                        echo "Active" ;
                    else{
                        echo "Not Active";
                    }
                
                
                ?></td>
            
            
			<td>
				<a href="train.php?edit=<?php echo $row['trid']; ?>" class="edit_btn" >Edit</a>
			</td>
<!--
			<td>
				<a href="service/trainService.php?del=<?php echo $row['trid']; ?>" class="del_btn">Delete</a>
			</td>
-->
		</tr>
	<?php } ?>
</table>
    
    
<!--    //show input form.....-->
    
	<form method="post" action="service/trainService.php" >
        
        
        <input type="hidden" name="trid" value="<?php echo $trid; ?>">
        
		<div class="input-group">
			<label>Name</label>
			<input type="text" name="trname" value="<?php echo $trname; ?>">
		</div>
		<div class="input-group">
			<label>Ticket price</label>
			<input type="text" name="trprice" value="<?php echo $trprice; ?>">
		</div>
        
        <div class="input-group">
			<label>Train start time</label>
			<input type="time" name="trstarttime" value="<?php echo $trstarttime; ?>">
		</div>
        <div class="input-group">
			<label>Train end time</label>
			<input type="time" name="trendtime" value="<?php echo $trendtime; ?>">
		</div>
        <div class="input-group">
			<label>Train seat capacity</label>
			<input type="text" name="trseatcapacity" value="<?php echo $trseatcapacity; ?>">
		</div>
        
        
        <div class="input-group">
			<label>Train Start station</label>

            
            
            
            <select name="trstartstation">
                    <?php 

                    $result = executeSQL("SELECT * FROM station");

                    while ($row = $result->fetch_assoc())
                    {
                        if($row['sstatus']==1){
                            $selected="";
                        if($row['sid']==$trstartstation){
                            $selected="selected";
                            echo "selected";
                        }
                        else{
                            $selected="";
                        }
                        
                    
                         
                        echo '<option value="'.$row['sid'].'" '.$selected.' ">'.$row['sname'].'</option>';
                            
                        }
                        
                    }
                    ?>

            </select>
                   
		</div>
        
        
        
        <div class="input-group">
			<label>Train end Station</label>

            
            
         
            <select name="trendstation">
                    <?php 

                    $result = executeSQL("SELECT * FROM station");

                    while ($row = $result->fetch_assoc())
                    { 
                        if($row['sstatus']==1){
                            
                            $selected="";
                            if($row['sid']==$trendstation){
                                $selected="selected";
                                echo "selected";
                            }
                            else{
                                $selected="";
                            }

                            echo '<option value="'.$row['sid'].'" '.$selected.' ">'.$row['sname'].'</option>';
                            
                            
                        }
                       
                    }
                    ?>

            </select>
            
            
            
            
		</div>
        
        
        
        
        
        <div class="input-group">
			<label>Status</label>
            
                <select name="trstatus" >
                  <option value=1 <?php if($trstatus==1){echo "selected";} ?> >Active</option>
                  <option value=0 <?php if($trstatus==0){echo "selected";} ?> >Not Active</option>
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