<?php

namespace lib;

use DirectoryIterator, 
    FilterIterator,
    RecursiveIterator,
    RecursiveDirectoryIterator,
    RecursiveIteratorIterator;

#----------------------------------------------------------
# GetFilesFromDir
function GetFilesFromDir($_Path, &$_Save)
{
		$Iterator = new RecursiveDirectoryIterator($_Path);

		foreach (new RecursiveIteratorIterator($Iterator, RecursiveIteratorIterator::CHILD_FIRST) as $File)
		{
			if ($File->isFile())
			{
				$ThisPath = str_replace('\\', '/', $File);
				$ThisFile = utf8_encode($File->getFilename());
				$_Save[]  = $ThisPath; 
				#$_Save['Structure'] = array_merge_recursive($_Save['Structure'], \lib\PathToArray($ThisPath));
			}
		}
}
#----------------------------------------------------------

#----------------------------------------------------------
# PathToArray
function PathToArray($_Path, $_Seperator = '/')
{
	if (($Pos = strpos($_Path, $_Seperator)) === false)
	{
		return array($_Path);
	}

	return array(substr($_Path, 0, $Pos) => \lib\PathToArray(substr($_Path, $Pos +1)));
}
#----------------------------------------------------------

#----------------------------------------------------------
# PathToArray
function SortLinks(&$_Links)
{
	foreach ($_Links as $Key => $Value)
	{
		$Counter['Length'] = count(explode('/', $Value));
		$_Key[] = $Counter;
	}

	var_dump($_Links);
}
#----------------------------------------------------------

?>