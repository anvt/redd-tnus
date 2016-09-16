<?php
require_once('admin/config/config.php');
require_once('admin/config/class.database.php');
require_once('admin/function.php');
$today = date("m"); 
$currentMonth = date('m');
$currentDay = isset($_POST['currentDay']) ? $_POST['currentDay'] : '';
$currentMonth = isset($_POST['currentMonth']) ? $_POST['currentMonth'] : '';
$currentYear = isset($_POST['currentYear']) ? $_POST['currentYear'] : '';

$currentDay = ($currentDay < 10) ? '0'.$currentDay : $currentDay;
$currentMonth = ($currentMonth < 10) ? '0'.$currentMonth : $currentMonth;
//$date = $currentYear.'-'.$currentMonth.'-'.$currentDay. ' 00:00:00';
echo getEventsDays($currentMonth, $currentYear);
?>