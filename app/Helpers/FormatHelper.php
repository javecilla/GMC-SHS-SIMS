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

  public static function formatAddress(string $hAddress, string $barangay, string $municipality, string $province, ?string $postalCode): string
  {
    $address = $hAddress . ', ' . $barangay . ', ' . $municipality . ', ' . $province . ', ' . $postalCode;
    return $address;
  }
}