<?php
include_once 'helper/TransformXML.php';
include_once 'helper/ListGenerator.php';
include_once '../classes/Event.php';
include_once '../classes/Gateway.php';
include_once '../classes/Task.php';
include_once '../classes/Process.php';
include_once '../classes/SequenceFlow.php';

$processName = htmlspecialchars($_POST['process_name']);
$nodeId      = htmlspecialchars($_POST['node']);

$process = new TransformXML();
$process = $process->unserialise($processName);

$lg = new ListGenerator($process);

if($node = $lg->findNode($nodeId))
{
	$next = $lg->getNext($node);
	$type = $node->getType();

	if($type == 'startEvent')
	{
		$node = $lg->getNext($node);
		$next = $lg->getNext($node);
		$type = $node->getType();
	}
}elseif(is_null($node))
{
	$node = $lg->findSequenceFlow($nodeId);
	$type = 'sequenceFlow';
}

	switch ($type)
	{
		case 'task' :
			processTask($node,$lg);
		break;
		/**
		 * New Page needed
		 */
		case 'subProcess' :
			processSubProcess($node,$lg);
		break;

		case 'exclusiveGateway':
			//processExclusiveGateway($node);
		break;

		case 'parallelGateway' :
			processParallelGateway($node,$lg);
		break;

		case 'endEvent' :
		break;

		case 'sequenceFlow':
			processSequenceFlow($node,$lg);
		break;
	}

	function processTask($node,$lg)
	{
		$next = $lg->getNext($node);

		if($next->getType() == 'exclusiveGateway')
		{
			processExclusiveGateway($node,$lg);
		}
		elseif($next->getType() == 'parallelGateway')
		{
			processParallelGateway($node,$lg);
		}
	}

	function processSequenceFlow($node,$lg)
	{
		if(is_object($node)){
			$target = $lg->findNode($node->getTargetRef());
			if($target->getType() == 'task')
			{
				processTask($target,$lg);
			}
		}
	}

	/**
	 * Processes the next, exlusiveGatway as an actionSheet
	 */
	function processExclusiveGateway($node,$lg)
	{
		$next = $lg->getNext($node);

		if($next->getGatewayDirection() == 'Diverging')
		{
			$string = '<div data-role="dialog" id="' . $node->getId() .'" data-title="' .$node->getName() .'"><div data-role="content">';
			foreach($next->getOutgoing() as $node)
			{
				$string .= '<a  class="flow" href="#home" data-role="button" id="' .$node->getId() .'">' . $node->getName() .'</a>';
			}
		}
		elseif($lg->getNext($next)->getType() == 'endEvent')
		{
			$string = '<div data-role="dialog" id="' . $node->getId() .'" data-title="' .$node->getName() .'"><div data-role="content">';
			$string .= '<a class="finish" href="#home" data-role="button" id="' .$next->getId() .'">Erledigt</a>';
		}
		$string .='</div></div>';
		echo $string;
	}

	function processParallelGateway($node,$lg)
	{
		$string = '<div data-role="dialog" id="' . $node->getId() .'" data-title="' .$node->getName() .'"><div data-role="content">';
		$string .= '<fieldset data-role="controlgroup" data-type="horizontal" >';

		$next = $lg->getNext($node);

		if($next->getGatewayDirection() == 'Diverging')
		{
			foreach($next->getOutgoing() as $out)
			{
				$task = $lg->findNode($out->getTargetRef());
				$string .= '<input type="checkbox" name="123" id="'. $task->getId() . '" />';
				$string .= '<label for="'.$task->getId().'"  data-theme="c">'. $task->getName() .'</label> ';
			}
			$string .= '<a class="flow" href="#home" data-role="button" id="123" data-theme="a">Submit</a>';
			$string .='</fieldset></div></div>';
		}
		elseif($lg->getNext($next)->getType() == 'endEvent')
		{
			$string = '<div data-role="dialog" id="' . $node->getId() .'" data-title="' .$node->getName() .'"><div data-role="content">';
			$string .= '<a class="finish" href="#home" data-role="button" id="' .$next->getId() .'">Erledigt</a>';
		}
		echo $string;

	}

	function processSubProcess($node)
	{
		$string = '<div data-role="dialog" id="' . $node->getId() .'" data-title="' .$node->getName() .'"><div data-role="content">';
		$string .= '<ol id="process-list" data-inset="true" data-role="listview" data-split-theme="d"></ol>';
		$string .= '<a class="flow" href="#home" data-role="button" id="123">Schritt 1</a>';
		$string .='</div></div>';
			echo $string;
	}
?>