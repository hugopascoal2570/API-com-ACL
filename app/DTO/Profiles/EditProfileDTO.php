<?php

namespace App\DTO\Profiles;

class EditProfileDTO
{
    public function __construct(
        public readonly string $id,
        public readonly string $name,
        public readonly string $description,
    ) {
        //
    }
}