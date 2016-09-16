<?php
# Get category tree
require_once('config/config.php');
require_once('config/class.database.php');
define("HOST_LINK", "http://localhost/redd-tnus");

/* # get category tree 
function categoryParentChildTree($parent_id = 0, $spacing = '-', $category_tree_array = '') 
{
	$db=new Database();
	$table = 'category';
	$result = $db->getRows($table, '*', array('parentCat' => array($parent_id)), PDO::FETCH_OBJ);
	if (!is_array($category_tree_array))
			$category_tree_array = array();
	foreach ($result as $mainCategory)
	{
		$category_tree_array[] = array("id" => $mainCategory->id, "name" => $spacing . $mainCategory->nameCat);
		$category_tree_array = categoryParentChildTree($mainCategory->id, '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
	}	
	return $category_tree_array;
} */
# get category tree by group
function categoryParentChildTree($parent_id = 0, $group ='', $spacing = '-', $category_tree_array = '') 
{
	$db=new Database();
	$table = 'category';
	$condition = array('parentCat' => array($parent_id));
	if(!empty($group)) $condition['groupCat'] = array($group);
	$result = $db->getRows($table, '*', $condition, PDO::FETCH_OBJ);
	if (!is_array($category_tree_array))
			$category_tree_array = array();
	foreach ($result as $mainCategory)
	{
		$category_tree_array[] = array("id" => $mainCategory->id, "name" => $spacing . $mainCategory->nameCat);
		$category_tree_array = categoryParentChildTree($mainCategory->id, $group, '&nbsp;&nbsp;&nbsp;&nbsp;'.$spacing . '-&nbsp;', $category_tree_array);
	}	
	return $category_tree_array;
}
# export category tree to dropdown element
function dropdownCategory()
{
	$cat_all = categoryParentChildTree(0,'','','');
	$export ='';
	foreach ($cat_all as $items=>$item)
	{
		$id = $item['id'];
		$name = $item['name'];
		$export .= '<option value="'.$id.'">'.$name.'</option>';
	}
	return $export;
	return "<select id=\"category\">$export</select>";
}
# export category tree to dropdown element by groupCat 'news'
function dropdownCategoryIntro($id_selected = '')
{
	$cat_all = categoryParentChildTree(0,'intro','','');
	$export ='';
	foreach ($cat_all as $items=>$item)
	{
		$id = $item['id'];
		$name = $item['name'];
		if(!empty($id_selected))
		{
			if ($id == $id_selected)
			{
				$export .= '<option value="'.$id.'" selected>'.$name.'</option>';
			}
			else
				$export .= '<option value="'.$id.'">'.$name.'</option>';
		}
		else
		{
			$export .= '<option value="'.$id.'">'.$name.'</option>';	
		}
	}
	return $export;
	return "<select id=\"category\">$export</select>";
}

# export category tree to dropdown element by groupCat 'intro'
function dropdownCategoryNews($id_selected = '')
{
	$cat_all = categoryParentChildTree(0,'','','');
	$export ='';
	foreach ($cat_all as $items=>$item)
	{
		$id = $item['id'];
		$name = $item['name'];
		if(!empty($id_selected))
		{
			if ($id == $id_selected)
			{
				$export .= '<option value="'.$id.'" selected>'.$name.'</option>';
			}
			else
				$export .= '<option value="'.$id.'">'.$name.'</option>';
		}
		else
		{
			$export .= '<option value="'.$id.'">'.$name.'</option>';	
		}
	}
	return $export;
	return "<select id=\"category\">$export</select>";
}

# export category tree to dropdown element by groupCat 'events'
function dropdownCategoryEvent($id_selected = '')
{
	$cat_all = categoryParentChildTree(0,'events','','');
	$export ='';
	foreach ($cat_all as $items=>$item)
	{
		$id = $item['id'];
		$name = $item['name'];
		if(!empty($id_selected))
		{
			if ($id == $id_selected)
			{
				$export .= '<option value="'.$id.'" selected>'.$name.'</option>';
			}
			else
				$export .= '<option value="'.$id.'">'.$name.'</option>';
		}
		else
		{
			$export .= '<option value="'.$id.'">'.$name.'</option>';	
		}
	}
	return $export;
	return "<select id=\"category\">$export</select>";
}
# export category tree to dropdown element by groupCat 'download'
function dropdownCategoryDownload($id_selected = '')
{
	$cat_all = categoryParentChildTree(0,'download','','');
	$export ='';
	foreach ($cat_all as $items=>$item)
	{
		$id = $item['id'];
		$name = $item['name'];
		if(!empty($id_selected))
		{
			if ($id == $id_selected)
			{
				$export .= '<option value="'.$id.'" selected>'.$name.'</option>';
			}
			else
				$export .= '<option value="'.$id.'">'.$name.'</option>';
		}
		else
		{
			$export .= '<option value="'.$id.'">'.$name.'</option>';	
		}
	}
	return $export;
	return "<select id=\"category\">$export</select>";
}
# export category tree to dropdown element by groupCat 'member'
function dropdownCategoryMember($id_selected = '')
{
	$cat_all = categoryParentChildTree(0,'member','','');
	$export ='';
	foreach ($cat_all as $items=>$item)
	{
		$id = $item['id'];
		$name = $item['name'];
		if(!empty($id_selected))
		{
			if ($id == $id_selected)
			{
				$export .= '<option value="'.$id.'" selected>'.$name.'</option>';
			}
			else
				$export .= '<option value="'.$id.'">'.$name.'</option>';
		}
		else
		{
			$export .= '<option value="'.$id.'">'.$name.'</option>';	
		}
	}
	return $export;
	return "<select id=\"category\">$export</select>";
}

# POST FUNCTION
function post_add($table, $data)
{
	$db=new Database();
	$result = $db->insert($table, $data);
	return $result;
}

function post_update($table, $data, $where)
{
	$db=new Database();
	$result = $db->update($table, $data, $where);	
	return $result;
}
function post_delete($table, $where)
{
	$db=new Database();
	$result = $db->delete_row($table, $where);
	return $result;
}

