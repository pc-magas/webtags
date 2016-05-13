<?php

if(!function_exists('common_strings'))
{
  /**
  * Count how many words exist in a text and sorting by the most popular to be above
  */
  function common_strings($phrase)
  {
    $words=str_word_count($phrase,1);

    $ret=array();
    foreach($words as $w)
    {
      $w= mb_strtolower(trim($w));
      if(!isset($ret[$w])) $ret[$w]=0;
      else $ret[$w]++;
    }

    asort($ret);
    return  array_reverse($ret);
  }
}
?>
