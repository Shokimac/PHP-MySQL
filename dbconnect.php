<?php
try {
    // PDO = PHP Data Object の新しいインスタンスとして$dbを用意することで、mydb内のテーブルを自由に操作できるようになる
    $db = new PDO('mysql:dbname=mydb;host=localhost;port=3306;charset=utf8','root','root');
} catch(PDOException $e) {
    echo 'DB接続エラー：　' . $e->getMessage();
}

?>