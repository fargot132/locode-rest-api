<?php

namespace App\Command;

use Symfony\Component\Finder\Finder;
use Doctrine\ORM\EntityManagerInterface;

class CsvImportFromDir
{
    private $dir;
    private $em;
    
    public function __construct(EntityManagerInterface $em, string $dir)
    {
        $this->em = $em;
        $this->dir = $dir;
    }
    
    public function import()
    {
        $finder = new Finder();
        $finder->name('*UNLOCODE*.csv');
        foreach ($finder->in($this->dir) as $file){
            $csv = new CsvImportFromFile($this->em, $file);
            $csv->import();
        }
        
    }
}
