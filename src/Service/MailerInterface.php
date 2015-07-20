<?php
namespace Werkint\Bundle\NotificationBundle\Service;

use Werkint\Bundle\NotificationBundle\Service\Model\LocaleAwareUserInterface;

/**
 * Интерфейс почтового сервиса
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface MailerInterface
{
    /**
     * @param string                   $template
     * @param array                    $parameters
     * @param LocaleAwareUserInterface $target
     * @param array                    $ignoredHandlers
     * @return boolean
     */
    public function sendMessage(
        $template,
        array $parameters,
        LocaleAwareUserInterface $target,
        array $ignoredHandlers = []
    );
}