<?php

namespace App\Helpers;

class CalculatorHelper
{
  public static function calculateAge(string $birthdate): int
  {
    $birthdate = new \DateTime($birthdate);
    $currentDate = new \DateTime();
    $age = $currentDate->diff($birthdate);

    return $age->y;
  }
}