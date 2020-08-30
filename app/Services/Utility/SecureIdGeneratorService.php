<?php

namespace App\Services\Utility;

use Str;

class SecureIdGeneratorService {

  public function generate(int $length): string {
    return Str::random($length);
  }
}
