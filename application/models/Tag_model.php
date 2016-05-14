<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*Model that is used to generate Hashtags
*/
class Tag_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  /**
  * Method that generates Tags from a url given
  * @param $url {String} A url specified by user
  * @return {Array} with the Hashtags
  */
  function generate_tags($url)
  {
    $this->load->helper('http_meta_helper');
    $meta_tags=getUrlData($url);//It stores any sort of element that we can export information

    if($meta_tags===false) return false;
    if(isset($meta_tags['metaTags']['keywords'])) return explode(',',$meta_tags['metaTags']['keywords']);

    $final_tags=array(); //Array that stores the final hashtags
    $final_string="";//String that will sum all the to be hashhtag words

    try
    {
      /*Try to retrieve from headers the most common words*/
      if(!empty($meta_tags['html_header']))//Generate from headers (hX html tags)
      {
        foreach($meta_tags['html_header'] as $h)
        {
          $final_string.=$h;
        }
        $this->load->library('wordlist');
        $final_string=$this->wordlist->remove_strings($final_string);

        $this->load->helper('phrase');
        $final_string=common_strings($final_string);

        $i=1;
        foreach($final_string as $key=>$val)
        {
          if($i>10) break;
          if(strlen($key)===1) continue;
          $final_tags[]=$key;
          $i++;
        }
      }
      /*End of: "Try to retrieve from headers the most common words"*/
    }
    catch (Exception $e)
    {
      if(empty($final_string)) return false;
    }

    return  array_unique($final_tags);// In order not to have duplicates
  }

}
