<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str)
{
  return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn()
{
  try {
    // データベース接続情報（データベース接続情報を別ファイルから読み込む）
    require_once('config.php');

    return new PDO('mysql:dbname=' . DB_NAME . ';charset=utf8;host=' . DB_HOST, DB_USER, DB_PASS);
  } catch (PDOException $e) {
    exit('DB Connection Error:' . $e->getMessage());
  }
}

//SQLエラー
function sql_error($stmt)
{
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQLError:" . $error[2]);
}

//リダイレクト
function redirect($file_name)
{
  header("Location: " . $file_name);
  exit();
}

//SessionCheck(スケルトン)
function sschk()
{
  //LOGINチェック → funcs.phpへ関数化しましょう！
  if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] != session_id()) {
    exit("Login Error");
    // } else {
    //   session_regenerate_id(true); //login_act.phpで、ログイン成功時にセッションIDを再生成する
    //   $_SESSION["chk_ssid"] = session_id();
  }
}
