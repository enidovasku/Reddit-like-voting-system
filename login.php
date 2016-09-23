<?php
session_start();
include_once("auth.php");
if(isset($_SESSION['logged_in'])){
     header("Location:index.php");
     //. $_SERVER['HTTP_REFERER']
     }else {
?>
<html>
<body>
<form method="post" action="login.php" >
    <input name="username" type="text" />
    <input name="password" type="password"/>
    <input type="submit" value="submit"/>
</form>
</body>
</html>

<?php 
if(isset($_POST['username'])&& isset($_POST['password'])){
    $username=$_POST['username'];
    $password=$_POST['password'];

    $result=$auth->login($username,$password);
    if($result!=0){
        session_start();
        $_SESSION['logged_in']=1;
        $_SESSION['user_id']=$result;
        header("Location:index.php");
    }
    else{

    }
}
else{
    echo "Plotesoji te gjitha fushat.";
}?>
<?php } ?>