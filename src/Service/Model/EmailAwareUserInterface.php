<?php
namespace Werkint\Bundle\NotificationBundle\Service\Model;

/**
 * EmailAwareUserInterface.
 *
 * @author igor
 */
interface EmailAwareUserInterface extends UserInterface  {

    /**
     * @return string
     */
    public function getEmail();

} 