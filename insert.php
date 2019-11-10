<?php
$username = $_POST['username'];
$password = $_POST['pwd'];
$email=$_POST['email'];
if(!empty($username) || !empty($pwd) || !empty($email))
{
$host="localhost";
$dbUsername="root";
$dbPassword="";
$dbname="wwflogin_";
$conn=new mysqli($host,$dbUsername,$dbPassword,$dbdbname);
if(mysqli_connect_error())
{
die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
}
else
{
$SELECT = "SELECT email From zoo_hackathon Where email = ? Limit 1";
$INSERT = "INSERT Into zoo_hackathon (username,password,email) values(?,?,?)";
$stmt=$conn->prepare($SELECT);
$stmt->bind_parem("s", $email);
$stmt->execute();
$stmt->bind_result($email);
$stmt->store_result();
$rnum=$stmt->num_rows;
if($rnum==0)
{
$stmt->close();
$stmt=$conn->prepare($INSERT);
$stmt->bind_param("sis",$username, $password, $email);
$stmt->execute();
echo "New record inserted succesfully";
}
else {
echo "someone already register using this email";
}
$stmt->close();
$conn->close();
}
}
else
{
echo "all field are required";
die();
}
?>
