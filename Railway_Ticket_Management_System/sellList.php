<?php
session_start();
include('service/db.php');

?>
<!DOCTYPE html>
<html>
<head>
<title>Customer home page</title>
        <link rel="stylesheet" type="text/css" href="style/Style.css">

</head>

<body>
    <?php
    include('adminHeader.php');
    ?>
    <?php 
       
        $results = executeSQL("SELECT ticket.cid,customer.cname, ticket.tiid,ticket.tiprice,ticket.titransactionno FROM ticket INNER JOIN customer ON ticket.cid=customer.cid "); 
    ?>

<table>
	<thead>
		<tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
			<th>Ticket ID</th>
			<th>Amount</th>
            <th>Transaction No</th>
            
            
			
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
            <td><?php echo $row['cid']; ?></td>
            <td><?php echo $row['cname']; ?></td>
			<td><?php echo $row['tiid']; ?></td>
			<td><?php echo $row['tiprice']; ?></td>
            <td><?php echo $row['titransactionno']; ?></td>
<!--
            <td><?php echo $row['tmobile']; ?></td>
            <td><?php echo $row['tdob']; ?></td>
			
-->
		</tr>
	<?php } ?>
</table>
    
</body>

</html>