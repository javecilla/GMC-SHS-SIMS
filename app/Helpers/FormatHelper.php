<?php

namespace App\Helpers;

class FormatHelper
{
  public static function formatPersonName(string $lastName, string $firstName, ?string $middleName = null, ?string $extensionName = null): string
  {
    $name = strtoupper($lastName) . ', ' . $firstName;
    if ($middleName) {
      $name .= ' ' . ucfirst(substr($middleName, 0, 1)) . '.';
    }
    if ($extensionName) {
      $name .= ' ' . $extensionName;
    }

    return $name;
  }
}