<?php

namespace App\Services;

use App\Repositories\PricingRepositoryInterface;

class PricingService 
{
    protected $pricingRepository;

    public function __construct(PricingRepositoryInterface $pricingRepository)
    {
        $this->pricingRepository = $pricingRepository;
    }
}