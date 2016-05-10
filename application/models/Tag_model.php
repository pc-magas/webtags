<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag_model extends CI_Model
{
  function __construct()
  {
    parent::__construct();
  }

  /**
  * Method that generates Tags from a url given
  * @param $url {String} A url specified by user
  * @return {Array} with the Tags
  */
  function generate_tags($url)
  {
    $meta_tags=get_meta_tags($url);
    var_dump($meta_tags);

    $final_tags=array();

    return $final_tags;
  }

}
