<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
  include_once 'includes/headerinc.php';
  include_once 'includes/databhandler.php';
  include_once 'includes/functionsinc.php';
  echo "<p></p>"
  
?>
<link rel="stylesheet" href="css/style.css"<?php echo time(); ?>>

<script>
$(document).ready(function(){
      var today = new Date();
      var minDate = new Date(today);
      minDate.setDate(minDate.getDate()+1);
      var maxDate = new Date(today);
      maxDate.setDate(minDate.getDate()+29);
      var Loadcount = 1;
         
      

      $("#closeDate").datepicker({
         
         showAnim:'drop',
         numberOfMonth:1,
         minDate: minDate,
         maxDate: maxDate,
         dateFormat:'yy/mm/dd',
         onClose: function(dateSelected){
         }
      });
      $("#bookoff").click(function(e){
        e.preventDefault();
        $.ajax({
          url:"includes/dashboardinc.php",
          type:"post",
          data:$("#bookoffform").serialize(),
          success:function(d){
            
          }
        });
      });  
      $("#update").click(function(e){
        //e.preventDefault();
        $.ajax({
          url:"includes/profileinc.php",
          type:"post",
          data:$("#profileform").serialize(),
          success:function(d){
            echo(d);
            
          }
        });
      });  
      
      
      
    });
</script>
<section>
    <div class="container-fluid" id="profilecontainer">
      <div class="card text-center">
      <div class="card-header text-center">
          <h2>Your details</h2>
                      
      </div>
      <div class="card-body">
        <form class = "row g-3 w-auto" id ="profileform" action="" method="post">
          <div class="col-4">
            <?php 
                $id = $_SESSION["userid"];
                $sql = "SELECT * FROM users WHERE usersID = '{$id}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo "<label for='f_name' class='form-label'>";
                echo $row["usersFname"];
                echo"</label>";
              
              ?>

              <input class="form-control" type="text" name="fname" placeholder="Change First Name here" id="f_name">

          </div>
          <div class="col-4">
            <?php 
                $id = $_SESSION["userid"];
                $sql = "SELECT * FROM users WHERE usersID = '{$id}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo "<label for='s_name' class='form-label'>";
                echo $row["usersSname"];
                echo"</label>";
              
              ?>

              <input class="form-control" type="text" name="sname" placeholder="Change Last Name here" id="s_name">

          </div>
          <div class="col-4">
            <?php 
                $id = $_SESSION["userid"];
                $sql = "SELECT * FROM users WHERE usersID = '{$id}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo "<label for='pnum' class='form-label'>";
                echo $row["usersPnum"];
                echo"</label>";
              
              ?>

              <input class="form-control" type="text" name="pnum" placeholder="Change Phone number here" id="pnum" >

          </div>
          
          <div class="col-4">
              <label for="pass" class="form-label">Password </label>

              <input class="form-control" type="text" name="pass" placeholder="Change Password Here" id="pass" pattern="[0-9]{11}">

          </div>
          <div class="col-4">
            <?php 
                $id = $_SESSION["userid"];
                $sql = "SELECT * FROM Barber WHERE usersID = '{$id}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo "<label for='b_name' class='form-label'>";
                echo $row["BarberName"];
                echo"</label>";
              
              ?>

              <input class="form-control" type="text" name="bname" placeholder="Change Barber shop name here" id="b_name">

          </div>
          <div class="col-4">
            <?php 
                $id = $_SESSION["userid"];
                $sql = "SELECT * FROM Barber WHERE usersID = '{$id}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo "<label for='add' class='form-label'>";
                echo $row["BarberAddress"];
                echo"</label>";
              
              ?>

              <input class="form-control" type="text" name="add" placeholder="Change Barber Address here" id="add">

          </div>
          <div class="col-4">
            <?php 
                $id = $_SESSION["userid"];
                $sql = "SELECT * FROM Barber WHERE usersID = '{$id}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo "<label for='serv1' class='form-label'>";
                echo $row["BarberService"];
                echo"</label>";
              
              ?>

              <input class="form-control" type="text" name="serv1" placeholder="Change first service and price here" id="serv1">

          </div>
          <div class="col-4">
            <?php 
                $id = $_SESSION["userid"];
                $sql = "SELECT * FROM Barber WHERE usersID = '{$id}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo "<label for='serv2' class='form-label'>";
                echo $row["BarberService2"];
                echo"</label>";
              
              ?>

              <input class="form-control" type="text" name="serv2" placeholder="Change second service and price here" id="serv2">

          </div>
          <div class="col-4">
            <?php 
                $id = $_SESSION["userid"];
                $sql = "SELECT * FROM Barber WHERE usersID = '{$id}'";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                echo "<label for='serv3' class='form-label'>";
                echo $row["BarberService3"];
                echo"</label>";
              
              ?>

              <input class="form-control" type="text" name="serv3" placeholder="Change third service and price here" id="serv3">

          </div>
          
          <div class="card-footer text-muted">

              <button class="btn btn-primary" type ="submit" id="update" name="update">Update details</button>

          </div>
      
      </form>

          

      </div>
        
      
      </div>
    </div>
      
      
     
</section>

<section class="bookoffformsection">
          <div class="container-fluid" id="sign1">
              <div class="card">
                  <div class="card-header text-center">
                    <h2>Select day off</h2>
                      
                  </div>
                  <div class="card-body text-center">
                    <form class = "row g-3" id="bookoffform" action="" method="post">
                            
                        <div class = "col-12">
                        <input type ="text" name="date" id ="closeDate" placeholder = "Please select date">
                        </div>
                        </div>
                        <div class="card-footer text-muted text-center">

                            <button class="btn btn-primary" type ="submit" id ="bookoff" name="bookoff">Book off</button>
                            

                        </div>
                    </form>
      
                    </section>
