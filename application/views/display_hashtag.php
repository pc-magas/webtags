<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Generated Hashtags</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

</head>
<body>
  <div class="container-fluid">
  <h1>Generated Tags</h1>

<?php
  if(!empty($tags))
  {
?>
    <div class="col-xs-12">
<?php
    foreach($tags as $t)
    {
      echo "<span class=\"label label-default\">#$t</span>&nbsp;";
    }
?>
  </div>
<?php
  }
  else
  {
?>
    <div class="alert alert-danger" role="alert">
        <strong>Sorry:</strong>
        I couldn't generate hashtags
    </div>
<?php
  }
?>
</div>
</body>
</html>
