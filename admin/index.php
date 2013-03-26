<?php
/**
 * 
  * File: /admin/index.php
 * 
 * ACP-Index
 * 
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License (GPL)
 * @since		1.00
  * @author		Finjon Kiang
 * @author		debianus
 * @version		$Id$
 * @package	lang_tool
 *
 */
include '../../../include/cp_header.php';
include 'function.php';
icms_cp_header();
$icmsModule->displayAdminMenu ( 0, _MD_LANG_TOOL_ADMIN );		
define('LANG_THIS_URL', ICMS_URL.'/modules/lang_tool/admin/index.php');
switch($_GET['act']){
  case 'add':
    if($_POST['lang']){
      if($_POST['lang_title']&&$_POST['dirname']){
        $sql = 'INSERT INTO `'.$xoopsDB->prefix('lt_languages').'` VALUES (\'\', \''.$_POST['lang_title'].'\', \''.$_POST['dirname'].'\')';
        if ($result = $xoopsDB->query($sql)) {
          redirect_header(LANG_THIS_URL,1, _MD_LANG_TOOL_UPDATEOK);
        }
      }
    } else {
      the_form();
    }
  break;
  case 'edit':
    if($_GET['lang_id']){
      if($_POST['lang']){
        if($_POST['lang_title']&&$_POST['dirname']){
          $sql = 'UPDATE `'.$xoopsDB->prefix('lt_languages').'` SET
                 `lang_title` = \''.$_POST['lang_title'].'\',
                 `dirname` = \''.$_POST['dirname'].'\'
                 WHERE `lang_id` = \''.$_GET['lang_id'].'\'';
          if ($xoopsDB->query($sql)) {
            redirect_header(LANG_THIS_URL,1,_MD_LANG_TOOL_UPDATEOK);
          }
        }
      } else {
        $sql = 'SELECT * FROM `'.$xoopsDB->prefix('lt_languages').'` WHERE `lang_id` = '.$_GET['lang_id'];
        if (!$result = $xoopsDB->query($sql)) {
          redirect_header(ICMS_URL.'/',1,_MD_LANG_TOOL_ERROR);
          exit();
        }
        $data = $xoopsDB->fetchArray($result);
        the_form($data);
      }
    } else {
      redirect_header(LANG_THIS_URL,1,_MD_LANG_TOOL_NOLANG);
    }
  break;
  case 'del':
    if($_GET['lang_id']){
      $sql = 'DELETE FROM `'.$xoopsDB->prefix('lt_languages').'` WHERE `lang_id` = '.$_GET['lang_id'];
      if(mysql_query($sql)){
        redirect_header(LANG_THIS_URL,1,_MD_LANG_TOOL_UPDATEOK);
      }
    } else {
      redirect_header(LANG_THIS_URL,1,_MD_LANG_TOOL_NOLANG);
    }
  break;
  default:
    $sql1 = 'SELECT `lang_id` FROM `'.$xoopsDB->prefix('lt_languages').'`';
    if (!$result1 = $xoopsDB->query($sql1) ) {
      redirect_header(ICMS_URL.'/',1,_MD_LANG_TOOL_ERROR);
      exit();
    }
    $total = $xoopsDB->getRowsNum($result1); 
    if(!$_GET["page"]) $page=1;
    else $page = $_GET["page"];
    $per = 20; 
    $list = 10; 
    $start = ($page-1)*$per;
    $pages = ceil($total/$per);
    
    if((floor($pages/$list)>=1)&&($pages > $list)){ 
      if($page%$list > 0)
        $page_loop = ((floor($page/$list))*$list) +1;
      else
        $page_loop = ((floor(($page-1)/$list))*$list) +1;
      
      if($pages > ($list+$page_loop-1))
        $page_limit = $list+$page_loop-1;
      else
        $page_limit = $pages;
    } else {
      $page_loop = 1;
      $page_limit = $pages;
    }
    
    if($page==$pages&&$total%$per!=0)
      $per = $total % $per;
    
    $sql = 'SELECT * FROM `'.$xoopsDB->prefix('lt_languages').'` LIMIT '.$start.', '.$per;
    if (!$result = $xoopsDB->query($sql) ) {
      redirect_header(ICMS_URL.'/',1,_MD_LANG_TOOL_ERROR);
      exit();
    }
    
    if(($num = $xoopsDB->getRowsNum($result))>0){
      
      echo '<table align="center" width="400">';
      echo '<tr><th width="200">'._MD_LANG_TOOL_LANGTITLE.'</th><th width="100">'._MD_LANG_TOOL_FOLDER.'</th><th width="100">'._MD_LANG_TOOL_ADMIN.'</th></tr>';
      for($i=0;$i<$num;$i++){
        $data = $xoopsDB->fetchArray($result);
        echo '<tr>';
        echo '<td class="head">'.$data['lang_title'].'</td>';
        echo '<td class="head">'.$data['dirname'].'</td>';
        echo '<td class="even">';
        echo '<a href="'.LANG_THIS_URL.'?act=edit&lang_id='.$data['lang_id'].'">'._MD_LANG_TOOL_EDIT.'</a>&nbsp;&nbsp;';
        echo '<a href="'.LANG_THIS_URL.'?act=del&lang_id='.$data['lang_id'].'">'._MD_LANG_TOOL_DEL.'</a>&nbsp;&nbsp;';
        echo '</td>';
        echo '</tr>';
      }
      echo '</table>';	  
		echo '
		<div style="padding-top: 15px; padding-bottom: 5px; padding-left:2px">
		<form method="post" action="'.LANG_THIS_URL.'?act=add">
		<input type="submit" value="'._MD_LANG_TOOL_ADD.'" onclick="'.LANG_THIS_URL.'?act=add" name="addcontent">
		</form></div>';  
      if($pages>1){
        echo '<table align="center" width="400"><tr><td align="center">';
        if($pages>$list&&$page>$list){
          $p = floor(($page_loop - 2) / $list)*$list+1;
          echo '<a href="'.LANG_THIS_URL.'?page='.$p.'">'._MD_LANG_TOOL_L10.'</a>&nbsp;';
        }
        if($page>1){
          $p = $page - 1;
          echo '&nbsp;<a href="'.LANG_THIS_URL.'?page='.$p.'">'._MD_LANG_TOOL_L1.'</a>&nbsp;';
        }
        for($t=$page_loop;$t<=$page_limit;$t++){
          if ($page == $t){
            echo '&nbsp;<b>'.$t.'</b>&nbsp;';
          } else {
            echo '&nbsp;<a href="'.LANG_THIS_URL.'?page='.$t.'">'.$t.'</a>&nbsp;';
          }
        }
        if($pages>$page){
          $p = $page + 1;
          echo '&nbsp;<a href="'.LANG_THIS_URL.'?page='.$p.'">'._MD_LANG_TOOL_N1.'</a>&nbsp;';
        }
        if($pages>$list&&$pages >= ($page_loop+$list) ){
          $p = $page_limit + 1;
          echo '&nbsp;<a href="'.LANG_THIS_URL.'?page='.$p.'">'._MD_LANG_TOOL_N10.'</a>';
        }
        echo '</td></tr></table>';
      }
    }
}
icms_cp_footer();