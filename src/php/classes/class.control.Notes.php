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
		require_once LIB_ROOT."/lib.Directory.php";

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
		\lib\GetFilesFromDir(CSS_ROOT, $Arguments['CSS']);
		\view\Html::RenderHead($Arguments);
		#----------------------------------------------------------

		#----------------------------------------------------------
		# load folder structure
		$Structure = new \control\ParseStructure();
		$Structure->Parse();
		#----------------------------------------------------------
		\lib\SortLinks($Structure->Save['HTMLUrl']);

		if (isset($_GET['folder']) && !empty($_GET['folder']))
		{
			foreach ($Structure->Save['HTMLUrl'] as $Page)
			{
				include $Page;
			}
		}
		else
		{
			foreach ($Structure->Save['TableOfContentRoot'] as $Key => $Value)
			{
				$Link = new \control\HtmlElement('a');
				$Link->Set('href', '?folder=/'.$Key)->Set('title', $Key)->Set('text', $Key);
				$Link->Output();
				echo '<br />';
			}
		}


		#----------------------------------------------------------
		# closing html skeleton
		\view\Html::RenderFoot();
		#----------------------------------------------------------
	}
}

?>