<?php
session_start();
include("funcs.php");
$pdo = db_conn();

// データ取得クエリ
$sql = "SELECT id, isbn, name, author, py, tekiyou, status, action FROM my_bm_table ORDER BY id ASC";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status == false) {
  sql_error($stmt);
}

$values =  $stmt->fetchAll(PDO::FETCH_ASSOC);

// CSVファイル名
$filename = "bookshelf_data_" . date("Ymd_His") . ".csv";

// CSVデータ作成
$csv_data = "ID,ISBN,Title,Author's Name,Publication Year,Memo,States,Action\n";
foreach ($values as $row) {
  $csv_data .= $row['id'] . ",";
  $csv_data .= $row['isbn'] . ",";
  $csv_data .= $row['name'] . ",";
  $csv_data .= $row['author'] . ",";
  $csv_data .= $row['py'] . ",";
  $csv_data .= $row['tekiyou'] . ",";
  $csv_data .= $row['status'] . ",";
  $csv_data .= $row['action'] . "\n";
}

// CSVファイル出力
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $filename);
echo mb_convert_encoding($csv_data, "SJIS-win", "UTF-8");
exit();
?>