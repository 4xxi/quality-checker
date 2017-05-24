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
    public function execute(array $files)
    {
        $phpFiles = $this->extractPhpFiles($files);

        foreach ($phpFiles as $file) {
            $this->run(
                sprintf('php -l %s', $file)
            );
        }
    }
}
