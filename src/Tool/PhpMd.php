<?php


namespace QC\Tool;

use QC\Util\PathResolver;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PhpMd.
 */
class PhpMd extends AbstractTool
{
    /**
     * {@inheritdoc}
     */
    public function execute(array $files)
    {
        $phpFiles = $this->extractPhpFiles($files);

        foreach ($phpFiles as $file) {
            $this->run(
                sprintf('php %s %s text %s', PathResolver::resolve('phpcs'), $file, $this->options['rules'])
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefault('rules', './PhpMdRules.xml')
        ;
    }
}
