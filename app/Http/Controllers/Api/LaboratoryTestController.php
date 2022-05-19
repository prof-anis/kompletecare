<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaboratoryTestGroupResource;
use App\Models\LaboratoryTestGroup;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class LaboratoryTestController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        return LaboratoryTestGroupResource::collection(
            LaboratoryTestGroup::with(['laboratoryTests'])->paginate()
        );
    }
}
