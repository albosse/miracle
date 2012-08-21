<?php
include_once 'Node.php';

class Gateway extends Node
{
	protected $gatewayDirection;

	public function setGatewayDirection($gatewayDirection)
	{
		$this->gatewayDirection = $gatewayDirection;
	}

	public function getGatewayDirection()
	{
		return $this->gatewayDirection;
	}

	public function setType($type)
	{
		$this->type= $type;
	}

	public function getType()
	{
		return $this->type;
	}
}