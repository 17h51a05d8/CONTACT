<?php
	$myButtonText = "click me if you can!";
?>
<!DOCTYPE html>
<html>
<body>
<p>Click the button below to disable the button above.</p>

<button id="myBtn" onclick="window.location.href='disable.php'";"myFunction();">Try it</button>

<script>
function myFunction() {
  document.getElementById("myBtn").disabled = true;
}
</script>
  </body>
</html>