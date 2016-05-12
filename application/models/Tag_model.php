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
    $meta_tags=getUrlData($url);
    if($meta_tags===false) return false;

    $final_tags=array();

    return $final_tags;
  }

}
