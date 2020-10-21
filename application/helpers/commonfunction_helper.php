<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function url_rewrite($url)
{
	return strtolower(str_replace(array(" ","_","!","@","#","$","^","(",")","%","%20","&","!","%","'",'"',"*"),array("-",""),$url));
}

function seo_text($text)
{
	return strtolower(str_replace(array('\/','/',"'",'"'),array("-",""),$text));
}