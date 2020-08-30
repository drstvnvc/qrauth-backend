<?php

namespace App\Services;

use App\Exceptions\Application\ApplicationNotFoundException;
use App\Models\Application;

class ApplicationService {

  public function getByApplicationId($applicationId): Application {
    $application = Application::where('application_id', $applicationId)->first();
    if (!$application) {
      throw new ApplicationNotFoundException;
    }

    return $application;
  }
}