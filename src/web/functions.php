<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param  array  $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports): array
{
    $uniqueFirstLetters = [];
    foreach ($airports as $airport) {
        if (!is_string($airport['name'])) {
            throw new InvalidArgumentException('The variable must be string');
        }
        $firstLetter = substr(trim($airport['name']), 0, 1);
        if (!in_array($firstLetter, $uniqueFirstLetters)) {
            $uniqueFirstLetters[] = $firstLetter;
        }
    }
    sort($uniqueFirstLetters);

    return $uniqueFirstLetters;
}

/**
 * @param array $airports
 * @param string $filter
 */
function filterByGetParams(array &$airports, string $filter)
{
    $airports = array_filter($airports, function ($a) use ($filter) {
        if ($filter == $_GET['filter_by_first_letter']) {
            return substr($a['name'], 0, 1) == $_GET['filter_by_first_letter'];
        }
        return $a['state'] == $_GET['filter_by_state'];
    });
    sort($airports);
}

/**
 * @param array $airports
 */
function sortByKey(array &$airports)
{
    usort($airports, function ($a, $b) {
        return  $a[$_GET['sort']] <=> $b[$_GET['sort']];
    });
}

/**
 * @param array $airports
 * @param int $limit
 * @return array
 */
function paginationParams(array $airports, int  $limit = 5): array
{
    $totalPages = ceil(count($airports) / $limit);
    if (!isset($_GET['page']) || $_GET['page'] > $totalPages) {
        $_GET['page'] = 1;
    }
    $offset = ($_GET['page'] - 1) * $limit;

    return [
        'limit' => $limit,
        'totalPages' => $totalPages,
        'offset' => $offset
    ];
}