function Replace_TiengViet($str){

	  $coDau=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",

	  "ằ","ắ","ặ","ẳ","ẵ",

	  "è","é","ẹ","ẻ","ẽ","ê","ề","ế","ệ","ể","ễ",

	  "ì","í","ị","ỉ","ĩ",

	  "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"

	  ,"ờ","ớ","ợ","ở","ỡ",

	  "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",

	  "ỳ","ý","ỵ","ỷ","ỹ",

	  "đ",

	  "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"

	  ,"Ằ","Ắ","Ặ","Ẳ","Ẵ",

	  "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",

	  "Ì","Í","Ị","Ỉ","Ĩ",

	  "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"

	  ,"Ờ","Ớ","Ợ","Ở","Ỡ",

	  "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",

	  "Ỳ","Ý","Ỵ","Ỷ","Ỹ",

	  "Đ","ê","ù","à");



	  $khongDau=array("a","a","a","a","a","a","a","a","a","a","a"

	  ,"a","a","a","a","a","a",

	  "e","e","e","e","e","e","e","e","e","e","e",

	  "i","i","i","i","i",

	  "o","o","o","o","o","o","o","o","o","o","o","o"

	  ,"o","o","o","o","o",

	  "u","u","u","u","u","u","u","u","u","u","u",

	  "y","y","y","y","y",

	  "d",

	  "A","A","A","A","A","A","A","A","A","A","A","A"

	  ,"A","A","A","A","A",

	  "E","E","E","E","E","E","E","E","E","E","E",

	  "I","I","I","I","I",

	  "O","O","O","O","O","O","O","O","O","O","O","O"

	  ,"O","O","O","O","O",

	  "U","U","U","U","U","U","U","U","U","U","U",

	  "Y","Y","Y","Y","Y",

	  "D","e","u","a");

	  return str_replace($coDau,$khongDau,$str);

}

function makeLink($str, $id){

	 //var $string_return = Replace_TiengViet($str);

	 $string_return = str_replace(" ", "-", $str);
	 $string_return = str_replace("'", "-", $string_return);
	 $string_return = str_replace('"', "-", $string_return);
	 $string_return = str_replace(';', "-", $string_return);
	 $string_return = str_replace('.', "-", $string_return);
	 $string_return = str_replace(',', "-", $string_return);
	 $string_return = str_replace('\\', "-", $string_return);
	 $string_return = str_replace('/', "-", $string_return);
	 $string_return = str_replace(':', "-", $string_return);
	 $string_return = str_replace('?', "-", $string_return);
	 $string_return = str_replace('%', "-", $string_return);
	 $string_return = str_replace('#', "-", $string_return);
	 $string_return = str_replace('~', "-", $string_return);
	 $string_return = str_replace('`', "-", $string_return);
	 $string_return = str_replace('!', "-", $string_return);
	 $string_return = str_replace('>', "-", $string_return);
	 $string_return = str_replace('<', "-", $string_return);
	 $string_return = str_replace('+', "-", $string_return);

	 $string_return .= "-".$id;

	 $string_return = str_replace('--', "-", $string_return);

	 $string_return = strtolower($string_return);

	 return $string_return;

}
function trimCaption($strings)
{
	 $string_return = ltrim($strings, 1);
	 $string_return = ltrim($string_return, -3);
	 return $string_return;
}
function viewfiles($path)
{
	$ff = array();
	if ($dir = @opendir("./$path"))
	{
		while (false !== ($file = readdir($dir))) 
		{
			if ($file != "." && $file != "..")
			{
				$ff[] = $file;
				/* $countfile+=1; */
			}
		}
		closedir($dir);
	}
	$result = implode("*",$ff);
	return $result;
}

/* 

	Make date 2014-12-09 08:13:02 -> 09/12/2014 08:03

*/

function makeDatePost($str)
{
	$str_array1 = explode(" ", $str);
	$str_array2 = explode("-", $str_array1[0]);
	$str_array3 = explode(":", $str_array1[1]);
	$str_return = $str_array2[2].'/'.$str_array2[1].'/'.$str_array2[0].' - '. $str_array3[0].':'.$str_array3[1]; 
	return $str_return;	
}
function makeDateEventsPost($str)
{
	$str_array1 = explode(" ", $str);
	$str_array2 = explode("-", $str_array1[0]);
	$str_array3 = explode(":", $str_array1[1]);
	$str_return = $str_array2[2].'/'.$str_array2[1].'/'.$str_array2[0]; 
	return $str_return;	
}
function makeDateEvent($str)
{
	$months= array("Tháng Một","Tháng Hai","Tháng Ba","Tháng Tư","Tháng Năm","Tháng Sáu","Tháng Bẩy","Tháng Tám","Tháng Chín","Tháng Mười","Tháng Mười một","Tháng Mười hai");
	$str_array1 = explode(" ", $str);
	$str_array2 = explode("-", $str_array1[0]);
	$str_array3 = explode(":", $str_array1[1]);
	$str_return = $str_array2[2].' '.$months[$str_array2[1]-1].' '.$str_array2[0]; 
	return $str_return;	
}

function export($template){

	$exporthtml = file_get_contents("templates/".$template.".html");

	return $exporthtml;

}

