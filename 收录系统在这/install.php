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

    // 显示写入成功页面
    echo '<!DOCTYPE html>';
    echo '<html>';
    echo '<head>';
    echo '<title>配置信息已更新</title>';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">';
    echo '</head>';
    echo '<body>';
    echo '<div class="container">';
    echo '<h1 class="mt-5">配置信息已更新</h1>';
    echo '<p class="lead">请将根目录下的 <code>create_table.sql</code> 文件导入数据库，然后即可开始使用系统。</p>';
    echo '<a href="/" class="btn btn-primary">返回首页</a>';
    echo '</div>';
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>';
    echo '</body>';
    echo '</html>';
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>配置信息</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">请输入需要的信息</h1>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>