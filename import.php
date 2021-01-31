<?php
	
session_start();

$logged_in = false;
$autos = [];
$email;

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
    $image="user.png";
    $info=null;
	try 
	{
	  $pdo = new PDO("mysql:host=localhost;dbname=contacts", "root", "");
	    // set the PDO error mode to exception
        $pdo2=new PDO("mysql:host=localhost;dbname=id13583630_contactlist","root","");
        $pdo2->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	    $all_autos = $pdo->query("SELECT * FROM usercontact WHERE useremail='$na'");

		while ( $row = $all_autos->fetch(PDO::FETCH_OBJ) ) 
		{
		    $autos[] = $row;
		}
       foreach($autos as $auto) 
        {
           $stmt = $pdo2->prepare("
        INSERT INTO autos (username,name,contact,image,email,info) 
        VALUES ('$na','$auto->name','$auto->contact','$image','$auto->email','$info')");
	   $stmt->execute();		                        	
	}
        header("Location:contact.php");
    }
	catch(PDOException $e)
	{
	    echo "Connection failed: " . $e->getMessage();
	    die();
	}
}

?>
