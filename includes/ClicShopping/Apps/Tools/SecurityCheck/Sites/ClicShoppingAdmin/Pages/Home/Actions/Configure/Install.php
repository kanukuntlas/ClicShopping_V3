<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Tools\SecurityCheck\Sites\ClicShoppingAdmin\Pages\Home\Actions\Configure;

  use ClicShopping\OM\Registry;
  use ClicShopping\OM\Cache;

  class Install extends \ClicShopping\OM\PagesActionsAbstract
  {
    public function execute()
    {
      $CLICSHOPPING_MessageStack = Registry::get('MessageStack');
      $CLICSHOPPING_SecurityCheck = Registry::get('SecurityCheck');

      $current_module = $this->page->data['current_module'];

      $CLICSHOPPING_SecurityCheck->loadDefinitions('Sites/ClicShoppingAdmin/install');

      $m = Registry::get('SecurityCheckAdminConfig' . $current_module);
      $m->install();

      static::installDbMenuAdministration();
      static::installDb();

      $CLICSHOPPING_MessageStack->add($CLICSHOPPING_SecurityCheck->getDef('alert_module_install_success'), 'success');

      $CLICSHOPPING_SecurityCheck->redirect('Configure&module=' . $current_module);
    }

    private static function installDbMenuAdministration()
    {
      $CLICSHOPPING_Db = Registry::get('Db');
      $CLICSHOPPING_SecurityCheck = Registry::get('SecurityCheck');
      $CLICSHOPPING_Language = Registry::get('Language');

      $Qcheck = $CLICSHOPPING_Db->get('administrator_menu', 'app_code', ['app_code' => 'app_tools_security_check']);

      if ($Qcheck->fetch() === false) {

        $sql_data_array = [
          'sort_order' => 1,
          'link' => 'index.php?A&Tools\SecurityCheck&SecurityCheck',
          'image' => 'cybermarketing.gif',
          'b2b_menu' => 0,
          'access' => 1,
          'app_code' => 'app_tools_security_check'
        ];

        $insert_sql_data = ['parent_id' => 178];

        $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

        $CLICSHOPPING_Db->save('administrator_menu', $sql_data_array);

        $id = $CLICSHOPPING_Db->lastInsertId();

        $languages = $CLICSHOPPING_Language->getLanguages();

        for ($i = 0, $n = \count($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];

          $sql_data_array = ['label' => $CLICSHOPPING_SecurityCheck->getDef('title_menu')];

          $insert_sql_data = [
            'id' => (int)$id,
            'language_id' => (int)$language_id
          ];

          $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

          $CLICSHOPPING_Db->save('administrator_menu_description', $sql_data_array);
        }

        $sql_data_array = [
          'sort_order' => 1,
          'link' => 'index.php?A&Tools\SecurityCheck&IpRestriction',
          'image' => 'cybermarketing.gif',
          'b2b_menu' => 0,
          'access' => 1,
          'app_code' => 'app_tools_security_check'
        ];

        $insert_sql_data = ['parent_id' => 178];

        $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

        $CLICSHOPPING_Db->save('administrator_menu', $sql_data_array);

        $id = $CLICSHOPPING_Db->lastInsertId();

        $languages = $CLICSHOPPING_Language->getLanguages();

        for ($i = 0, $n = \count($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];

          $sql_data_array = ['label' => $CLICSHOPPING_SecurityCheck->getDef('title_menu_ip_restriction')];

          $insert_sql_data = [
            'id' => (int)$id,
            'language_id' => (int)$language_id
          ];

          $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

          $CLICSHOPPING_Db->save('administrator_menu_description', $sql_data_array);
        }

        Cache::clear('menu-administrator');
      }
    }

    /**
     *
     */
    private static function installDb() :void
    {
      $CLICSHOPPING_Db = Registry::get('Db');

      $Qcheck = $CLICSHOPPING_Db->query('show tables like ":table_ip_restriction"');

      if ($Qcheck->fetch() === false) {
        $sql = <<<EOD
CREATE TABLE :table_ip_restriction(
  id int NOT NULL auto_increment,
  ip_restriction varchar(64) NOT NULL,
  ip_comment varchar(255) NULL DEFAULT NULL,
  ip_status_shop tinyint(1) default(0) NOT NULL,
  ip_status_admin tinyint(0) default(0) NOT NULL,
  PRIMARY KEY (id)
) CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE :table_ip_restriction_stats(
  id int NOT NULL auto_increment,
  ip_remote varchar(64) NOT NULL,
  PRIMARY KEY (id)
) CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
EOD;

        $CLICSHOPPING_Db->exec($sql);
      }
    }
  }
