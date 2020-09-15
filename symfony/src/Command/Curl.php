<?php

namespace App\Command;

class Curl
{

    private $curlHandle;
    private $url;
    
    public function __construct(string $url)
    {
        $this->url = $url;
        $this->curlHandle = null;
    }
    
    public function getFileDateTime(): ?\DateTime
    {
        $this->curlHandle = curl_init($this->url);
        $this->setHeaderOptions();
        curl_exec($this->curlHandle);
        $filetime = curl_getinfo($this->curlHandle, CURLINFO_FILETIME);
        curl_close($this->curlHandle);
        if (!is_null($filetime) && $filetime != -1) {
            $date = new \DateTime();
            $date->setTimestamp($filetime);
            return $date;
        }
        
        return null;
    }
    
    private function setHeaderOptions(bool $value = true)
    {
        if ($this->curlHandle) {
            //don't fetch the actual page, you only want headers
            curl_setopt($this->curlHandle, CURLOPT_NOBODY, $value);
            curl_setopt($this->curlHandle, CURLOPT_HEADER, $value);
            //stop it from outputting stuff to stdout
            curl_setopt($this->curlHandle, CURLOPT_RETURNTRANSFER, $value);
            // attempt to retrieve the modification date
            curl_setopt($this->curlHandle, CURLOPT_FILETIME, $value);
        }
    }
    
    public function downloadToFile(string $file)
    {
        $fp = fopen($file, "w");
        $this->curlHandle = curl_init($this->url);
        curl_setopt($this->curlHandle, CURLOPT_FILE, $fp);
        $status = curl_exec($this->curlHandle);
        curl_close($this->curlHandle);
        fclose($fp);
        return $status;
    }
}
