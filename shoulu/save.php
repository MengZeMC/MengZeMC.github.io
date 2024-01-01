<?php
require_once('config.php');
// 连接到数据库
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// 检查连接是否成功
if ($mysqli->connect_errno) {
    die("连接数据库失败，请稍后再试。");
}

// 执行查询操作
$query = "SELECT * FROM urls WHERE approved = 1";
if (!$result = $mysqli->query($query)) {
    die("查询失败，请稍后再试。");
}

// 显示已审核通过的网站列表
echo "<h2>已审核网站</h2>";
while ($row = $result->fetch_assoc()) {
    $title = htmlspecialchars($row["website_title"]);
    $url = htmlspecialchars($row["url"]);
    echo "<div><a href='{$url}' style='text-decoration:none;'>{$title}</a> - <a href='{$url}' style='text-decoration:none;'>{$url}</a></div>";
}
$result->free();

// 关闭数据库连接
$mysqli->close();
?>