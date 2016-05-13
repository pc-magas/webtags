<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hashtags extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model("Tag_model","hashtag");
  }

  /**
  * Main Page
  */
  public function index()
  {
    $this->load->view('index_view.php');
  }

  /**
  *Auto generate Hashtags
  */
  public function generate_tags()
  {
    $url=$this->input->post('url');

    $tags=$this->hashtag->generate_tags($url);

    $this->load->view('display_hashtag.php',array('tags'=>$tags));
  }

}
