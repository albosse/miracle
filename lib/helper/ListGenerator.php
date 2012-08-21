<?php
/**
 * Example of an Iterator
 */
class ListGenerator
{
	protected $process;
	protected $list;
	protected $currentNode;

	function __construct($process)
	 {
	   $this->list = '';
       $this->process = $process;
 	 }

 	 public function generate()
	{
		$this->processNode($this->findStart()->getId());
		$this->finishList();

		return $this->list;
	}

 	 function append($element)
 	 {
 	 	$this->list .= $element;
 	 }

 	 function findNode($id)
 	 {
 	 	foreach($this->process as $node)
 	 	{
 	 		if($node->getId() == $id)
 	 		{
 	 			return $node;
 	 		}
 	 	}
 	 }

 	 function findSequenceFlow($id)
 	 {
 	 	foreach($this->process as $key => $value)
 	 	{
 	 		if($value->getOutgoing() !=null){
	 	 		foreach($value->getOutgoing() as $flow)
	 	 		{
	 	 			if($flow->getId() == $id)
	 	 			{
	 	 				return $flow;
	 	 			}
	 	 		}
 	 		}
 	 	}
 	 }

 	 public function hasNext($node)
 	 {
 	 	$outgoing = $node->getOutgoing();
 	 	if($outgoing == null)
 	 	{
 	 		return false;
 	 	}

 	 }

 	 public function getNext($node)
	{
		if($outgoing = $node->getOutgoing())
		{
			$outgoing = array_shift($outgoing);
			return $this->findNode($outgoing->getTargetRef());
		}else{
			return false;
		}
	}

 	 function findStart()
 	 {
 	 	foreach($this->process as $node)
		{
			if($node->getType() == 'startEvent')
			{
				return $node;
			}
		}
 	 }
}
?>

