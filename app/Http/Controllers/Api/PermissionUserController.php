<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PermissionUserController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    { 
    }

    public function syncProfilesOfUser(string $id, Request $request)
    {
        $user = $this->userRepository->findById($id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
        }
    
        $profiles = $request->profiles;
    
        $user->profiles()->sync($profiles);
    
        return response()->json(['message' => 'ok'], Response::HTTP_OK);
    }
}