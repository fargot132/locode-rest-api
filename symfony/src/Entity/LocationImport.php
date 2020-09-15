<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 */
class LocationImport extends Location
{
    public function setFunction(string $function_code)
    {
        if (strpos($function_code, '1') !== false) {
            $this->setPort(1);
        }
        if (strpos($function_code, '2') !== false) {
            $this->setRail(1);
        }
        if (strpos($function_code, '3') !== false) {
            $this->setRoad(1);
        }
        if (strpos($function_code, '4') !== false) {
            $this->setAirport(1);
        }
        if (strpos($function_code, '5') !== false) {
            $this->setPostoffice(1);
        }
        if (strpos($function_code, '6') !== false) {
            $this->setReserved1(1);
        }
        if (strpos($function_code, '7') !== false) {
            $this->setReserved2(1);
        }
        if (strpos($function_code, 'B') !== false) {
            $this->setBorder(1);
        }
        if (strpos($function_code, '0') !== false) {
            $this->setNotknown(1);
        }
        
        return $this;
    }
}
