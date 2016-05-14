<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$ci=&get_instance();
$ci->load->helper('url');
class Wordlist
{
  /**
  * The wordlist in order to remove or find strings
  */
  private $wordlist=array();

  function ___construct($file=null)
  {
    if(empty($file)) $file=base_url('words.txt');//If no wordlist provided I get the default one

    /*Read line by line*/
    $file=fopen($file,'rt');
    if(!$file) throw Exception("Could not read file");
    while (($line = fgets($handle)) !== false) $this->wordlist[]=$line;//Appending to the wordlis
    fclose($file);
    /*End of: "Read line by line"*/
  }

  /**
  *Removing strings from a specific wordlist
  * @param $string {String} Input string
  * @return {String} Without the words in the wordlist
  */
  public function remove_strings($string)
  {
    if(!is_string($string)) throw Exception("The input you've givven is not a string.");
    return str_replace($this->wordlist,"",$string);
  }
}
?>
