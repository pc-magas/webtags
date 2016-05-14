<?php

if(!function_exists('getMetaTags'))
{
  /**
  * @return {String} With attributes that are on <meta /> Tag
  */
  function getMetaTags($str)
  {
    $pattern = '
    ~<\s*meta\s

    # using lookahead to capture type to $1
      (?=[^>]*?
      \b(?:name|property|http-equiv|charset)\s*=\s*
      (?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
      ([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
    )

    # capture content to $2
    [^>]*?\bcontent\s*=\s*
      (?|"\s*([^"]*?)\s*"|\'\s*([^\']*?)\s*\'|
      ([^"\'>]*?)(?=\s*/?\s*>|\s\w+\s*=))
    [^>]*>

    ~ix';

    if(preg_match_all($pattern, $str, $out))
      return array_combine($out[1], $out[2]);
    return array();
  }
}

if(!function_exists('getUrlData'))
{
  /**
  * Retrieve the title, the headers and the attributed of the <meta /> tags of a site in $url
  * @param $url {String} The site's $url
  * @return {Boolean} FALSE on failure
  *         {Array} With the title, the headers and the attributes of the <meta /> tags of a site
  */
  function getUrlData($url)
  {
      $result = false;

      $contents = getCurlContents($url);

      if (isset($contents) && is_string($contents))
      {
          $title = null;
          $metaTags = null;
          $h1=null;

          /*Get page's title*/
          //preg_match('/<title>([^>]*)<\/title>/si', $contents, $match );
          $match=pseudoMatchHTags($contents);

          if (isset($match) && is_array($match) && count($match) > 0)
          {
              $title = strip_tags($match[1]);
          }
          /*End of: "Get page's title" */

          $metaTags=getMetaTags($contents);


          preg_match_all('<h\d>', $contents, $matches);

          if (isset($match) && is_array($match) && count($match) > 0)
          {
              foreach($match as $key=>$m)
              {
                $match[$key]= html_entity_decode(strip_tags($m));
              }
              $h1=$match;
          }

          $result = array (
              'title' => $title,
              'metaTags' => $metaTags,
              'html_header'=>$h1
          );
      }

      return $result;
  }
}

if(!function_exists('pseudoMatchHTags'))
{
  /**
  * Get the headers of a web page
  * @param  $htmlContentWithHTags {String} Get the html contents of a web page
  * @return Array with the matches
  */
  function pseudoMatchHTags($htmlContentWithHTags)
  {
      $parts      = preg_split("%<\/h[1-6]>%si", $htmlContentWithHTags);
      $matches    = array();
      foreach($parts as $part){
          if(preg_match("%(.*|.?)(<h)([1-6])%si", $part)){
              $matches[] = preg_replace("%(.*|.?)(<)(h[1-6])(.*)%si", "$2$3$4$2/$3>", $part);
          }
      }
      return $matches;
  }
}

if(!function_exists('getCurlContents'))
{
  /**
  * Retrieves the content of a site of a specified $url
  *
  * @return {Boolean} FALSE on failure
  *         {String} with the contents
  */
  function getCurlContents($url)
  {
    require APPPATH."../vendor/autoload.php";
    try
    {
      $client = new GuzzleHttp\Client();
      $res = $client->request('GET', $url);

      if((int)$res->getStatusCode()>=400) return false; //If something wrong happened like 4XX or 5XX errors return false

      /*For better prosessing we retrieve the connection's encoding*/
      $header=$res->getHeader('content-type');
      $charset=str_replace('text/html; charset=','',$header[0]);
      /*End of: "For better prosessing we retrieve the connection's encoding" */

      $data=$res->getBody()->getContents();

      //Convert to UTF-8
      if($charset!==$header[0] && strcasecmp($charset[0],'utf-8')!==0) $data=mb_convert_encoding($data,'UTF-8',$charset);

      return $data;
    }
    catch (Exception $e)
    {
        return false;
    }
  }
}
