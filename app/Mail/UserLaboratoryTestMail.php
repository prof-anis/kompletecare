<?php

namespace App\Mail;

use App\Models\LaboratoryTestGroup;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class UserLaboratoryTestMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private Collection $laboratoryTestGroup;

    public function __construct(private EloquentCollection $laboratoryTests, private User $user)
    {
        $this->laboratoryTestGroup = $this->laboratoryTests
            ->pluck('laboratoryTestGroup')
            ->unique()
            ->map(function (LaboratoryTestGroup $laboratoryTestGroup) {
                $laboratoryTestGroup->setRelation(
                    'laboratoryTest',
                    $this->laboratoryTests->where('laboratory_test_group_id', $laboratoryTestGroup['id'])
                );

                return $laboratoryTestGroup;
            });
    }

    public function build(): UserLaboratoryTestMail
    {
        return $this->markdown('mails.user.laboratory-tests', [
            'laboratoryTestGroups' => $this->laboratoryTestGroup,
            'user'                 => $this->user,
        ])->subject("{$this->user->name} medical data");
    }
}
