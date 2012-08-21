<?php
include_once '/helper/TransformXML.php';
include_once '/helper/ListGenerator.php';
include_once '../classes/Event.php';
include_once '../classes/Gateway.php';
include_once '../classes/Task.php';
include_once '../classes/Process.php';
include_once '../classes/SequenceFlow.php';
?>

<!DOCTYPE HTML>
<html>
 <head>
 	  	<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="application/xhtml+xml;  charset=utf-8" />
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
		<script src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
		<script src="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.js"></script>
   		<title>Codename :: Miracle</title>

	    <script>

	    		$(document).bind('pagebeforecreate',function()
	    		{
	    				var urlQuery = location.search;
						urlQuery = urlQuery.replace('?', '');
						var split = urlQuery.split('=');

						if(split[1] != '')
						{
							var sel = 	split[1];
						}
						if(split == '')
						{
							var sel = 	'Testprozess.mpro';
						}

						$("select#select-process").val(sel);
	    		});

	    		$(document).bind('pageinit',function()
	    		{
	    			$('#select-process').children().click(function(e)
					{
						var val = $(this).val();
						$.mobile.changePage($(document.location.href="generate_list.php?process="+val),{reloadPage: true} );
					});

	    		});

				$(document).ready()
				{
					$('.flow').live('click',function(e)
					{
						$("#process-list a:last").append('<br /><small><i>::' + $(this).find('.ui-btn-text').html() +'</i></small></p>');
						$.ajax(
							{
								type: "POST",
								url : "process_node.php",
								data: {node:$(this).attr('id'), process_name:$('#process-name').html()},
								success : function (data)
								{
									$("#process-list").append(data).listview('refresh');
									var newPage = $(data);
									newPage.appendTo( $.mobile.pageContainer );

									var name = $(data).attr('data-title');
									var link = $(data).attr('id')

									var li = '<li data-icon="arrow-d"><a data-role="button" class="list-button" href="#' + link+' "><img src="../images/progress.png">' + name + '</a></li>';
									$("#process-list").append(li).listview('refresh');
							}
						});
					});

					$('.finish').live('click',function()
					{
						var li = '<li data-icon="forward"><a data-role="button" class="list-button"><img src="../images/finished.jpg">Prozess beenden</a></li>';
						$("#process-list").append(li).listview('refresh');
					});

					$('.list-button').live('click',function()
					{
						$(this).find('img').attr('src',"../images/done.png");
						$(this).addClass('ui-disabled');
					});
				};

		</script>
 </head>
 <body>

 <div  data-role="page" id="home" data-title="Home">

    <div data-role="header">
			<select name="select-choice-1" id="select-process">
			<?php
					if ($handle = opendir('../processes/serialized/'))
					{
					    while (false !== ($file = readdir($handle)))
					    {
					        if ($file != "." && $file != ".." && (strpos($file,'mpro'))) {
					        	$filename = explode('.',$file);
					            echo '<option value="' . $file . '">' . $filename[0] . '</option>';
					        }
					    }
					    closedir($handle);
					}
			?>
			</select>
    </div>

    <div data-role="content">
	    <ol id="process-list" data-inset="true" data-role="listview" data-split-theme="d"></ol>
	 	<?php
	 	if((isset($_GET['process'])))
	 	{
	 		$process_link = htmlspecialchars($_GET['process']);
	 	}else
	 	{
	 		$process_link = 'Testprozess.mpro';
	 	}

	 		echo '<div style="visibility:hidden" id="process-name">' . $process_link . '</div>';
	 		$process = new TransformXML();
			$process = $process->unserialise($process_link);

			$lg = new ListGenerator($process);
			$start = $lg->findStart();
			$next = $lg->getNext($start);
			?>
			<script>
				var process = $('#process-name').html();
					$.ajax(
						{
							type: "POST",
							url : "process_node.php",
							data: {node:'<?php echo $start->getId() ?>', process_name:process},
							success : function (data)
							{
								//$("#process-list").append(data).listview('refresh');
								var newPage = $(data);
								newPage.appendTo( $.mobile.pageContainer );

								var name = $(data).attr('data-title');
								var link = $(data).attr('id')

								var li = '<li data-icon="arrow-d"><a data-role="button" class="list-button" href="#' + link+' "><img src="../images/progress.png">' + name + '</a></li>';
								$("#process-list").append(li).listview('refresh');
							}
						});
			</script>

			<?php

	 	?>
 	</div>

</body>
</html>