<?php

namespace FarmaProm\Behat\SkipExtension\Tester;

use Behat\Testwork\Environment\Environment;
use Behat\Behat\Tester\Result\StepResult;
use Behat\Behat\Tester\StepTester as BaseStepTester;
use Behat\Behat\Tester\Result\ExecutedStepResult;
use Behat\Gherkin\Node\FeatureNode;
use Behat\Gherkin\Node\StepNode;
use FarmaProm\Behat\SkipExtension\Result\SkipStepResultWrapper;

/**
 * Step tester wrapper
 *
 */
final class StepTester implements BaseStepTester
{
    /**
     * @var BaseStepTester
     */
    private $baseTester;

    /**
     * Initializes wrapper
     *
     * @param BaseStepTester $baseTester
     */
    public function __construct(BaseStepTester $baseTester)
    {
        $this->baseTester = $baseTester;
    }

    /**
     * {@inheritdoc}
     */
    public function setUp(Environment $env, FeatureNode $feature, StepNode $step, $skip)
    {
        $setup = $this->baseTester->setUp($env, $feature, $step, $skip);

        return $setup;
    }

    /**
     * {@inheritdoc}
     */
    public function test(Environment $env, FeatureNode $feature, StepNode $step, $skip)
    {
        $stepResult = $this->baseTester->test($env, $feature, $step, $skip);
        if ($stepResult instanceof ExecutedStepResult) {
            return new SkipStepResultWrapper($stepResult);
        }

        return $stepResult;
    }

    /**
     * {@inheritdoc}
     */
    public function tearDown(Environment $env, FeatureNode $feature, StepNode $step, $skip, StepResult $result)
    {
        $teardown = $this->baseTester->tearDown($env, $feature, $step, $skip, $result);

        return $teardown;
    }
}
