<?php

namespace FarmaProm\Behat\SkipExtension\ServiceContainer;

use Behat\Testwork\ServiceContainer\Extension;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Behat\Behat\Tester\ServiceContainer\TesterExtension;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use FarmaProm\Behat\SkipExtension\Tester\StepTester;

/**
 * Add tester wrapper and ability to skip scenario
 */
final class SkipExtension implements Extension
{
    /**
     * {@inheritdoc}
     */
    public function getConfigKey()
    {
        return 'farmaprom_skip';
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config)
    {
        $definition = new Definition(StepTester::class, array(
            new Reference(TesterExtension::STEP_TESTER_ID)
        ));
        $definition->addTag(TesterExtension::STEP_TESTER_WRAPPER_TAG, array('priority' => 222));
        $container->setDefinition(TesterExtension::STEP_TESTER_WRAPPER_TAG . '.skip', $definition);
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
    }
}
