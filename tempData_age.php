<?php

$dataArray = [
    'teen' => [
        ['restaurantName' => 'Teen Food Place', 'likeCount' => 10, 'minPrice' => 10, 'maxPrice' => 20],
        ['restaurantName' => 'High School Hangout', 'likeCount' => 5, 'minPrice' => 7, 'maxPrice' => 15]
    ],
    'young' => [
        ['restaurantName' => 'Young Professionals Cafe', 'likeCount' => 20, 'minPrice' => 15, 'maxPrice' => 30],
        ['restaurantName' => 'Start-Up Eatery', 'likeCount' => 18, 'minPrice' => 12, 'maxPrice' => 25]
    ],
    'middle' => [
        ['restaurantName' => 'Family Friendly Diner', 'likeCount' => 25, 'minPrice' => 20, 'maxPrice' => 40],
        ['restaurantName' => 'Middle Age Bistro', 'likeCount' => 30, 'minPrice' => 25, 'maxPrice' => 50]
    ]
];

header('Content-Type: application/json');
echo json_encode($dataArray);
exit;
?>
