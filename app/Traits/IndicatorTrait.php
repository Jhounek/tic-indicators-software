<?php
namespace App\Traits;

use App\Models\Indicator;

Trait IndicatorTrait
{

    private function indicators()
    {
        $model  = new Indicator();
        $indicators = $model
        ->get()
        ->getResult();

        $percentages = [];
        foreach($indicators as $item) {
            $percentages[$item->code] = $item->percentage;
        }

        return $percentages;
    }
}