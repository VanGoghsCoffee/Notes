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
		$Structure['Types']		= array('.html');
		$Structure['Root'] 		= \control\ParseStructure::GetDir();
		$Structure['Initials']  = scandir($Structure['Root'], 0);
		$Structure['Folders']   = array();
		$Structure['Entries']   = array();
		$Structure['Files']     = array();
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
		$_Structure['Folders'] .= \control\ParseStructure::FilterFolders($_Structure['Initials'], $_Structure['Root'], $_Structure['Forbidden']);
		
		foreach ($_Structure['Folders'][] as $Folder)
		{
			echo $Folder.'<br />';
		}

		echo "<pre>";
		var_dump($_Structure);
		echo "</pre>";
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# FilterFolders
	private static function FilterFolders(&$_Entry, $_Root, $_Forbidden)
	{
		$Folders = array();

		foreach ($_Entry as $Key => $Value)
		{
			if (!in_array($Value, $_Forbidden) && is_dir($_Root."/".$Value))
			{
				$Folders[] = $_Root."/".$Value;
			}
		}

		return $Folders;
	}
	#----------------------------------------------------------
}

?>