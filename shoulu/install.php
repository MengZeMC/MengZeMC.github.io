<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 获取用户提交的信息
    $username = $_POST['admin_username'];
    $password = $_POST['admin_password'];
    $db_host = $_POST['db_host'];
    $db_name = $_POST['db_name'];
    $db_user = $_POST['db_user'];
    $db_pass = $_POST['db_pass'];

    // 读取原始配置模板
    $config_template = file_get_contents('config_template.php');

    // 替换占位符为用户输入的信息
    $config_template = str_replace('[[ADMIN_USERNAME]]', $username, $config_template);
    $config_template = str_replace('[[ADMIN_PASSWORD]]', $password, $config_template);
    $config_template = str_replace('[[DB_HOST]]', $db_host, $config_template);
    $config_template = str_replace('[[DB_NAME]]', $db_name, $config_template);
    $config_template = str_replace('[[DB_USER]]', $db_user, $config_template);
    $config_template = str_replace('[[DB_PASS]]', $db_pass, $config_template);

    // 将替换后的配置写入新的config.php文件
    file_put_contents('config.php', $config_template);

    echo '配置文件已更新！';
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>配置信息</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            padding: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <h1>请输入需要的信息</h1>
    <form method="POST" action="">
        <div class="mb-3">
            <label class="form-label">管理员用户名：</label>
            <input type="text" class="form-control" name="admin_username" required>
        </div>

        <div class="mb-3">
            <label class="form-label">管理员密码：</label>
            <input type="password" class="form-control" name="admin_password" required>
        </div>

        <div class="mb-3">
            <label class="form-label">数据库地址：</label>
            <input type="text" class="form-control" name="db_host" required>
        </div>

        <div class="mb-3">
            <label class="form-label">数据库名称：</label>
            <input type="text" class="form-control" name="db_name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">数据库用户名：</label>
            <input type="text" class="form-control" name="db_user" required>
        </div>

        <div class="mb-3">
            <label class="form-label">数据库密码：</label>
            <input type="password" class="form-control" name="db_pass" required>
        </div>

        <button type="submit" class="btn btn-primary">提交</button>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>