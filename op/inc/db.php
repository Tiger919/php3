<?php 
	try
	{
		$db=new pdo("mysql:host=127.0.0.1;dbname=one piece;","root","root");
		$db->query("SET NAMES 'utf8'");
		$db->setAttribute(pdo::ATTR_ERRMODE,pdo::ERRMODE_WARNING);
	}
	catch(pdoexception $e)
	{
		echo $e->getMessage().'<br/>';
	}
?>