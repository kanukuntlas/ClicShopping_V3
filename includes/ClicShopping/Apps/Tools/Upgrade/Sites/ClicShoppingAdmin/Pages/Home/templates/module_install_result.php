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
  use ClicShopping\OM\HTML;
  use ClicShopping\OM\CLICSHOPPING;
  use ClicShopping\OM\HTTP;

  use ClicShopping\Apps\Tools\Upgrade\Classes\ClicShoppingAdmin\Github;

  $CLICSHOPPING_Template = Registry::get('TemplateAdmin');
  $CLICSHOPPING_Upgrade = Registry::get('Upgrade');
  $CLICSHOPPING_MessageStack = Registry::get('MessageStack');

  $CLICSHOPPING_Github = new Github();
  $CLICSHOPPING_Page = Registry::get('Site')->getPage();

  if ($CLICSHOPPING_MessageStack->exists('main')) {
    echo $CLICSHOPPING_MessageStack->get('main');
  }
?>
<div class="contentBody">
  <div class="row">
    <div class="col-md-12">
      <div class="card card-block headerCard">
        <div class="row col-md-12">
          <?php echo HTML::form('upgrade', $CLICSHOPPING_Upgrade->link('ModuleInstall'), 'post', null, ['session_id' => true]); ?>
          <div class="col-md-12 form-group row">
            <div class="col-md-3">
              <span
                class="col-md-1"><?php echo HTML::image($CLICSHOPPING_Template->getImageDirectory() . 'categories/apps.png', $CLICSHOPPING_Upgrade->getDef('heading_title'), '40', '40'); ?></span>
              <span
                class="col-md-11 pageHeading"><?php echo '&nbsp;' . $CLICSHOPPING_Upgrade->getDef('heading_title'); ?></span>
            </div>

            <div
              class="col-md-2"><?php echo HTML::selectMenu('install_module_directory', $CLICSHOPPING_Github->getModuleDirectory()); ?></div>
            <div
              class="col-md-2"><?php echo HTML::selectMenu('install_module_template_directory', $CLICSHOPPING_Github->getModuleTemplateDirectory()); ?></div>
            <div
              class="col-md-2"><?php echo HTML::inputField('module_search', '', 'id="search" placeholder="' . $CLICSHOPPING_Upgrade->getDef('text_search') . '"'); ?></div>
            <div class="col-md-3 text-end">
              <?php
                echo HTML::button($CLICSHOPPING_Upgrade->getDef('button_reset'), null, $CLICSHOPPING_Upgrade->link('Upgrade&ResetCache'), 'danger', null, 'sm') . '&nbsp;';
                echo HTML::button($CLICSHOPPING_Upgrade->getDef('button_reset_temp'), null, $CLICSHOPPING_Upgrade->link('Upgrade&ResetCacheTemp'), 'warning', null, 'sm') . '&nbsp;';
                echo HTML::button($CLICSHOPPING_Upgrade->getDef('button_back'), null, $CLICSHOPPING_Upgrade->link('Upgrade'), 'primary', null, 'sm') . '&nbsp;';
              ?>
            </div>
          </div>
          <div class="row col-md-12">
            <div class="col-md-12 form-group row">
              <span class="col-md-4"></span>
              <span
                class="col-md-4 text-center"><?php echo $CLICSHOPPING_Github->getDropDownMenuSearchOption(); ?></span>
              <span
                class="col-md-4"><?php echo HTML::button($CLICSHOPPING_Upgrade->getDef('text_search'), null, null, 'primary'); ?></span>
            </div>
          </div>
          </form>
        </div>
      </div>
    </div>
    <div class="separator"></div>
    <div class="col-md-12">
      <div class="mainTitle"><?php echo $CLICSHOPPING_Upgrade->getDef('text_result_install'); ?></div>
      <div class="adminformTitle">
        <div class="card-block">
          <div class="card-text">
       <?php
        if (is_file(CLICSHOPPING::BASE_DIR . 'Work/Cache/Github/' . HTML::sanitize($_GET['file']) . '.json')) {
          $json = file_get_contents(CLICSHOPPING::BASE_DIR . 'Work/Cache/Github/' . HTML::sanitize($_GET['file']) . '.json', true);
          $result = json_decode($json);
        ?>
        <blockquote>
          <?php echo $CLICSHOPPING_Upgrade->getDef('text_info_result', ['file' => HTML::sanitize($_GET['file'])]); ?>
          <blockquote>
            <ul>
              <?php
                foreach ($result as $key => $value) {
                  $text = '';

                  if (!\is_array($value)) $text = $value;

                  if ($key == 'module_directory') {
                    $_SESSION['module_directory'] = $value;
                  }

                  if ($key == 'apps_name') {
                    $_SESSION['module_apps_name'] = $value;
                  }

                  echo '<li>' . $key . ' : ' . $text . '</li>';

                  if (\is_array($value)) {
                    echo '<div class="separator"></div>';

                    foreach ($value as $item) {
                      echo '      -' . $item->name . '<br />';
                      echo '      -' . $item->company . '<br />';
                      echo '      -' . $item->email . '<br />';
                      echo '      -' . $item->website . '<br />';
                      echo '      -' . $item->Community . '<br />';
                    }
                  }
                }

                if (isset($_SESSION['module_directory'])) {
                  echo '<div class="separator"></div>';
                  echo '<div class="alert alert-success" role="alert">';
                  echo '<span class="text-center"><h3>';
                  echo HTML::link(CLICSHOPPING::getConfig('http_server') . CLICSHOPPING::getConfig('http_path', 'ClicShoppingAdmin') . 'index.php?A&' . $_SESSION['module_directory'] . '\\' . $_SESSION['module_apps_name'], $CLICSHOPPING_Upgrade->getDef('text_activate'));
                  echo '</h3></span>';
                  echo '</div>';

                  unset($_SESSION['module_directory']);
                  unset($_SESSION['module_apps_name']);
                }
              ?>
            </ul>
          </blockquote>
        </blockquote>
        <?php
        } else {
          echo $CLICSHOPPING_Upgrade->getDef('error_result');
          exit;
        }
      ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="separator"></div>