//* PHAN TRANG
function paging($currentPage, $totalPages, $Pagelink=''){
    $prepages ='';
    $pages ='';

    if($currentPage <= 1) $currentPage=1;
    if($currentPage >= $totalPages) $currentPage = $totalPages;
    
    if($currentPage == 1)
    {
        $prebtn = '<span class="disabled">« </span>';//
    }
    else
    {
        $prebtn = '<a href="'.$Pagelink.'">&laquo;</a>';
    }       
            
    if($currentPage == $totalPages)
    {
        
		if($currentPage == 1)
        {
            $prebtn = '<span class="disabled">« </span>';
        }
        else
        {
          $prebtn = '<a href="'.$Pagelink.'page='.($currentPage-1).'">« </a>';
        }
        $btn = '<span class="disabled"> &raquo;</span>';
    }
    else
    {
        if($currentPage == 1)
        {
            $prebtn = '<span class="disabled">« </span>';
        }
        else
        {
          $prebtn = '<a href="'.$Pagelink.'page='.($currentPage-1).'">« </a>';
        }
        $btn = '<a href="'.$Pagelink.'page='.($currentPage+1).'"> &raquo;</a>';
    }        
        
    if($totalPages <= 7){
        $html = $prebtn;
        for($i=1;$i<=$totalPages;$i++){
            if($i != $currentPage)
                $html .= '<a href="'.$Pagelink.'page='.$i.'">'.$i.'</a>';
            else
                $html .= '<span class="current">'.$i.'</span>';
        }
        $html .= $btn;
    }
    else{
        if(($currentPage - 3) > 1){
            $prepages = '<a href="'.$Pagelink.'">1</a>';
            $prepages .= '<a class="threedot">...</a>';
            $prepages .= '<a href="'.$Pagelink.'page='.($currentPage-2).'">'.($currentPage-2).'</a>';
            $prepages .= '<a href="'.$Pagelink.'page='.($currentPage-1).'">'.($currentPage-1).'</a>';
        }
        else{
            for($i=1;$i<$currentPage;$i++){
                $prepages .= '<a href="'.$Pagelink.'page='.$i.'">'.$i.'</a>';
            }
        }
        
        if(($currentPage + 4) < $totalPages){
            $pages = '<a href="'.$Pagelink.'page='.($currentPage+1).'">'.($currentPage+1).'</a>';
            $pages .= '<a href="'.$Pagelink.'page='.($currentPage+2).'">'.($currentPage+2).'</a>';
            $pages .= '<a class="threedot">...</a>';
            $pages .= '<a href="'.$Pagelink.'page='.$totalPages.'">'.$totalPages.'</a>';
        }
        else{
            for($i=($currentPage+1);$i<=$totalPages;$i++){
                $pages .= '<a href="'.$Pagelink.'page='.$i.'">'.$i.'</a>';
            }
        }
        
        $html = $prebtn;
        $html .= $prepages;
       // $html .= '<li class="active">'.$currentPage.'</li>';
        $html .= '<span class="current">'.$currentPage.'</span>';
        $html .= $pages;
        $html .= $btn;
    }
    
    return $html;
}
# search funtion
function getSearch($keyword, $from = null, $to = null)
{

    // get input
    $fromPost = isset($from) ? $from : 0;
    $toPost = isset($to) ? $to : 10;
    $sql_search = "SELECT `postId`, `postTitle`, `postType`, `postDate` FROM `posts` WHERE `postTitle` LIKE '%".$keyword."%' AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT ".$fromPost.", ".$toPost.";";
    $query_getpost = mysql_query($sql_search);
    $result_post = array();
    while($row_query_getpost = mysql_fetch_array($query_getpost)){
        $row_query_getpost['postId'] = $row_query_getpost['postId'];
        $row_query_getpost['postTitle'] = $row_query_getpost['postTitle'];
        $row_query_getpost['postType'] = $row_query_getpost['postType'];
        $row_query_getpost['postDate'] = $row_query_getpost['postDate'];
        $result_post[] = $row_query_getpost;         

    }
    return $result_post;
}

/*
	NEWS
*/
function getNewsPaging($pages)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	$url = HOST_LINK.'/news.php?';
	$db=new Database();
	$table = 'posts';
	// get total post
	
	$condition = array('postType' => array('news'));
	$get_max = $db->getCountRows($table, 'postId',"`postType` = 'news' AND `postPublish` = '1'");
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	$url = rtrim($url, "/");
	$html_Paging = paging($pages,$totalPage, $url);
	if($totalPage > 1)
	{
		$html_Paging = "<div class=\"paginationTNUS\">".$html_Paging."</div>";		
	}
	else
	{
		return '';
	} 
	return $html_Paging;
}
function getNews($pages)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	$url = HOST_LINK.'/news.php?';
	$db=new Database();
	$table = 'posts';	
	$condition = array('postType' => array('news'));
	$get_max = $db->getCountRows($table, 'postId',"`postType` = 'news' AND `postPublish` = '1'");
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	$url = rtrim($url, "/");
	//$html_Paging = paging($page,$totalPage, $url);
	
	$condition = array('postType' => array('news'), 'postPublish' => array('1'));
	$result = $db->getRowsOrderBy($table, '*', $condition, "ORDER BY `postId` DESC LIMIT $fromPost,$offsetPostPerPage", PDO::FETCH_OBJ);	
	$i = 0;
	$NEWS_BLOCK_SUB = '<ul>';
	foreach ($result as $item)
	{		
		$i++;
		$id = $item->postId;
		$post_title = $item->postTitle;
		$post_date = $item->postDate;
		$post_date = makeDatePost($post_date);		
		$NEWS_BLOCK_SUB .='<li>
								<h5>
									<a id="" href="{HOST_LINK}/news.php?id='.$id.'">'.$post_title.'</a>
								</h5>
								<p class="date">
									<span id="">'.$post_date.'</span>
								</p>
							</li>
							<li class="sep"></li>';	
	}
	$NEWS_BLOCK_SUB .= '</ul>';
	return $NEWS_BLOCK_SUB;
}

function getNewsDetail($id)
{
	$db=new Database();
	$table = 'posts';
	$condition = array('postId' => array($id));
	$condition = array('postId' => array($id), 'postType' => array('news'));
	$result = $db->getRow($table, '*', $condition, PDO::FETCH_OBJ);
	$post_title = $result->postTitle;
	$post_content = $result->postContent;
	$NEWS_BLOCK = '';
	$NEWS_BLOCK .='<h3><span>'.$post_title.'</span></h3>					
					<div class="content gallery">
						'.$post_content.'
					</div>';
	return $NEWS_BLOCK;	
}

