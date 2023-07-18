<?php

echo "1." . PHP_EOL;

$arr = [
    ["id" => 1, "date" => "12.01.2020", 'name' => "test1"],
    ["id" => 2, "date" => "02.05.2020", 'name' => "test2"],
    ["id" => 4, "date" => "08.03.2020", 'name' => "test4"],
    ["id" => 1, "date" => "22.01.2020", 'name' => "test1"],
    ["id" => 2, "date" => "11.11.2020", 'name' => "test4"],
    ["id" => 3, "date" => "06.06.2020", 'name' => "test3"],
];

function unique(array $array, callable $callback, bool $preserveKeys = false): array
{
    $unique = array_intersect_key($array, array_unique(array_map($callback, $array)));
    return ($preserveKeys) ? $unique : array_values($unique);
}
$unique = unique($arr, function ($arr) {
    return $arr['id'];
});
var_dump($unique);

echo "2." . PHP_EOL;

$sort = $arr;
array_multisort(array_column($sort, 'name'), SORT_STRING, $sort);
var_dump($sort);

echo "3." . PHP_EOL;

$byId = $unique;
$callbackForGetById = function (int $id): Closure {
    return function (array $item) use ($id) {
        return $item['id'] == $id;
    };
};
var_dump(array_values(array_filter($arr, $callbackForGetById(4)))[0]);

echo "4." . PHP_EOL;

var_dump(array_map(function($key, $value) {
    return "{$value['name']} => {$value['id']}";
}, array_keys($arr), $arr));

echo "5." . PHP_EOL;

echo "select goods.id, goods.name from `goods` where exists (select * from `tags` inner join `goods_tag` on `tags`.`id` = `goods_tag`.`tag_id` where `goods`.`id` = `goods_tag`.`good_id`)";

echo "6. " . PHP_EOL;

echo "SELECT departments.*, evaluations.gender from departments, evaluations WHERE evaluations.department_id = departments.id AND evaluations.gender = 1 AND evaluations.value = 5";