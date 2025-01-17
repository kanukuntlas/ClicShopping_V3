<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Catalog\Categories\Module\HeaderTags;

  use ClicShopping\OM\Registry;
  use ClicShopping\OM\CLICSHOPPING;
  use ClicShopping\OM\HTML;

  use ClicShopping\Apps\Catalog\Categories\Categories as CategoriesApp;

  class Categories extends \ClicShopping\OM\Modules\HeaderTagsAbstract
  {
    protected mixed $lang;
    protected mixed $app;
    protected mixed $template;

    protected function init()
    {
      if (!Registry::exists('Categories')) {
        Registry::set('Categories', new CategoriesApp());
      }

      $this->app = Registry::get('Categories');
      $this->lang = Registry::get('Language');
      $this->group = 'header_tags'; // could be header_tags or footer_scripts

      $this->app->loadDefinitions('Module/HeaderTags/products_categories');

      $this->title = $this->app->getDef('module_header_tags_products_categories_title');
      $this->description = $this->app->getDef('module_header_tags_products_categories_description');

      if (\defined('MODULE_HEADER_TAGS_PRODUCT_CATEGORIES_STATUS')) {
        $this->sort_order = (int)MODULE_HEADER_TAGS_PRODUCT_CATEGORIES_SORT_ORDER;
        $this->enabled = (MODULE_HEADER_TAGS_PRODUCT_CATEGORIES_STATUS == 'True');
      }
    }

    public function isEnabled()
    {
      return $this->enabled;
    }

    public function getOutput()
    {
      $this->template = Registry::get('Template');
      $CLICSHOPPING_Category = Registry::get('Category');

      if (!\defined('CLICSHOPPING_APP_CATEGORIES_CT_STATUS') || CLICSHOPPING_APP_CATEGORIES_CT_STATUS == 'False') {
        return false;
      }

      $current_category_id = $CLICSHOPPING_Category->getPath();

      if (CLICSHOPPING::getBaseNameIndex()) {
// $categories is set in application_top.php to add the category to the breadcrumb
// $categories is not set so a database query is needed
        if ($current_category_id > 0) {
          $Qsubmit = $this->app->db->prepare('select submit_id,
                                                    language_id,
                                                    submit_defaut_language_title,
                                                    submit_defaut_language_keywords,
                                                    submit_defaut_language_description
                                              from :table_submit_description
                                              where submit_id = 1
                                              and language_id = :language_id
                                            ');
          $Qsubmit->bindInt(':language_id', (int)$this->lang->getId());
          $Qsubmit->execute();

          $Qcategories = $this->app->db->prepare('select categories_name,
                                                         categories_head_title_tag,
                                                         categories_head_desc_tag,
                                                         categories_head_keywords_tag
                                                  from :table_categories_description
                                                  where categories_id = :categories_id
                                                  and language_id = :language_id
                                                  limit 1
                                                ');

          $Qcategories->bindInt(':categories_id', (int)$current_category_id);
          $Qcategories->bindInt(':language_id', (int)$this->lang->getId());
          $Qcategories->execute();

          if ($Qcategories->rowCount() > 0) {
            $categories_name_clean = HTML::sanitize($Qcategories->value('categories_name'));

            if (empty($Qcategories->value('categories_head_title_tag'))) {
              if (empty($Qsubmit->value('submit_defaut_language_title'))) {
                $title = $categories_name_clean . ', ' . HTML::outputProtected(STORE_NAME);
              } else {
                $title = $categories_name_clean . ',  ' . HTML::sanitize($Qsubmit->value('submit_defaut_language_title')) . ', ' . HTML::outputProtected(STORE_NAME);
              }
            } else {
              $title = HTML::sanitize($Qcategories->value('categories_head_title_tag')) . ', ' . $categories_name_clean . ', ' . HTML::outputProtected(STORE_NAME);
            }

            if (empty($Qcategories->value('categories_head_desc_tag'))) {
              if (empty($Qsubmit->value('submit_defaut_language_description'))) {
                $description = $categories_name_clean . ', ' . HTML::outputProtected(STORE_NAME);
              } else {
                $description = $categories_name_clean . ', ' . HTML::sanitize($Qsubmit->value('submit_defaut_language_description')) . ', ' . HTML::outputProtected(STORE_NAME);
              }
            } else {
              $description = HTML::sanitize($Qcategories->value('categories_head_desc_tag')) . ', ' . $categories_name_clean . ', ' . HTML::outputProtected(STORE_NAME);
            }

            if (empty($Qcategories->value('categories_head_keywords_tag'))) {
              if (empty($Qsubmit->value('submit_defaut_language_keywords'))) {
                $keywords = $categories_name_clean;
              } else {
                $keywords = $categories_name_clean . ', ' . HTML::sanitize($Qsubmit->value('submit_defaut_language_keywords'));
              }
            } else {
              $keywords = $Qcategories->value('categories_head_keywords_tag') . ', ' . $categories_name_clean;
            }

            $title = $this->template->setTitle($title) . ' ' . $this->template->getTitle();
            $description = $this->template->setDescription($description) . ' ' . $this->template->getDescription();
            $keywords = $this->template->setKeywords($keywords) . ', ' . $this->template->getKeywords();

            $output =
              <<<EOD
    <title>{$title}</title>
    <meta name="description" content="{$description}" />
    <meta name="keywords"  content="{$keywords}" />
    <meta name="news_keywords" content="{$keywords}" />
EOD;

            return $output;
          }
        }
      }
    }

    public function Install()
    {
      $this->app->db->save('configuration', [
          'configuration_title' => 'Do you want to install this module ?',
          'configuration_key' => 'MODULE_HEADER_TAGS_PRODUCT_CATEGORIES_STATUS',
          'configuration_value' => 'True',
          'configuration_description' => 'Do you want to install this module ?',
          'configuration_group_id' => '6',
          'sort_order' => '1',
          'set_function' => 'clic_cfg_set_boolean_value(array(\'True\', \'False\'))',
          'date_added' => 'now()'
        ]
      );


      $this->app->db->save('configuration', [
          'configuration_title' => 'Display sort order',
          'configuration_key' => 'MODULE_HEADER_TAGS_PRODUCT_CATEGORIES_SORT_ORDER',
          'configuration_value' => '162',
          'configuration_description' => 'Display sort order (The lower is displayd in first)',
          'configuration_group_id' => '6',
          'sort_order' => '215',
          'set_function' => '',
          'date_added' => 'now()'
        ]
      );
    }

    public function keys()
    {
      return ['MODULE_HEADER_TAGS_PRODUCT_CATEGORIES_STATUS',
        'MODULE_HEADER_TAGS_PRODUCT_CATEGORIES_SORT_ORDER'
      ];
    }
  }
