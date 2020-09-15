<?php

namespace App\Command;

use App\Entity\Country;
use App\Entity\CountryImport;
use App\Entity\LocationImport;
use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use League\Csv\Reader;

class CsvImportFromFile
{
    private $fileName;
    private $em;
    
    public function __construct(EntityManagerInterface $em, string $file)
    {
        $this->em = $em;
        $this->fileName = $file;
    }
    
    public function import() 
    {
        $reader = Reader::createFromPath($this->fileName,'r');
        $records = $reader->getRecords();
        $counter = 0;
        
        $this->em->getConnection()->getConfiguration()->setSQLLogger(null);
                
        foreach ($records as $offset => $record) {
            if (empty($record['2']) && !empty($record['1'])) {
                if (strpos($record['3'],'.') === 0) {
                    $this->em->clear();
                    $country = null;
                    // create new country
                    $country = $this->buildCountry($record);

                    $this->em->persist($country);
                }
            } else {
                // create new location
                $location = null;
                $location = $this->buildLocation($record);
               
                $this->em->persist($location);
                
                $location->setCountry($country);
                ++$counter;
            }
            if (($offset % 50) === 0) {
                $this->em->flush();
            }
        }
        
        $this->em->flush();
        $this->em->clear();
        
        return $counter;
    }
    
    private function buildCountry (array $record) : Country
    {
        $country = (new CountryImport())
            ->setCode($record['1'])
            ->setName($this->convertEncoding(ltrim($record['3'],'.')));
        return $country;
    }
    
    private function buildLocation (array $record) : Location
    {
         $location = (new LocationImport())
            ->setCode($record['2'])
            ->setName($this->convertEncoding($record['3']))
            ->setNameWoDiacritics($this->convertEncoding($record['4']))
            ->setSubdivision($record['5'])
            ->setFunctionCode($record['6'])
            ->setFunction($record['6'])
            ->setStatus($record['7'])
            ->setDate($record['8'])
            ->setIata($record['9'])
            ->setCoordinates($record['10'])
            ;
         return $location;
    }
    
    private function convertEncoding (string $text)
    {
        return mb_convert_encoding($text, 'UTF-8', 'ISO-8859-1');
    }
}
