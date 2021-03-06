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
    
    public function import(): bool
    {
        $counter = 0;
        $finder = new Finder();
        $finder->name('*UNLOCODE*.csv');
        foreach ($finder->in($this->dir) as $file) {
            $csv = new CsvImportFromFile($this->em, $file);
            $counter += $csv->import();
        }
        
        if ($counter > 0) {
            $this->replaceOldWithNew();
            return true;
        }
        
        return false;
    }
    
    private function replaceOldWithNew()
    {
        $q = "DELETE FROM location WHERE type = 'old'";
        $this->em->getConnection()->exec($q);
        $q = "DELETE FROM country WHERE type = 'old'";
        $this->em->getConnection()->exec($q);
        $q = "UPDATE country SET type = 'old' WHERE type = 'new'";
        $this->em->getConnection()->exec($q);
        $q = "UPDATE location SET type = 'old' WHERE type = 'new'";
        $this->em->getConnection()->exec($q);
    }
}
