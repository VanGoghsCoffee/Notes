<?php

namespace control;

class ParseStructure
{
	#----------------------------------------------------------
	# Parse
	public static function Parse()
	{
		$Structure 		   		= array();
		$Structure['Forbidden'] = array('..', '.');
		$Structure['Root'] 		= \control\ParseStructure::GetDir();
		$Structure['Entries']   = scandir($Structure['Root'], 0);
		$Structure['Folders']   = array();
		\control\ParseStructure::ScanRecursive($Structure);
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# GetDir
	private static function GetDir()
	{
		$Dir = "";

		if (isset($_GET['folder']) && !empty($_GET['folder']))
		{
			$Dir = NOTES_DOCUMENT_ROOT.$_GET['folder'];
		}
		else
		{
			$Dir = NOTES_DOCUMENT_ROOT;
		}

		return $Dir;
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# ScanRecursive
	private static function ScanRecursive(&$_Structure)
	{
		$_Structure['Folders'][] = \control\ParseStructure::FilterFolders($_Structure['Entries'], $_Structure['Root'], $_Structure['Forbidden']);

		var_dump($_Structure);
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# FilterFolders
	private static function FilterFolders(&$_Entry, $_Root, $_Forbidden)
	{
		$Folders = array();

		foreach ($_Entry as $Key => $Value)
		{
			if (in_array($Value, $_Forbidden))
			{
				unset($_Entry[$Key]);
			}
			else if (!is_dir($_Root."/".$Value))
			{
				unset($_Entry[$Key]);
			}
			else
			{
				$Folders[] = $_Root."/".$Value;
			}
		}

		return $Folders;
	}
	#----------------------------------------------------------
}

?>