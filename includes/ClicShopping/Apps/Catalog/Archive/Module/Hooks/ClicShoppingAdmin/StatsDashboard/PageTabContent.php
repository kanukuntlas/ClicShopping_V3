<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Catalog\Archive\Module\Hooks\ClicShoppingAdmin\StatsDashboard;

  use ClicShopping\OM\Registry;

  use ClicShopping\Apps\Catalog\Archive\Archive as ArchiveApp;

  class PageTabContent implements \ClicShopping\OM\Modules\HooksInterface
  {
    protected mixed $app;

    public function __construct()
    {
      if (!Registry::exists('Archive')) {
        Registry::set('Archive', new ArchiveApp());
      }

      $this->app = Registry::get('Archive');

      $this->app->loadDefinitions('Module/Hooks/ClicShoppingAdmin/StatsDashboard/page_tab_content');
    }

    private function statsCountProductsArchive()
    {
      $QproductsArchives = $this->app->db->prepare('select count(products_id) as count
                                                    from :table_products
                                                    where products_archive = 1
                                                    limit 1
                                                   ');
      $QproductsArchives->execute();

      $products_archives_total = $QproductsArchives->valueInt('count');

      return $products_archives_total;
    }

    public function display()
    {
      if (!\defined('CLICSHOPPING_APP_ARCHIVE_AR_STATUS') || CLICSHOPPING_APP_ARCHIVE_AR_STATUS == 'False') {
        return false;
      }

      if ($this->statsCountProductsArchive() != 0) {
        $content = '
        <div class="row">
          <div class="col-md-11 mainTable">
            <div class="form-group row">
              <label for="' . $this->app->getDef('box_entry_products_archives') . '" class="col-9 col-form-label"><a href="' . $this->app->link('Archive') . '">' . $this->app->getDef('box_entry_products_archives') . '</a></label>
              <div class="col-md-3">
                ' . $this->statsCountProductsArchive() . '
              </div>
            </div>
          </div>
        </div>
       ';

        $output = <<<EOD
  <!-- ######################## -->
  <!--  Start Products      -->
  <!-- ######################## -->
             {$content}
  <!-- ######################## -->
  <!--  Start Products      -->
  <!-- ######################## -->
EOD;
        return $output;
      }
    }
  }
