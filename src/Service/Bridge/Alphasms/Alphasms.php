<?php
namespace Werkint\Bundle\NotificationBundle\Service\Bridge\Alphasms;

use Werkint\Alphasms\Alphasms as BaseAlphasms;

/**
 * Alphasms.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class Alphasms extends BaseAlphasms implements
    AlphasmsInterface
{
    protected $from;

    /**
     * @param string $key
     * @param $from
     */
    public function __construct($key, $from)
    {
        $this->from = $from;
        parent::__construct($key);
    }

    /**
     * {@inheritdoc}
     */
    public function sendSms(
        $target,
        $message
    ) {
        return parent::sendMessage($target, $message, $this->from);
    }

}
