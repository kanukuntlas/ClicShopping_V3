<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Customers\Groups\Module\Hooks\ClicShoppingAdmin\TopDashboard;

  use ClicShopping\OM\CLICSHOPPING;
  use ClicShopping\OM\Registry;
  use ClicShopping\OM\HTML;

  use ClicShopping\Apps\Customers\Groups\Groups as GroupsApp;

  class DashboardMembersB2B implements \ClicShopping\OM\Modules\HooksInterface
  {
    /**
     * @var bool|null
     */
    protected mixed $app;

    public function __construct()
    {
      if (!Registry::exists('Groups')) {
        Registry::set('Groups', new GroupsApp());
      }

      $this->app = Registry::get('Groups');

      $this->app->loadDefinitions('Module/Hooks/ClicShoppingAdmin/TopDashboard/dashboard_top_members_B2B');
    }

    public function Display(): string
    {
      $Qmembes = $this->app->db->prepare('select count(customers_id) as count 
                                          from :table_customers
                                          where member_level = 0
                                          ');
      $Qmembes->execute();

      $number_members = $Qmembes->valueInt('count');
      $output = '';

      if ($number_members > 0) {
        $text = $this->app->getDef('text_number_members_b2b');
        $text_view = $this->app->getDef('text_view');

        $output = '
<div class="col-md-2 col-12 m-1">
  <div class="card bg-secondary">
      <div class="card-body">
        <div class="row">
          <h6 class="card-title text-white"><i class="bi bi-person-fill"></i> ' . $text . '</h6>
        </div>
        <div class="col-md-12">
          <span class="text-white"><strong>' . $number_members . '</strong></span>
          <span><small class="text-white">' . HTML::link(CLICSHOPPING::link(null, 'A&Customers\Members&Members'), $text_view, 'class="text-white"') . '</small></span>
      </div>
    </div>
  </div>
</div>
';
      }

      return $output;
    }
  }