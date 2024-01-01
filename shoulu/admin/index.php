<?php
require_once('config.php');
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
              echo '<button class="approve-button ml-auto" data-id="' . $row["id"] . '">审核</button>';
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
  <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script><script src="https://cdn.bootcdn.net/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
  <script src="https://cdn.bootcdn.net/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
  <!-- 引入FontAwesome的JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
  <script>
    function addLink() {
      var newLink = $('#newLinkInput').val();

      // 如果用户没有输入链接URL，则不执行后续操作
      if (newLink === '') {
        return;
      }

      // 发送POST请求，将新链接插入到数据库中
      $.post('approve.php', {
          url: newLink
        })
        .done(function(data) {
          // 清空输入框内容
          $('#newLinkInput').val('');

          // 显示成功提示信息
          alert('添加链接成功！请等待管理员审核。');
        })
        .fail(function() {
          // 显示失败提示信息
          alert('添加链接失败！');
        });
    }

    $(document).on('click', '.approve-button', function() {
      var id = $(this).data('id');

      // 发送POST请求，将指定ID的链接标记为已审核
      $.post('approve.php', {
          id: id
        })
        .done(function(data) {
          // 刷新页面
          location.reload();
        })
        .fail(function() {
          // 显示失败提示信息
          alert('审核链接失败！');
        });
    });
  </script>
</body>

</html>