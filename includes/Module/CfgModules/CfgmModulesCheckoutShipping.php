<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  use ClicShopping\OM\Registry;
  use ClicShopping\OM\CLICSHOPPING;

  class CfgmModulesCheckoutShipping
  {
    public string $code = 'modules_checkout_shipping';
    public string $directory;
    public $language_directory;
    public string $site = 'Shop';
    public string $key = 'MODULE_MODULES_CHECKOUT_SHIPPING_INSTALLED';
    public $title;
    public bool $template_integration = true;

    public function __construct()
    {
      $CLICSHOPPING_Template = Registry::get('TemplateAdmin');

      $this->directory = $CLICSHOPPING_Template->getDirectoryPathShopDefaultTemplateHtml() . '/modules/modules_checkout_shipping/';
      $this->language_directory = $CLICSHOPPING_Template->getPathLanguageShopDirectory();

      $this->title = CLICSHOPPING::getDef('module_cfg_module_checkout_shipping_title');
    }
  }

?>
