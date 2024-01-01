<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站收录</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* 自定义样式 */
    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>

    <header class="p-5 bg-primary text-center">
        <h1 class="display-4 text-white">梦泽人工收录</h1>
        <p class="lead text-white">探索各种优秀的中文网站</p>
          <p class="lead text-white">注：自己写的收录系统，太烂了别在意</p>
        <a href="../shoulu.php" class="btn btn-primary">点击加入</a>
    </header>

    <section class="container mt-5">
        <h2>最新收录</h2>
        <div class="row">
            <div class="col-md-6 col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <?php include 'save.php'; ?>
                    </div>
                    <div class="card-footer text-muted">
                        <i class="fa fa-clock"></i> 发布时间: 2023-12-13
                    </div>
                </div>
            </div>
            <!-- 其他收录卡片 -->
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
