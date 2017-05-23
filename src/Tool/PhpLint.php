<?php

namespace QC\Tool;

use QC\Util\PathResolver;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpLint.
 */
class PhpLint extends AbstractTool
{
    /**
     * {@inheritdoc}
     */
    public function execute(array $files, array $options)
    {
        foreach ($files as $file) {
            $processBuilder = new ProcessBuilder(
                [
                    'php',
                    '-l',
                    $file,
                ]
            );

            $processBuilder->getProcess()->mustRun();
        }
    }
}
