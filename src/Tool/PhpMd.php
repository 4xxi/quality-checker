<?php


namespace QC\Tool;

use QC\Util\PathResolver;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpMd.
 */
class PhpMd extends AbstractTool
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
                    PathResolver::resolve('phpmd'),
                    $file,
                    'text',
                    './PhpMdRules.xml'
                ]
            );

            $processBuilder->getProcess()->mustRun();
        }
    }
}
