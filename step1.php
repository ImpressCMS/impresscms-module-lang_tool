<?php
/**
 * 
  * First step: module selection
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
$base = ICMS_ROOT_PATH.'/modules';
if(is_dir($base)){
  if ($dh = opendir($base)) {
    while (($file = readdir($dh)) !== false) {
      if($file!='.'&&$file!='..'&&is_dir($base.'/'.$file))
        $mo_dir[] = $file;
      }
    closedir($dh);
  }
} else {
  echo printf(_MD_LANG_TOOL_DIRERROR, $base);
}
$mo_dir[] = 'core_lang_files';
$content .= '<input type="hidden" name="step" value="2">';
$content .= _MD_LANG_TOOL_SESELECTMOD.'<p></p>';
$content .= '<select name="module">';
$num = sizeof($mo_dir);
for($i=0;$i<$num;$i++){
  $content .= '<option>'.$mo_dir[$i].'</option>';
}
$content .= '</select>';
$content .= '<p>'._MD_LANG_TOOL_MANUALPATH.'</p><input type="text" name="manual_path" value="';
if(isset($_SESSION['lang_tool']['base_dir'])) {
	$content .= $_SESSION['lang_tool']['base_dir'];
}
$content .= '" size="100"><p></p>';
$content .= '<input type="submit" value="' . _MD_LANG_TOOL_GO . '" />';