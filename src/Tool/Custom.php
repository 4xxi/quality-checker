<?php

namespace QC\Tool;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class Custom.
 */
class Custom extends AbstractTool
{
    const FILE_PLACEHOLDER = '{path}';

    /**
     * {@inheritdoc}
     */
    public function execute(array $files)
    {
        foreach ($files as $file) {
            $this->run(
                str_replace(static::FILE_PLACEHOLDER, $file, $this->options['cmd'])
            );
        }
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
