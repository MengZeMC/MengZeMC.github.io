<?php
// 连接到数据库
$mysqli = new mysqli($servername = DB_HOST, $username = DB_USER, $password = DB_PASS, $dbname = DB_NAME);

// 检查连接是否成功
if ($mysqli->connect_errno) {
    die("连接数据库失败: " . $mysqli->connect_error);
}

// 获取通过GET请求传递的链接ID
$id = $_GET["id"];

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
http_response_code(200);
?>