<?php

namespace control;

class Notes
{
	#----------------------------------------------------------
	# construct
	public function __construct()
	{
		#----------------------------------------------------------
		# error handling
		ini_set('display_errors', 'On');
		error_reporting(E_ALL);
		#----------------------------------------------------------

		#----------------------------------------------------------
		# loading libs and classes
		require_once CLASS_ROOT."/class.view.Html.php";
		require_once CLASS_ROOT."/class.control.HtmlElement.php";
		require_once CLASS_ROOT."/class.control.ParseStructure.php";
		#----------------------------------------------------------
	}
	#----------------------------------------------------------

	public function Run()
	{
		#----------------------------------------------------------
		# building html skeleton
		\view\Html::RenderHead();
		#----------------------------------------------------------

		#----------------------------------------------------------
		# load folder structure
		$Structure = new \control\ParseStructure();
		$Structure->Parse();

		#----------------------------------------------------------

		#----------------------------------------------------------
		# closing html skeleton
		\view\Html::RenderFoot();
		#----------------------------------------------------------
	}
}

?>