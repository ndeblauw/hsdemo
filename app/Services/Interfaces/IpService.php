<?php

namespace App\Services\Interfaces;

interface IpService
{
    public function for(string $ip): self;
    public function get(): self;
}
