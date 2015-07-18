<?php
namespace Werkint\Bundle\NotificationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Werkint\Bundle\NotificationBundle\DependencyInjection\Compiler\MailerProviderPass;

/**
 * WerkintNotificationBundle.
 */
class WerkintNotificationBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new MailerProviderPass());
    }
}
