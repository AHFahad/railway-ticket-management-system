<!DOCTYPE html>
<?php
    session_start();
    require "service/db.php";
?>
<html>
<head>
    <title>Payment</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    
</head>
<body>
    <?php
    include('customerHeader.php');
    
    
    $trid = $_GET['trid'];
    $tobookedseat = $_GET['tobookedseat'];
    $trseatcapacity = $_GET['trseatcapacity'];
    $trprice = $_GET['trprice'];
    $toid = $_GET['toid'];
    $_SESSION['trid']= $_GET['trid'];
    $_SESSION['tobookedseat'] = $_GET['tobookedseat'];
    $_SESSION['trseatcapacity'] = $_GET['trseatcapacity'];
    $_SESSION['trprice'] = $_GET['trprice'];
    $_SESSION['toid'] = $_GET['toid'];
    
    
    
    $availableseat=$trseatcapacity-$tobookedseat;
    $ticketscanbuy=0;
    if($availableseat>=4){
        $ticketscanbuy=4;
    }
    elseif($availableseat<0){
        $ticketscanbuy=0;
    }
    else{
      $ticketscanbuy=$availableseat;
    }
    
    
    ?>

         <form method="post" action="service/customerservice.php" >
         
        <div class="input-group">
			<label>Cost per seat</label>
            <?php echo $trprice;?>
             <input type="hidden" id="price" name="t" value="<?php echo $trprice; ?>">
		</div>
        <div class="input-group">
            
            <?php echo  "You can buy ".$ticketscanbuy." tikets at Max "; ?>
           
			<label>No of tickets</label>
            <select name="nooftickets" id="nooftickets">
                <?php
                    
                    
                    $count=1;
                    while($count<=$ticketscanbuy){
                       echo '<option value="'.$count.'"  ">'.$count.'</option>';
                        $count++;
                    }
                ?>
            </select>
		</div>
        <div class="input-group">
			<label>Total Cost</label>
            <p id="totalcost"><?php echo $trprice;?></p>
		</div>
             
          <div class="input-group">
			<label>Payment method</label>
			<select name="tipaymentmethod" id="paymentmethod" >
                <option value="1">Bikash</option>
                <option value="2">Bank</option>
                <option value="3">Nagat</option>
             
            </select>
		</div>
             <div class="input-group">
			<label>Send money to our</label>
            <p id="accountno">bikash account :016-XXXXXXX</p>
		</div>
        
        <div class="input-group">
			<label>Transaction No</label>
			<input type="text" name="titransactionno" >
		</div>
    
    
		<div class="input-group">
            
		
                <button class="btn" type="submit" name="pay" >Pay</button>
          
            
		</div>
	</form>
    
   
    
    
   
    
    <script>
        document.getElementById('nooftickets').onchange = function() {
        var a = this.value;
        var b=  document.getElementById('price').value;
            var x=a*b;
        document.getElementById("totalcost").innerHTML = x;    
       
        };
        document.getElementById('paymentmethod').onchange = function() {
        var a = this.value;
        if(a==1){
          document.getElementById("accountno").innerHTML = "bikash account :016-XXXXXXX";  
        }
        else if(a==2){
          document.getElementById("accountno").innerHTML = "bank account :123-XXXXX-XX-X";  
        } 
        else{
          document.getElementById("accountno").innerHTML = "Nagat account :016-XXXXXXX";  
        }   
       
        };
    </script>
</body>
</html>