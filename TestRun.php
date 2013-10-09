<?php

require_once __DIR__."/Common.php";

require_once CLASS_ROOT."/class.view.Html.php";

$Arguments = array(
					"CSS" => array(
									CSS_ROOT."/reset.css",
									CSS_ROOT."/main.css"
								  ),
					"FAV" => PROJECT_DOCUMENT_ROOT."/img/test.ico"
				  );

\view\Html::RenderHead($Arguments);

?>