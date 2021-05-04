<?php
echo"<p>";
error_reporting(E_ALL);
ini_set('display_errors', '1');
echo"</p>";

require_once 'databhandler.php';
require_once 'functionsinc.php';
/*
<div class="card col-4">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div>
*/
$sql = "SELECT * FROM Barber WHERE BarberActive = '1'";

$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $sql2 = "SELECT usersPnum FROM users WHERE usersID = {$row['usersID']} ";
        $result2 = mysqli_query($conn, $sql2);
        $aResult = mysqli_fetch_assoc($result2);
        echo "<div class = 'card col-4'> <div class = 'card-header text-center'> <h2>{$row['BarberName']}</h2></div>";
        echo "<div class='card-body'>";
        echo"<p>Address: {$row['BarberAddress']}</p>";
        echo"<p>Phone number: {$aResult['usersPnum']} </p>";
        echo"<p>Top 3 services: </p>";
        echo"<p>{$row['BarberService']}</p>";
        echo"<p>{$row['BarberService2']}</p>";
        echo"<p>{$row['BarberService3']}</p>";
        echo "<div class='card-footer text-muted'>";
        echo "<form action='book.php' method ='post'>";
        echo "<input type='hidden' name='barberid' value= {$row['BarberID']}>";
        echo "<input type ='hidden' name='barbername' value= '{$row['BarberName']}''>";
        echo "<button class='btn btn-primary' type ='submit' name='submit'>Book Now</button>";
        echo"</form>";
        echo "</div>";
        echo"</div>";
        echo "</div>";

    }
    

}else{
    echo"ERROR";
}
