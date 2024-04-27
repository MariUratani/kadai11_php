<?php
//1. POSTデータ取得
$id = $_POST["id"];

//2. DB接続
include("funcs.php");
$pdo = db_conn();

//３．データ削除SQL作成
$sql = "DELETE FROM my_bm_table WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//４．データ削除処理後
if ($status == false) {
    sql_error($stmt);
} else {
    echo "<script>alert('削除が完了しました。'); window.location.href='select.php';</script>";
    exit();
}
?>