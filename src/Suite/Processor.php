<?php

namespace QC\Suite;

use QC\Exception\QualityToolViolationException;
use QC\Suite\Repository\RepositoryInterface;
use QC\Tool\AbstractTool;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Processor.
 */
class Processor
{
    /**
     * @var RepositoryInterface
     */
    protected $suiteRepository;

    /**
     * @var OutputInterface
     */
    protected $io;

    /**
     * Processor constructor.
     *
     * @param RepositoryInterface $suiteRepository
     * @param OutputInterface     $io
     */
    public function __construct(RepositoryInterface $suiteRepository, OutputInterface $io)
    {
        $this->suiteRepository = $suiteRepository;
        $this->io = $io;
    }

    /**
     * @param string $suite
     * @param array  $files
     *
     * @throws QualityToolViolationException
     * @throws \Exception
     */
    public function process($suite, array $files)
    {
        $suite = $this->suiteRepository->find($suite);

        if (!$suite) {
            throw new \Exception('Suite not found.');
        }

        foreach ($suite->getItems() as $alias => $item) {
            if ($item->isEnabled()) {
                $this->io->writeln(sprintf('<info>Running "%s"</info>', strtoupper($alias)));

                $qualityTool = AbstractTool::type($item->getType(), $item->getOptions());
                $qualityTool->execute($files);

                if ($qualityTool->hasErrors()) {
                    $this->io->writeln(sprintf('<error>%s</error>', implode('', $qualityTool->getErrors())));

                    throw new QualityToolViolationException();
                }
            }
        }

        $this->io->writeln('<info>Good job!</info>');
    }
}
