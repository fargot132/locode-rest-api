<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Finder\Finder;
use App\Entity\UpdateLog;

class UpdateDatabaseCommand extends Command
{
    private $entityManager;
    private $kernel;
    private $url;
    private $zipFileName;
    private $dir;
    
    public function __construct(EntityManagerInterface $em, KernelInterface $appKernel)
    {
        parent::__construct();

        $this->entityManager = $em;
        $this->kernel = $appKernel;
        $this->zipFileName = 'Download.zip';
        $this->dir = $this->kernel->getProjectDir() . '/src/Data/';
    }
    
    public function setURL(string $url)
    {
        $this->url = $url;
    }
    
    protected function configure()
    {
        $this
            ->setName('update:database')
            ->setDescription('Update LOCODE database')
        ;
        $this->setURL('http://www.unece.org/fileadmin/DAM/cefact/locode/loc201csv.zip');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Attempting update of LOCODE database...');
        
        $curl = new Curl($this->url);
        $fileDate = $curl->getFileDateTime();
        
        $lastUpdate = $this->entityManager->getRepository('App:UpdateLog')
                ->getLastUpdate();
        
        $status = false;
        if ($lastUpdate === null || $fileDate > ($lastUpdate->getFileDate())) {
            $status = $curl->downloadToFile($this->dir . $this->zipFileName);
        }
        
        if ($status) {
            $status = $this->unzipFile();
        }
        
        if ($status) {
            $csv = new CsvImportFromDir($this->entityManager, $this->dir);
            $status = $csv->import();
        }
        
        $this->deleteFiles();
        $this->writeToLog($status, $fileDate);
        $io->success('Update finished');
        
        return 0;
    }
    
    private function writeToLog(bool $status, \DateTimeInterface $fileDate)
    {
        $updateLog = (new UpdateLog())
                ->setDate(new \DateTime())
                ->setUpdated($status)
                ->setFileDate($fileDate)
        ;
        $this->entityManager->persist($updateLog);
        $this->entityManager->flush();
        $this->entityManager->clear();
    }
    
    private function deleteFiles()
    {
        $finder = new Finder();
        $finder->name('*.csv')
                ->name('*.pdf')
                ->name('*.zip');
        foreach ($finder->in($this->dir) as $file) {
            unlink($file);
        }
    }
    
    private function unzipFile(): bool
    {
        $zip = new \ZipArchive();
        if ($zip->open($this->dir . $this->zipFileName) === true) {
            $zip->extractTo($this->dir);
            $zip->close();
            return true;
        }
        
        return false;
    }
}
