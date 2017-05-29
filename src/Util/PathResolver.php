<?php

namespace QC\Util;

/**
 * Class PathResolver.
 */
class PathResolver
{
    /**
     * @param string $tool
     *
     * @return string
     */
    public static function resolve($tool)
    {
        return 'bin'.DIRECTORY_SEPARATOR.$tool;
    }
}
