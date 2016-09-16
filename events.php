<?php
set_time_limit(36000);
ini_set("memory_limit","1220M");
error_reporting(E_ALL ^ E_NOTICE);
require_once('admin/config/config.php');
require_once('admin/config/class.database.php');
require_once('admin/function.php');

$id = (isset($_GET['id'])) ? $_GET['id'] : '';
$catid = (isset($_GET['catid'])) ? $_GET['catid'] : '';
$type = (isset($_GET['type'])) ? $_GET['type'] : '';
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$page = (!empty($page)) ? $page : 1;
$catid = (!empty($catid)) ? $catid : getCategoryByPostId($id);
$catid = (!empty($catid) AND !empty($id)) ? $catid : 5;
	$tempExport_part_header = "";
	$tempExport_part_content = "";
	$tempExport_part_footer = "";	
	$tempExport_part_header = export("part_header");
	if(!empty($id))
	{
		$tempExport_part_content = export("part_events_detail");
	}
	else
	{
		$tempExport_part_content = export("part_events");
	}
	$tempExport_part_footer = export("part_footer");
	$tempExport = $tempExport_part_header;
	$tempExport .=$tempExport_part_content;
	$tempExport .=$tempExport_part_footer;
	
	if(!empty($id))
	{
		$EVENT_BLOCK = getEventsDetail($id);
		//$EVENTS_BLOCK_OTHER = getNewsDetail_Other($id, 3);
	}
	else
	{
		$EVENT_BLOCK = getEvents($type,$page);
		$PAGE_NAVIGATOR = getEventsPaging($type, $page);
	}

	/**
		NEWS BLOCK SUB
	**/
	
	$NEWS_BLOCK_SUB = getNewsSub(4);
	
	/**
		EVENTS BLOCK SUB
	**/
	$EVENT_BLOCK_SUB = getEventSub(2);
	
	/**
		RENDER DATA
	*/
	$CURRENTMONTH = date("m", time());
	$CURRENTYEAR = date("Y", time());
	
	$BREAD_CRUMB = breadCrum($catid);
	
	$tempExport = str_replace("{BREAD_CRUMB}", $BREAD_CRUMB, $tempExport);
	$tempExport = str_replace("{EVENT_BLOCK}", $EVENT_BLOCK, $tempExport);
	$tempExport = str_replace("{PAGE_NAVIGATOR}", $PAGE_NAVIGATOR, $tempExport);
	$tempExport = str_replace("{NEWS_BLOCK_SUB}", $NEWS_BLOCK_SUB, $tempExport);
	$tempExport = str_replace("{EVENT_BLOCK_SUB}", $EVENT_BLOCK_SUB, $tempExport);
	$tempExport = str_replace("{CURRENTMONTH}", $CURRENTMONTH, $tempExport);
	$tempExport = str_replace("{CURRENTYEAR}", $CURRENTYEAR, $tempExport);
	$tempExport = str_replace("{HOST_LINK}", HOST_LINK, $tempExport);

	echo $tempExport;

?>



