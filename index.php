<?php
	
session_start();

$logged_in = false;
$autos = [];
if (isset($_SESSION['na']) ) {

	$logged_in = true;
	$status = false;

	if ( isset($_SESSION['status']) ) {
		$status = htmlentities($_SESSION['status']);
		$status_color = htmlentities($_SESSION['color']);

		unset($_SESSION['status']);
		unset($_SESSION['color']);
	}
    $na=htmlentities($_SESSION['na']);
	try 
	{
	    $pdo = new PDO("mysql:host=localhost;dbname=id13583630_contactlist", "root", "");
	    // set the PDO error mode to exception
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    $all_autos = $pdo->query("SELECT * FROM autos where username='$na'");

		while ( $row = $all_autos->fetch(PDO::FETCH_OBJ) ) 
		{
		    $autos[] = $row;
		}
	}
	catch(PDOException $e)
	{
	    echo "Connection failed: " . $e->getMessage();
	    die();
	}
}

?>

<!DOCTYPE html>
<html>
	<head>
		<title>MINI PROJECT</title>
        <link rel="stylesheet" href="style.css">
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
	<body style="background-color:grey;">
			<?php if (!$logged_in) : ?>
                
            
            <div class="container">
            <div class="form-group"> 
             
                <a   href="login.php" class="btn btn-success btn-lg float-right" 
                      style='margin-right:16px'> 
                    <i class="fa fa-user-circle-o" style="font-size:36px"></i>
                    sign in </a> 
                <a href='register.php' class="btn btn-success btn-lg float-right" style='margin-right:16px'> <i class="fa fa-user-plus" style="font-size:36px"></i>sign up </a>
            </div> 
        </div>
            
            
            
            <div class="container">
        <div class="jumbotron">
        <div class="row">
          <div class="card col-md-4" style="width: 18rem;">
  <img class="card-img-top" src="add.jpg" alt="Card image cap" height="300" width="300">
  <div class="card-body">
    <h5 class="card-title">ADD CONTACT</h5>
    <p class="card-text"></p>
    <a href="login.php" class="btn btn-success"><i class="fa fa-plus-square-o"></i>ADD</a>
  </div>
</div>
      
             <div class="card col-md-4" style="width: 18rem;">
  <img class="card-img-top" src="edit.png" alt="Card image cap" height="300" width="300">
  <div class="card-body">
    <h5 class="card-title">EDIT CONTACT</h5>
    <p class="card-text"></p>
    <a href="login.php" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>EDIT</a>
  </div>
</div>
      
            
             <div class="card col-md-4" style="width: 18rem;">
  <img class="card-img-top" src="delete.jpg" alt="Card image cap" height="300" width="300">
  <div class="card-body">
    <h5 class="card-title">DELETE CONTACT</h5>
    <p class="card-text"></p>
    <a href="login.php" class="btn btn-danger"><i class="fa fa-trash"></i>DELETE</a>
  </div>
</div>
            
      </div>
      </div>
      </div>
            
<?php else : ?>
            
        
        
        
        <div class="container">
            <div class="form-group"> 
             
                <a   href="logout.php" class="btn btn-success btn-lg float-right" 
                      style='margin-right:16px'> 
                    <i class="fa fa-sign-out" style="font-size:36px"></i>
                     LOGOUT</a> 
                <a href='profile.php' class="btn btn-success btn-lg float-right" style='margin-right:16px'> <i class="fa fa-user-circle-o" style="font-size:36px"></i>PROFILE</a>
                <a href='contact.php' class="btn btn-success btn-lg float-right" style='margin-right:16px'> <i class="fa fa-address-card-o" style="font-size:36px"></i>MYCONTACTS</a>
            </div> 
        </div>
            
            
            
            <div class="container">
        <div class="jumbotron">
        <div class="row">
          <div class="card col-md-4" style="width: 18rem;">
  <img class="card-img-top" src="add.jpg" alt="Card image cap" height="300" width="300">
  <div class="card-body">
    <h5 class="card-title">ADD CONTACT</h5>
    <p class="card-text"></p>
    <a href="add.php" class="btn btn-success"><i class="fa fa-plus-square-o"></i>ADD</a>
  </div>
</div>
      
             <div class="card col-md-4" style="width: 18rem;">
  <img class="card-img-top" src="edit.png" alt="Card image cap" height="300" width="300">
  <div class="card-body">
    <h5 class="card-title">EDIT CONTACT</h5>
    <p class="card-text"></p>
    <a href="contact.php" class="btn btn-primary"><i class="fa fa-pencil-square-o"></i>EDIT</a>
  </div>
</div>
      
            
             <div class="card col-md-4" style="width: 18rem;">
  <img class="card-img-top" src="delete.jpg" alt="Card image cap" height="300" width="300">
  <div class="card-body">
    <h5 class="card-title">DELETE CONTACT</h5>
    <p class="card-text"></p>
    <a href="contact.php" class="btn btn-danger"><i class="fa fa-trash"></i>DELETE</a>
  </div>
</div>
            
      </div>
      </div>
      </div>
        
        
        
        
<?php endif; ?>
	</body>
</html>