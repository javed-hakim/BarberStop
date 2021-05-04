<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

function emptyInputS($fname,$sname,$email, $pnum ,$pass ){
    $result;
    if(empty($fname)|| empty($sname)|| empty($email)|| empty($pnum)|| empty($pass)){
        $result =true;

    }
    else {
        $result =false;
    }
    return $result;
}

function invalidfname($fname){
    $result;
    if(!preg_match("/^[a-zA-z]*$/", $fname)){
        $result =true;

    }
    else {
        $result =false;
    }
    return $result;
}

function invalidsname($sname){
    $result;
    if(!preg_match("/^[a-zA-z]*$/", $sname)){
        $result =true;

    }
    else {
        $result =false;
    }
    return $result;
}

function serviceincf($conn, $name){
    $sql = "SELECT * FROM Barber WHERE BarberID = ?";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s", $name);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);


    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
        
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);


}

function closedates($conn, $bid){
    $sql = "SELECT appointmentDate FROM appointment WHERE appointmentStatus = 'BClosed' AND BarberID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"i", $bid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $inventory = array();
    $whilec = "False";


    if ($row = mysqli_fetch_assoc($resultData)) {
        while ($row = mysqli_fetch_assoc($resultData)) {
            $inventory[] = $row;
            $whilec = "True";
            
        }
        if ($whilec === "True"){
            echo json_encode($inventory);

        }
        else{
            $inventory[] = $row;
            echo json_encode($inventory);

        }
        
        
        
        
        
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
    

}
function closedtimes($conn, $date, $bid){
    $sql = "SELECT appointmentTime FROM appointment WHERE appointmentStatus = 'Active' AND appointmentDate = ? AND BarberID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss", $date, $bid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $inventory = array();
    $whilec = "False";


    if (mysqli_num_rows($resultData)!==0) {
        if ($check = mysqli_num_rows($resultData)> 1){
            while ($row = mysqli_fetch_assoc($resultData)) {
                $inventory[] = $row;
                $whilec = "True";
            }

        }else {
            
        }
        if ($whilec === "True"){
            
            
            echo json_encode($inventory);
        }else{
            $row = mysqli_fetch_assoc($resultData);
            $inventory[] = $row;
            
            echo json_encode($inventory);
        }
        
        
        
        
        
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
    

}
function Exists($conn, $email, $pnum){
    $sql = "SELECT * FROM users WHERE usersEmail = ? OR usersPnum = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"si", $email, $pnum);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);


    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
        
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);


}

function createUser($conn,$fname,$sname,$email, $pnum ,$pass){
    $sql = "INSERT INTO users (usersFname, usersSname, usersEmail, usersPnum, usersPass) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt,"sssss",$fname, $sname, $email, $pnum, $hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?error=Successful signup");
    exit();


}

function emptyInputL($email,$pass){
    $result;
    if(empty($email)|| empty($pass)){
        $result =true;

    }
    else {
        $result =false;
    }
    return $result;
}

function loginUser($conn, $email, $pass){
    $emailExists = Exists($conn, $email, $pnum);

    if ($emailExists === false) {
        header("location: ../login.php?error=Emailnotinuse");
        exit();
    }
    $passHash = $emailExists["usersPass"];
    $checkPass = password_verify($pass, $passHash);

    if ($checkPass === false){
        header("location: ../login.php?error=wrongpass");
        exit();
    }
    elseif ($checkPass === true) {
        session_start();
        $_SESSION["userid"]= $emailExists["usersID"];
        $_SESSION["username"]= $emailExists["usersFname"];
        $_SESSION["type"]= $emailExists["usersType"];
        
        header("location: ../index.php?error=Loggedin");
        exit();
        
    }
}


function appCheck($conn, $email, $pnum){
    $sql = "SELECT * FROM users WHERE usersEmail = ? OR usersPnum = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"si", $email, $pnum);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);


    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
        
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);


}

function emptyInputB($date,$time){
    $result;
    if(empty($date)|| empty($time)){
        $result =true;

    }
    else {
        $result =false;
    }
    return $result;
}