function getNewsDetail_Other($id, $limit ='')
{
	/**
		NEWS BLOCK
		**/
		$db=new Database();
		$table = 'posts';
		$limit = (!empty($limit))? $limit : 4;
		$condition = array('postType' => array('news'));
		$result = $db->getRowsOrderBy($table, '*', $condition, "AND postId != $id AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT 0,$limit", PDO::FETCH_OBJ);
		
		$i = 0;
		$NEWS_BLOCK = '<ul>';
		foreach ($result as $item)
		{		
			$i++;
			$id = $item->postId;
			$post_title = $item->postTitle;
			$post_desc = $item->postDesc;
			$post_date = $item->postDate;
			$post_date = makeDateEvent($post_date);		
			$NEWS_BLOCK .='<li>								
								<a id="" href="{HOST_LINK}/news.php?id='.$id.'">'.$post_title.'</a>&nbsp;&nbsp;
								<span id="">'.$post_date.'</span>
							</li>';	
		}
		$NEWS_BLOCK .= '</ul>';
		return $NEWS_BLOCK;
}
/*
	EVENTS
*/
function getEventsPaging($type, $pages)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	if(!empty($type))
	{
		$url = HOST_LINK.'/events.php?type='.$type.'&';
	}
	else
	{
		$url = HOST_LINK.'/events.php?';
	}
	
	$db=new Database();
	$table = 'posts';
	// get total post
	
	$condition = array('postType' => array('events'));
	//$get_max = $db->getCountRows($table, 'postId',"`postType` = 'events'");
	if(!empty($type))
	{
		if($type == 'future')
		{			
			$get_max = $db->getCountRows($table, 'postId',"`postType` = 'events' AND `postPublish` = '1' AND `dateStart` > '$today'");
		}
		else
		{
			$get_max = $db->getCountRows($table, 'postId',"`postType` = 'events' AND `postPublish` = '1' AND `dateStart` <= '$today'");
		}			
	}
	else
	{
		$get_max = $db->getCountRows($table, 'postId',"`postType` = 'events' AND `postPublish` = '1'");
	}
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	$url = rtrim($url, "/");
	$html_Paging = paging($pages,$totalPage, $url);
	if($totalPage > 1)
	{
		$html_Paging = "<div class=\"paginationTNUS\">".$html_Paging."</div>";		
	}
	else
	{
		return '';
	} 
	return $html_Paging;
}

function getEvents($type, $pages)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	if(!empty($type))
	{
		$url = HOST_LINK.'/events.php?type='.$type.'&';
	}
	else
	{
		$url = HOST_LINK.'/events.php?';
	}
	$db=new Database();
	$table = 'posts';	
	$condition = array('postType' => array('events'), 'postPublish' => array('1'));
	//$get_max = $db->getCountRows($table, 'postId',"`postType` = 'events'");
	if(!empty($type))
	{
		if($type == 'future')
		{			
			$get_max = $db->getCountRows($table, 'postId',"`postType` = 'events' AND `postPublish` = '1' AND `dateStart` > '$today'");
		}
		else
		{
			$get_max = $db->getCountRows($table, 'postId',"`postType` = 'events' AND `postPublish` = '1' AND `dateStart` <= '$today'");
		}			
	}
	else
	{
		$get_max = $db->getCountRows($table, 'postId',"`postType` = 'events' AND `postPublish` = '1'");
	}
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	$url = rtrim($url, "/");
	//$html_Paging = paging($page,$totalPage, $url);
	
	$condition = array('postType' => array('events'));
	$today = date("Y-m-d H:i:s", time());
	if(!empty($type))
	{
		if($type == 'future')
		{
			$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' AND dateStart > '$today' ORDER BY `postId` DESC LIMIT $fromPost,$offsetPostPerPage", PDO::FETCH_OBJ);
		}
		else
		{
			$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' AND dateStart <= '$today' ORDER BY `postId` DESC LIMIT $fromPost,$offsetPostPerPage", PDO::FETCH_OBJ);
		}			
	}
	else
	{
		$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT $fromPost,$offsetPostPerPage", PDO::FETCH_OBJ);
	}
		
	$i = 0;
	$NEWS_BLOCK_SUB = '<ul>';
	foreach ($result as $item)
	{		
		$i++;
		$id = $item->postId;
		$post_title = $item->postTitle;
		$post_desc = $item->postDesc;
		$post_date_start = $item->dateStart;
		$post_date_start = makeDateEventsPost($post_date_start);	
		$post_desc = str_replace(PHP_EOL, '<br />', $post_desc);
		$NEWS_BLOCK_SUB .='<li>
								<p class="date">
									<span>'.$post_date_start.'</span>
								</p>
								<h5>
									<a id="" href="{HOST_LINK}/events.php?id='.$id.'">'.$post_title.'</a>
								</h5>
								<p class="clear teaser">
									'.$post_desc.'
								</p>
								<div class="hor_line_light"> </div>
							</li>';	
	}
	$NEWS_BLOCK_SUB .= '</ul>';
	return $NEWS_BLOCK_SUB;
}

function getEventsDetail_By_Date_Start($date)
{
	$db=new Database();
	$table = 'posts';
	$condition = array('dateStart' => array($date), 'postType' => array('events'));
	$result = $db->getRow($table, '*', $condition, PDO::FETCH_OBJ);
	$NEWS_BLOCK = '';
	if($result)
	{
		$post_title = $result->postTitle;
		$post_content = $result->postContent;		
		$NEWS_BLOCK .='<h3><span>'.$post_title.'</span></h3>					
					<div class="content">
						'.$post_content.'
					</div>';
		}
	return $NEWS_BLOCK;	
}

function getEventsDetail($id)
{
	$db=new Database();
	$table = 'posts';
	$condition = array('postId' => array($id), 'postType' => array('events'));
	$result = $db->getRow($table, '*', $condition, PDO::FETCH_OBJ);
	$post_title = $result->postTitle;
	$post_content = $result->postContent;
	$NEWS_BLOCK = '';
	$NEWS_BLOCK .='<h3><span>'.$post_title.'</span></h3>					
					<div class="content">
						'.$post_content.'
					</div>';
	return $NEWS_BLOCK;	
}

function getEventsDays($month, $year)
{
	$db=new Database();
	$table = 'posts';
	$condition = array('postType' => array('events'));
	$month = ($month < 10) ? '0'.$month : $month;
	$start = $year.'-'.$month.'-01 00:00:00.000000';
	$end = $year.'-'.$month.'-31 00:00:00.000000';	
	$days = '';
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' AND `dateStart` BETWEEN '$start' AND '$end' ORDER BY `postId` ASC", PDO::FETCH_OBJ);
	foreach ($result as $item)
	{
		$day = '';
		$dateStart = $item->dateStart;
		$day = trim(substr($dateStart,8,2));
		$days .= $day.',';
	
	}
	$days = trim($days,',');
	return $days;	
}

