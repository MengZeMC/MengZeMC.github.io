<?php
// 连接到数据库
$mysqli = new mysqli($servername = DB_HOST, $username = DB_USER, $password = DB_PASS, $dbname = DB_NAME);

// 检查连接是否成功
if ($mysqli->connect_errno) {
    die("连接数据库失败，请稍后再试。");
}

// 执行查询操作
$query = "SELECT * FROM urls WHERE approved = 1";
$result = $mysqli->query($query);

// 检查查询是否成功
if (!$result) {
    die("查询失败，请稍后再试。");
}

// 显示已审核通过的网站列表
echo "<h2>已审核网站</h2>";
while ($row = $result->fetch_assoc()) {
    echo "<div><a href='" . $row["url"] . "' style='text-decoration:none;'>" . $row["website_title"] . "</a> - <a href='" . $row["url"] . "' style='text-decoration:none;'>" . $row["url"] . "</a></div>";
}

// 关闭数据库连接
$mysqli->close();
?>