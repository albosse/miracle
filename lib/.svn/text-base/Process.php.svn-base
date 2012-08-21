<?php
include_once 'Node.php';
class Process extends Node
{
	protected $completionQuantity;
	protected $isClosed;
	protected $isExecutable;
	protected $isForCompensation;
	protected $processName;
	protected $processType;
	protected $setTriggeredByEvent;
	protected $startQuantity;
	protected $subProcess;

	public function setSubProcess($process)
	{
		$this->subProcess[] = $process;
	}

	public function getSubProcess()
	{
		return $this->subProcess;
	}

	public function setCompletionQuantity($quantity)
	{
		$this->completionQuantity = $quantity;
	}

	public function getCompletionQuantity()
	{
		return $this->completionQuantity;
	}

	public function setIsClosed($boolean)
	{
		$this->isClosed = $boolean;
	}

	public function getIsClosed()
	{
		return $this->isClosed;
	}

	public function setIsExecutable($boolean)
	{
		$this->isExecutable = $boolean;
	}

	public function getIsExecutable()
	{
		return $this->isExecutable;
	}

	public function setIsForCompensation($boolean)
	{
		$this->isForCompensation = $boolean;
	}

	public function getIsForCompensation()
	{
		return $this->isForCompensation;
	}

	public function setProcessName($name)
	{
		$this->processName = $name;
	}

	public function getProcessName()
	{
		return $this->processName;
	}

	public function setProcessType($type)
	{
		$this->processType = $type;
	}

	public function getProcessType()
	{
		return $this->processType;
	}

	public function setStartQuantity($quantity)
	{
		$this->startQuantity = $quantity;
	}

	public function getStartQuantity()
	{
		return $this->startQuantity;
	}

	public function setTriggeredByEvent($event)
	{
		$this->triggeredByEvent = $event;
	}

	public function getTriggeredByEvent()
	{
		return $this->triggeredByEvent;
	}


}
?>
