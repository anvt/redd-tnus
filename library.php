<?php
set_time_limit(36000);
ini_set("memory_limit","1220M");
error_reporting(E_ALL ^ E_NOTICE);
require_once('admin/function.php');

$id = (isset($_GET['id'])) ? $_GET['id'] : '';
$catid = (isset($_GET['catid'])) ? $_GET['catid'] : '';
/* 
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$page = (!empty($page)) ? $page : 1;
$id = ($page =='gioithieu')? 6 : $id;
$catid = (!empty($catid)) ? $catid : getCategoryByPostId($id);
*/
$catid = (!empty($catid)) ? $catid : 14; 

	$tempExport_part_header = "";
	$tempExport_part_content = "";
	$tempExport_part_footer = "";	
	$tempExport_part_header = export("part_header");
	$tempExport_part_content = export("part_library");
	$tempExport_part_footer = export("part_footer");
	$tempExport = $tempExport_part_header;
	$tempExport .=$tempExport_part_content;
	$tempExport .=$tempExport_part_footer;

	/* if(!empty($id))
	{
		$NEWS_BLOCK = getIntroDetail($id);
		$NEWS_BLOCK_OTHER = getIntroDetail_Other($id, 4);
	}
	else
	{
		$NEWS_BLOCK = getIntro($page,$catid);
		$PAGE_NAVIGATOR = getIntroPaging($page,$catid);
	} */	
	
	$NEWS_BLOCK = getProject($catid);
	
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
	$SELECT_BLOCK = getListProject($catid);
	$BREAD_CRUMB = breadCrum($catid);
	$CURRENTMONTH = date("m", time());
	$CURRENTYEAR = date("Y", time());
	
	$tempExport = str_replace("{SELECT_BLOCK}", $SELECT_BLOCK, $tempExport);
	$tempExport = str_replace("{BREAD_CRUMB}", $BREAD_CRUMB, $tempExport);
	$tempExport = str_replace("{NEWS_BLOCK}", $NEWS_BLOCK, $tempExport);
	$tempExport = str_replace("{PAGE_NAVIGATOR}", $PAGE_NAVIGATOR, $tempExport);
	$tempExport = str_replace("{NEWS_BLOCK_OTHER}", $NEWS_BLOCK_OTHER, $tempExport);
	$tempExport = str_replace("{NEWS_BLOCK_SUB}", $NEWS_BLOCK_SUB, $tempExport);
	$tempExport = str_replace("{EVENT_BLOCK_SUB}", $EVENT_BLOCK_SUB, $tempExport);
	$tempExport = str_replace("{CURRENTMONTH}", $CURRENTMONTH, $tempExport);
	$tempExport = str_replace("{CURRENTYEAR}", $CURRENTYEAR, $tempExport);
	$tempExport = str_replace("{HOST_LINK}", HOST_LINK, $tempExport);

	echo $tempExport;

?>



