<?php
set_time_limit(36000);
ini_set("memory_limit","1220M");
error_reporting(E_ALL ^ E_NOTICE);
require_once('admin/function.php');

$id = (isset($_GET['id'])) ? $_GET['id'] : '';
$catid = (isset($_GET['catid'])) ? $_GET['catid'] : '';
$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
$page = (!empty($page)) ? $page : 1;
/* $catid = (!empty($catid)) ? $catid : getCategoryByPostId($id);
$catid = (!empty($catid)) ? $catid : 18;  */
$album = (isset($_GET['album'])) ? $_GET['album'] : "Project - TNUS";

	$tempExport_part_header = "";
	$tempExport_part_content = "";
	$tempExport_part_footer = "";	
	$tempExport_part_header = export("part_header");
	$tempExport_part_content = export("part_album");
	$tempExport_part_footer = export("part_footer");
	$tempExport = $tempExport_part_header;
	$tempExport .=$tempExport_part_content;
	$tempExport .=$tempExport_part_footer;

	$dir_path = trim("/uploads/images/album/".$album."/", "/")."/";
    $file_list = viewfiles($dir_path);
    $item_file_list = explode("*",$file_list);
    $countfile = count($item_file_list);
	$NEWS_BLOCK = '<div id="slide_image">
						Album: <span>'.$album.'</span>
						<ul class="bxslider-picture">';
	foreach ($item_file_list as $item)
	{
		if(substr($item, -4, 1) == '.')
		{			
			//$NEWS_BLOCK .= '<li><img src="'.HOST_LINK."/".$dir_path.$item.'" title="'.trimCaption($item).'"/></li>';
			$NEWS_BLOCK .= '<li><img src="'.HOST_LINK."/".$dir_path.$item.'" title="'.substr($item,0, -4).'"/></li>';
		}
	}
	$NEWS_BLOCK .= "</ul></div><hr>";
	//$NEWS_BLOCK .= '<div id="bx-pager" style="border-right: 1px solid rgb(204, 204, 204); margin-top: -20px; border-left: 1px solid rgb(204, 204, 204); height: 67px; margin-bottom: -2px">';
	$NEWS_BLOCK .= '<div id="bx-pager">';
	$i = 0;
	foreach ($item_file_list as $item)
	{
		if(substr($item, -4, 1) == '.')
		{			
			$NEWS_BLOCK .= '<a data-slide-index="'.$i.'" href=""><img src="'.HOST_LINK."/".$dir_path.$item.'" /></a>';
			$i++;
		}
	}
	// get album list
	$dir_path = "/uploads/images/album/";
    $file_list = viewfiles($dir_path);
    $item_file_list = explode("*",$file_list);
    $countfile = count($item_file_list);
	$NEWS_BLOCK .= "</div><hr>";
	$NEWS_BLOCK .= "<div class=\"navbar-category\">Album ảnh</div><ul id=\"explode\" class=\"profiles cf\">";
	foreach ($item_file_list as $item)
	{
		if(substr($item, -4, 1) !== '.')
		{	
			$dir_path_child = trim("/uploads/images/album/".$item."/", "/")."/";
			$file_list_child = viewfiles($dir_path_child);
			$item_file_list_child = explode("*",$file_list_child);
			$countfilechild = count($item_file_list_child);
			foreach ($item_file_list_child as $item_child)
			{
				if(substr($item_child, -4, 1) == '.')
				{
					$NEWS_BLOCK .= '<li><img src="'.HOST_LINK."/".$dir_path_child.$item_child.'" title="'.trimCaption($item).'" class="pic"/><a href="'.HOST_LINK."/album.php?album=".$item.'" class="info">'.$item.'</a><span>'.$item.'</span></li>';
					break;
				}
			}
		}
	}
		//$NEWS_BLOCK .= '<li><img src="'.HOST_LINK.'/uploads/images/album/'.$item.'"/></li>';
	$NEWS_BLOCK .= "</ul>";
		
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
	
	$BREAD_CRUMB = breadCrum($catid);
	$CURRENTMONTH = date("m", time());
	$CURRENTYEAR = date("Y", time());
	
	$tempExport = str_replace("{SELECT_BLOCK}", $SELECT_BLOCK, $tempExport);
	$tempExport = str_replace("{BREAD_CRUMB}", $BREAD_CRUMB, $tempExport);
	$tempExport = str_replace("{ALBUM_BLOCK}", $NEWS_BLOCK, $tempExport);
	$tempExport = str_replace("{PAGE_NAVIGATOR}", $PAGE_NAVIGATOR, $tempExport);
	$tempExport = str_replace("{NEWS_BLOCK_OTHER}", $NEWS_BLOCK_OTHER, $tempExport);
	$tempExport = str_replace("{NEWS_BLOCK_SUB}", $NEWS_BLOCK_SUB, $tempExport);
	$tempExport = str_replace("{EVENT_BLOCK_SUB}", $EVENT_BLOCK_SUB, $tempExport);
	$tempExport = str_replace("{CURRENTMONTH}", $CURRENTMONTH, $tempExport);
	$tempExport = str_replace("{CURRENTYEAR}", $CURRENTYEAR, $tempExport);
	$tempExport = str_replace("{HOST_LINK}", HOST_LINK, $tempExport);

	echo $tempExport;

?>



