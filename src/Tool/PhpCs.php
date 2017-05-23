<?php

namespace QC\Tool;

use QC\Util\PathResolver;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class PhpCs.
 */
class PhpCs extends AbstractTool
{
    /**
     * {@inheritdoc}
     */
    public function execute(array $files, array $options)
    {
        $options = $this->setDefaultOptions($options);

        foreach ($files as $file) {
            $processBuilder = new ProcessBuilder(
                [
                    'php',
                    PathResolver::resolve('phpcs'),
                    '--standard=%s'.$options['standard'],
                    '--ignore=%s'.$options['ignore'],
                    $file,
                ]
            );

            $processBuilder->getProcess()->mustRun();
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('standard');
        $resolver->setAllowedTypes('standard', 'string');
        $resolver->setDefault('ignore', '');
        $resolver->setAllowedTypes('ignore', 'string');
    }
}
