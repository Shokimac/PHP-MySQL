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
// try&catchが例外処理。
// エラーが起きた時に、エラーをそのまま落とすのではなく、例外処理を設定することで処理を制御することができる
try {
    // PDO = PHP Data Object の新しいインスタンスとして$dbを用意することで、mydb内のテーブルを自由に操作できるようになる
    $db = new PDO('mysql:dbname=mydb;host=localhost;port=3306;charset=utf8','root','root');
} catch(PDOException $e) {
    echo 'DB接続エラー：　' . $e->getMessage();
}

// execメソッドにはSQL文をそのまま書いていく
// 影響を与えた行の数が戻り値として返ってくるので、それを$countへいれる
// $count = $db->exec('INSERT INTO my_items SET maker_id=1, name="もも", price=210, keyword="缶詰, ピンク, 甘い"');
// $ee = $db->errorInfo();
// if($ee[0] == "00000"){
//     echo $count."件のデータを挿入しました";
// }else{
//     var_dump($ee);
//     exit();
// }

// SELECT文を使う場合には、execメソッドではデータを受け取ることができない
// queryメソッドでは戻り値に、SELECTで得られた値を受け取る。
// $records は、レコードセットオブジェクトのインスタンスになる
$records = $db->query('SELECT * FROM my_items');
// fetch＝割り当てる。DBから受け取った行達から1行を取得する。全て終わるとfalseを返す
while($record = $records->fetch()) {
    // $recordは連想配列になる
    print($record['name'] . "\n");
}
?>
</pre>
</main>
</body>    
</html>