<?php

namespace QC\Tool;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class AbstractTool.
 */
abstract class AbstractTool
{
    /**
     * @param array $files
     * @param array $options
     */
    abstract public function execute(array $files, array $options);

    /**
     * @param array $options
     *
     * @return array
     */
    protected function setDefaultOptions(array $options)
    {
        $resolver = new OptionsResolver();

        $this->configureOptions($resolver);

        return $resolver->resolve($options);
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
    }
}
