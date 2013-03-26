<?php
/**
 * 
 * Header page included at the begining of each page on user side of the mdoule
 * 
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.00
  * @author		Finjon Kiang
 * @author		debianus
 * @version		$Id$
 * @package	lang_tool
 *
 */
require('../../mainfile.php');
include 'include/function.php';
DEFINE('LANG_TOOL_PATTERN', '/define\s*\(\s*[\'"]([^\'"]*?)[\'"]\s*,\s*[\'"](.*?)[\'"]?\)\s*;\s*/ism');
$skip_patterns = array(
    '/\/\/.*/',
    '/\/\*([^\*]*)\*\//s',
);
//	'/define\s*\(\s*[\'"]([^\'"]*?)[\'"]\s*,\s*([^\'"]*?)\s*;\s*/ism',

if(isset($_POST['step']))
    $step = $_POST['step'];
else if(isset($_GET['step']) && $_GET['step'] < 4)
    $step = $_GET['step'];
else if(isset($_SESSION['lang_tool']['step']))
    $step = 3;
else $step = 1;

switch($step)
{
    case 1:
        $_SESSION['lang_tool']['step'] = 1;
    break;
    case 2:
        if(isset($_POST['module']))
        {
            if($_POST['manual_path'] != '' && $_POST['manual_path'] != $_SESSION['lang_tool']['base_dir'] && file_exists($_POST['manual_path'])) {
            	$_SESSION['lang_tool']['base_dir'] = $_POST['manual_path'];
            	$_SESSION['lang_tool']['module'] = $_POST['manual_path'];
            } else if($_POST['module'] == 'core_lang_files') {
            	$_SESSION['lang_tool']['base_dir'] = ICMS_ROOT_PATH.'/language/';
            	$_SESSION['lang_tool']['module'] = $_POST['module'];
            } else {
            	$_SESSION['lang_tool']['base_dir'] = ICMS_ROOT_PATH.'/modules/'.$_POST['module'].'/language/';
            	$_SESSION['lang_tool']['module'] = $_POST['module'];
            }
        	
        }
        $_SESSION['lang_tool']['step'] = 2;
    break;
    case 3:
        if($_POST['step'] == '3' && $_POST['from'] != $_POST['to']){
          $_SESSION['lang_tool']['from'] = $_POST['from'];
          $_SESSION['lang_tool']['to'] = $_POST['to'];
          $_SESSION['lang_tool']['step'] = 3;
          $_SESSION['lang_tool']['path'] = '';
        } else $_SESSION['lang_tool']['step'] = 3;
    break;
    case 4:
        $_SESSION['lang_tool']['file'] = preg_replace('/..\//', '', $_POST['the_file']);
        $file_from = $_SESSION['lang_tool']['base_dir'].$_SESSION['lang_tool']['from'].$_SESSION['lang_tool']['path'].'/'.$_SESSION['lang_tool']['file'];
        $file_to = $_SESSION['lang_tool']['base_dir'].$_SESSION['lang_tool']['to'].$_SESSION['lang_tool']['path'].'/'.$_SESSION['lang_tool']['file'];
        $pass_step4 = 1;
        if(is_dir($file_to)||is_dir($file_from)){
          $pass_step4 = NULL;
          if($_POST["the_file"] != '')
          {
              if($_POST["the_file"] != '..')
                $_SESSION['lang_tool']['path'] .= '/'.$_POST["the_file"];
              else
              {
                if(substr_count($_SESSION['lang_tool']['path'], '/') < 1)
                    unset($_SESSION['lang_tool']['path']);
                else
                {
                    $path_array = explode('/', $_SESSION['lang_tool']['path']);
                    $_SESSION['lang_tool']['path'] = '';
                    for($i=1;$i<(sizeof($path_array) - 1);$i++)
                        $_SESSION['lang_tool']['path'] .= '/' . $path_array[$i];
                }
              }
          }
          $_SESSION['lang_tool']['step'] = 3;
        } else $_SESSION['lang_tool']['step'] = 4;
    break;
    case 5:
        $_SESSION['lang_tool']['step'] = 5;
    break;
    default:
        redirect_header(ICMS_URL.'/',1,_MD_ERROROCCURED);
        exit();
}
  //unset($_SESSION['lang_tool']);