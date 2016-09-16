<?php
set_time_limit(36000);
ini_set("memory_limit","1220M");
error_reporting(E_ALL ^ E_NOTICE);
require_once('admin/config/config.php');
require_once('admin/config/class.database.php');
require_once('admin/function.php');

	$tempExport_part_header = "";
	$tempExport_part_content = "";
	$tempExport_part_footer = "";
	$tempExport_part_header = export("part_header");
	$tempExport_part_content = export("part_index");
	$tempExport_part_footer = export("part_footer");
	$tempExport = $tempExport_part_header;
	$tempExport .=$tempExport_part_content;
	$tempExport .=$tempExport_part_footer;

	/**
		NEWS BLOCK
	**/
	$db=new Database();
	$table = 'posts';
	$condition = array('postType' => array('news'));
	$result = $db->getRowsOrderBy($table, '*', $condition, "ORDER BY `postId` DESC LIMIT 0,4", PDO::FETCH_OBJ);
	
	$i = 0;
	$NEWS_BLOCK = '<ul>';
	foreach ($result as $item)
	{		
		$i++;
		$id = $item->postId;
		$post_title = $item->postTitle;
		$post_date_start = $item->dateStart;
		$post_date = makeDateEvent($post_date_start);		
		$NEWS_BLOCK .='<li>
							<h5><a id="" href="{HOST_LINK}/news.php?id='.$id.'">'.$post_title.'</a></h5>
							<p class="date"><span id="">'.$post_date.'</span></p><!-- 12/04/2011 - 15h:20pm -->
							<div class="hor_line"></div>
						</li>';	
	}
	$NEWS_BLOCK .= '</ul>';
	
	
	$table = 'posts';
	$condition = array('postType' => array('events'));
	$result = $db->getRowsOrderBy($table, '*', $condition, "ORDER BY `postId` DESC LIMIT 0,4", PDO::FETCH_OBJ);
	
	$EVENT_BLOCK = '<ul>';
	foreach ($result as $item)
	{		
		$i++;
		$id = $item->postId;
		$post_title = $item->postTitle;
		$post_date_start = $item->dateStart;
		$post_date = makeDateEvent($post_date_start);		
		$EVENT_BLOCK .='<li class="clearfix">
							<div class="content" style="width: auto;">
								<p class="date">
									<span>'.$post_date.'</span>
								</p>
								<h5><a href="{HOST_LINK}/events.php?id='.$id.'">'.$post_title.'</a></h5>
								<a class="more">Chi tiết</a>
							</div>							
						</li>';	
	}
	$EVENT_BLOCK .= '</ul>';
	/**

		RENDER DATA

	*/
	$CURRENTMONTH = date("m", time());
	$CURRENTYEAR = date("Y", time());
	
	$tempExport = str_replace("{NEWS_BLOCK}", $NEWS_BLOCK, $tempExport);
	$tempExport = str_replace("{EVENT_BLOCK}", $EVENT_BLOCK, $tempExport);
	$tempExport = str_replace("{CURRENTMONTH}", $CURRENTMONTH, $tempExport);
	$tempExport = str_replace("{CURRENTYEAR}", $CURRENTYEAR, $tempExport);	
	$tempExport = str_replace("{HOST_LINK}", HOST_LINK, $tempExport);

	echo $tempExport;

?>



