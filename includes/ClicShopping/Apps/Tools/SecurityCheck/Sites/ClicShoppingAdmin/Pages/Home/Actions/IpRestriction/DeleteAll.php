<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Tools\SecurityCheck\Sites\ClicShoppingAdmin\Pages\Home\Actions\IpRestriction;

  use ClicShopping\OM\Registry;

  class DeleteAll extends \ClicShopping\OM\PagesActionsAbstract
  {
    protected mixed $app;

    public function __construct()
    {
      $this->app = Registry::get('SecurityCheck');
    }

    public function execute()
    {
      $page = (isset($_GET['page']) && is_numeric($_GET['page'])) ? (int)$_GET['page'] : 1;

      if (isset($_POST['selected'])) {
        foreach ($_POST['selected'] as $id) {
          $Qdelete = $this->app->db->prepare('delete
                                              from :table_ip_restriction
                                              where id = :id
                                            ');
          $Qdelete->bindInt(':id', $id);
          $Qdelete->execute();
        }
      }

      $this->app->redirect('IpRestriction&page=' . $page);
    }
  }