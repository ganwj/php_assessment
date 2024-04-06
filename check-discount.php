<?php

function checkDiscount($purchaseValue)
{
    if (is_numeric($purchaseValue) && $purchaseValue > 0) {
        if ($purchaseValue > 500) {
            $afterDiscount = $purchaseValue * 0.9;
            return "Purchase value is {$afterDiscount}, discount is 10%.";
        } else if ($purchaseValue >= 100) {
            $afterDiscount = $purchaseValue * 0.95;
            return "Purchase value is {$afterDiscount}, discount is 5%.";
        } else {
            return "Purchase value is {$purchaseValue}, there is no discount.";
        }
    } else {
        return "Only positive non-zero numbers are accepted as arguments.";
    }
}
