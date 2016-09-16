<?php
error_reporting(E_ALL ^ E_NOTICE);
require_once('admin/function.php');

$id = (isset($_POST['id'])) ? $_POST['id'] : '';
echo(getSubjectDetailById($id));
?>