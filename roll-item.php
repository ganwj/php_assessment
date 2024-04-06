<?php

function binarySearch(array $arr, int $target)
{
    if ($target <= 0) return -1;

    $left = 0;
    $right = count($arr) - 1;

    while ($left < $right) {
        $mid = floor(($left + $right) / 2);

        if ($target == $arr[$mid]) {
            return $mid;
        }

        if ($right - $left == 1) {
            if ($target <= $arr[$left]) {
                return $left;
            } else  if ($target <= $arr[$right]) {
                return $right;
            } else {
                return -1;
            }
        }

        if ($target < $arr[$mid]) {
            if (($target) > $arr[$mid - 1]) {
                return $mid;
            } else {
                $right = $mid - 1;
            }
        } else {
            if (($target) < $arr[$mid + 1]) {
                return $mid + 1;
            } else {
                $left = $mid + 1;
            }
        }
    }

    return -1;
}

function roll_item(string $vip_rank)
{
    $total_weight = 100;
    $rank = substr($vip_rank, 3);

    /* Probability of each vip rank is based on assumptions */
    switch ($rank) {
        case "1":
            $weight = array(50, 40, 7, 2, 1);
            break;
        case "2":
            $weight = array(40, 30, 27, 2, 1);
            break;
        case "3":
            $weight = array(30, 25, 22, 22, 1);
            break;
        case "4":
            $weight = array(20, 20, 20, 20, 20);
            break;
        case "5":
            $weight = array(10, 15, 15, 30, 30);
            break;
        default:
            return "Invalid VIP rank";
    }

    $cumulative_array = array($weight[0]);
    for ($i = 1; $i < count($weight); $i++) {
        array_push($cumulative_array, $cumulative_array[$i - 1] + $weight[$i]);
    }

    return binarySearch($cumulative_array, random_int(1, $total_weight));
}

function simulate_rolls()
{
    $item_tier_rarity = array_fill(1, 5, 0);
    $keys = array("vip1", "vip2", "vip3", "vip4", "vip5");
    $vip_rank = array_fill_keys($keys, $item_tier_rarity);

    foreach ($vip_rank as $key => $value) {
        for ($i = 0; $i < 100; $i++) {
            $item_index = roll_item($key);
            if (is_string($item_index)) {
                return $item_index;
            } else if ($item_index == -1) {
                return "Error. Invalid item.";
            }
            $value[$item_index + 1] += 1;
        }
        $vip_rank[$key] = $value;
    }

    return $vip_rank;
}

$vip_rank = simulate_rolls();
if (is_array($vip_rank)) {
    foreach ($vip_rank as $key => $value) {
        $result = implode("<br/>", $value);
        echo "{$key} => <br/> {$result} <br/>";
    }
} else {
    echo "{$vip_rank}";
}
