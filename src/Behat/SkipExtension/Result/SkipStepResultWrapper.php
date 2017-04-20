<?php

namespace FarmaProm\Behat\SkipExtension\Result;

use Behat\Testwork\Tester\Result\ExceptionResult;
use Behat\Behat\Tester\Result\StepResult;
use Behat\Behat\Tester\Result\DefinedStepResult;
use Behat\Behat\Tester\Result\ExecutedStepResult;
use FarmaProm\Behat\SkipExtension\Exception\SkipException;

/**
 * Wrapper for skipped step resoults
 */
final class SkipStepResultWrapper implements StepResult, DefinedStepResult, ExceptionResult
{
    /**
     *
     * @var StepResult
     */
    private $stepResult;

    /**
     * Initialize step result
     *
     * @param ExecutedStepResult $stepResult
     */
    public function __construct(ExecutedStepResult $stepResult)
    {
        $this->stepResult = $stepResult;
    }

    /**
     * {@inheritdoc}
     */
    public function getStepDefinition()
    {
        return $this->stepResult->getStepDefinition();
    }

    /**
     * {@inheritdoc}
     */
    public function hasException()
    {
        return $this->stepResult->hasException();
    }

    /**
     * {@inheritdoc}
     */
    public function getException()
    {
        return $this->stepResult->getException();
    }

    /**
     * {@inheritdoc}
     */
    public function getResultCode()
    {
        if ($this->stepResult->hasException() && $this->stepResult->getException() instanceof SkipException) {
            return self::SKIPPED;
        }

        return $this->stepResult->getResultCode();
    }

    /**
     * {@inheritdoc}
     */
    public function isPassed()
    {
        return $this->stepResult->isPassed();
    }
}
