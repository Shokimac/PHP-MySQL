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
    $db = new PDO('mysql:dbname=mydb;host=localhost;port=3306;charset=utf8','root','root');
} catch(PDOException $e) {
    echo 'DB接続エラー：　' . $e->getMessage();
}

// // URLパラメータを使ってSQL文のid指定を動的に変える
// // prepateメソッドに変えて、?とexecuteを使用してURLパラメータを使う
// $memos = $db->prepare('SELECT * FROM memos WHERE id=?');
// $memos->execute(array($_REQUEST['id']));
// $memo = $memos->fetch();

// 上記では、URLパラメータが意図的に文字列で指定されたり、おかしな数字(-1000など)で指定される危険性がある為
// 事前にURLパラメータが数字であるかどうかを判別する必要がある

$id = $_REQUEST['id'];
// is_numericはパラメータで指定された値が数字であるかどうかを判別する
// エクスクラメーションマークが先頭にあるので、否定条件になる
if (!is_numeric($id) || $id <= 0){
    print('1以上の数字で指定してください');
    exit();
}

$memos = $db->prepare('SELECT * FROM memos WHERE id=?');
// 上のif文で数字と判定された $id を executeの引数に指定する
$memos->execute(array($id));
$memo = $memos->fetch();

?>
<article>
    <pre><?php print($memo['memo']); ?></pre>
    <a href="index.php">戻る</a>
</article>

</main>
</body>
</html>