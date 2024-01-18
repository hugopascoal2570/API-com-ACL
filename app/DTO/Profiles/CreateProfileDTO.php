<?php

namespace App\DTO\Profiles;

class CreateProfileDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $description,
    ) {
        //
    }
}