<!DOCTYPE html>
<?php
    session_start();
include('service/db.php');
   if(isset($_POST['search'])){
    $trstartstation=$_POST['trstartstation'];
    $trendstation=$_POST['trendstation'];
   }
?>
<html>
<head>
<title>Buy Ticket</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
    <?php
    include('customerHeader.php');
    ?>
    <form method="post" action="buyTicket.php" >
        
        
   
        
        
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
			<label>date</label>
			<input type="date" name="bookdate" >
		</div>
    
    
		<div class="input-group">
            
		
                <button class="btn" type="submit" name="search" >Search</button>
          
            
		</div>
	</form>
    
    
    <?php 
    if(isset($_POST['search'])){
        $trstartstation=$_POST['trstartstation'];
        $trendstation=$_POST['trendstation'];
        $bookdate=$_POST['bookdate'];
    
    ?>
    

      
        
     <?php 
       $currentDate=date("Y/m/d");
        $results = executeSQL(" select toid,todate,train.trid,train.trname,train.trprice,totalbookedseatbydate.tobookedseat,train.trseatcapacity,train.trstarttime,train.trendtime,train.trstartstation,train.trendstation,train.trstatus from train inner join totalbookedseatbydate on totalbookedseatbydate.trid=train.trid inner join station s on s.sid=train.trendstation inner join station e on e.sid=train.trendstation WHERE trstartstation =$trstartstation  AND trendstation=$trendstation AND totalbookedseatbydate.todate ='$bookdate'"); 
//        echo  $currentDate;
    ?>

<table>
	<thead>
		<tr>
            
            <th>Train ID</th>
			<th>Name</th>
			<th>Ticket price</th>
            <th>total booked seat</th>
            <th>Seat Capacity</th>
            <th>Start time</th>
             <th>End time</th>
            <th>Start station</th>
             <th>End station</th>
            <th>Date</th>
            <th>Status</th>
            
            
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
            <td><?php echo $row['trid']; ?></td>
			<td><?php echo $row['trname']; ?></td>
            <td><?php echo $row['trprice']; ?></td>
			<td><?php echo $row['tobookedseat']; ?></td>
            <td><?php echo $row['trseatcapacity']; ?></td>
            <td><?php echo $row['trstarttime']; ?></td>
            <td><?php echo $row['trendtime']; ?></td>
<!--
            <td><?php echo $row['trstartstation']; ?></td>
            <td><?php echo $row['trendstation']; ?></td>
-->
            
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
            
            
            <td><?php echo $row['todate']; ?></td>
            <td><?php 
                    if($row['trstatus']==1)
                        echo "Active" ;
                    else{
                        echo "Not Active";
                    }
                
                
                ?></td>
            
           
            
			<td>
                <?php
                         $currentDate=date("Y-m-d");
                if($row['todate']>=$currentDate){?>
				<a href="payment.php?trid=<?php echo $row['trid']; ?>&tobookedseat=<?php echo $row['tobookedseat']; ?>&trseatcapacity=<?php echo $row['trseatcapacity']; ?>&trprice=<?php echo $row['trprice']; ?>&toid=<?php echo $row['toid']; ?>" class="edit_btn" >GET</a>
                <?php }
                else {
                echo "not available";
                }
                ?>
			</td>
			
		</tr>
	<?php } ?>
</table>    
        
        
     <?php   
    }
    
    
    ?>
    
    
    
    
    
    

</body>
</html>