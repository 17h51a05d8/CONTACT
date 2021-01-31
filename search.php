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
    $name2=htmlentities($_POST['input']);
	try 
	{
	  $pdo = new PDO("mysql:host=localhost;dbname=id13583630_contactlist", "root", "");
	    // set the PDO error mode to exception
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if(strlen($_POST['input'])>1){

	    $all_autos = $pdo->query("SELECT * FROM autos WHERE username='$na' and name='$name2' or contact='$name2' or email='$name2'");

		while ( $row = $all_autos->fetch(PDO::FETCH_OBJ) ) 
		{
		    $autos[] = $row;
		}
        }
        else
        {
            header('Location:contact.php');
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
<h1 align="center">YOUR CONTACTS</h1>
				<?php
	                if ( $status !== false ) 
	                {
	                    // Look closely at the use of single and double quotes
	                    echo(
	                        '<p style="color: ' .$status_color. ';" class="col-sm-10">'.
	                            $status.
	                        "</p>\n"
	                    );
	                }
	            ?>

				<?php if (empty($autos)) : ?>
					<p>No Contacts</p>
                    
				<?php else : ?>  
<form method="post" action="search.php">
<input type="text" id ="speech" name="input" maxlength="150" size="150">
    <input type="button" value="speak" onclick="record()"/> 
    <input type="submit" value="search"/>
     </form>
        <p>
						<table class="table">
							<thead>
								<tr>
									<th>name</th>
									<th>contact</th>
                                    <th>Profile</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($autos as $auto) : ?>
			                        <tr>
			                        	<td><?php echo $auto->name; ?></td>
										<td><?php echo $auto->contact; ?></td>
                                        <td><?php echo $auto->email;?></td>
                                        <td>
                                               <img src="upload/<?php echo $auto->image;?>" width="100" height="100">
                                        </td>
                                        <td><?php echo $auto->info;?></td>
										<td><a class="btn btn-primary" href="edit.php?autos_id=<?php echo $auto->autos_id; ?>"><i class="fa fa-pencil-square-o"></i>Edit</a> <a class="btn btn-danger" href="delete.php?autos_id=<?php echo $auto->autos_id; ?>"><i class="fa fa-trash"></i>Delete</a></td>
			                        </tr>
			                    <?php endforeach; ?>
							</tbody>
						</table>
					</p>
				<?php endif; ?>
               
    
    

            <div class="form-group"> 
                <a href="add.php" class="btn btn-success btn-lg" 
                      style='margin-right:16px'> 
                    <i class="fa fa-plus-square-o"></i>
                    Add new Contact </a> 
                <a href='logout.php' class="btn btn-danger btn-lg float-right" style='margin-right:16px'><i class="fa fa-sign-out"></i>Log out</a>
            </div> 
  <script>
    function record() {
            var recognition = new webkitSpeechRecognition();
            recognition.lang = "en-GB";

            recognition.onresult = function(event) {
                // console.log(event);
                document.getElementById('speech').value = event.results[0][0].transcript;
            }
            recognition.start();

        }
    </script>
    </body>
</html>