<?php
/**
 * 
  * Second step: language selection
 * 
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.00
  * @author		Finjon Kiang
 * @author		debianus
 * @version		$Id$
 * @package	lang_tool
 *
 */
if(!defined('ICMS_ROOT_PATH')) exit();
if($_POST['module'] || $_SESSION['lang_tool']['module']){
  $sql = 'SELECT * FROM `'.$xoopsDB->prefix('lt_languages').'`';
  if (!$result = $xoopsDB->query($sql) ) {
    redirect_header(ICMS_URL.'/',1,_MD_ERROROCCURED);
    exit();
  }

  $content .= '<input type="hidden" name="step" value="3">';
  $content .= _MD_LANG_TOOL_SESELECTLANG.'<div style="padding:10px;">';
  $content .= '<p>'._MD_LANG_TOOL_FROM.'<p><select name="from">';
  while ( $row = $xoopsDB->fetchArray($result) ) {
    $content .= '<option value="'.$row['dirname'].'">'.$row['lang_title'].'</option>';
  }
  $content .= '</select><p>'._MD_LANG_TOOL_TO.'<p><select name="to">';
  @mysql_data_seek($result, 0);
  while ($row = $xoopsDB->fetchArray($result)){
    $content .= '<option value="'.$row['dirname'].'">'.$row['lang_title'].'</option>';
  }
  $content .= '</select>';
  $content .= '<p><input type="submit" value="' . _MD_LANG_TOOL_GO . '" /></p>';
}