<?php

namespace App\Helpers;

class CurrencyHelper
{

    public function getNewChangedCurrencies(array $newData, array $oldData): array
    {
        $across = [];

        if (empty($oldData)) {
            return $newData;
        }

        foreach ($newData as $newItem) {
            $oldItem = array_filter($oldData, fn($i) => $i['key'] === $newItem['key']);

            $oldItem = count($oldItem) === 0 ? $oldItem[0] : [];

            foreach ($oldItem as $key => $oldValue) {
                if (isset($newItem[$key]) && $oldValue != $newItem[$key]) {
                    $across[] = $newItem;
                    break;
                }
            }
        }

        return $across;
    }
}
