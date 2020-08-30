<?php

namespace App\Services;

use App\Models\Application;
use App\Models\AuthorizationAttempt;
use App\Models\Factories\AuthorizationAttemptFactory;

class AuthorizationAttemptService
{
    private $authorizationAttemptFactory;

    public function __construct(AuthorizationAttemptFactory $authorizationAttemptFactory)
    {
        $this->authorizationAttemptFactory = $authorizationAttemptFactory;
    }

    public function getById($id): AuthorizationAttempt
    {
        return AuthorizationAttempt::find($id);
    }

    public function getByAuthorizationAttemptId($authorizationAttemptId): AuthorizationAttempt
    {
        return AuthorizationAttempt::where('authorization_attemp_id', $authorizationAttemptId)->first();
    }

    public function create(Application $application): AuthorizationAttempt
    {
        return $this->authorizationAttemptFactory->createAuthorizationAttempt($application->id);
    }
}
