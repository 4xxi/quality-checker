<?php

namespace QC\Tool;

use QC\Tool\PhpCs\Standard;
use QC\Tool\PhpCs\StandardPathResolver;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\ProcessBuilder;

/**
 * Class CodeQualityTool.
 */
final class CodeQualityTool extends Application
{
    const PHP_FILES_IN_SRC = '/^src\/(.*)(\.php)$/';
    const PHP_FILES_IN_CLASSES = '/^classes\/(.*)(\.php)$/';

    /**
     * @var OutputInterface
     */
    private $output;

    /**
     * @var InputInterface
     */
    private $input;

    /**
     * {@inheritdoc}
     */
    public function __construct()
    {
        parent::__construct('Code quality tool', '0.1.0');
    }

    /**
     * {@inheritdoc}
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $this->input = $input;
        $this->output = $output;

        $files = $this->extractStagedFiles();

        try {
            $this->runPhpCsWithStandard($files, Standard::SYMFONY);
            $this->writeln('Good job!');
        } catch (ProcessFailedException $e) {
            $this->writeln(trim($e->getProcess()->getOutput()), 'error');
            throw new \Exception('Please fix this violations!');
        }
    }

    /**
     * @return array
     */
    private function extractStagedFiles()
    {
        $output = [];
        $rc = 0;

        exec('git rev-parse --verify HEAD 2> /dev/null', $output, $rc);

        $against = '4b825dc642cb6eb9a060e54bf8d69288fbee4904';
        if ($rc == 0) {
            $against = 'HEAD';
        }

        exec("git diff-index --cached --name-status $against | egrep '^(A|M)' | awk '{print $2;}'", $output);

        return $output;
    }

    /**
     * @param array  $files
     * @param string $standard
     */
    private function runPhpCsWithStandard(array $files, $standard)
    {
        $this->writeln(sprintf('Checking code style with PHPCS (%s)', $standard));

        foreach ($files as $file) {
            if (!preg_match(self::PHP_FILES_IN_SRC, $file)) {
                continue;
            }

            $processBuilder = new ProcessBuilder([
                'php',
                'bin/phpcs',
                '--standard='.StandardPathResolver::resolve($standard),
                $file,
            ]);
            $processBuilder->setWorkingDirectory(__DIR__ . '/../../../../../');
            $processBuilder->getProcess()->mustRun();
        }
    }

    /**
     * @param string $message
     * @param string $type
     */
    private function writeln($message, $type = 'info')
    {
        $this->output->writeln(sprintf('<%s>%s</%s>', $type, $message, $type));
    }
}
