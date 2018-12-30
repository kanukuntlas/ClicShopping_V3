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

namespace ClicShopping\OM\Session;

use ClicShopping\OM\Registry;

class MySQL extends \ClicShopping\OM\SessionAbstract implements \SessionHandlerInterface
{
    protected $db;

    public function __construct() {
        $this->db = Registry::get('Db');

        session_set_save_handler($this, true);
    }

    public function exists($session_id) {
      $Qsession = $this->db->prepare('select 1 from :table_sessions where sesskey = :sesskey');
      $Qsession->bindValue(':sesskey', $session_id);
      $Qsession->execute();

      return $Qsession->fetch() !== false;
    }

    public function open($save_path, $name)   {
      return true;
    }

    public function close()  {
      return true;
    }

    public function read($session_id)  {
      $Qsession = $this->db->prepare('select value from :table_sessions where sesskey = :sesskey');
      $Qsession->bindValue(':sesskey', $session_id);
      $Qsession->execute();

      if ($Qsession->fetch() !== false) {
        return $Qsession->value('value');
      }
      return '';
    }

    public function write($session_id, $session_data) {
        if ($this->exists($session_id)) {
            $result = $this->db->save('sessions', [
                'expiry' => time(),
                'value' => $session_data
            ], [
                'sesskey' => $session_id
            ]);
        } else {
            $result = $this->db->save('sessions', [
                'sesskey' => $session_id,
                'expiry' => time(),
                'value' => $session_data
            ]);
        }

        return $result !== false;
    }

    public function destroy($session_id)
    {
        $result = $this->db->delete('sessions', [
            'sesskey' => $session_id
        ]);

        return $result !== false;
    }

    public function gc($maxlifetime)
    {
        $Qdel = $this->db->prepare('delete from :table_sessions where expiry < :expiry');
        $Qdel->bindValue(':expiry', time() - $maxlifetime);
        $Qdel->execute();

        return $Qdel->isError() === false;
    }
}
