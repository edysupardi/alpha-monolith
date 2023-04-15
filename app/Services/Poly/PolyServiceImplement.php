<?php

namespace App\Services\Poly;

use LaravelEasyRepository\Service;
use App\Repositories\Poly\PolyRepository;

class PolyServiceImplement extends Service implements PolyService{

     /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
     protected $mainRepository;

    public function __construct(PolyRepository $mainRepository)
    {
      $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
