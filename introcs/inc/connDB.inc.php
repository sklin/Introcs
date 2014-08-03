<?php
/****************************************************************************************************************
 * NCTU INTRO - http://intro.cs.nctu.edu.tw/																			Connect Database Include File	*
 * Develop environment: Apache 2.0.40 & PHP 4.2.2																	Programmer: JasonChung				*
 ****************************************************************************************************************
 * Date: 2008/09/05																																															*
 ****************************************************************************************************************/

// Database Setting
$DB_Host = "wwwdb.cs.nctu.edu.tw";
$DB_User = "intro";
$DB_PassWD = "Comment out by kohy";

$INTRO_DB = "INTRO_DB";

// Connect INTRO_DB DataBase Function
function conn_INTRO_DB() {
	global $DB_Host, $DB_User, $DB_PassWD, $INTRO_DB;
	$link_INTRO_DB = mysql_connect($DB_Host, $DB_User, $DB_PassWD);
	mysql_select_db($INTRO_DB, $link_INTRO_DB);
	mysql_query("SET NAMES UTF8");
	return $link_INTRO_DB;
}

// Disconnect DataBase Function
function closeDB($link) {
	mysql_close($link);
}
?>
