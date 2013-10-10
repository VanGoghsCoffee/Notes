<?php

/* 
* Simple class for generating HTML elements. Keeps the code organized.
* Credit goes to http://davidwalsh.name/create-html-elements-php-htmlelement-class
*/

namespace control;

class HtmlElement
{
	#----------------------------------------------------------
	# construct
	public function __construct($_Type, $_SelfClosers = array('input', 'img', 'hr', 'br', 'meta', 'link'))
	{
		$this->Type 	   = strtolower($_Type);
		$this->SelfClosers = $_SelfClosers;
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# get
	public function Get($_Attribute)
	{
		return $this->Attributes[$_Attribute];
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# set -- array or key, value
	public function Set($_Attribute, $_Value = '')
	{
		if (!is_array($_Attribute))
		{
			$this->Attributes[$_Attribute] = $_Value;
		}
		else
		{
			$this->Attributes = array_merge($this->Attributes, $_Attribute);
		}

		return $this;
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# remove an attribute
	public function Remove($_Attribute)
	{
		if (isset($this->Attributes[$_Attribute]))
		{
			unset($this->Attributes[$_Attribute]);
		}
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# clear
	public function Clear()
	{
		$this->Attributes = array();
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# inject
	public function Inject($_Object)
	{
		if (@get_class($_Object) == __class__)
		{
			$this->Attributes['text'] .= $_Object->Build();
		}
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# output
	public function Output()
	{
		echo $this->Build();
	}
	#----------------------------------------------------------

	#----------------------------------------------------------
	# build
	public function Build()
	{
		// start
		$Build = '<'.$this->Type;

		// add attributes
		if (count($this->Attributes))
		{
			foreach ($this->Attributes as $Key => $Value)
			{
				if ($Key != 'text') { $Build .= ' '.$Key.'="'.$Value.'"'; }
			}
		}

		// closing
		if (!in_array($this->Type, $this->SelfClosers))
		{
			$Build .= '>'.$this->Attributes['text'].'</'.$this->Type.'>';
		}
		else 
		{
			$Build .= ' />';
		}

		// returning it
		return $Build;
	}
	#----------------------------------------------------------


	private $Type;
	private $Attributes;
	private $SelfClosers;
}

?>