<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @licence MIT - Portion of osCommerce 2.4
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  use ClicShopping\OM\HTML;
  use ClicShopping\OM\CLICSHOPPING;

  http_response_code(503);
  header('Retry-After: 300');
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Maintenance</title>
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<div class="text-center" style="padding-top:150px;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron" style="margin-top: 40px;">
          <h1>We'll be back soon!</h1>
          <p>We're currently working on and improving our website. We'll be back in a few moments..</p>
          <p style="margin-top: 40px;"><?php echo HTML::button('Return to website', null, CLICSHOPPING::link(), 'primary', null, 'sm'); ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>
