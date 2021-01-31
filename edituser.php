<?php
session_start();
if(!isset($_SESSION['na'])){
    echo "failed";
    die();
}
if(isset($_SESSION['na'])){
    try{
      $pdo = new PDO("mysql:host=localhost;dbname=id13583630_contactlist", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
        echo "failed" . $e->getMessage();
    }
    if(isset($_POST['username'])&&isset($_POST['password'])&&!isset($_SESSION['email'])){
    $username=htmlentities($_POST['username']);
    $password=htmlentities($_POST['password']);
    $email=htmlentities($_POST['email']);
    $na=htmlentities($_SESSION['na']);
    if(!empty($username)&&!empty($password)&&!empty(email)){
    $stmt=$pdo->query("UPDATE users SET username='$username',password='$password',email='$email' WHERE email='$na'");
         $stmt=$pdo->query("UPDATE autos SET username='$username' WHERE email='$na'");
    $_SESSION['na']=$email;
    header('Location:index.php');
    return;
    }
    else
    if(!empty($username)&&!empty($password)){
    $stmt=$pdo->query("UPDATE users SET username='$username',password='$password' WHERE email='$na'");
    $stmt=$pdo->query("UPDATE autos SET username='$username' WHERE email='$na'");
    $_SESSION['na']=$email;
    header('Location:index.php');
    return; 
    }
    else
    if(!empty($username)&&!empty($email)){
    $stmt=$pdo->query("UPDATE users SET username='$username',email='$email' WHERE email='$na'");
    $stmt=$pdo->query("UPDATE autos SET username='$username' WHERE email='$na'");
    $_SESSION['na']=$email;
    header('Location:index.php');
    return; 
    }
    else
     if(!empty($email)&&!empty($password)){
    $stmt=$pdo->query("UPDATE users SET email='$email',password='$password' WHERE email='$na'");
    $stmt=$pdo->query("UPDATE autos SET username='$username' WHERE email='$na'");
    header('Location:index.php');
    return; 
    }
    else
    if(!empty($password)){
    $stmt=$pdo->query("UPDATE users SET password='$password' WHERE email='$na'");
    header('Location:index.php');
    return;
    }
    else
    if(!empty($username)){
    $stmt=$pdo->query("UPDATE users SET username='$username' WHERE email='$na'");
    header('Location:index.php');
        $_SESSION['na']=$email;
    return;
    }
    else
    if(!empty($email)){
    $stmt=$pdo->query("UPDATE users SET email='$email' WHERE email='$na'");
    header('Location:index.php');
    return;
    } 
        $stmt = $pdo->prepare("
	    SELECT * FROM users
	    WHERE email ='$na''
	");
        
	$auto = $stmt->fetch(PDO::FETCH_OBJ);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MINI PROJECT</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h1>Editing Contact</h1>
            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-sm-2" for="username">User Name:</label>
                    <div class="col-sm-3 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input class="form-control" type="text" name="username" id="username">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2" for="password">Password:</label>
                    <div class="col-sm-3 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                </div>
                 <div class="form-group">
                    <label class="control-label col-sm-2" for="password">EMAIL:</label>
                    <div class="col-sm-3 input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                        <input class="form-control" type="txt" name="email" id="email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2 col-sm-offset-2">
                        <input class="btn btn-primary" type="submit" value="Save">
                        <a href="profile.php"class="btn btn-danger" name="cancel" value="Cancel">cancel</a>
                    </div>
                </div>
            </form>

        </div>
    </body>
</html>