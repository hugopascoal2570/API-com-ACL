<?php

namespace App\Http\Controllers\Api;

use App\DTO\Profiles\CreateProfileDTO;
use App\DTO\Profiles\EditProfileDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreProfileRequest;
use App\Http\Requests\Api\UpdateProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function __construct(private ProfileRepository $profileRepository, private UserRepository $userRepository)
    {
        
    }

    public function syncProfilePermissions(string $profile, Request $request)
    {
        $profile = $this->profileRepository->findById($profile);
        if (!$profile) {
            return response()->json(['message' => 'Profile not found'], Response::HTTP_NOT_FOUND);
        }
    
        $permissions = $request->permissions;
    
        $profile->permissions()->sync($permissions);
    
        return response()->json(['message' => 'ok'], Response::HTTP_OK);
    }
    

    public function index(Request $request)
    {

        $profiles = $this->profileRepository->getPaginate(
        totalPerPage: $request->total_per_page ?? 15,
        page: $request->page ?? 1,
        filter: $request->filter ?? '');

        return ProfileResource::collection($profiles);
    }

    public function store(StoreProfileRequest $request)
    {
        $user = $this->profileRepository->createNew(new CreateProfileDTO(... $request->validated()));
        return new ProfileResource($user);
    }

    public function update(UpdateProfileRequest $request, string $id)
    {
        $response = $this->profileRepository->update(new EditProfileDTO(...[$id, ...$request->validated()]));
        if (!$response) {
            return response()->json(['message' => 'Profile not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json(['message' => 'Perfil atualizado com sucesso']);
    }

    public function destroy(string $id)
    {
        if (!$this->profileRepository->delete($id)) {
            return response()->json(['message' => 'profile not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
