<?php

/* PER IL FUTURO */
// header("Access-Control-Allow-Origin: http://127.0.0.1:5173");
// header("Access-Control-Allow-Headers: X-Requested-With");

if (
    isset($_POST['student'])
    &&
    is_array($_POST['student'])
    &&
    array_key_exists('name', $_POST['student'])
    &&
    is_string($_POST['student']['name'])
    &&
    strlen($_POST['student']['name']) >= 3
    &&
    strlen($_POST['student']['name']) <= 64
    &&
    array_key_exists('species', $_POST['student'])
    &&
    is_string($_POST['student']['species'])
    &&
    strlen($_POST['student']['species']) >= 3
    &&
    strlen($_POST['student']['species']) <= 64
    &&
    array_key_exists('status', $_POST['student'])
    &&
    is_string($_POST['student']['status'])
    &&
    (
        $_POST['student']['status'] == 'Alive'
        ||
        $_POST['student']['status'] == 'Dead'
        ||
        $_POST['student']['status'] == 'Unknown'
    )
) {
    $newStudent = $_POST['student'];
    
    $allStudents = file_get_contents('./db/students.json');
    
    $allStudentsData = json_decode($allStudents, true);
    $lastId = $allStudentsData[count($allStudentsData) - 1]['id'];
    $allStudentsData[] = [
        'id' => $lastId + 1,
        'name' => $newStudent['name'],
        'status' => $newStudent['status'],
        'species' => $newStudent['species'],
        'created' => date('Y-m-d\TH:i:s.v\Z')        // date(FORMATO) -> date('d/m/Y') -> 02/10/2024
    ];
    
    file_put_contents('./db/students.json', json_encode($allStudentsData));

    echo json_encode([
        'success' => true,
        'code' => 200,
        'message' => 'Ok'
    ]);
}
else {
    echo json_encode([
        'success' => false,
        'code' => 400,
        'message' => 'Dati non validi'
    ]);
}