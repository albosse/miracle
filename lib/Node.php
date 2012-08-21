<?php
abstract class Node
{
	protected $id;
	protected $incoming;
	protected $name;
	protected $outgoing;
	protected $type;

	function setId($id)
	{
		 $this->id = $id;
	}

	function getId()
	{
		return $this->id;
	}

	function setIncoming($incoming)
	{
		 $this->incoming[] = $incoming;
	}

	function getIncoming()
	{
		return $this->incoming;
	}

	function setName($name)
	{
		 $this->name = $name;
	}

	function getName()
	{
		return $this->name;
	}

	function setType($type)
	{
		 $this->type = $type;
	}

	function getType()
	{
		return $this->type;
	}

	function setOutgoing($outgoing)
	{
		if($outgoing instanceof SequenceFlow)
		{
			$pos = array_search($outgoing->getId(), $this->getOutgoing());
			 unset($this->outgoing[$pos]);
		}
		 $this->outgoing[] = $outgoing;
	}

	function getOutgoing()
	{
		return $this->outgoing;
	}
}
?>
