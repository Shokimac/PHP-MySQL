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
require('dbconnect.php');

// // ページネーション を実装する場合、LIMIT句の取得開始位置を動的にすることで実装可能
// // ただし、今回LIMIT句には数字で実装しなくてはいけない為、型を指定出来ないexecute()メソッドだと上手く動作しない
// // そこで、bindParamメソッドを使い、数値をSQL文に差し込む
// $memos = $db->prepare('SELECT * FROM memos ORDER BY id DESC LIMIT ?, 5');
// // GETとPOST両方で来る可能性を考慮し、$_REQUESTで指定する
// // 1つ目の ? に、$_REQUEST['page']で取得した値を、数字で差し込む(PDO::PARAM_INT)
// $memos->bindParam(1, $_REQUEST['page'], PDO::PARAM_INT);
// $memos->execute();

// 上記の実装では、取得開始位置をURLパラメータに指定しないといけないので、期待した動きとは違う。
// 綺麗に5件ずつ表示させるために、以下のように改良する

// // まずURLパラメータを変数で受け取る
// $page = $_REQUEST['page'];

// // page1の場合は、LIMIT句は 0, page2の場合は 5, page3の場合は 10 を計算で示すと以下のようになる
// $start = 5 * ($page - 1);
// $memos = $db->prepare('SELECT * FROM memos ORDER BY id DESC LIMIT ?, 5');
// $memos->bindParam(1, $start, PDO::PARAM_INT);
// $memos->execute();

// 上記のままだと、URLパラメータがない場合はエラーが表示されてしまう為
// 以下のようにif文を使って、パラメータが無い場合は1ページ目を表示するようにさせる
// isset()で値が入っているかを判別＆is_numeric()で数字が入っているかを判別
if(isset($_REQUEST['page']) && is_numeric($_REQUEST['page'])){
    $page= $_REQUEST['page'];
}else{
    $page=1;
}

$start = 5 * ($page - 1);
$memos = $db->prepare('SELECT * FROM memos ORDER BY id DESC LIMIT ?, 5');
$memos->bindParam(1, $start, PDO::PARAM_INT);
$memos->execute();
?>

<article>
    <!-- 記事の内容を表示する為のタグ -->
    <?php while($memo = $memos->fetch()): ?>
        <!-- aタグのリンク先をURLパラメータで動的に変える -->
        <p><a href="memo.php?id=<?php print($memo['id']); ?>"><?php print(mb_substr($memo['memo'], 0, 50)); ?></a></p>
        <time><?php print($memo['created_at']); ?></time>
        <hr>
    <?php endwhile; ?>
</article>

</main>
</body>
</html>