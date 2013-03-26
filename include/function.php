<?php
function showitem($str, $key){
  if(!$_SESSION['lang_tool']['step'] || ($_SESSION['lang_tool']['step'] == $key && $key == 1))
    return '<font color="red">'.$str.'</font>';
  else if($_SESSION['lang_tool']['step'] == $key)
    return ' => <font color="red">'.$str.'</font>';
  else if($key == 1)
    return '<a href="?step=1">' . $str . '</a>';
  else if($key == 2 && isset($_SESSION['lang_tool']['module']))
    return ' => <a href="?step=2">' . $str . '</a>';
  else if($key == 3 && isset($_SESSION['lang_tool']['from']))
    return ' => <a href="?step=3">' . $str . '</a>';
  else
    return ' => '.$str;
}

function navbar(){
  $str = '<p>'._MD_LANG_TOOL_STEPS;
  $str .= showitem(_MD_LANG_TOOL_STEPS_MODULE, 1);
  $str .= showitem(_MD_LANG_TOOL_STEPS_LANGUAGE, 2);
  $str .= showitem(_MD_LANG_TOOL_STEPS_FILE, 3);
  $str .= showitem(_MD_LANG_TOOL_STEPS_TRANSLATE, 4);
  $str .= showitem(_MD_LANG_TOOL_STEPS_FINISH, 5);
  return $str;
}

function lang_trans($matches) {  
    if(isset($_POST[$matches[1]]))
        $new_string = preg_replace('/\'/', '\\\'', stripslashes($_POST[$matches[1]]));
    else
        $new_string = preg_replace('/\'/', '\\\'', stripslashes($matches[2]));
    $i =0 ;
    
    while(strpos($new_string, '\\\\')){
        $new_string = str_replace('\\\\', '\\', $new_string);
    }
    if(preg_match_all('/\\\\\'\s*\.(.*?)\s*\.\s*\\\\\'/ism', $new_string, $inmatches)) {
    	foreach($inmatches[1] AS $key => $val) {
    		$inmatches[1][$key] = '\' . ' . stripslashes($val) . ' . \'';
    	}
    	$new_string = str_replace($inmatches[0], $inmatches[1], $new_string);
    }
        
        return 'define(\''.$matches[1].'\', \''.$new_string.'\');'. chr(10);
}

function getlist($dir, &$var){
  if(is_dir($dir)){
    if($dh = opendir($dir)){
      while(($file = readdir($dh)) !== false){
        if($file != '.' && $file != '..')
          $the_list[] = getlist($dir . '/' . $file, $var);
      }
    }
  } else {
    $var[] = $dir;
  }
}