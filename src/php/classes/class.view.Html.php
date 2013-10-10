<?php

namespace view;

class Html
{

	#-----------------------------------------------
	# Render Head
	# $_Arguments could be CSS or Favicon files
	# Don't want to see any JS imported here!
	# $_Arguments look like 
	# $_Arguments = array( 
	#						"CSS" => array(
	#										"CSS_ROOT/reset.css",
	#										"CSS_ROOT/main.css"
	#									  ),
	#						"FAV" => "PROJECT_DOCUMENT_ROOT/img/..."
	#					 );
	#-----------------------------------------------
	public static function RenderHead($_Arguments = array())
	{
		?>
<!doctype html>
<html lang="de">
	<head>
		<meta charset="utf-8">
		<title><?=HTML_TITLE?></title>
		<meta name="description" content="<?=HTML_DESC?>">
		<meta name="author" content="<?=HTML_AUTHOR?>">
		  <?php
		  	foreach ($_Arguments as $Argument => $Value)
		  	{
		  		if (strtoupper($Argument) == "CSS")
		  		{
		  			foreach($Value as $CSS)
		  			{
		  			?>
		<link rel="stylesheet" href="<?=$CSS?>">
		  			<?php
		  			}
		  		}
		  		if (strtoupper($Argument) == "FAV")
		  		{
		  			?>
		<link rel="icon" type="image/x-icon" href="<?=$Value?>">
		  			<?php
		  		}
		  	}
		  ?>

		  <!--<link rel="stylesheet" href="css/styles.css?v=1.0"> -->

		  <!--[if lt IE 9]>
		  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		  <![endif]-->
	</head>
	<body>		
		<?php
	}

	#-----------------------------------------------
	# Render Foot
	# $_Arguments could JS files
	#-----------------------------------------------
	public static function RenderFoot($_Arguments = array())
	{
		?>

	</body>
</html>
		<?php
	}
}

?>