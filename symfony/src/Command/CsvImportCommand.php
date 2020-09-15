<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;

class CsvImportCommand extends Command
{
    private $entityManager;
    private $kernel;
    
    public function __construct(EntityManagerInterface $em, KernelInterface $appKernel)
    {
        parent::__construct();

        $this->entityManager = $em;
        $this->kernel = $appKernel;
    }
    
    protected function configure()
    {
        $this
            ->setName('csv:import')
            ->setDescription('Imports CSV data file')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Attempting import of LOCODE database...');
                
        $csv = new CsvImportFromDir($this->entityManager, $this->kernel->getProjectDir() . '/src/Data/');
        $csv->import();
        
        $io->success('Import finished');
        
        return 0;
    }
}
