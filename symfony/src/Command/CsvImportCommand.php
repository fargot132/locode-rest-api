<?php

namespace App\Command;

use App\Entity\Country;
use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CsvImportCommand extends Command
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->entityManager = $em;
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
        $io->title('Attempting import of Feed...');
        
        $reader = Reader::createFromPath('%kernel.root_dir%/../src/Data/2020-1 UNLOCODE CodeListPart1.csv','r');
        
        $records = $reader->getRecords();
        
        foreach ($records as $offset => $record) {
            if (empty($record['2']) && !empty($record['1'])) {                
                // create new country
                $country = (new Country())
                        ->setCode($record['1'])
                        ->setName(mb_convert_encoding($record['3'], 'UTF-8', 'ISO-8859-1'));
        
                $this->entityManager->persist($country);
            } else {
                // create new location
                $location = (new Location())
                        ->setCode($record['2'])
                        ->setName(mb_convert_encoding($record['3'], 'UTF-8', 'ISO-8859-1'))
                        ->setNameWoDiacritics($record['4'])
                        ->setSubdivision($record['5'])
                        ->setFunctionCode($record['6'])
                        ->setStatus($record['7'])
                        ->setDate($record['8'])
                        ->setIata($record['9'])
                        ->setCoordinates($record['10'])
                        ;
                $this->entityManager->persist($location);
                
                $location->setCountry($country);
            }
            if ($offset % 10) {
                $this->entityManager->flush();
            }
        }
        
        $this->entityManager->flush();
        $this->entityManager->clear();

        $io->success('Command exited cleanly!');
        
        return 0;
    }
}
