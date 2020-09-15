<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationProdRepository")
 */
class LocationProd extends Location
{
    public function getLocationData(): array
    {
        $data = [
            'locode' => $this->getCountry()->getCode() . ' ' . $this->getCode(),
            'country' => $this->getCountry()->getName(),
            'name' => $this->getName(),
            'nameWoDiacritics' => $this->getNameWoDiacritics(),
            'subdivision' => $this->getSubdivision(),
            'functionCode' => $this->getFunctionCode(),
            'status' => $this->getStatus(),
            'date' => $this->getDate(),
            'iata' => $this->getIata(),
            'coordinates' => $this->getCoordinates(),
            'port' => $this->getPort(),
            'rail' => $this->getRail(),
            'road' => $this->getRoad(),
            'airport' => $this->getAirport(),
            'post' => $this->getPostoffice(),
            'reserved1' => $this->getReserved1(),
            'reserved2' => $this->getReserved2(),
            'border' => $this->getBorder(),
            'notknown' => $this->getNotknown(),
        ];
        return $data;
    }
}
