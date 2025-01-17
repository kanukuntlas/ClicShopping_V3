<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\Apps\Tools\DefineLanguage\Sites\ClicShoppingAdmin\Pages\Home\Actions;

  use ClicShopping\OM\Registry;

  class Contentgroup extends \ClicShopping\OM\PagesActionsAbstract
  {
    public function execute()
    {
      $CLICSHOPPING_DefineLanguage = Registry::get('DefineLanguage');

      $this->page->setFile('content_group.php');
      $this->page->data['action'] = 'ContentGroupe';

      $CLICSHOPPING_DefineLanguage->loadDefinitions('Sites/ClicShoppingAdmin/main');
    }
  }