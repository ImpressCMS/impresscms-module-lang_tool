<?php
/**
 * 
 * Last step: download file or package
 * 
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.00
 * @author		Finjon Kiang
 * @author		debianus
 * @package	lang_tool
  * @version	$Id$
 *
 */

if(!defined('ICMS_ROOT_PATH')) exit();
$dir2 = $_SESSION['lang_tool']['base_dir'].$_SESSION['lang_tool']['to'].$_SESSION['lang_tool']['path'];
$file1 = $dir2.'/'.$_SESSION['lang_tool']['file'];
$file2 = ICMS_ROOT_PATH.'/cache/'.$_SESSION['lang_tool']['file'];
$mailt = '/mail_template';
$path_array = explode('/', $_SESSION['lang_tool']['path']);
$mk_path = $_SESSION['lang_tool']['base_dir'].$_SESSION['lang_tool']['to'];
$mk_path2 = $_SESSION['lang_tool']['base_dir'].$_SESSION['lang_tool']['to'].$mailt;
if(!file_exists($mk_path) && is_writeable($_SESSION['lang_tool']['base_dir']))
    mkdir($mk_path);	
	$mk_path .= '/index.html';
			$filename = $mk_path;	
			$contents = '<script>history.go(-1);</script>';
			$handle = fopen($filename, 'wb');
			$result = fwrite($handle, $contents);
			fclose($handle);
			chmod($mk_path, 0644);

if(!file_exists($mk_path2) && is_writeable($_SESSION['lang_tool']['base_dir']))
mkdir($mk_path2);	
$mk_path2 .= '/index.html';
		$filename = $mk_path2;	
		$contents = '<script>history.go(-1);</script>';
		$handle = fopen($filename, 'wb');
		$result = fwrite($handle, $contents);
		fclose($handle);
		chmod($mk_path2, 0644);		
			
for($i=1;$i<(sizeof($path_array) - 1);$i++)
{
    if(!file_exists($mk_path))
        mkdir($mk_path);
    $mk_path .= '/' . $path_array[$i];
}

if(is_writeable($_SESSION['lang_tool']['base_dir'].$_SESSION['lang_tool']['to'].$_SESSION['lang_tool']['path'])){
  $target_file = $file1;
} else {
  $target_file = $file2;
}

$translated_str = '';
switch($_POST['ext'])
{
    case 'php':
        $file_from = $_SESSION['lang_tool']['base_dir'].$_SESSION['lang_tool']['from'].$_SESSION['lang_tool']['path'].'/'.$_SESSION['lang_tool']['file'];
        $source_str = file_get_contents($file_from);
        $translated_str=preg_replace_callback(LANG_TOOL_PATTERN,'lang_trans',$source_str);    
    break;
    case 'tpl':
        $translated_str = $_POST['target'];
    default:
}

$fh = fopen($target_file, 'wb');
if(isset($translated_str))
    fwrite($fh, $translated_str);
fclose($fh);
$content .= _MD_LANG_TOOL_YOUCANFIND. $target_file;
$content .= '<p><a href="download.php">'._MD_LANG_TOOL_DOWNLOAD.'</a></p>' . _MD_LANG_TOOL_SHARE;