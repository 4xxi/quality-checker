<?php

namespace QC\Tool;

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
