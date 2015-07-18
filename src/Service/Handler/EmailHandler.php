<?php
namespace Werkint\Bundle\NotificationBundle\Service\Handler;

use Werkint\Bundle\NotificationBundle\Service\Model\EmailAwareUserInterface;
use Werkint\Bundle\NotificationBundle\Service\HandlerInterface;
use Werkint\Bundle\NotificationBundle\Service\Model\UserInterface;

/**
 * EmailHandler.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class EmailHandler implements
    HandlerInterface
{
    protected $mailer;
    protected $sender;

    /**
     * @param \Swift_Mailer $mailer
     * @param string        $sender
     */
    public function __construct(
        \Swift_Mailer $mailer,
        $sender
    ) {
        $this->mailer = $mailer;
        $this->sender = $sender;
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
        if ($user instanceof EmailAwareUserInterface) {
            if (!$user->getEmail()) {
                return false;
            }

            $subject = $twigTemplate->renderBlock('subject', $parameters);
            if (!$subject) {
                throw new \Exception('Subject not defined');
            }
            $body = $twigTemplate->renderBlock('body_email_text', $parameters);
            $emailMessage = \Swift_Message::newInstance();
            $emailMessage = $emailMessage
                ->setSubject($subject)
                ->setFrom($this->sender)
                ->setTo($user->getEmail())
                ->setBody($body);
            /** @var \Swift_Message $emailMessage */
            $emailMessage = $emailMessage->addPart($text, 'text/html');
            return $this->mailer->send($emailMessage);
        }

        return null;
    }

} 