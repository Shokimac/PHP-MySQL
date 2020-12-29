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
        // ただし、この状態では危険な文字列や記号がDBへ送られMySQLが破壊されたりデータを盗まれる危険がある
        // SQLに投げるデータは、事前に処理をしないといけない
        // $db->exec('INSERT INTO memos SET memo="' . $_POST['memo'] . '", created_at=NOW()');

        // prepare = 事前準備。
        // ユーザーが入力した値が代入される場所を ? で示す。
        // $statementは、executeメソッドを持っている。このメソッドが指定した文字列が ? へ入る仕組み
        // execteメソッドが自動で数値や文字列を判別してくれる。
        // 上のexecメソッドは、完全に安全なデータとして認識されるため、ユーザーがフォームから入力するような
        // どんなデータが飛んでくるか分からない場合には、executeメソッドで安全性を高めてからDBへ飛ばす必要がある。
        // $statement = $db->prepare('INSERT INTO memos SET memo=?, created_at=NOW()');
        // $statement->execute(array($_POST['memo']));

        // 値の取得方法は、executeメソッドの引数として指定する方法以外に bindParamを使う方法もある。
        // 代入場所を示す ? は複数指定できる。bindParamを使うことで、第一引数に何番目の ? か、第二引数に取得する値を指定することができる
        $statement = $db->prepare('INSERT INTO memos SET memo=?, created_at=NOW()');
        $statement->bindParam(1, $_POST['memo']);
        $statement->execute();
        echo 'メッセージが登録されました';

    }catch(PDOException $e){
        echo 'DB接続エラー： ' . $e->getMessage();
    }
    ?>
</pre>
</main>
</body>    
</html>