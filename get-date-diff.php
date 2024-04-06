<?php
function getDateDiff(string $dateStr1, string $dateStr2)
{
    try {
        $date1 = date_create_from_format("!Y-m-d", $dateStr1);
        $date2 = date_create_from_format("!Y-m-d", $dateStr2);
        if ($date1 === false || $date2 === false) {
            return "Invalid date. Date must be in yyyy-mm-dd format.";
        }
        $interval = date_diff($date1, $date2);
        return $interval->format("%r%a");
    } catch (ValueError $e) {
        return "Invalid date. Date must be in yyyy-mm-dd format.";
    }
}

function isOddEven(int $number)
{
    if ($number % 2 === 0) return "even";

    return "odd";
}
