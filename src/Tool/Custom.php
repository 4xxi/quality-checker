<?php

namespace QC\Tool;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Process\Process;

/**
 * Class Custom.
 */
class Custom extends AbstractTool
{
    /**
     * @param array $files
     * @param array $options
     */
    public function execute(array $files, array $options)
    {
        $options = $this->setDefaultOptions($options);

        $process = new Process($options['command']);
        $process->mustRun();
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('cmd');
        $resolver->setAllowedTypes('cmd', 'string');
    }
}
