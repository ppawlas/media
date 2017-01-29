<?php

namespace App;

use Carbon\Carbon;

trait ReadingTrait
{

    public function getDailyAttribute()
    {
        if ($this->previous !== null) {
            return $this->_getDaily();
        }
    }

    public function getMonthlyPredictionAttribute()
    {
        if ($this->previous !== null) {
            return $this->_getDaily() * (new Carbon($this->date))->lastOfMonth()->day;
        }
    }

    public function getYearlyPredictionAttribute()
    {
        if ($this->previous !== null) {
            // dayOfYear returns zero based result
            return $this->_getDaily() * ((new Carbon($this->date))->lastOfYear()->dayOfYear + 1);
        }
    }

    private function _getDaily()
    {
        return $this->usage / (new Carbon($this->date))->diff(new Carbon($this->previous->date))->days;

    }

}