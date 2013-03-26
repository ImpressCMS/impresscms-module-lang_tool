<?php
/**
 *
 * File: /admin/menu.php
 * 
 * ACP Menu of the module
 * 
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.0
 * @author		debianus
 * @version		$Id$
 * @package	lang_tool
 *
 */

$adminmenu[0]['title'] = _MI_LANG_TOOL_MENU;
$adminmenu[0]['link'] = 'admin/index.php';

if ( isset( icms::$module ) ) {
icms_loadLanguageFile( basename( dirname( dirname( __FILE__ ) ) ), 'admin' );

global $icmsConfig;
$careerModule = icms_getModuleInfo(basename(dirname(dirname(__FILE__))));
$moddir = basename(dirname(dirname(__FILE__)));
	$i = -1;
	$i++;
	$headermenu[$i]['title'] = _CO_ICMS_GOTOMODULE;
	$headermenu[$i]['link']  = ICMS_URL . '/modules/' . icms::$module -> getVar( 'dirname' );
	$i++;
	$headermenu[$i]['title'] = _MI_LANG_TOOL_TEMPLATES;
	$headermenu[$i]['link'] = '../../system/admin.php?fct=tplsets&op=listtpl&tplset=' . $icmsConfig['template_set'] . '&moddir=' . $moddir;
	$i++;
	$headermenu[$i]['title'] = _CO_ICMS_UPDATE_MODULE;
	$headermenu[$i]['link'] = ICMS_URL . '/modules/system/admin.php?fct=modulesadmin&op=update&module=' . $moddir;

	$i++;
	$headermenu[$i]['title'] = _MODABOUT_ABOUT;
	$headermenu[$i]['link']  = ICMS_URL . '/modules/' . icms::$module -> getVar( 'dirname' ) . '/admin/about.php';
}
