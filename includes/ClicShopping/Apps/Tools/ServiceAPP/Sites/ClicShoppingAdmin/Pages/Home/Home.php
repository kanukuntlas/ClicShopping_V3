<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Tools\ServiceAPP\Sites\ClicShoppingAdmin\Pages\Home;

  use ClicShopping\OM\Registry;

  use ClicShopping\Apps\Tools\ServiceAPP\ServiceAPP;

  class Home extends \ClicShopping\OM\PagesAbstract
  {
    public mixed $app;

    protected function init()
    {
      $CLICSHOPPING_ServiceAPP = new ServiceAPP();
      Registry::set('ServiceAPP', $CLICSHOPPING_ServiceAPP);

      $this->app = Registry::get('ServiceAPP');

      $this->app->loadDefinitions('Sites/ClicShoppingAdmin/main');
    }
  }
