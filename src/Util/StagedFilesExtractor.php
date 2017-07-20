<?php

namespace QC\Util;

/**
 * Class StagedFilesExtractor.
 */
class StagedFilesExtractor
{
    /**
     * @return array
     */
    public static function extract()
    {
        $output = [];
        $rc = 0;

        exec('git rev-parse --verify HEAD 2> /dev/null', $output, $rc);

        $against = '4b825dc642cb6eb9a060e54bf8d69288fbee4904';

        if ($rc === 0) {
            $against = 'HEAD';
        }

        $output = [];

        exec("git diff-index --cached --name-status $against", $output);

        return array_filter(
            array_map(
                function ($string) {
                    return preg_match('/^(A|M)(.*)/', $string, $matches) ? ltrim($matches[2]) : null;
                },
                $output
            )
        );
    }
}
