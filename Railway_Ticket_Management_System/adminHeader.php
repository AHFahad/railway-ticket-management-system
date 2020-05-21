
        <link rel="stylesheet" href="style/headerStyle.css">
        <script>
          
             

        
            function colorNavlink(ok){
                
                 document.getElementsByClassName("link")[0].style.backgroundColor="";
                 document.getElementsByClassName("link")[1].style.backgroundColor="";
                 document.getElementsByClassName("link")[2].style.backgroundColor="";
                 document.getElementsByClassName("link")[3].style.backgroundColor="";
                 document.getElementsByClassName("link")[4].style.backgroundColor="";
                document.getElementsByClassName("link")[ok].style.backgroundColor = "#4CAF50";
               
            }
        </script>
        <div class="header">
            <div class="logo">
                <img src="img/logo.png" alt="logo">
            </div>
            <div class="menu">
                <ul>
                    <li><a class="link"  onclick="colorNavlink(0)" href="Adminhome.php">Home</a></li>
                    <li><a class="link"  onclick="colorNavlink(1)" href="ticketClerk.php">Ticket clerk</a></li>
                    <li><a class="link" onclick="colorNavlink(2)" href="refundList.php">Refund list</a></li>
                     <li><a class="link" onclick="colorNavlink(3)" href="sellList.php">sell list</a></li>
                    <li><a class="link" onclick="colorNavlink(4)" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
       