<?php 
require( '/../views/' . 'config.php' );
/*define a variable of the name of a php file containing extra scripts or links that are necessary*/
/*$HEAD_EXTRA = "";*/
?>

<html>
<?php
	include('/../' . VIEW_HEAD);
?>

<body>
<?php 
	
	include( '/../' . VIEW_NAVIGATION );  

/*need to define the file name of the php containing content for page_to_load in the file that will include this file*/

	include( '/../' . DIR_CONTENT . $page_to_load );
	include( '/../' . VIEW_FOOTER );
?>
</body>
</html>