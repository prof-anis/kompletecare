<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendUserLaboratoryTestRequest;
use App\Mail\UserLaboratoryTestMail;
use App\Models\LaboratoryTest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Mail;

class UserLaboratoryTestController extends Controller
{
    public function __invoke(SendUserLaboratoryTestRequest $request, User $user): JsonResponse
    {
        $laboratoryTests = LaboratoryTest::whereIn('id', $request->get('laboratoryTests'))
            ->with('laboratoryTestGroup')
            ->get();

        Mail::to('peopleoperations@kompletecare.com')
            ->queue(new UserLaboratoryTestMail($laboratoryTests, $user));

        return response()->json(['message' => 'Records sent successfully.']);
    }
}
