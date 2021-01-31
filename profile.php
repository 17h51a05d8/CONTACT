<?php
 session_start();
$users=[];
if(!isset($_SESSION['na']))
{
    echo "ACCESS DENIED";
    die();
}
if(isset($_SESSION['na'])){
     $na=htmlentities($_SESSION['na']);
    try{
        $pdo = new PDO("mysql:host=localhost;dbname=id13583630_contactlist", "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $stmt=$pdo->query("SELECT * FROM users where email='$na'");
    while($row=$stmt->fetch(PDO::FETCH_OBJ)){
        $users[]=$row;
    }}
    catch(PDOExcepion $e){
        echo "connection failed" . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>MINI PROJECT</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <meta charset="utf-8"> 
    <meta name="viewport" 
          content="width=device-width, initial-scale=1"> 
    <link rel="stylesheet" 
          href= 
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"> 
  </script> 
    <script src= 
"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"> 
    </script> 
    <script src= 
"https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"> 
    </script> 
	</head>
<body>
    <div class="container">
    <div class="card text-center"  style="width: 50rem;margin: 0 auto;float: none;margin-bottom: 10px;padding:10px;background:grey;text-color:white;">
  <div class="card-body" style="color:white;font-size:15px;">
    <h5 class="card-title">PROFILE</h5>
     <pre> <?php foreach($users as $user) : ?>
      <p><b>USERNAME:-  </b><?php echo $user->username;?></p>
      <p><b> PASSWORD:-  </b><?php echo $user->password;?></p>
      <p><b>EMAIL:-  </b><?php echo $user->email;?></p>
      <?php endforeach;?></pre>
    <a href="edituser.php?id=<php echo $user->id;?>" class="btn btn-primary">EDIT</a>
      <a href="index.php" class="btn btn-success">back</a>
  </div>
</div>
    </div>
    </body>
</html>