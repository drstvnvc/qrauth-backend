<?php

namespace App\Models\Factories;

use Carbon\Carbon;

use App\Models\AuthorizationAttempt;
use App\Services\Utility\SecureIdGeneratorService;

class AuthorizationAttemptFactory
{
    private $secureIdGenerator;

    public function __construct()
    {
        $this->secureIdGenerator = new SecureIdGeneratorService;
    }

    public function createAuthorizationAttempt($applicationId): AuthorizationAttempt
    {
        return AuthorizationAttempt::create([
            'application_id' => $applicationId,
            'authorization_attempt_id' => $this->secureIdGenerator->generate(32),
            'status' => AuthorizationAttempt::STATUS_PENDING,
            'expires_at' => Carbon::now()->addMinutes(AuthorizationAttempt::TTL)
        ]);
    }
}
