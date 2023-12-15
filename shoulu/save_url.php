<?php
// 引用数据库连接信息常量
$servername = DB_HOST;
$username = DB_USER;
$password = DB_PASS;
$dbname = DB_NAME;

$conn = new mysqli($servername, $username, $password, $dbname);

// 检查连接
if ($conn->connect_error) {
  die("连接失败: " . $conn->connect_error);
}

// 从表单获取URL和网站标题
$url = $_POST['url'];
$website_title = $_POST['website_title'];

// 准备SQL语句
$sql = "INSERT INTO urls (url, website_title, timestamp) VALUES ('$url', '$website_title', NOW())";

// 执行SQL语句
if ($conn->query($sql) === TRUE) {
  echo "URL已成功收录";
} else {
  echo "出错了: " . $sql . "<br>" . $conn->error;
}

// 关闭数据库连接
$conn->close();
?>