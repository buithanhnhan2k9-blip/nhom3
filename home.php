<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
    content="width=device-width, initial-scale=1.0">

    <title>Home</title>

    <style>

        body{
            font-family: Arial, Helvetica, sans-serif;
            background:#f5f5f5;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            margin:0;
        }

        .home-box{
            background:#fff;
            padding:40px;
            border-radius:12px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
            text-align:center;
            width:350px;
        }

        .home-box h1{
            margin-bottom:25px;
            color:#111;
        }

        .home-box a{
            display:inline-block;
            padding:12px 25px;
            background:#000;
            color:#fff;
            text-decoration:none;
            border-radius:8px;
            transition:0.3s;
        }

        .home-box a:hover{
            background:#444;
        }

    </style>

</head>

<body>

    <div class="home-box">

        <h1>Xin chào User</h1>

        <a href="login.html">
            Đăng xuất
        </a>

    </div>

</body>
</html>