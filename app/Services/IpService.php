<?php

namespace App\Services;

interface IpService
{
    public function for(string $ip): self;
    public function get(): self;
}
