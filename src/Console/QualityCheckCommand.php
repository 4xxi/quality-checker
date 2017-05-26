<?php

namespace QC\Console;

use QC\Suite\Processor;
use QC\Suite\Repository\YamlRepository;
use QC\Util\StagedFilesExtractor;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class QualityCheckCommand.
 */
class QualityCheckCommand extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('quality:check');
        $this->addArgument(
            'path',
            InputArgument::IS_ARRAY | InputArgument::OPTIONAL,
            'Path to check code (folder or file). If does not set - only staged files will be checked'
        );
        $this->addOption(
            'suite',
            null,
            InputOption::VALUE_OPTIONAL,
            'Quality suite',
            'pre-commit'
        );
        $this->addOption(
            'autofix',
            null,
            InputOption::VALUE_NONE,
            'We have to fix quality issues automatically'
        );
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $files = $this->extractFiles($input);

        $suiteProcessor = new Processor(new YamlRepository(), $output);

        if ($input->getOption('autofix')) {
            $suiteProcessor->process('fix', $files);
        }

        $suiteProcessor->process($input->getOption('suite'), $files);
    }

    /**
     * @param InputInterface $input
     *
     * @return array
     */
    protected function extractFiles(InputInterface $input)
    {
        if (count($input->getArgument('path'))) {
            return $input->getArgument('path');
        }

        return StagedFilesExtractor::extract();
    }
}
