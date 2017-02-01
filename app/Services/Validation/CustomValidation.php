<?php

namespace App\Services\Validation;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Validator;

class CustomValidation extends Validator
{
    public function validateDateRangeAvailable($attribute, $value, $parameters)
    {
        // database table is passed as a first parameter
        $table = $parameters[0];

        $exists = DB::table($table)->where(function ($query) use ($attribute, $value, $parameters) {
            // get the lower bound column and value
            $lowerBoundColumn = $attribute;
            $lowerBoundValue = $value;

            // upper bound column is passed as second parameter
            $upperBoundColumn = $parameters[1];
            // upper bound value should be taken from the request data array
            $upperBoundValue = $this->data[$upperBoundColumn];

            /** @var Builder $query */
            $query->where(function ($query) use ($upperBoundColumn, $lowerBoundValue) {
                /** @var Builder $query */
                $query->where($upperBoundColumn, '>=', $lowerBoundValue);
                $query->orWhereNull($upperBoundColumn);
            });
            $query->where(function ($query) use ($lowerBoundColumn, $upperBoundValue) {
                /** @var Builder $query */
                $query->where($lowerBoundColumn, '<=', $upperBoundValue);
                $query->orWhereNull($lowerBoundColumn);
            });

            // check if there is an id to be ignored
            $ignoreId = preg_match('/^[1-9][0-9]*$/', end($parameters)) ? end($parameters) : null;
            if ($ignoreId !== null) {
                $query->where('id', '<>', $ignoreId);
            }
        })->exists();

        // validation should pass if there is no record with dates overlapping the requested period
        return !$exists;
    }
}