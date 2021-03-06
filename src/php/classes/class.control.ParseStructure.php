<?php

namespace control;

use DirectoryIterator, 
    FilterIterator,
    RecursiveIterator,
    RecursiveDirectoryIterator,
    RecursiveIteratorIterator;

class ParseStructure
{
	#----------------------------------------------------------
	# Parse
	public function Parse()
	{

		$Structure 				 = array();
		$Structure['Forbidden']  = array('..', '.');
		$Structure['Types']		 = array('.html');
		$Structure['ImageTypes'] = array('.jpg', '.jpeg', '.png', '.gif');
		$Structure['Root'] 		 = $this->GetDir();
		$Structure['TableOfContentRoot'] = $this->FilterFolders(scandir(NOTES_DOCUMENT_ROOT), NOTES_DOCUMENT_ROOT, $Structure['Forbidden']);
		$Structure['Initials']   = scandir($Structure['Root'], 0);
		$Structure['Initials']   = $this->FilterFolders($Structure['Initials'], $Structure['Root'], $Structure['Forbidden']);
		$Structure['Folders']    = array();
		$Structure['Entries']    = array();
		$Structure['Files']      = array();
		$Structure['HTML']       = array();
		$Structure['Images']	 = array();
		$this->ScanRecursive($Structure);
		$this->Save = $Structure;
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# GetDir
	private function GetDir()
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
	private function ScanRecursive(&$_Structure)
	{
		if (is_dir($_Structure['Root']))
		{
			$Iterator = new RecursiveDirectoryIterator($_Structure['Root']);

			foreach (new RecursiveIteratorIterator($Iterator, RecursiveIteratorIterator::CHILD_FIRST) as $File)
			{
				if ($File->isFile())
				{
					$ThisPath = str_replace('\\', '/', $File);
					$ThisFile = utf8_encode($File->getFilename());
					$_Structure['Entries']  = array_merge_recursive($_Structure['Entries'], \lib\PathToArray($ThisPath));
				
					
					foreach ($_Structure['Types'] as $Type)
					{
						if (!($File->getBasename($Type) == $File->getBasename()))
						{
							$_Structure['HTML']      = array_merge_recursive($_Structure['HTML'], \lib\PathToArray($ThisPath));
							$_Structure['HTMLUrl'][] = $ThisPath;
						}
					}

					foreach ($_Structure['ImageTypes'] as $Type)
					{
						if (!($File->getBasename($Type) == $File->getBasename()))
						{
							$_Structure['Images']   = array_merge_recursive($_Structure['Images'], \lib\PathToArray($ThisPath));
							$_Structure['ImgUrl'][] = $ThisPath;					}
					}
				}
			}
		}

		#$_Structure['Folders'] = \control\ParseStructure::FilterFolders($_Structure['Initials'], $_Structure['Root'], $_Structure['Forbidden']);
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# FilterFolders
	private function FilterFolders($_Entry, $_Root, $_Forbidden)
	{
		$Folders = array();

		foreach ($_Entry as $Key => $Value)
		{
			if (!in_array($Value, $_Forbidden) && is_dir($_Root."/".$Value))
			{
				$Folders[$Value] = PROJECT_HTTP_ROOT.'/'.$Value;
			}
		}

		return $Folders;
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# FilterFiles
	/*private static function FilterFiles($_Folders, $_Types, &$_Files)
	{
		foreach ($_Folders as $Key => $Value)
		{
			if (!in_array($Value, $_Forbidden) && is_dir($_Root."/".$Value))
			{
				$_Files[] = $Value;
			}
		}
	}*/
	#----------------------------------------------------------

public $Save = array();

}



?>