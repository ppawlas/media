<?php

namespace App\Http\Controllers;

use App\ElectricityReading;
use App\GasReading;
use App\User;
use App\WaterReading;

class ReportController extends Controller
{
    /**
     * Get the gas, electricity and water aggregates.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function aggregates(User $user)
    {
        $gas = GasReading::getAggregates($user);
        $electricity = ElectricityReading::getAggregates($user);
        $water = WaterReading::getAggregates($user);
        // get all unique year-month combinations
        $periods = collect([$gas->keys(), $electricity->keys(), $water->keys()])->flatten()->unique();

        $aggregates = $periods->map(function ($period) use ($gas, $electricity, $water) {
            $aggregate = ['period' => $period];
            if ($gas->has($period)) $aggregate['gas'] = $gas[$period];
            if ($electricity->has($period)) $aggregate['electricity'] = $electricity[$period];
            if ($water->has($period)) $aggregate['water'] = $water[$period];
            return $aggregate;
        });

        return response()->json($aggregates, 200);
    }
}