function getEventSub($limit ='')
{
	$db=new Database();
	$table = 'posts';
	$limit = (!empty($limit))? $limit : 4;
	$condition = array('postType' => array('events'));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT 0,$limit", PDO::FETCH_OBJ);
	
	$EVENT_BLOCK_SUB = '<ul>';
	foreach ($result as $item)
	{		
		$i++;
		$id = $item->postId;
		$post_title = $item->postTitle;
		$post_date_start = $item->dateStart;
		$post_date = makeDateEvent($post_date_start);		
		$EVENT_BLOCK_SUB .='<li class="clearfix">
								<div class="content" style="width: auto;">
									<p class="date">
										<span>'.$post_date.'</span>
									</p>
									<h5><a href="{HOST_LINK}/events.php?id='.$id.'">'.$post_title.'</a></h5>
									<a href="{HOST_LINK}/events.php?id='.$id.'" class="more">Chi tiết</a>
								</div>							
							</li>
							<li class="sep"></li>';	
	}
	$EVENT_BLOCK_SUB .= '</ul>';
	return $EVENT_BLOCK_SUB;
}

function getNewsSub($limit ='')
{
	/**
		NEWS BLOCK SUB
	**/
	$db=new Database();
	$table = 'posts';
	$limit = (!empty($limit))? $limit : 4;
	$condition = array('postType' => array('news'));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT 0,$limit", PDO::FETCH_OBJ);
	
	$i = 0;
	$NEWS_BLOCK_SUB = '<ul>';
	foreach ($result as $item)
	{		
		$i++;
		$id = $item->postId;
		$post_title = $item->postTitle;
		$post_date = $item->postDate;
		$post_date = makeDatePost($post_date);		
		$NEWS_BLOCK_SUB .='<li>
								<h5>
									<a id="" href="{HOST_LINK}/news.php?id='.$id.'">'.$post_title.'</a>
								</h5>
								<p class="date">
									<span id="">'.$post_date.'</span>
								</p>
							</li>
							<li class="sep"></li>';	
	}
	$NEWS_BLOCK_SUB .= '</ul>';
	return $NEWS_BLOCK_SUB;
}

/*
	INTRO
*/
function getIntroDetail($id)
{
	$db=new Database();
	$table = 'posts';
	$condition = array('postId' => array($id), 'postType' => array('intro'));
	$result = $db->getRow($table, '*', $condition, PDO::FETCH_OBJ);
	$post_title = $result->postTitle;
	$post_content = $result->postContent;
	$NEWS_BLOCK = '';
	$NEWS_BLOCK .='<h3><span>'.$post_title.'</span></h3>					
					<div class="content gallery">
						'.$post_content.'
					</div>';
	return $NEWS_BLOCK;	
}
function getIntroDetail_Other($id, $limit ='')
{
	/**
		NEWS BLOCK
		**/
		$db=new Database();
		$table = 'posts';
		$limit = (!empty($limit))? $limit : 4;
		$condition = array('postId' => array($id), 'postType' => array('intro'));
		$item = $db->getRow($table, 'postCategory', $condition, PDO::FETCH_OBJ);
		$catId = $item->postCategory;
		$condition = array('postType' => array('intro'), 'postCategory' => array($catId));
		$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' AND postId != $id ORDER BY `postId` ASC LIMIT 0,$limit", PDO::FETCH_OBJ);
		
		$i = 0;
		$NEWS_BLOCK = '<ul>';
		foreach ($result as $item)
		{		
			$i++;
			$id = $item->postId;
			$post_title = $item->postTitle;
			$post_desc = $item->postDesc;
			$post_date = $item->postDate;
			$post_date = makeDateEvent($post_date);		
			$NEWS_BLOCK .='<li>								
								<a id="" href="{HOST_LINK}/intro.php?id='.$id.'">'.$post_title.'</a>								
							</li>';	
		}
		$NEWS_BLOCK .= '</ul>';
		return $NEWS_BLOCK;
}

function getIntroPaging($pages, $catid)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	$url = HOST_LINK.'/intro.php?catid='.$catid.'&';
	$db=new Database();
	$table = 'posts';
	// get total post
	
	$get_max = $db->getCountRows($table, 'postId',"`postType` = 'intro' AND `postCategory` = '$catid' AND `postPublish` = '1'");
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	$url = rtrim($url, "/");
	$html_Paging = paging($pages,$totalPage, $url);
	if($totalPage > 1)
	{
		$html_Paging = "<div class=\"paginationTNUS\">".$html_Paging."</div>";		
	}
	else
	{
		return '';
	} 
	return $html_Paging;
}
function getIntro($pages, $catid)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	
	$url = HOST_LINK.'/intro.php?catid='.$catid.'&';
	$db=new Database();
	$table = 'posts';	
	$get_max = $db->getCountRows($table, 'postId',"`postType` = 'intro' AND `postCategory` = '$catid' AND `postPublish` = '1'");
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	
	
	$url = rtrim($url, "/");
	//$html_Paging = paging($page,$totalPage, $url);
	
	$condition = array('postType' => array('intro'), 'postCategory' => array($catid));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT $fromPost,$offsetPostPerPage", PDO::FETCH_OBJ);	
	$i = 0;
	$NEWS_BLOCK_SUB = '<ul>';
	foreach ($result as $item)
	{		
		$i++;
		$id = $item->postId;
		$post_title = $item->postTitle;
		$post_date = $item->postDate;
		$post_date = makeDatePost($post_date);		
		$NEWS_BLOCK_SUB .='<li>
								<h5>
									<a id="" href="{HOST_LINK}/intro.php?id='.$id.'">'.$post_title.'</a>
								</h5>
								<p class="date">
									<span id="">'.$post_date.'</span>
								</p>
							</li>
							<div class="hor_line_light"></div>';	
	}
	$NEWS_BLOCK_SUB .= '</ul>';
	return $NEWS_BLOCK_SUB;
}

