<?php
namespace Werkint\Bundle\NotificationBundle\Service\Bridge\Alphasms;

use Werkint\Alphasms\AlphasmsInterface as BaseAlphasmsInterface;
use Werkint\Alphasms\Response\SendResponse;

/**
 * AlphasmsInterface.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
interface AlphasmsInterface extends BaseAlphasmsInterface
{
    /**
     * @param string $target
     * @param string $message
     * @return SendResponse
     */
    public function sendSms(
        $target,
        $message
    );
}