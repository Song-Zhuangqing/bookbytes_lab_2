<?php
include_once("dbconnect.php");

// Check connection
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

$sqlloadbooks = "SELECT * FROM tbl_books";
$result = $conn->query($sqlloadbooks);

if ($result->num_rows > 0) {
    $response['status'] = 'success';
    $response['data']['books'] = array();
    // 遍历数据库结果集，将每本书的信息添加到数组中
    while ($row = $result->fetch_assoc()) {
        $bookList = array(
            'id' => $row['user_id'],
            'name'=>$row['user_name'],
            'isbn' => $row['book_isbn'],
            'title' => $row['book_title'],
            'desc' => $row['book_desc'],
            'author' => $row['book_author'],
            'price' => $row['book_price'],
            'qty' => $row['book_qty'],
            'status' => $row['book_status']
            // 如果有其他字段，继续添加到 $book 数组中
        );

        array_push($response['data']['books'], $bookList);
    }
} else {
    $response['status'] = 'failed';
}

sendJsonResponse($response);

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}
?>