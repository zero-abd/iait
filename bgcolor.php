<?php 
	if(isset($_GET['color']))
		$selected_color = $_GET['color'];
		file_put_contents("uploads/color.txt", $_GET['color']);
?>
<script type="text/javascript"> 
   		if (window.confirm('Color selected successfully! Go back to the previous page and select image file.'))
{
	window.history.back();  
}
else
{
	window.history.back();
}
		</script>