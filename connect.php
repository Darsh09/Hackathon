<?php
$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$password=$_POST['password'];

$dbusername='root';
$dbpassword='';
$db='hackathon';

$db=new mysqli('localhost', $dbusername, $dbpassword, $db);
if(mysqli_connect_error())
{
    die('Connection Unsuccessful');
}
else{
    $select="SELECT email from users WHERE email=? LIMIT 1";
    $insert="INSERT INTO users ( name, phone, email, password ) VALUES (?,?,?,?)";

    $stmt=$db->prepare($select);
    $stmt=$db->bind_param("s",$email);
    $stmt=$db->execute();
    $stmt=$db->bind_result($email);
    $stmt=$db->store_result();
    $rnum=$stmt->num_rows;
    if($rnum==0)
    {
        $stmt->close();
        $stmt=$db->prepare($insert);
        $stmt=$db->bind_param("siss", $name, $phone, $email, $password);
        $stmt=$db->execute();
        echo "New record inserted successfully";
    }
    else{
        echo "Someone already registered using this email";
    }
}
?>
<html>
<head><title>fekafjdn</title></head>
<body>  
    <form action="" method="post">
    <input type="text" name="name" placeholder="Name">
    <input type="email" name="email" placeholder="email">
    <input type="password" name="password" placeholder="password">
    <input type="number" name="phone" placeholder="">
    <input type="submit">
    </form>
</body>
</html>