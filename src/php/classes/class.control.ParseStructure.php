<?php

namespace control;

class ParseStructure
{
	#----------------------------------------------------------
	# Parse
	public static function Parse()
	{
		$Structure 		   		= array();
		$Structure['forbidden'] = array('..', '.');
		$Structure['root'] 		= \control\ParseStructure::GetDir();

		$Structure['entries'] = scandir($Structure['root'], 0);

		\control\ParseStructure::ScanRecursive($Structure['entries']);
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# GetDir
	private static function GetDir()
	{
		$Dir = "";

		if (isset($_GET['folder']) && !empty($_GET['folder']))
		{
			$Dir = PROJECT_DOCUMENT_ROOT."/notes".$_GET['folder'];
		}
		else
		{
			$Dir = PROJECT_DOCUMENT_ROOT."/notes";
		}

		return $Dir;
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# ScanRecursive
	private static function ScanRecursive(&$_Entries)
	{
		\control\ParseStructure::FilterFolders($_Entries);



	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# FilterFolders
	private static function FilterFolders(&$_Entries)
	{
		$Forbidden = array(".", "..");

		foreach ($_Entries as $Key => $Value)
		{
			if (!is_dir($Value) || in_array($Value, $Forbidden))
			{
				unset($_Entries[$Key]);
			}
		}
		var_dump($_Entries);
		$_Entries = array_values($_Entries);
		var_dump($_Entries);
	}
	#----------------------------------------------------------
}

?>