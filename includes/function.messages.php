<?php
// MLM - PHP Script
// Author: DeluxeScript
// Website: www.deluxescript.com
if(!defined('V1_INSTALLED')){
    header("HTTP/1.0 404 Not Found");
	exit;
}

function success($text) {
	return '<div class="alert alert-success success"><i class="fa fa-check"></i> '.$text.'</div>';
}

function error($text) {
	return '<div class="alert alert-danger danger"><i class="fa fa-times"></i> '.$text.'</div>';
}

function info($text) {
	return '<div class="alert alert-info info"><i class="fa fa-info-circle"></i> '.$text.'</div>';
}
function warn($text) {
	return '<div class="alert alert-warning warning"><i class="fa fa-info-circle"></i> '.$text.'</div>';
}
?>