/*
	MEMBER
*/
function getMemberPaging($pages)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	$url = HOST_LINK.'/member.php?';
	$db=new Database();
	$table = 'posts';
	// get total post
	
	$condition = array('postType' => array('member'));
	$get_max = $db->getCountRows($table, 'postId',"`postType` = 'member' AND `postPublish` = '1'");
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	$url = rtrim($url, "/");
	$html_Paging = paging($pages,$totalPage, $url);
	if($totalPage > 1)
	{
		$html_Paging = "<div class=\"paginationTNUS\">".$html_Paging."</div>";		
	}
	else
	{
		return '';
	} 
	return $html_Paging;
}

function getMember($pages)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	$url = HOST_LINK.'/member.php?';
	$db=new Database();
	$table = 'posts';	
	$condition = array('postType' => array('member'));
	$get_max = $db->getCountRows($table, 'postId',"`postType` = 'member' AND `postPublish` = '1'");
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	$url = rtrim($url, "/");
	//$html_Paging = paging($page,$totalPage, $url);
	
	$condition = array('postType' => array('member'));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT $fromPost,$offsetPostPerPage", PDO::FETCH_OBJ);	
	$i = 0;
	$NEWS_BLOCK_SUB = '<ul>';
	foreach ($result as $item)
	{		
		$i++;
		$id = $item->postId;
		$post_title = $item->postTitle;
		$post_avatar = $item->postImageThumbnail;
		$post_link	= $item->postLink;
		$post_content = $item->postContent;	
		$NEWS_BLOCK_SUB .='<li class="clearfix">
								<div class="img_block">
									<img style="border-width:0px;" src="'.$post_avatar.'">
								</div>
								<div class="content">
									<h5>
										<a target="_blank" href="'.$post_link.'">'.$post_title.'</a>
									</h5>									
									<p class="teaser">
										<span>'.$post_content.'</span>
										<a class="click" target="_blank" href="'.$post_link.'">external Link</a>
								</div>
								<div class="clear hor_line_light"> </div>
							</li>';	
	}
	$NEWS_BLOCK_SUB .= '</ul>';
	return $NEWS_BLOCK_SUB;
}

/*
	SUBJECT
*/
function getListSubject($catid)
{
	$db=new Database();
	$table = 'posts';
	//$limit = (!empty($limit))? $limit : 10;
	$limit = 50;
	/* 
		$condition = array('postId' => array($id), 'postType' => array('subject'));
		$item = $db->getRow($table, 'postCategory', $condition, PDO::FETCH_OBJ);
		$catId = $item->postCategory;
	*/
	$condition = array('postType' => array('subject'), 'postCategory' => array($catid));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT 0,$limit", PDO::FETCH_OBJ);
	$i=0;
	$NEWS_BLOCK = '<select id="choiceSubject">';
	foreach ($result as $item)
	{
		$id = $item->postId;
		$post_title= $item->postTitle;
		if($i == 0)
		{
			$NEWS_BLOCK .='<option value="'.$id.'" selected="selected">'.$post_title.'</option>';
		}
		else
		{
			$NEWS_BLOCK .='<option value="'.$id.'">'.$post_title.'</option>';
		}
		$i++;
	}
	$NEWS_BLOCK .='</select>';
	return $NEWS_BLOCK;
}

function getSubject($catid)
{
	$db=new Database();
	$table = 'posts';
	$condition = array('postType' => array('subject'), 'postCategory' => array($catid));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT 0,1", PDO::FETCH_OBJ);
	$i=0;
	$NEWS_BLOCK = '';
	foreach ($result as $item)
	{
		$id = $item->postId;
		$post_title= $item->postTitle;
		$post_desc= $item->postDesc;
		$post_content= $item->postContent;		
		$NEWS_BLOCK .='<h3>
							<span>'.$post_title.'</span>
						</h3>
						<div class="teaser">'.$post_desc.'</div>
						<div class="content">
							'.$post_content.'
						</div>';
		
		$i++;
	}
	
	return $NEWS_BLOCK;
}

function getSubjectDetailById($id)
{
	$db=new Database();
	$table = 'posts';
	
	$condition = array('postType' => array('subject'), 'postId' => array($id));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT 0,1", PDO::FETCH_OBJ);
	$i=0;
	$NEWS_BLOCK = '';
	foreach ($result as $item)
	{
		$id = $item->postId;
		$post_title= $item->postTitle;
		$post_desc= $item->postDesc;
		$post_content= $item->postContent;		
		$NEWS_BLOCK .='<h3>
							<span>'.$post_title.'</span>
						</h3>
						<div class="teaser">'.$post_desc.'</div>
						<div class="content">
							'.$post_content.'
						</div>';
		
		$i++;
	}
	
	return $NEWS_BLOCK;
}

/*
	PROJECT
*/
function getListProject($catid)
{
	$db=new Database();
	$table = 'posts';
	$limit = 50;
	/* 
		$condition = array('postId' => array($id), 'postType' => array('subject'));
		$item = $db->getRow($table, 'postCategory', $condition, PDO::FETCH_OBJ);
		$catId = $item->postCategory;
	*/
	$condition = array('postType' => array('project'), 'postCategory' => array($catid));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT 0,$limit", PDO::FETCH_OBJ);
	$i=0;
	$NEWS_BLOCK = '<select id="choiceSubject">';
	foreach ($result as $item)
	{
		$id = $item->postId;
		$post_title= $item->postTitle;
		if($i == 0)
		{
			$NEWS_BLOCK .='<option value="'.$id.'" selected="selected">'.$post_title.'</option>';
		}
		else
		{
			$NEWS_BLOCK .='<option value="'.$id.'">'.$post_title.'</option>';
		}
		$i++;
	}
	$NEWS_BLOCK .='</select>';
	return $NEWS_BLOCK;
}

