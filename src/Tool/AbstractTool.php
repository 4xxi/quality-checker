<?php

namespace QC\Tool;

use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Process\Process;

/**
 * Class AbstractTool.
 */
abstract class AbstractTool
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * AbstractTool constructor.
     * @param array $options
     */
    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();

        $this->configureOptions($resolver);

        $this->options = $resolver->resolve($options);
    }

    /**
     * @param string $type
     * @param array  $options
     *
     * @return AbstractTool
     */
    public static function type($type, array $options = [])
    {
        switch ($type) {
            case 'phpmd':
                return new PhpMd($options);
            case 'phpcs':
                return new PhpCs($options);
            case 'phplint':
                return new PhpLint($options);
            case 'phpcs-fixer':
                return new PhpCsFixer($options);
            case 'custom':
                return new Custom($options);
            default:
                throw new \InvalidArgumentException('Unsupported tool type');
        }
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return (bool) count($this->errors);
    }

    /**
     * @param array $files
     */
    abstract public function execute(array $files);

    /**
     * @param string $command
     */
    protected function run($command)
    {
        $process = new Process($command);
        $process->run();

        if (false === $process->isSuccessful()) {
            $this->errors[] = $process->getOutput();
        }
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
    }

    /**
     * @param array $files
     *
     * @return array
     */
    protected function extractPhpFiles(array $files)
    {
        return array_filter(
            $files,
            function ($file) {
                return preg_match('/(\.php)|(\.inc)$/', $file);
            }
        );
    }
}
