<?php

namespace QC\Tool\PhpCs;

/**
 * Class Standard.
 */
class Standard
{
    const PSR2 = 'PSR2';
    const SYMFONY = 'Symfony';

    /**
     * @return array
     */
    public static function available()
    {
        return [
            self::PSR2,
            self::SYMFONY,
        ];
    }
}