<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Tools\SecurityCheck\Sites\ClicShoppingAdmin\Pages\Home\Actions;

  use ClicShopping\OM\Registry;

  class SecurityCheck extends \ClicShopping\OM\PagesActionsAbstract
  {

    public function execute()
    {
      $CLICSHOPPING_SecurityCheck = Registry::get('SecurityCheck');

      $this->page->setFile('security_check.php');

      $CLICSHOPPING_SecurityCheck->loadDefinitions('Sites/ClicShoppingAdmin/main');
    }
  }