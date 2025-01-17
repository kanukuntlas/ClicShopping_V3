<?php
/**
 *
 *  @copyright 2008 - https://www.clicshopping.org
 *  @Brand : ClicShopping(Tm) at Inpi all right Reserved
 *  @Licence GPL 2 & MIT
 *  @Info : https://www.clicshopping.org/forum/trademark/
 *
 */

  use ClicShopping\OM\CLICSHOPPING;
  use ClicShopping\OM\HTML;

  require_once($CLICSHOPPING_Template->getTemplateFiles('breadcrumb'));
?>
<section class="login" id="login">
  <div class="contentContainer">
    <div class="contentText">
      <div class="page-title loginText"><h1><?php echo CLICSHOPPING::getDef('heading_title_login'); ?></h1></div>
      <div class="separator"></div>
      <div class="col-md-12 mainLogin"><?php echo CLICSHOPPING::getDef('text_new_customer_introduction', ['store_name' => HTML::outputProtected(STORE_NAME)]); ?></div>
      <div class="separator"></div>
      <?php echo $CLICSHOPPING_Template->getBlocks('modules_login'); ?>
    </div>
  </div>
</section>