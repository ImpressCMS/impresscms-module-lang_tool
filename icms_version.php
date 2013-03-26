<?php
/**
 *
 * File: /icms_version.php
 * 
 * module informations and config
 * 
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		debianus
 * @version		$Id$
 * @package	lang_tool
 *
 */

defined("ICMS_ROOT_PATH") or die("ICMS root path not defined");
/**  General Information  */
$modversion = array(
		"name"						=> _MI_LANG_TOOL_NAME,
		"version"					=> 1.0,
		"description"				=> _MI_LANG_TOOL_DESC,
		"author"					=> "Finjon Kiang | http://twpug.net/",
		"credits"					=> "",
		"help"						=> "",
		"license"					=> "GNU General Public License (GPL)",
		"official"					=> 0,
		"dirname"					=> basename(dirname(__FILE__)),
		"modname"					=> "Lang_Tool",
	
	/**  Images information  */
		"iconsmall"					=> "images/icon_small.png",
		"iconbig"					=> "images/icon_big.png",
		"image"						=> "images/icon_big.png", /* for backward compatibility */
	
	/**  Development information */
		"status_version"			=> "Beta",
		"status"					=> "Beta",
		"date"						=> "15/03/2013",
		"author_word"				=> "",
		"warning"					=> _CO_ICMS_WARNING_BETA,
		
	
	/** Administrative information */
		"hasAdmin"					=> 1,
		"adminindex"				=> "admin/index.php",
		"adminmenu"					=> "admin/menu.php",
	
	/** Install and update informations 
		"onInstall"					=> "include/onupdate.inc.php",
		"onUpdate"					=> "include/onupdate.inc.php",
	*/
	/** Search information */
		"hasSearch"					=> 0,
	
	/** Menu information */
		"hasMain"					=> 1,
	/** Comments information */
		"hasComments"				=> 0
);

/** other possible types: testers, translators, documenters and other */
$modversion['people']['developers'][] = "[url=http://community.impresscms.org/userinfo.php?uid=106]TheRplima[/url]";
$modversion['people']['developers'][] = '<a href="http://community.impresscms.org/userinfo.php?uid=97" target="_blank">debianus</a> (since 1.0)';
$modversion['people']['testers'][] = '<a href="http://community.impresscms.org/userinfo.php?uid=446">Evasan</a>';
$modversion['people']['translators'][] = '<a href="http://community.impresscms.org/userinfo.php?uid=97" target="_blank">debianus</a> (Spanish)';
$modversion['support_site_url'] = 'http://community.impresscms.org/modules/newbb/viewforum.php?forum=9';
$modversion['support_site_name']= 'ImpressCMS Community Forum';

// Db
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";
// Table
$modversion['tables'][0] = "lt_languages";
//// TEMPLATES /

$i = 0;
$i++;
$modversion['templates'][$i] = array(
	'file'			=> 'lang_tool_greet.html',
	'description'	=> 'lang_tool Form' 
);
