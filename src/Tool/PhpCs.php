<?php

namespace QC\Tool;

use QC\Util\PathResolver;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PhpCs.
 */
class PhpCs extends AbstractTool
{
    /**
     * {@inheritdoc}
     */
    public function execute(array $files)
    {
        $phpFiles = $this->extractPhpFiles($files);

        foreach ($phpFiles as $file) {
            $this->run(
                sprintf('php %s --standard=%s %s', PathResolver::resolve('phpcs'), $this->options['standard'], $file)
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setRequired('standard')
            ->setAllowedTypes('standard', 'string')
        ;
    }
}
