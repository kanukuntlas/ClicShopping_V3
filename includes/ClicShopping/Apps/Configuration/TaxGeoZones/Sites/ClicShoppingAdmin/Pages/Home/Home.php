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

  namespace ClicShopping\Apps\Configuration\TaxGeoZones\Sites\ClicShoppingAdmin\Pages\Home;

  use ClicShopping\OM\Registry;

  use ClicShopping\Apps\Configuration\TaxGeoZones\TaxGeoZones;

  class Home extends \ClicShopping\OM\PagesAbstract
  {
    public mixed $app;

    protected function init()
    {
      $CLICSHOPPING_TaxGeoZones = new TaxGeoZones();
      Registry::set('TaxGeoZones', $CLICSHOPPING_TaxGeoZones);

      $this->app = $CLICSHOPPING_TaxGeoZones;

      $this->app->loadDefinitions('Sites/ClicShoppingAdmin/main');
    }
  }
