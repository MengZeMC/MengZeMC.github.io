<?php

session_start();

require_once 'config.php';

// 检查用户是否已登录
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    // 用户已登录，转跳到 cnm.php 页面
    header("Location: cnm.php");
    exit;
} else {
    // 用户未登录，验证用户名和密码
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // 验证用户名和密码
        if ($username === DEFAULT_USERNAME && $password === DEFAULT_PASSWORD) {
            // 认证成功，设置 session 变量并转跳到 cnm.php 页面
            $_SESSION['loggedin'] = true;
            header("Location: cnm.php");
            exit;
        } else {
            // 认证失败，显示错误信息
            echo "用户名或密码错误";
        }
    }
}

// 显示登录页面
echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>后台登录</title>
    <!-- 引入Bootstrap的CSS -->
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <style>
        /* 样式代码 */
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <h2>后台登录</h2>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="username">用户名：</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="请输入用户名" required>
                            </div>
                            <div class="form-group">
                                <label for="password">密码：</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码" required>
                            </div>
                            <button type="submit" class="btn btn-primary">登录</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 引入Bootstrap的JS -->
    <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // JavaScript代码
    </script>
</body>
</html>
';
?>