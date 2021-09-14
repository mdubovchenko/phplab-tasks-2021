<?php
/**
 * @param PDO $pdo
 * @return array
 */
function getUniqueFirstLetters(PDO $pdo): array
{
    $uniqueFirstLetters = [];
    $result = $pdo->query('
        SELECT DISTINCT LEFT(`name`,1)
        FROM `airports`
        ORDER BY LEFT(`name`,1)
    ');
    foreach ($result as $firstLetter) {
        $uniqueFirstLetters[] = $firstLetter[0];
    }

    return $uniqueFirstLetters;
}

/**
 * @param PDO $pdo
 * @return array
 */
function getAllData(PDO $pdo): array
{
    $pgn = pagination($pdo);
    $sql = 'SELECT `airports`.`name`,
                    `code`,
                    `states`.`name` AS `state_name`,
                    `cities`.`name` AS `city_name`,
                    `address`,
                    `timezone`
            FROM `airports`
            JOIN `states` ON `airports`.`state_id` = `states`.`id`
            JOIN `cities` ON `airports`.`city_id` = `cities`.`id`';
    $sql .= filterByState();
    $sql .= filterByFirstLetter();
    $sql .= sortByKey();
    $sql .= " LIMIT {$pgn['offset']}, {$pgn['limit']}";
    $sth = $pdo->prepare($sql);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();
    $airports = $sth->fetchAll();
    $airports['totalPages'] = $pgn['totalPages'];

    return $airports;
}

/**
 * @return string
 */
function filterByState(): string
{
    $sql = '';
    if (!empty($_GET['filter_by_state'])) {
        $sql .= " AND `states`.`name` = '{$_GET['filter_by_state']}'";
    }

    return $sql;
}

/**
 * @return string
 */
function filterByFirstLetter(): string
{
    $sql = '';
    if (!empty($_GET['filter_by_first_letter'])) {
        $sql .= " WHERE `airports`.`name` LIKE '{$_GET['filter_by_first_letter']}%'";
    }

    return $sql;
}

/**
 * @return string
 */
function sortByKey(): string
{
    $sql = '';
    if (!empty($_GET['sort'])) {
        $sql .= " ORDER BY {$_GET['sort']}";
    }

    return $sql;
}

/**
 * @param PDO $pdo
 * @param int $limit
 * @return array
 */
function pagination(PDO $pdo, int  $limit = 5): array
{
    $sql = 'SELECT COUNT(*) AS `count`
            FROM `airports`
            JOIN `states` ON `airports`.`state_id` = `states`.`id`
            JOIN `cities` ON `airports`.`city_id` = `cities`.`id`';
    $sql .= filterByState();
    $sql .= filterByFirstLetter();
    $sth = $pdo->prepare($sql);
    $sth->setFetchMode(\PDO::FETCH_ASSOC);
    $sth->execute();
    $count = $sth->fetch();
    $totalPages = ceil($count['count'] / $limit);
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

