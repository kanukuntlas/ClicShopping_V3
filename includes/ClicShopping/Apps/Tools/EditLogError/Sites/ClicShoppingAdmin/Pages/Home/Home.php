<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Tools\EditLogError\Sites\ClicShoppingAdmin\Pages\Home;

  use ClicShopping\OM\Registry;

  use ClicShopping\Apps\Tools\EditLogError\EditLogError;

  class Home extends \ClicShopping\OM\PagesAbstract
  {
    public mixed $app;

    protected function init()
    {
      $CLICSHOPPING_EditLogError = new EditLogError();
      Registry::set('EditLogError', $CLICSHOPPING_EditLogError);

      $this->app = Registry::get('EditLogError');

      $this->app->loadDefinitions('Sites/ClicShoppingAdmin/main');
    }
  }
