<?php
namespace FarmaProm\Behat\SkipExtension\Exception;

use Behat\Testwork\Tester\Exception\TesterException;
use RuntimeException;

final class SkipException extends RuntimeException implements TesterException
{
    /**
     * Initializes skip exception.
     *
     * @param string $text
     */
    public function __construct($text = 'Step was skiped')
    {
        parent::__construct($text);
    }
}