function createBooking($conn, $serv, $date, $stat, $id, $time, $barbid){
    $sql = "INSERT INTO appointment (appointmentService, appointmentDate, appointmentStatus, usersID, appointmentTime, BarberID) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt,"ssssss",$serv, $date, $stat, $id, $time, $barbid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../send-email.php");
    exit();
    

}
function upFname($conn, $fname, $id){
    $sql = "UPDATE users SET usersFname = ? WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt,"ss",$fname, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function upSname($conn, $sname, $id){
    $sql = "UPDATE users SET usersSname = ? WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt,"ss",$sname, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function upPnum($conn, $pnum, $id){
    $sql = "UPDATE users SET usersPnum = ? WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt,"ss",$pnum, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function upBname($conn, $bname, $id){
    $sql = "UPDATE Barber SET BarberName = ? WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt,"ss",$bname, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function upAdd($conn, $add, $id){
    $sql = "UPDATE Barber SET BarberAddress = ? WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt,"ss",$add, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function upServ1($conn, $serv1, $id){
    $sql = "UPDATE Barber SET BarberService = ? WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt,"ss",$serv1, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function upServ2($conn, $serv2, $id){
    $sql = "UPDATE Barber SET BarberService2 = ? WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt,"ss",$serv2, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function upServ3($conn, $serv3, $id){
    $sql = "UPDATE Barber SET BarberService3 = ? WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt,"ss",$serv3, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function upPass($conn, $pass, $id){
    $sql = "UPDATE users SET usersPass = ? WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
    

    mysqli_stmt_bind_param($stmt,"ss",$hashedPwd, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

}
function getID($conn, $barb){
    $sql = "SELECT * FROM Barber WHERE BarberName = ?";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s", $barb);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);


    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row['BarberID'];
        
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function checkClose($conn, $date, $barbid){
    $sql = "SELECT * FROM appointment WHERE appointmentDate = ? AND BarberID = ? AND appointmentStatus = 'BClosed';";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../book.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss", $date,$barbid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);


    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
        
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);

}

function appExists($conn, $date, $time, $barbid){
    $sql = "SELECT * FROM appointment WHERE appointmentDate = ? AND appointmentTime = ? AND BarberID = ? AND appointmentStatus = 'Active';";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../book.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sss", $date, $time, $barbid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);


    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
        
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);


}

function getbid($conn, $id){
    $sql = "SELECT * FROM Barber WHERE usersID = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../book.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"s", $id);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);


    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
        
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);


}

function del($conn, $can, $bID){
    $sql = "UPDATE appointment SET appointmentStatus = ? WHERE BarberID = ?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../book.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"ss",$can, $bID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    }

function emptyInputBS($bLname,$bFname,$bActive, $bAdd ,$bServ1, $bServ2, $bServ3, $bEmail, $bPass, $bName, $bPnum){
    $result;
    if(empty($bLname)|| empty($bFname)|| empty($bAdd)|| empty($bServ1)||empty($bServ2)|| empty($bServ3)|| empty($bEmail)|| empty($bPass)|| empty($bName)|| empty($bPnum)){
        $result =true;

    }
    else {
        $result =false;
    }
    return $result;
}

function bExists($conn, $bEmail, $bPnum){
    $sql = "SELECT * FROM users WHERE usersEmail = ? OR usersPnum = ?;";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../book.php?error=stmtfail");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"si", $bEmail, $bPnum);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);


    if ($row = mysqli_fetch_assoc($resultData)) {
        print_r($row);
        echo "Hello";
        return $row;
        
    }
    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);


}

function createBarber($conn,$fname,$sname,$email, $pnum ,$pass, $type){
    $sql = "INSERT INTO users (usersFname, usersSname, usersEmail, usersPnum, usersPass, usersType) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt,"ssssss",$fname, $sname, $email, $pnum, $hashedPwd, $type);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);



}
function createShop($conn,$bActive, $bAdd ,$bServ1, $bServ2, $bServ3, $bName, $grabid){

    $sql = "INSERT INTO Barber (BarberActive, BarberAddress, BarberService, BarberService2, BarberService3, BarberName, usersID) VALUES (?, ?, ?, ?, ?,?, ?);";
    $stmt = mysqli_stmt_init($conn); //prepared statement
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.php?error=stmtfail2");
        exit();
    }
    

    mysqli_stmt_bind_param($stmt,"sssssss",$bActive, $bAdd ,$bServ1, $bServ2, $bServ3,$bName, $grabid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("location: ../signup.php?error=SHOPDONE");
    exit();



}