<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Http\Resources\PriorityResource;
use App\Models\Priority;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PriorityIndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return PriorityResource::collection(Priority::all());
    }
}
