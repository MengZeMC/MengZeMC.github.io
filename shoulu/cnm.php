<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// 设置默认的网站名称
$websiteTitle = "默认网站名称";

// 如果用户已经设置了网站名称，则使用用户输入的值
if (isset($_SESSION['website_title'])) {
    $websiteTitle = $_SESSION['website_title'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>后台管理</title>
    <!-- 引入Bootstrap的CSS -->
    <link rel="stylesheet" href="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <!-- 引入FontAwesome的CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f1f1f1;
        }

        h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
        }
        
        .card {
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            border: none;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            padding: 10px 20px;
            font-size: 18px;
            font-weight: bold;
        }

        .card-body {
            padding: 20px;
        }

        .link {
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .link-icon {
            margin-right: 10px;
            color: #007bff;
            font-size: 18px;
        }

        .link-text {
            margin-right: auto;
            color: #333;
            font-size: 16px;
            word-wrap: break-word;
            max-width: 20em;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .approve-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 2px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .approve-button:hover {
            background-color: #0062cc;
        }

        .add-link-form {
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        .add-link-input {
            width: 300px;
            padding: 5px;
            margin-right: 10px;
            border-radius: 2px;
            border: none;
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
            font-size: 16px;
            background-color: #fff;
            transition: box-shadow 0.3s ease;
        }

        .add-link-input:focus {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }

        .add-link-button {
            padding: 5px 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 2px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .add-link-button:hover {
            background-color: #0062cc;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        已审核链接
                    </div>
                    <div class="card-body">
                        <?php
                        // 连接到数据库
                        $mysqli = new mysqli($servername = DB_HOST, $username = DB_USER, $password = DB_PASS, $dbname = DB_NAME);

                        // 检查连接是否成功
                        if ($mysqli->connect_errno) {
                            die("连接数据库失败: " . $mysqli->connect_error);
                        }

                        // 执行查询操作
                        $query = "SELECT * FROM urls WHERE approved=1";
                        $result = $mysqli->query($query);

                        // 检查查询是否成功
                        if (!$result) {
                            die("查询失败: " . $mysqli->error);
                        }

                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="link">';
                            echo '<div class="link-icon"><i class="fas fa-link"></i></div>';
                            echo '<div class="link-text"><a href="' . $row["url"] . '">' . $row["url"] . '</a></div>';
                            echo '</div>';
                        }

                        // 关闭结果集和数据库连接
                        $result->close();
                        $mysqli->close();
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div class="card">
                    <div class="card-header">
                        未审核链接
                    </div>
                    <div class="card-body">
                        <?php
                        // 连接到数据库
                        $mysqli = new mysqli($servername = DB_HOST, $username = DB_USER, $password = DB_PASS, $dbname = DB_NAME);

                        // 检查连接是否成功
                        if ($mysqli->connect_errno) {
                            die("连接数据库失败: " . $mysqli->connect_error);
                        }

                        // 执行查询操作
                        $query = "SELECT * FROM urls WHERE approved=0";
                        $result = $mysqli->query($query);

                        // 检查查询是否成功
                        if (!$result) {
                            die("查询失败: " . $mysqli->error);
                        }

                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="link">';
                            echo '<div class="link-icon"><i class="fas fa-link"></i></div>';
                            echo '<div class="link-text">' . substr($row["url"], 0, 20) . '...</div>';
                            echo '<button class="approve-button ml-auto" onclick="approveLink(' . $row["id"] . ')">审核</button>';
                            echo '</div>';
                        }

                        // 关闭结果集和数据库连接
                        $result->close();
                        $mysqli->close();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-6 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <form class="add-link-form">
                            <div class="input-group">
                                <input type="text" class="form-control add-link-input" id="newLinkInput" placeholder="输入链接URL">
                                <div class="input-group-append">
                                    <button class="btn btn-primary add-link-button" type="button" onclick="addLink()">添加链接</button>
                                </div>
                            </div>
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
        function approveLink(id) {
            // 使用 AJAX 请求调用审核接口
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // 审核成功后刷新页面
                        location.reload();
                    } else {
                        alert("审核失败");
                    }
                }
            };
            xhr.open("GET", "approve.php?id=" + id, true);
            xhr.send();
        }

        function addLink() {
            var newLinkInput = document.getElementById("newLinkInput");
            var url = newLinkInput.value.trim();

            if (url !== "") {
                // 使用 AJAX 请求调用添加链接接口
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // 添加成功后刷新页面
                            location.reload();
                        } else {
                            alert("添加链接失败");
                        }
                    }
                };
                xhr.open("POST", "add.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.send("url=" + encodeURIComponent(url));
            }
        }
    </script>
</body>
</html>