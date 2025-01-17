<?php
/**
 *
 *  @copyright 2008 - https://www.clicshopping.org
 *  @Brand : ClicShopping(Tm) at Inpi all right Reserved
 *  @Licence GPL 2 & MIT
 *  @Info : https://www.clicshopping.org/forum/trademark/
 *
 */

  use ClicShopping\OM\HTML;
  use ClicShopping\OM\CLICSHOPPING;

  if ($CLICSHOPPING_MessageStack->exists('main')) {
    echo $CLICSHOPPING_MessageStack->get('main');
  }

  require_once($CLICSHOPPING_Template->getTemplateFiles('breadcrumb'));

  if (isset($_GET['reset']) === true && isset($_GET['PasswordForgotten'])) {
?>
<section class="password_forgotten" id="password_forgotten">
  <div class="contentContainer">
    <div class="separator"></div>
    <div class="contentText">
      <?php echo CLICSHOPPING::getDef('text_password_reset_initiated'); ?>
      <div class="separator"></div>
      <div class="control-group">
        <div>
          <div class="buttonSet">
            <div class="buttonSet">
              <span class="text-end"><label for="buttonContinue"><?php echo  HTML::button(CLICSHOPPING::getDef('button_continue'), null, CLICSHOPPING::redirect(null, 'Account&LogIn'), 'success'); ?></label></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="separator"></div>
</section>
<?php
  } else {
    CLICSHOPPING::redirect();
  }