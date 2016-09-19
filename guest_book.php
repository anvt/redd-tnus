<?php

set_time_limit(36000);

ini_set("memory_limit","1220M");

$timezone  = +7; //(GMT +7:00) 

error_reporting(E_ALL ^ E_NOTICE);

require_once('admin/function.php');


$post_type = isset($_POST['post_type']) ? stripslashes(trim($_POST['post_type'])) : "";
$post_code = isset($_POST['post_code']) ? stripslashes(trim($_POST['post_code'])) : "";
$post_title = isset($_POST['post_title']) ? stripslashes(trim($_POST['post_title'])) : "";
$postType = isset($_POST['postType']) ? stripslashes(trim($_POST['postType'])) : "";
$post_cat = isset($_POST['post_cat']) ? stripslashes(trim($_POST['post_cat'])) : "";
$post_desc = isset($_POST['post_desc']) ? stripslashes(trim($_POST['post_desc'])) : "";
$post_image_thumbnail = isset($_POST['post_image_thumbnail']) ? stripslashes(trim($_POST['post_image_thumbnail'])) : "";
$post_link = isset($_POST['post_link']) ? stripslashes(trim($_POST['post_link'])) : "";
$post_attachment = isset($_POST['post_attachment']) ? stripslashes(trim($_POST['post_attachment'])) : "";
$post_detail = isset($_POST['post_detail']) ? $_POST['post_detail'] : "";	
$post_source = isset($_POST['post_source']) ? $_POST['post_source'] : "";
	
$post_date_start = isset($_POST['date_start']) ? $_POST['date_start'] : "";	
$post_date_end = isset($_POST['date_end']) ? $_POST['date_end'] : "";	
$post_date_start = date("Y-m-d H:i:s", strtotime($post_date_start));
$post_date_end = date("Y-m-d H:i:s", strtotime($post_date_end));

$name = isset($_POST['name']) ? stripslashes(trim($_POST['name'])) : "";
$email = isset($_POST['email']) ? stripslashes(trim($_POST['email'])) : "";
$subject = isset($_POST['subject']) ? stripslashes(trim($_POST['subject'])) : "";
$content = isset($_POST['content']) ? stripslashes(trim($_POST['content'])) : "";
$db=new Database();
if($postType == "add")
{
	
	if($name == "" ||$email == "" || $subject == "" ||$content == "")
	{
		echo "Thêm bài viết thất bại!";
		exit();
	}

	$post_date = date("Y-m-d H:i:s", time()); //gmdate('d-m-Y H:i', time() + 3600*($timezone+date("0")));
	$post_view = 0;
	$post_publish = 1;
	$post_detail = '<b>Anh/chị:</b> '.$name.'</br><b>Email: </b>'.$email.'</br></br>'.$content;
	$post_title = $subject;
	$post_type = 'contact';
	$post_cat = 18;
	$data = array(
            'postTitle' => $post_title,
            'postContent' => $post_detail,
            'postDesc' => $post_desc,
            'postImageThumbnail' => $post_image_thumbnail,
            'postSource' => $post_source,
            'postLink' => $post_link,
            'postAttachment' => $post_attachment,
            'postCategory' => $post_cat,
            'postType' => $post_type,
            'postDate' => $post_date,
            'dateStart' => $post_date_start,
            'dateEnd' => $post_date_end,
            'postPublish' => $post_publish,
            'postNote' => NULL
        );
    $result = post_add('posts', $data);
	if($result)
	{
		echo "Thêm bài viết thành công!";
		exit();
	}
}