function getProject($catid)
{
	$db=new Database();
	$table = 'posts';
	$condition = array('postType' => array('project'), 'postCategory' => array($catid));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT 0,1", PDO::FETCH_OBJ);
	$i=0;
	$NEWS_BLOCK = '';
	foreach ($result as $item)
	{
		$id = $item->postId;
		$post_title= $item->postTitle;
		$post_desc= $item->postDesc;
		$post_image= $item->postImageThumbnail;
		$post_link= $item->postLink;
		$post_content= $item->postContent;		
		$NEWS_BLOCK .='<h3>
							<span>'.$post_title.'</span>
						</h3>
						<div id="sn">
							<div id="subcontent">
								<div id="project_tab">
									<ul class="idTabs iTabs clearfix">
										<li>
											<a class="selected" href="#idTab1">Thông tin chung</a>
										</li>
										<li>
											<a class="" href="#idTab2">Mô tả</a>
										</li>
										<li>
											<a class="" href="#idTab3">Kết quả</a>
										</li>
									</ul>
								</div>
								<div id="data_sheet">
									<div class="block_content">
										<div id="idTab1" class="">'.$post_desc.'</div>
										<div id="idTab2" class="block_hidden_only_for_screen">'.$post_image.'</div>
										<div id="idTab3" class="block_hidden_only_for_screen">'.$post_link.'</div>
									</div>
								</div>
							</div>						
							<div class="content">
								'.$post_content.'
							</div>
						</div>';
		
		$i++;
	}
	
	return $NEWS_BLOCK;
}

function getProjectDetailById($id)
{
	$db=new Database();
	$table = 'posts';
	
	$condition = array('postType' => array('project'), 'postId' => array($id));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT 0,1", PDO::FETCH_OBJ);
	$i=0;
	$NEWS_BLOCK = '';
	foreach ($result as $item)
	{
		$id = $item->postId;
		$post_title= $item->postTitle;
		$post_desc= $item->postDesc;
		$post_image= $item->postImageThumbnail;
		$post_link= $item->postLink;
		$post_content= $item->postContent;		
		$NEWS_BLOCK .='<h3>
							<span>'.$post_title.'</span>
						</h3>
						<div id="sn">
							<div id="subcontent">
								<div id="project_tab">
									<ul class="idTabs iTabs clearfix">
										<li>
											<a class="selected" href="#idTab1">Thông tin chung</a>
										</li>
										<li>
											<a class="" href="#idTab2">Mô tả</a>
										</li>
										<li>
											<a class="" href="#idTab3">Kết quả</a>
										</li>
									</ul>
								</div>
								<div id="data_sheet">
									<div class="block_content">
										<div id="idTab1" class="">'.$post_desc.'</div>
										<div id="idTab2" class="block_hidden_only_for_screen">'.$post_image.'</div>
										<div id="idTab3" class="block_hidden_only_for_screen">'.$post_link.'</div>
									</div>
								</div>
							</div>						
							<div class="content">
								'.$post_content.'
							</div>
						</div>
						<script type="text/javascript"> 
							$("#project_tab ul").idTabs("tabs1"); 
						</script>';
		
		$i++;
	}
	
	return $NEWS_BLOCK;
}

/*
	DOWNLOAD
*/
function getDownloadPaging($pages, $catid)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	$url = HOST_LINK.'/download.php?catid='.$catid.'&';
	$db=new Database();
	$table = 'posts';
	// get total post
	
	$get_max = $db->getCountRows($table, 'postId',"`postType` = 'download' AND `postCategory` = '$catid' AND `postPublish` = '1'");
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	$url = rtrim($url, "/");
	$html_Paging = paging($pages,$totalPage, $url);
	if($totalPage > 1)
	{
		$html_Paging = "<div class=\"paginationTNUS\">".$html_Paging."</div>";		
	}
	else
	{
		return '';
	} 
	return $html_Paging;
}

function getDownload($pages, $catid)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	
	$url = HOST_LINK.'/download.php?catid='.$catid.'&';
	$db=new Database();
	$table = 'posts';	
	$get_max = $db->getCountRows($table, 'postId',"`postType` = 'download' AND `postCategory` = '$catid' AND `postPublish` = '1'");
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	
	
	$url = rtrim($url, "/");
	//$html_Paging = paging($page,$totalPage, $url);
	
	$condition = array('postType' => array('download'), 'postCategory' => array($catid));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT $fromPost,$offsetPostPerPage", PDO::FETCH_OBJ);	
	$i = 0;
	$NEWS_BLOCK_SUB = '';
	foreach ($result as $item)
	{		
		$i++;
		$id = $item->postId;
		$post_title = $item->postTitle;
		$post_link = $item->postAttachment;
		$post_date = $item->postDate;
		$post_date = makeDatePost($post_date);		
		$file_type = substr($post_link, -4);
			$file_type = str_replace(".", "", $file_type);
			$file_type = ($file_type == 'xlsx') ? 'xls': $file_type;
			$file_type = ($file_type == 'docx') ? 'doc': $file_type;
			$file_type = ($file_type == 'rar') ? 'zip': $file_type;
			
		$NEWS_BLOCK_SUB .='<div class="post_download">
								<div class="downloadinfo">
									<a href="'.$post_link.'">'.$post_title.'</a>
										<p class="post_meta">Ngày ban hành: '.$post_date.' </p>
								</div>
								<div class="downloaditemlink">
									<a class="downloaditem pdf" href="{HOST_LINK}/'.$post_link.'"><img src="{HOST_LINK}/assets/img/'.$file_type.'download.png"></a>
								</div>
							</div>';	
	}
	return $NEWS_BLOCK_SUB;
}

function getCategoryByPostId($id)
{
	$db=new Database();
	$table = 'posts';
	$condition = array('postId' => array($id));
	$item = $db->getRow($table, 'postCategory', $condition, PDO::FETCH_OBJ);
	$catId = $item->postCategory;
	return $catId;
}

function categoryParentTree($child_id,$category_tree_array = '') 
{
	$db=new Database();
	$table = 'category';
	$result = $db->getRow($table, '*', array('id' => array($child_id)), PDO::FETCH_OBJ);
	if (!is_array($category_tree_array))
		$category_tree_array = array();
	if($result)
	{
		$category_tree_array[] = array("id" => $result->id, "name" =>$result->nameCat);
		$category_tree_array = categoryParentTree($result->parentCat, $category_tree_array);
	}
	else
	{
		$category_tree_array[] = array("id" => '1', "name" =>'Trang chủ');
	}
	return $category_tree_array;
} 

