<?php
namespace Werkint\Bundle\NotificationBundle\Service;

use Werkint\Bundle\NotificationBundle\Service\Model\UserInterface;

/**
 * HandlerInterface.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface HandlerInterface
{
    /**
     * @param string         $message  Данные для отправки
     * @param UserInterface  $user     Кому отправляем
     * @param \Twig_Template $twigTemplate  Твиговский шаблон
     * @param array          $parameters    Параметры для шаблона
     * @return mixed
     */
    public function sendMessage(
        $message,
        UserInterface $user,
        \Twig_Template $twigTemplate,
        array $parameters
    );
} 