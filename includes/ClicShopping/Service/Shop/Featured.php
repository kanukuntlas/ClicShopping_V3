<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Service\Shop;

  use ClicShopping\OM\Registry;
  use ClicShopping\OM\CLICSHOPPING;

  use ClicShopping\Apps\Marketing\Featured\Classes\Shop\FeaturedClass;

  class Featured implements \ClicShopping\OM\ServiceInterface
  {
    public static function start(): bool
    {
      if (is_file(CLICSHOPPING::BASE_DIR . 'Apps/Marketing/Featured/Classes/Shop/Featured.php')) {
        Registry::set('FeaturedClass', new FeaturedClass());

        $CLICSHOPPING_Featured = Registry::get('FeaturedClass');

        $CLICSHOPPING_Featured->scheduledFeatured();
        $CLICSHOPPING_Featured->expireFeatured();

        return true;
      } else {
        return false;
      }
    }

    public static function stop(): bool
    {
      return true;
    }
  }
