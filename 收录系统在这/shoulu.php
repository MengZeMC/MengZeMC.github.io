<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>网站收录</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 300px;
            margin: 0 auto;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <h1>网站收录</h1>

    <form action="save_url.php" method="post">
        <label for="url">请输入网站URL：</label>
        <input type="text" id="url" name="url">

        <label for="website_title">请输入网站标题：</label>
        <input type="text" id="website_title" name="website_title">

        <label for="captcha">验证码：
            <?php
                $num1 = rand(1, 9);
                $num2 = rand(1, 9);
                echo "$num1 + $num2 = ";
            ?>
        </label>
        <input type="text" id="captcha" name="captcha">
        <input type="hidden" name="num1" value="<?php echo $num1; ?>">
        <input type="hidden" name="num2" value="<?php echo $num2; ?>">
        <input type="submit" value="提交">
    </form>
    <p style="color:red;">链接加上"https"或者"https"！</p>
    <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userAnswer = $_POST['captcha'];
            $correctAnswer = $_POST['num1'] + $_POST['num2'];

            if ($userAnswer == $correctAnswer) {
                echo "<p>验证码正确！</p>";
                // 在这里可以继续处理表单提交的逻辑
            } else {
                echo "<p>验证码错误！请重新输入。</p>";
            }
        }
    ?>

</body>

</html>