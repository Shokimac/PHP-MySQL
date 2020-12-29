<!doctype html>
<html lang="ja">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
<link rel="stylesheet" href="css/style.css">

<title>PHP</title>
</head>
<body>
<header>
<h1 class="font-weight-normal">PHP</h1>    
</header>

<main>
<h2>Practice</h2>
<pre>
    <?php
    try{
        $db = new PDO('mysql:dbname=mydb;host=localhost;port=3306;charset=utf8','root','root');
        // memoには input.htmlで、methodをpostとしたので$_POSTとしてname属性が一致するもの[name]を指定する。
        $db->exec('INSERT INTO memos SET memo="' . $_POST['memo'] . '", created_at=NOW()');

    }catch(PDOException $e){
        echo 'DB接続エラー： ' . $e->getMessage();
    }


    ?>
</pre>
</main>
</body>    
</html>