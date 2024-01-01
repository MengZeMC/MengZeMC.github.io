<?php
require_once('config.php');
// 连接到数据库
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// 检查连接是否成功
if ($mysqli->connect_errno) {
    die("连接数据库失败: " . $mysqli->connect_error);
}

// 获取通过POST请求传递的链接ID
$id = $_POST["id"];

// 更新链接审核状态
$query = "UPDATE urls SET approved = 1 WHERE id = " . $id;
$result = $mysqli->query($query);

// 检查查询是否成功
if (!$result) {
    die("审核失败: " . $mysqli->error);
}

// 关闭数据库连接
$mysqli->close();

// 返回审核成功的响应
$response = [
    'success' => true
];
header('Content-Type: application/json');
echo json_encode($response);
?>