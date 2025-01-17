<?php
  /**
   *
   * @copyright 2008 - https://www.clicshopping.org
   * @Brand : ClicShopping(Tm) at Inpi all right Reserved
   * @Licence GPL 2 & MIT
   * @Info : https://www.clicshopping.org/forum/trademark/
   *
   */

  namespace ClicShopping\OM\Module\Hooks\ClicShoppingAdmin\Dashboard;

  use ClicShopping\OM\CLICSHOPPING;

  class ActionLinkedin
  {

    public function execute()
    {
      $output = '<div class="separator"></div>
                <div class="text-center">' . CLICSHOPPING::getDef('linkedin_certificate_clicshopping') . '</div>
                <div class="text-center"><a href="https://www.linkedin.com/profile/add?_ed=0_7nTFLiuDkkQkdELSpruCwGpUMNDIZlXEx27EQU-qViHbBgqjFXJtPnC2wRYrmwrBaSgvthvZk7wTBMS3S-m0L6A6mLjErM6PJiwMkk6nYZylU7__75hCVwJdOTZCAkdv&pfCertificationName=ClicShopping%20professionnal&pfCertificationUrl=http%3A%2F%2Fwww.clicshopping.org&trk=onsite_html" rel="noreferrer" target="_blank"><img src="../images/ClicShoppingAdmin/linkedin.webp" alt="LinkedIn Add to Profile button"></a></div>
                ';

      return $output;
    }
  }