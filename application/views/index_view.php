<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Generate hastags from a webpage</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
<body>
  <div class="container-fluid">
    <h1>Generate hastag from a webpage</h1>
      <form class="form-inline" action="<?php echo base_url('index.php/Hashtags/generate_tags');?>" method="POST">
        <div class="form-group">
           <input type="text" class="form-control" name="url" placeholder="Enter the site url here" required>
         </div>
         <button type="submit" class="btn btn-primary">Go!</button>
      </form>
  </div>
</body>
</html>
