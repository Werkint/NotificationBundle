<?php
namespace Werkint\Bundle\NotificationBundle\Service\Model;

/**
 * LocaleAwareUserInterface
 *
 * @author igor
 */
interface LocaleAwareUserInterface extends UserInterface  {

    /**
     * @return string
     */
    public function getDefaultLocale();

}