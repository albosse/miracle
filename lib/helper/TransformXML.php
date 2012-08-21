<?php
/**
 * Transform a Signavio XML-File into an Object of Arrays
 * This Object can be used as a linked list and will be serialized for later use
 */
class TransformXML
{
	protected $processName;
   	protected $process;

	/**
	 * Constructs a TransformXML object
	 */
	function __construct($name = '')
	 {
       $this->processName = $name;
       $this->process = array();
 	 }

	/**
	 * Returns the name of the process
	 */
 	function getProcessName()
 	 {
 	 	return $this->processName;
 	 }

	/**
	 * Sets the name of the process
	 */
	function setProcessName($name)
 	 {
 	 	 $this->processName = $name;
 	 }

 	function getProcess()
	{
		return $this->process;
	}

	function setProcess($process)
	{
		 $this->process = $process;
	}

    function generateObject($node,$sub = null)
    {
		$element = null;
		$type = $node->getName();

		if(stristr($type,'event'))
		{
			$element = new Event();
			$element->setType($type);
		}
		elseif(stristr($type,'Gateway'))
		{
			$element = new Gateway();
			$element->setType($type);
		}
		elseif(stristr($type,'process'))
		{
			$element = new Process();
			$element->setType($type);

			if($this->getProcessName() != '')
			{
				$element->setProcessName($this->getProcessName());
			}
		}
		elseif(stristr($type,'task'))
		{
			$element = new Task();
			$element->setType($type);
		}
		elseif(stristr($type,'Flow'))
		{
			$element = new SequenceFlow();
			$element->setType('sequenceFlow');
		}

		//Attribute
		$this->setAttributes($element,$node);

		/**
		 * Subprozess muss mit seinen Child-Nodes gekoppelt werden
		 */

		if($element instanceof SequenceFlow)
		{
			$this->transformSequenceFlow($element);
		}

		elseif(!empty($element))
		{
			if(isset($sub))
			{
				$sub->setSubProcess($element);
			}
			else
			{
				$this->process[] = $element;
			}

			if($element->getType() == 'subProcess')
			{
				$this->transformSubProcess($element,$node);
			}
			else
			{
				foreach ($node->children() as $child)
				{
					if($this->nodeValid($child))
					{
						$this->generateObject($child);
					}
				}
			}
		}
	}
	/**
	 * @element The Process-Object to transform
	 * @node The current xml-node
	 */
	private function setAttributes($element,$node)
	{
		if(is_object($element))
		{
			foreach ($node->attributes() as $key => $value)
			{
				$function = 'set' . ucfirst($key);
				$element->$function(''.$value);
			}

			if ($node->incoming != '')
			{
				foreach ($node->incoming as $key => $value)
				{
					$element->setIncoming(''.$value);
				}
			}
			if ($node->outgoing != '') {
				foreach ($node->outgoing as $key => $value)
				{
					$element->setOutgoing(''.$value);
				}
			}
		}
	}

	private function transformSubProcess($element,$node)
	{
		foreach($node->children() as $node)
		{
			if($this->nodeValid($node))
			{
				$this->generateObject($node,$element);
			}
		}
	}

	private function transformSequenceFlow($element)
	{
		foreach($this->getProcess() as $id => $elem)
			{
				if(is_array($elem->getOutgoing()))
				{
					foreach($elem->getOutgoing() as $out)
					{
					  if($element->getId() == $out)
					  {
					  	$elem->setOutgoing($element);
					  }
					}
				}
			}
	}

	private function nodeValid($node)
	{
		switch ($node->getName())
		{
			case 'flowNodeRef':
				return false;
			break;
			case 'extensionElements':
				return false;
			break;
			case 'conditionalEventDefinition':
				return false;
			break;

			default:
				return true;
			break;
		}
	}

	/**
	 * Serialisiert ein Prozessobjekt und
	 * schreibt es GZ-komprimiert in den Ordner 'serialized'
	 */
	function serialise()
	{
		$filename = '../processes/serialized/' . str_replace(' ','',$this->getProcessName()) . '.miracle';
			$s = serialize($this->getProcess());
			$file = gzopen($filename, "w");
			gzwrite($file, $s);
			gzclose($file);
	}

	function unserialise($filename = '')
	{
		$filename = '../processes/serialized/' .$filename ;
		if(file_exists($filename))
		{
			$file = gzopen($filename,"r");
			$string = gzread($file, 100000);
			gzclose($file);
			return unserialize($string);
		}
		else
		{
			die('Datei nicht gefunden.');
		}
	}
  }