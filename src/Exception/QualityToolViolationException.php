<?php

namespace QC\Exception;

/**
 * Class QualityToolViolationException.
 */
class QualityToolViolationException extends \Exception
{
    /**
     * @var string
     */
    protected $message = 'There are some errors in code style!';
}
