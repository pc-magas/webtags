<?php

if(!function_exists('getMetaTags'))
{
  /**
  * Retrieves anything that is on <meta /> tag
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
  * Retrieve the title and the <meta /> tags of a site in $url
  * @param $url {String} The site's $url
  * @param $row {Boolean} For non escpared html characters
  * @return {Boolean} FALSE on failure
  *         {Array} With the title anD <meta /> tags of a site
  */
  function getUrlData($url, $raw=false) // $raw - enable for raw display
  {
      $result = false;

      $contents = getCurlContents($url);

      if (isset($contents) && is_string($contents))
      {
          $title = null;
          $metaTags = null;

          /*Get page's title*/
          preg_match('/<title>([^>]*)<\/title>/si', $contents, $match );

          if (isset($match) && is_array($match) && count($match) > 0)
          {
              $title = strip_tags($match[1]);
          }
          /*End of: "Get page's title" */

          $meta=getMetaTags($contents);
          $result = array (
              'title' => $title,
              'metaTags' => $meta,
          );
      }

      return $result;
  }
}

if(!function_exists('getCurlContents'))
{
  /**
  * Retrieves the content of a site of a specified $url
  * @author php.net
  *
  * @return {Boolean} FALSE on failure
  *         {String} with the contents
  */
  function getCurlContents($url, $maximumRedirections = null, $currentRedirection = 0)
  {
    require APPPATH."../vendor/autoload.php";

    $client = new GuzzleHttp\Client();
    $res = $client->request('GET', $url);

    $header=$res->getHeader('content-type');
    $charset=str_replace('text/html; charset=','',$header);
    var_dump($header);
    $data=$res->getBody()->getContents();
    if(strcasecmp($charset[0],'utf-8')!==0) $data=mb_convert_encoding($data,'UTF-8',$charset);

    return $data;
  }
}
