<?php

/* PER IL FUTURO */
// header("Access-Control-Allow-Origin: http://127.0.0.1:5173");
// header("Access-Control-Allow-Headers: X-Requested-With");
	
$studentsString = file_get_contents('db/students.json');
 
$studentsArr = json_decode($studentsString, true);

$students = [];
foreach ($studentsArr as $singleStudent) {
    $addToArray = true;

    if (
        isset($_GET['name'])
        &&
        strpos(strtolower($singleStudent['name']), strtolower($_GET['name'])) === false
    ) {
        $addToArray = false;
    }

    if ($addToArray) {
        $students[] = $singleStudent;
    }
}

header('Content-Type: application/json');
 
echo json_encode($students);