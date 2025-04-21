<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class SigntaturesService
{
  public function getSigntatures()
  {
    $user = Auth::user();
    $signtatures = $user->signatures()->select('kind', 'surname', 'signdate', 'file_src', 'signs_lists_id')->get();
    return $signtatures;
  }

  public function createSigntatures($responsiblePersons)
  {
    // dd($responsiblePersons);
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
