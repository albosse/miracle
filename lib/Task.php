<?php
include_once 'Node.php';
class Task extends Node
{
	protected $completionQuantity;
	protected $isExecutable;
	protected $isForCompensation;
	protected $startQuantity;

	public function setCompletionQuantity($quantity)
	{
		$this->completionQuantity = $quantity;
	}

	public function getCompletionQuantity()
	{
		return $this->completionQuantity;
	}

	public function setIsExecutable($boolean)
	{
		$this->isExecutable = $boolean;
	}

	public function getIsExecutable()
	{
		return $this->isExecutable ;
	}

	public function setIsForCompensation($boolean)
	{
		$this->isForCompensation = $boolean;
	}

	public function getIsForCompensation()
	{
		return $this->isForCompensation;
	}

	public function setStartQuantity($quantity)
	{
		$this->startQuantity = $quantity;
	}

	public function getStartQuantity()
	{
		return $this->startQuantity;
	}


}
?>
