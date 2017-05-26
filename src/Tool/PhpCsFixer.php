<?php

namespace QC\Tool;

use QC\Util\PathResolver;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PhpCsFixer.
 */
class PhpCsFixer extends AbstractTool
{
    /**
     * {@inheritdoc}
     */
    public function execute(array $files)
    {
        $phpFiles = $this->extractPhpFiles($files);

        foreach ($phpFiles as $file) {
            $this->run(
                sprintf('php %s fix %s --level=%s', PathResolver::resolve('phpcs'), $file, $this->options['level'])
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('level')
            ->setAllowedTypes('standard', 'string')
        ;
    }
}
