<?php
namespace Werkint\Bundle\NotificationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Configuration for WerkintNotificationBundle.
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    protected $alias;

    /**
     * @param string $alias
     */
    public function __construct($alias)
    {
        $this->alias = $alias;
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        // @formatter:off
        $treeBuilder
            ->root($this->alias)
            ->children()
                ->scalarNode('enabled')->defaultValue(false)->end()
                ->scalarNode('alphasms_key')->defaultValue(null)->end()
                ->arrayNode('providers')
                    ->defaultValue(['email'])
                    ->prototype('scalar')->end()
                ->end()
            ->end()
        ;
        // @formatter:on

        return $treeBuilder;
    }
}
