<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class SigntaturesService
{
  public function getSigntatures()
  {
    $user = Auth::user();
    $signtatures = $user->signatures()->get();
    return $signtatures;
  }

  public function createSigntatures($responsiblePersons)
  {
    $user = Auth::user();

    //Проверяем, есть ли уже записи
    if ($user->signatures()->exists()) {
      $user->signatures()->delete();
    }

    foreach ($responsiblePersons as $responsiblePerson) {
      $user->signatures()->create($responsiblePerson);
    }
    return response()->json(['message' => 'Signatures created successfully.'], 201);
  }
}