<section>
    <div class="container-fluid" id="schedulecontainer">
      <div class="card text-center">
      <div class="card-header text-center">
          <h2>Schedule</h2>
                      
      </div>
        
      <table id="barberschedule" class="card-table table table-responsive table-striped table-responsive table-hover">
        <thead  >
          <tr>
            <th scope="col">Service</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
            <th scope="col">Time</th>
          </tr>
        </thead>
        <tbody>
          
          <?php
            $id = $_SESSION["userid"];
            $sql1="SELECT * FROM Barber WHERE usersID = '{$id}' ";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1)){
              $row1 = mysqli_fetch_assoc($result1);
              $bid = $row1["BarberID"];
              $date = date("Y/m/d") ;
              $sql = "SELECT * FROM appointment WHERE BarberID = '{$bid}' AND appointmentTime = '{$date}' ORDER BY appointmentDate ASC, appointmentTime ASC ";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result)> 0) {
                  while ($row = mysqli_fetch_assoc($result)){
                    echo"<tr>";
                    echo"<td>";
                    echo $row["appointmentService"];
                    echo"</td>";
                    echo"<td>";
                    echo $row["appointmentDate"];
                    echo"</td>";
                    echo"<td>";
                    echo $row["appointmentStatus"];
                    echo"</td>";
                    echo"<td>";
                    echo $row["appointmentTime"];
                    echo"</td>";
                    echo"</tr>";
                    
                    
                    
                  }

                
            }else {
                echo "No appointments today";
            }

            }
            else{
              echo "No appointments today";
            }
            
            
            

          ?>

          
          
          
        </tbody>
      </table>
      </div>
    </div>
      
      
     
</section>
<section>
    <div class="container-fluid"  id="schedulecontainer">
      <div class="card text-center">
        <div class="card-header text-center">
          <h2>Upcoming Appointments</h2>
                      
        </div>
      <table id="barberschedule" class="card-table table table-responsive table-striped table-responsive table-hover">
        <thead  >
          <tr>
            <th scope="col">Service</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
            <th scope="col">Time</th>
          </tr>
        </thead>
        <tbody>
          
          <?php
            $id = $_SESSION["userid"];
            $sql1="SELECT * FROM Barber WHERE usersID = '{$id}' ";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1)>0){
              $row1 = mysqli_fetch_assoc($result1);
              $bid = $row1["BarberID"];
              $date = date("Y/m/d") ;
              
              $sql = "SELECT * FROM appointment WHERE BarberID = '{$bid}' AND appointmentDate > '{$date}' ORDER BY appointmentDate DESC, appointmentTime ASC";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result)> 0) {
                  while ($row = mysqli_fetch_assoc($result)){
                    echo"<tr>";
                    echo"<td>";
                    echo $row["appointmentService"];
                    echo"</td>";
                    echo"<td>";
                    echo $row["appointmentDate"];
                    echo"</td>";
                    echo"<td>";
                    echo $row["appointmentStatus"];
                    echo"</td>";
                    echo"<td>";
                    echo $row["appointmentTime"];
                    echo"</td>";
                    echo"</tr>";
                    
                    
                    
                  }

                  
              }else {
                  
                  
                  echo "No previous appointments";
              }

            }else{
              echo "No history";
            }
            
            

          ?>

          
          
          
        </tbody>
      </table>
      </div>
    </div>
      
      
     
</section>
<section>
    <div class="container-fluid"  id="schedulecontainer">
      <div class="card text-center">
        <div class="card-header text-center">
          <h2>History</h2>
                      
        </div>
      <table id="barberschedule" class="card-table table table-responsive table-striped table-responsive table-hover">
        <thead  >
          <tr>
            <th scope="col">Service</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
            <th scope="col">Time</th>
          </tr>
        </thead>
        <tbody>
          
          <?php
            $id = $_SESSION["userid"];
            $sql1="SELECT * FROM Barber WHERE usersID = '{$id}' ";
            $result1 = mysqli_query($conn, $sql1);
            if (mysqli_num_rows($result1)>0){
              $row1 = mysqli_fetch_assoc($result1);
              $bid = $row1["BarberID"];
              $date = date("Y/m/d") ;
              
              $sql = "SELECT * FROM appointment WHERE BarberID = '{$bid}' AND appointmentDate < '{$date}' ORDER BY appointmentDate DESC, appointmentTime ASC";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result)> 0) {
                  while ($row = mysqli_fetch_assoc($result)){
                    echo"<tr>";
                    echo"<td>";
                    echo $row["appointmentService"];
                    echo"</td>";
                    echo"<td>";
                    echo $row["appointmentDate"];
                    echo"</td>";
                    echo"<td>";
                    echo $row["appointmentStatus"];
                    echo"</td>";
                    echo"<td>";
                    echo $row["appointmentTime"];
                    echo"</td>";
                    echo"</tr>";
                    
                    
                    
                  }

                  
              }else {
                  echo"<br>";
                  
                  echo "No previous appointments";
              }

            }else{
              echo "No history";
            }
          ?>
        </tbody>
      </table>
      </div>
    </div>
      
      
     
</section>
<?php
include_once 'includes/footerinc.php';
?>