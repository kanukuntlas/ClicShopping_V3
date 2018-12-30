<?php
/**
 *
 *  @copyright 2008 - https://www.clicshopping.org
 *  @Brand : ClicShopping(Tm) at Inpi all right Reserved
 *  @Licence GPL 2 & MIT
 *  @licence MIT - Portion of osCommerce 2.4
 *  @Info : https://www.clicshopping.org/forum/trademark/
 *
 */


  namespace ClicShopping\OM\Modules;

  interface ContentInterface
  {
      public function execute();
      public function isEnabled();
      public function check();
      public function install();
      public function remove();
      public function keys();
  }
