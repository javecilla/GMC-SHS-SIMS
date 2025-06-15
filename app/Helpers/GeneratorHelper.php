<?php

namespace App\Helpers;

class GeneratorHelper
{
  /**
   * Generate a random numeric string (e.g., for codes).
   */
  public static function randomNumber(int $length = 6): string
  {
    //ex: "705081"
    return str_pad((string)mt_rand(0, 10 ** $length - 1), $length, '0', STR_PAD_LEFT);
  }

  /**
   * Generate a random pure alphabet string string (e.g., for ).
   */
  public static function randomString(int $length = 8): string
  {
    //ex: "aJslkHZd"
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return $randomString;
  }

  public static function generateUserNo(): string
  {
    //ex: 2023100300
    return date('Y') . rand(100000, 999999);
  }

  public static function generateFileName(string $docType = 'XXXX', $prefix = 'xxxxx', string $extension): string
  {
    //ex: "{XXXX}2025061257adb7cba02096d8afcf{xxxx}.{extension}" = "IMG2025061257db7cba02096d8afcf3profile.jpeg"
    return strtoupper($docType) .  date('Ymd') . substr(md5(uniqid(mt_rand(), true)), 0, 20) . strtolower($prefix) . '.' . strtolower($extension);
  }

  public static function generateEnrollmentNo(): string
  {
    //ex: "REG20250613239924"
    return 'REG' . date('Ymd') . rand(100000, 999999);
  }
}
