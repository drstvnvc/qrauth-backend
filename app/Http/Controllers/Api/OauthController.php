<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Exceptions\Application\ApplicationNotFoundException;
use App\Http\Controllers\Controller;
use App\Services\ApplicationService;
use App\Services\AuthorizationAttemptService;

class OauthController extends Controller
{
    private $applicationService;
    private $authorizationAttemptService;

    public function __construct(
        ApplicationService $applicationService,
        AuthorizationAttemptService $authorizationAttemptService
    ) {
        $this->applicationService = $applicationService;
        $this->authorizationAttemptService = $authorizationAttemptService;
    }

    public function oauth(Request $request)
    {
        $applicationId = $request->query('application_id');

        try {
            $application = $this->applicationService->getByApplicationId($applicationId);
        } catch (ApplicationNotFoundException $exception) {
            return $this->invalidApplicationResponse();
        }
        // TODO check domain

        $authorizationAttempt = $this->authorizationAttemptService->create($application);
        $viewData = [
            'application_name' => $application->name,
            'application_homepage_url' => $application->homepage_url,

            'encoded' => json_encode(['attempt' => $authorizationAttempt->authorization_attempt_id]),
        ];
        return response()->view('oauth', $viewData);
    }

    private function invalidApplicationResponse()
    {
        return response()->json([
            'message' => __('oauth.invalid_application_id')
        ], Response::HTTP_FORBIDDEN);
    }
}
