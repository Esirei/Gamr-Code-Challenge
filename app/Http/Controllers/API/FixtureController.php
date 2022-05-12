<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Fixture;

class FixtureController extends Controller
{
    public function show(Fixture $fixture)
    {
        return $fixture;
    }
}
