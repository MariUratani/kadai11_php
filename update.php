<?php
// 1. POSTデータ取得
$id = $_POST["id"];
$isbn = $_POST["isbn"];
$name = $_POST["name"];
$author = $_POST["author"];
$py = isset($_POST["py"]) ? $_POST["py"] : null; // pyがPOSTされていない場合はnullを設定
$tekiyou = $_POST["tekiyou"];
$status = $_POST["status"];
$action = $_POST["action"];

// 2. DB接続
include("funcs.php");
$pdo = db_conn();

// 3. UPDATE gs_an_table SET ....; で更新
$sql = "UPDATE my_bm_table SET isbn=:isbn, name=:name, author=:author, py=:py, tekiyou=:tekiyou, status=:status, action=:action WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':isbn', $isbn, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$stmt->bindValue(':py', $py, PDO::PARAM_INT); // pyがnullの場合はデータベースにNULLが保存される
$stmt->bindValue(':tekiyou', $tekiyou, PDO::PARAM_STR);
$stmt->bindValue(':status', $status, PDO::PARAM_STR);
$stmt->bindValue(':action', $action, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 4. データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    echo "<script>alert('更新が完了しました。'); window.location.href='select.php';</script>";
    exit();
}
?>