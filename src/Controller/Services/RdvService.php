<?php

namespace App\Controller\Services;

use App\Entity\ServiceType;
use App\Repository\ServicetypeRepository;

class RdvService
{

    public function getDetailsRdv($servicetypee){

        $servicetypee= new ServiceType();

        $sevicetypeprice= $servicetypee->getPrice();


            $line_items = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => 2000,
                    'product_data' => [
                        'name' => 'produit1',
                    ],
                ],
                'quantity' => 1,
            ];

            $lineItems[] = $line_items;

        return $lineItems;

    }
}