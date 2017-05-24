<?php

namespace QC\Hook;

use QC\Configuration\YamlConfigurationReader;
use QC\Exception\QualityToolViolationException;
use QC\Util\StagedFilesExtractor;
use QC\Tool\AbstractTool;
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
        $configurationReader = new YamlConfigurationReader();
        $config = $configurationReader->read();
        $files = StagedFilesExtractor::extract();

        foreach ($config->getItems() as $alias => $item) {
            if ($item->isEnabled()) {
                $output->writeln(sprintf('<info>Checking style with "%s"</info>', strtoupper($alias)));

                $qualityTool = AbstractTool::type($item->getType(), $item->getOptions());
                $qualityTool->execute($files);

                if ($qualityTool->hasErrors()) {
                    $output->writeln(sprintf('<error>%s</error>', implode('', $qualityTool->getErrors())));

                    throw new QualityToolViolationException();
                }
            }
        }

        $output->writeln('<info>Good job!</info>');
    }
}
