<?php
/**
 * 
  * Fourth step: translation  page
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
if($_POST["the_file"]&&!is_dir($file_to)&&!is_dir($file_from)){
    $pass_step4 = 1;
    $path_parts = pathinfo($_POST["the_file"]);
    $content .= '<input type="hidden" name="ext" value="'.$path_parts['extension'].'"><input type="hidden" name="step" value="5">';
    switch($path_parts['extension'])
    {
        case 'php':
            $str1 = file_get_contents($file_from);
            //$str1 = preg_replace($skip_patterns, '', $str1);
            preg_match_all(LANG_TOOL_PATTERN, $str1, $match1);
            for($i=0;$i<sizeof($match1[1]);$i++){
              $lang_source[$match1[1][$i]] = $match1[2][$i];
            }
            if(file_exists($file_to))
            {
                $str2 = file_get_contents($file_to);
                //$str2 = preg_replace($skip_patterns, '', $str2);
                preg_match_all(LANG_TOOL_PATTERN, $str2, $match2);
                for($i=0;$i<sizeof($match2[1]);$i++){
                  $lang_target[$match2[1][$i]] = $match2[2][$i];
                }
            } else $lang_target = array();
          
            $content .= '<p>' . _MD_LANG_TOOL_INFILE . ''.$_SESSION['lang_tool']['file'].'<br><table id="langtool"><tr><th>' . _MD_LANG_TOOL_CONSTANT . '</th><th>'.$_SESSION['lang_tool']['from'].'</th><th>'.$_SESSION['lang_tool']['to'].'</th></tr>';
            $bgnum = 1;
            while(list($key, $val) = each($lang_source)){
              if($bgnum%2==1)
                $class = 'even';
              else
                $class = 'odd';
              $bgnum ++;
              $content .= '<tr class="'.$class.'"><td>'.$key.'</td><td>'.$val.'</td><td>';
              $rows = (strlen($val) / 100) + 2;
              if(substr_count($val, chr(13).chr(10))||strlen($val)>100)
              {
                if(isset($lang_target[$key]))
                    $content .= '<textarea class="resize" name="'.$key.'" rows="'.$rows.'" cols="30">'.$lang_target[$key].'</textarea>';
                else
                    $content .= '<textarea class="resize" name="'.$key.'" rows="'.$rows.'" cols="30">'.$lang_source[$key].'</textarea>';
              }
              else if(isset($lang_target[$key]))
                $content .= '<input class="resize2" size="40" type="text" name="'.$key.'" value="'.$lang_target[$key].'">';
              else
                $content .= '<input class="resize2" size="40" type="text" name="'.$key.'" value="'.$lang_source[$key].'">';
              $content .= '</td></tr>' . chr(10);
            }
            $content .= '<tr><td colspan="3" align="center"><input type="submit" value="' . _MD_LANG_TOOL_GO . '"></td></tr></table>';
        break;
        case 'tpl':
        default:
            $content .= '<textarea class="resize" name="source" rows="10" cols="100" readonly>'.file_get_contents($file_from).'</textarea>';
            $content .= '<p><input type="button" value="' . _MD_LANG_TOOL_COPY . '" onclick="this.form.target.value=this.form.source.value"> <input type="reset"></p>';
            $content .= '<textarea class="resize" name="target" rows="10" cols="100">'.file_get_contents($file_to).'</textarea>';
            $content .= '<br><input type="submit" value="' . _MD_LANG_TOOL_GO . '" />';
    }
}