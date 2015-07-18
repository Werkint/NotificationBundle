<?php
namespace Werkint\Bundle\NotificationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * Extension for WerkintNotificationBundle.
 */
class WerkintNotificationExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configDir = __DIR__ . '/../Resources/config';

        $processor = new Processor();
        $config = $processor->processConfiguration(
            new Configuration($this->getAlias()),
            $configs
        );
        $container->setParameter(
            $this->getAlias(),
            $config
        );

        $loader = new YamlFileLoader(
            $container,
            new FileLocator($configDir)
        );
        $loader->load('services.yml');

        $container->setParameter(
            $this->getAlias() . '.mailerloaded',
            $config['enabled']
        );
        if (!$config['alphasms_key']) {
            $container->removeDefinition('werkint_notification.handler.sms');
            $container->removeDefinition('werkint_notification.bridge.alphasms');
        }
    }
}
