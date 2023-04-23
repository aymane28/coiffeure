<?php

namespace App\Services;

use Symfony\Component\String\Slugger\SluggerInterface;

class AddEtablissementController
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger=$slugger;
    }
    public function __invoke(){

    }
}