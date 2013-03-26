<?php
/**
 * 
  * Index Page
 * 
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.00
  * @author		Finjon Kiang
 * @author		debianus
 * @version		$Id$
 * @package	lang_tool
 *
 */
require('header.php');

// We must always set our main template before including the header
$xoopsOption['template_main'] = 'lang_tool_greet.html';

// Include the page header
require(ICMS_ROOT_PATH.'/header.php');

$content = navbar().'<br>';
if(isset($_SESSION['lang_tool']['module']))
//  $content .= _MD_LANG_TOOL_INMODULE . $_SESSION['lang_tool']['module'] . '/language/*';
  $content .= '<p>'._MD_LANG_TOOL_INMODULE . $_SESSION['lang_tool']['module'];
if(isset($_SESSION['lang_tool']['path']))
  $content .= $_SESSION['lang_tool']['path'];
$content .= '<hr><div class="form"><form method="post">';
$pattern = LANG_TOOL_PATTERN;
switch($_SESSION['lang_tool']['step']){
  case 5:
    include 'step5.php';
  break;
  case 4:
    include 'step4.php';
  case 3:
    include 'step3.php';
  break;
  case 2:
    include 'step2.php';
  break;
  case 1:
  default:
    include 'step1.php';
}
$content .= '</form></div>';

$icmsTpl->assign('content', $content);

// Include the page footer
require(ICMS_ROOT_PATH.'/footer.php');