/*
	JOB
*/
function getJobDetail($id)
{
	$db=new Database();
	$table = 'posts';
	$condition = array('postId' => array($id), 'postType' => array('job'));
	$result = $db->getRow($table, '*', $condition, PDO::FETCH_OBJ);
	$post_title = $result->postTitle;
	$post_content = $result->postContent;
	$NEWS_BLOCK = '';
	$NEWS_BLOCK .='<h3><span>'.$post_title.'</span></h3>					
					<div class="content gallery">
						'.$post_content.'
					</div>
					<div class="hor_line_light"></div>';
	return $NEWS_BLOCK;	
}
function getJobDetail_Other($id, $limit ='')
{
	/**
		NEWS BLOCK
		**/
		$db=new Database();
		$table = 'posts';
		$limit = (!empty($limit))? $limit : 4;
		$condition = array('postId' => array($id), 'postType' => array('job'));
		$item = $db->getRow($table, 'postCategory', $condition, PDO::FETCH_OBJ);
		$catId = $item->postCategory;
		$condition = array('postType' => array('job'), 'postCategory' => array($catId));
		$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' AND postId != $id ORDER BY `postId` ASC LIMIT 0,$limit", PDO::FETCH_OBJ);
		
		$i = 0;
		$NEWS_BLOCK = '<ul>';
		foreach ($result as $item)
		{		
			$i++;
			$id = $item->postId;
			$post_title = $item->postTitle;
			$post_desc = $item->postDesc;
			$post_date = $item->postDate;
			$post_date = makeDateEvent($post_date);		
			$NEWS_BLOCK .='<li>								
								<a id="" href="{HOST_LINK}/job.php?id='.$id.'">'.$post_title.'</a>								
							</li>';	
		}
		$NEWS_BLOCK .= '</ul>';
		return $NEWS_BLOCK;
}

function getJobPaging($pages, $catid)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	$url = HOST_LINK.'/intro.php?catid='.$catid.'&';
	$db=new Database();
	$table = 'posts';
	// get total post
	
	$get_max = $db->getCountRows($table, 'postId',"`postType` = 'intro' AND `postCategory` = '$catid' AND `postPublish` = '1'");
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	$url = rtrim($url, "/");
	$html_Paging = paging($pages,$totalPage, $url);
	if($totalPage > 1)
	{
		$html_Paging = "<div class=\"paginationTNUS\">".$html_Paging."</div>";		
	}
	else
	{
		return '';
	} 
	return $html_Paging;
}
function getJob($pages, $catid)
{
	/**
		NEWS BLOCK
	**/
	# thiet lap phan trang
	$offsetPostPerPage = 10;
	$totalPost = 0;
	$totalPage = 0;
	$currentPage = 0;
	$fromPost = 0;
	$toPost = 10;
	$html_Paging = '';
	$pages = (!empty($pages))? $pages : 1;
	
	$url = HOST_LINK.'/job.php?catid='.$catid.'&';
	$db=new Database();
	$table = 'posts';	
	$get_max = $db->getCountRows($table, 'postId',"`postType` = 'job' AND `postCategory` = '$catid' AND `postPublish` = '1'");
	$totalPost = $get_max;
	if($totalPost > $offsetPostPerPage)
	{
		$totalPage = ceil($totalPost / $offsetPostPerPage);
	}
	else
	{
		$totalPage = 1;
	}
	$toPost = $pages * $offsetPostPerPage;
	$fromPost = $toPost - $offsetPostPerPage;
	
	
	$url = rtrim($url, "/");
	//$html_Paging = paging($page,$totalPage, $url);
	
	$condition = array('postType' => array('job'), 'postCategory' => array($catid));
	$result = $db->getRowsOrderBy($table, '*', $condition, " AND `postPublish` = '1' ORDER BY `postId` DESC LIMIT $fromPost,$offsetPostPerPage", PDO::FETCH_OBJ);	
	$i = 0;
	$NEWS_BLOCK_SUB = '<ul>';
	foreach ($result as $item)
	{		
		$i++;
		$id = $item->postId;
		$post_title = $item->postTitle;
		$post_date = $item->postDate;
		$post_date = makeDatePost($post_date);		
		$NEWS_BLOCK_SUB .='<li>
								<h5>
									<a id="" href="{HOST_LINK}/job.php?id='.$id.'">'.$post_title.'</a>
								</h5>
								<p class="date">
									<span id="">'.$post_date.'</span>
								</p>
							</li>
							<div class="hor_line_light"></div>';	
	}
	$NEWS_BLOCK_SUB .= '</ul>';
	return $NEWS_BLOCK_SUB;
}

/*
	MENU LIST
*/
function breadCrum($catid)
{
	$getMenu = array_reverse(categoryParentTree($catid));
	$menu_array = array(
						'1' =>'<a href="'.HOST_LINK.'/">Trang chủ</a>',
						'2' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/intro.php?page=gioithieu">Giới thiệu </a>',
						'3' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/news.php">Tin tức & SK </a>',
						'4' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/news.php">Tin tức </a>',
						'5' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/events.php">Sự kiện </a>',
						'6' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/network.php">Mạng lưới </a>',
						'7' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/intro.php?id=23">Mạng lưới 1 </a>',
						'8' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/intro.php?id=23">Giới thiệu </a>',
						'9' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/member.php?catid=9">Thành viên </a>',
						'10' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/intro.php?catid=10">Mạng lưới 2 </a>',
						'11' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/news.php?catid=11">Tin tức </a>',
						'12' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/subject.php">Chuyên đề </a>',
						'13' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/project.php">Dự án </a>',
						'14' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/library.php">Thư viện </a>',
						'15' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/download.php">Tài liệu </a>',
						'16' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/album.php">Ảnh </a>',
						'17' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/job.php">Tuyển dụng </a>',
						'18' =>'<span class="navigation_pipe">::</span>
								<a href="'.HOST_LINK.'/contact.php">Liên hệ </a>'
						);
	$BREAD_CRUMB = '';
	
	foreach ($getMenu as $item)
	{
		$BREAD_CRUMB .= $menu_array[$item[id]];
	}
	return $BREAD_CRUMB;
}

?>