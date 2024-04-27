<?php
//$_SESSION使うよ！
session_start();

//※htdocsと同じ階層に「includes」を作成してfuncs.phpを入れましょう！
//include "../../includes/funcs.php";
include "funcs.php";
// sschk();

//1. POSTデータ取得
$username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$lid = filter_input(INPUT_POST, "lid", FILTER_SANITIZE_STRING);
$lpw = filter_input(INPUT_POST, "lpw", FILTER_SANITIZE_STRING);
$kanri_flg = filter_input(INPUT_POST, "kanri_flg", FILTER_SANITIZE_NUMBER_INT);
$lpw = password_hash($lpw, PASSWORD_DEFAULT); //パスワードハッシュ化


//2. DB接続
$pdo = db_conn();


//３．データ登録SQL作成
$sql = "INSERT INTO gs_user_table(username, email, lid, lpw, kanri_flg, life_flg) VALUES(:username, :email, :lid, :lpw, :kanri_flg, 0)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':username', $username, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':email', $email, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR); //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT); //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//４．データ登録処理後
if ($status == false) {
    sql_error($stmt);
} else {
    // 新規ユーザー登録に成功したときは、セッションにユーザー情報を保存してselect.phpにジャンプ
    $_SESSION["kanri_flg"] = $kanri_flg;
    $_SESSION["username"] = $username;
    echo "<script>
            alert('新規ユーザー登録が完了しました。');
            window.location.href='select.php';
          </script>";
    exit();
}
?>
    <!-- // 新規ユーザー登録に失敗したときはlogin.phpを表示
    echo "<script>
            alert('新規ユーザー登録に失敗しました。');
            window.location.href='login.php';
          </script>";
    exit();
} else {
    // 新規ユーザー登録に成功したときはselect.phpにジャンプ
    echo "<script>
            alert('新規ユーザー登録が完了しました。');
            window.location.href='select.php';
          </script>";
    exit();
} -->
