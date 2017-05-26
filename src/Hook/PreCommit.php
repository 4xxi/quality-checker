<?php

namespace QC\Hook;

use QC\Suite\Processor;
use QC\Suite\Repository\YamlRepository;
use QC\Util\StagedFilesExtractor;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class PreCommit.
 */
class PreCommit extends Application
{
    /**
     * {@inheritdoc}
     */
    public function doRun(InputInterface $input, OutputInterface $output)
    {
        $suiteProcessor = new Processor(new YamlRepository(), $output);
        $suiteProcessor->process('pre-commit', StagedFilesExtractor::extract());
    }
}
