<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Configuration\Modules\Module\ClicShoppingAdmin\Config\MO;

  class MO extends \ClicShopping\Apps\Configuration\Modules\Module\ClicShoppingAdmin\Config\ConfigAbstract
  {

    protected $pm_code = 'modules';

    public bool $is_uninstallable = true;
    public ?int $sort_order = 400;

    protected function init()
    {
      $this->title = $this->app->getDef('module_mo_title');
      $this->short_title = $this->app->getDef('module_mo_short_title');
      $this->introduction = $this->app->getDef('module_mo_introduction');
      $this->is_installed = \defined('CLICSHOPPING_APP_MODULES_MO_STATUS') && (trim(CLICSHOPPING_APP_MODULES_MO_STATUS) != '');
    }

    public function install()
    {
      parent::install();

      if (\defined('MODULE_MODULES_MODULES_INSTALLED')) {
        $installed = explode(';', MODULE_MODULES_MODULES_INSTALLED);
      }

      $installed[] = $this->app->vendor . '\\' . $this->app->code . '\\' . $this->code;

      $this->app->saveCfgParam('MODULE_MODULES_MODULES_INSTALLED', implode(';', $installed));
    }

    public function uninstall()
    {
      parent::uninstall();

      $installed = explode(';', MODULE_MODULES_MODULES_INSTALLED);
      $installed_pos = array_search($this->app->vendor . '\\' . $this->app->code . '\\' . $this->code, $installed);

      if ($installed_pos !== false) {
        unset($installed[$installed_pos]);

        $this->app->saveCfgParam('MODULE_MODULES_MODULES_INSTALLED', implode(';', $installed));
      }
    }
  }