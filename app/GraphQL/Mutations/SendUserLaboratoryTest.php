<?php

namespace App\GraphQL\Mutations;

use App\Mail\UserLaboratoryTestMail;
use App\Models\LaboratoryTest;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

final class SendUserLaboratoryTest
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args): array
    {
        $laboratoryTests = LaboratoryTest::whereIn("id", $args["laboratoryTests"])
            ->with('laboratoryTestGroup')
            ->get();

        $user = User::find($args['userID']);

        Mail::to("peopleoperations@kompletecare.com")
            ->queue(new UserLaboratoryTestMail($laboratoryTests, $user));

       return [
           "message" => "Records sent successfully."
       ];
    }
}
