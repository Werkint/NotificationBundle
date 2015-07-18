<?php
namespace Werkint\Bundle\NotificationBundle\Service\Handler;


use Werkint\Bundle\NotificationBundle\Service\Model\PhoneAwareUserInterface;
use Werkint\Bundle\NotificationBundle\Service\Bridge\Alphasms\AlphasmsInterface;
use Werkint\Bundle\NotificationBundle\Service\HandlerInterface;
use Werkint\Bundle\NotificationBundle\Service\Model\UserInterface;

/**
 * SmsHandler.
 *
 * @author Tomfun
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class SmsHandler implements
    HandlerInterface
{
    protected $alpha;

    /**
     * @param AlphasmsInterface $alpha
     */
    public function __construct(
        AlphasmsInterface $alpha
    ) {
        $this->alpha = $alpha;
    }

    /**
     * {@inheritdoc}
     */
    public function sendMessage(
        $text,
        UserInterface $user,
        \Twig_Template $twigTemplate,
        array $parameters
    ) {
        if ($user instanceof PhoneAwareUserInterface) {
            if (!$user->getPhone()) {
                return false;
            }

            $ret = $this->alpha->sendSms(
                $user->getPhone(),
                $text
            );
            return !$ret->getErrors();
        }
        return 0;
    }
}
