<?php
namespace Werkint\Bundle\NotificationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * MailerProviderPass.
 *
 * @author Bogdan Yurov <bogdan@yurov.me>
 */
class MailerProviderPass implements
    CompilerPassInterface
{
    const CLASS_SRV = 'werkint.util.mailer';
    const CLASS_TAG = 'werkint.util.mailer.provider';

    /**
     * {@inheritdoc}
     */
    public function process(
        ContainerBuilder $container
    ) {
        if (!$container->hasDefinition(static::CLASS_SRV)) {
            return;
        }
        $config = $container->getParameter('werkint_notification');

        $definition = $container->getDefinition(
            static::CLASS_SRV
        );

        $allowedProviders = $config['providers'];

        $list = $container->findTaggedServiceIds(static::CLASS_TAG);
        foreach ($list as $id => $attributes) {
            $a = $attributes[0];
            if (!in_array($a['class'], $allowedProviders)) {
                continue;
            }
            $definition->addMethodCall(
                'addHandler', [
                    new Reference($id),
                    $a['class']
                ]
            );
        }
    }
}
