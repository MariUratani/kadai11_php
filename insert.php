<?php
//1. POSTデータ取得
$isbn = $_POST["isbn"];
$name = $_POST["name"];
$author = $_POST["author"];
$py = isset($_POST["py"]) ? $_POST["py"] : null; // pyがPOSTされていない場合はnullを設定
$tekiyou = $_POST["tekiyou"];
$status = $_POST["status"];
$action = $_POST["action"];

//2. DB接続
include("funcs.php");
$pdo = db_conn();

//３．データ登録SQL作成
$sql = "INSERT INTO my_bm_table(isbn,name,author,py,tekiyou, status, action)VALUES(:isbn,:name,:author,:py,:tekiyou,:status,:action);";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':isbn', $isbn, PDO::PARAM_STR);  //MySQLのINT型の最大値は「2147483647」であるため、VARCHAR型を使用する
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':author', $author, PDO::PARAM_STR);
$stmt->bindValue(':py', $py, PDO::PARAM_INT); // pyがnullの場合はデータベースにNULLが保存される
$stmt->bindValue(':tekiyou', $tekiyou, PDO::PARAM_STR);
$stmt->bindValue(':status', $status, PDO::PARAM_STR);
$stmt->bindValue(':action', $action, PDO::PARAM_STR);
$status = $stmt->execute(); //true or false

//４．データ登録処理後
if ($status == false) {
  sql_error($stmt);
  // 書籍情報の登録に失敗したときはindex.phpを表示
  echo "<script>
  alert('タイトル登録に失敗しました。');
  window.location.href='index.php';
</script>";
  exit();
} else {
  // 書籍情報の登録に成功したときはselect.phpを表示
  echo "<script>
            alert('登録が完了しました。');
            window.location.href='select.php';
</script>";
  exit();
}
