<?php

namespace App\Repositories;

use App\DTO\Profiles\CreateProfileDTO;
use App\DTO\Profiles\EditProfileDTO;
use App\Models\Profile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProfileRepository{

    public function __construct(protected Profile $profile)
    {
        
    }
 
    public function getPaginate(int $totalPerPage = 15, int $page = 1, string $filter = ''): LengthAwarePaginator
    {
        $query = $this->profile
            ->where(function ($query) use ($filter) {
                if ($filter !== '') {
                    $query->where('name', 'LIKE', "%{$filter}%");
                }
            })
            ->with(['permissions']);
        return $query->paginate($totalPerPage, ['*'], 'page', $page);
    }
    
    public function createNew(CreateProfileDTO $dto): Profile 
    {
        return $this->profile->create((array) $dto);
    }

    public function findById(string $id): ? Profile
    {
        return $this->profile->find($id);
    }

    public function findByName(string $name): ?Profile
    {
        return $this->profile->where('name', $name)->first();
    }

    public function update(EditProfileDTO $dto): bool
    {
        if (!$profile = $this->findById($dto->id)) {
            return false;
        }
        return $profile->update((array) $dto);
    }

    public function delete(string $id): bool
    {
        if (!$profile = $this->findById($id)) {
            return false;
        }
        return $profile->delete();
    }


}