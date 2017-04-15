<?php

namespace QC\Tool\PhpCs;

/**
 * Class StandardPathResolver.
 */
class StandardPathResolver
{
    /**
     * @param string $standard
     *
     * @return string
     *
     * @throws \Exception
     */
    public static function resolve($standard)
    {
        if (!in_array($standard, Standard::AVAILABLE)) {
            throw new \Exception('Unsupported standard');
        }

        $map = array_combine(Standard::AVAILABLE, [
            'PSR2',
            __DIR__ . '/../../../../../escapestudios/symfony2-coding-standard/Symfony2',
        ]);

        return $map[$standard];
    }
}