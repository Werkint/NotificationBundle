<?php
namespace Werkint\Bundle\NotificationBundle\Service\Model;

/**
 * PhoneAwareUserInterface
 *
 * @author igor
 */
interface PhoneAwareUserInterface extends UserInterface {

    /**
     * @return string
     */
    public function getPhone();

}