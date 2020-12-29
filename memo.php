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
<?php 

try {
    // PDO = PHP Data Object の新しいインスタンスとして$dbを用意することで、mydb内のテーブルを自由に操作できるようになる
    $db = new PDO('mysql:dbname=mydb;host=localhost;port=3306;charset=utf8','root','root');
} catch(PDOException $e) {
    echo 'DB接続エラー：　' . $e->getMessage();
}

$memos = $db->query('SELECT * FROM memos WHERE id=1');
$memo = $memos->fetch();
?>

<article>
    <pre><?php print($memo['memo']); ?></pre>
    <a href="index.php">戻る</a>
</article>

</main>
</body>
</html>