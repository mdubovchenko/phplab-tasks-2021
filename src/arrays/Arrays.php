<?php

namespace arrays;

class Arrays implements ArraysInterface
{
    /**
     * The $input variable contains an array of digits
     * The method returns an array which will contain the same digits but repetitives by its value
     * without changing the order.
     *
     * @param array $input
     * @return array
     */
    public function repeatArrayValues(array $input): array
    {
        $arrRepeat = [];
        foreach ($input as $value) {
            for ($i = 0; $i < (int)$value; $i++) {
                $arrRepeat[] = $value;
            }
        }

        return $arrRepeat;
    }

    /**
     * The $input variable contains an array of digits
     * The method returns the lowest unique value or 0 if there is no unique values or array is empty.
     *
     * @param array $input
     * @return int
     */
    public function getUniqueValue(array $input): int
    {
        $result = [];
        foreach ($input as $value) {
            if (array_key_exists($value, $result)) {
                $result[$value]++;
                continue;
            }
            $result[$value] = 1;
        }
        ksort($result);

        return (int)array_search(1, $result);
    }
    /**
     * The $input variable contains an array of arrays
     * Each sub array has keys: name (contains strings), tags (contains array of strings)
     * The method returns the list of names grouped by tags
     * And the 'names' in returned array sorted ascending.
     *
     * @param array $input
     * @return array
     */
    public function groupByTag(array $input): array
    {
        $name = array_column($input, 'name');
        $tags = array_column($input, 'tags');
        $comb = array_combine($name, $tags);
        $result = [];

        foreach ($comb as $key => $value) {
            for ($i = 0; $i < count($value); $i++) {
                $result[$value[$i]][] = $key;
            }
        }
        foreach ($result as $key => $value) {
            sort($value);
            $result[$key] = $value;
        }
        ksort($result);

        return $result;
    }
}