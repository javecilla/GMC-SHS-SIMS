<?php

namespace App\Services;

use App\Models\User;
use App\Enums\UserStatusEnum;
use App\Helpers\GeneratorHelper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserService
{
  public function create(array $data): User
  {
    $data['password'] = Hash::make($data['password']);
    $imageProfileFileName = GeneratorHelper::generateFileName('IMG', 'profile', $data['image_profile']->getClientOriginalExtension());
    $eSignatureFileName = GeneratorHelper::generateFileName('IMG', 'esignature', $data['e_signature']->getClientOriginalExtension());

    Storage::disk('public')->put('user/profiles/' . $imageProfileFileName, file_get_contents($data['image_profile']));
    Storage::disk('public')->put('user/signatures/' . $eSignatureFileName, file_get_contents($data['e_signature']));

    $data['image_profile'] = $imageProfileFileName;
    $data['e_signature'] = $eSignatureFileName;

    return User::create($data);
  }
}
