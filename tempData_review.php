<?php

$dataArray = [
  ['restaurantName' => 'Success Food', 'starRate' => 3, 'comment' => 'Test Success content']
];

header('Content-Type: application/json');

echo json_encode($dataArray);
exit;
?>
