<?php
include_once 'ListGenerator.php';
/**
 * Create HTML sites from Signavio XML Docs
 */
 interface PageGeneratorInfterface
 {
 	public function getPageTemplate();
 	public function finish();
 	public function saveToFile($filename);
 }

class PageGenerator implements PageGeneratorInfterface
{
	protected $process;
	protected $processName;
	protected $page;
	protected $content;
	protected $lg;

	function __construct($process = null, $name)
	{
		$this->process = $process;
		$this->lg = new ListGenerator($this->process);
		$this->processName = $name;
		$this->content = array();
 	}

 	private function replaceTitle()
 	{
 		$this->page = str_replace('%title%', $this->processName, $this->page);
 	}

 	private function replaceContent()
 	{
 		$this->page = str_replace('%content%', implode($this->content), $this->page);
 	}

 	public function process()
 	{
 		$this->page = $this->getPageTemplate();
		$this->replaceTitle();
		$this->processNodes();
		$this->replaceContent();

 		return $this->page;
 	}

 	function processNodes($node = null)
 	{
 		if($node == null)
 		{
			$node = $this->lg->findStart();
 		}

		if($node->getType() != 'endEvent')
		{
			if($node->getType() == 'task')
			{
				$this->content[] = $node->getName();
			}
			else
			{
				$this->content[] = 'XXX';
			}

			foreach($this->lg->getNext($node) as $child)
			{
				echo 'ya  ';
				$this->processNodes($child);
			}
		}
 	}

	public function getPageTemplate()
	{
		$page = '<!DOCTYPE HTML>
				<html>
				 <head>
				 	  	<meta name="viewport" content="width=device-width, initial-scale=1">
						<meta http-equiv="content-type" content="application/xhtml+xml;  charset=utf-8" />
						<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
						<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
						<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
				   		<!--Put title here -->
				   		<title>%title%</title>
				 </head>
				 <body>

					<!-- Page 1:Home -->
					 <div  data-role="page" id="home" data-title="Home">

					    <div data-role="header">
					        <!--Put title here -->
					        		<h1>%title%</h1>
					    </div>

					    <div data-role="content">
					   		<!-- Put content here -->
							%content%
					 	</div>

					 	<div data-role="footer" data-position="fixed">
					        <h1>Copyright 2012</h1>
					    </div>
					 </div>
					</body>
					</html>';

		return $page;
	}

	public function finish()
	{

	}

	public function saveToFile($filename)
	{
		finish();
	}
}
