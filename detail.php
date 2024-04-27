<?php
// 1. GETデータ取得
$id = $_GET["id"];

// 2. DB接続
include("funcs.php");
$pdo = db_conn();

// 3. SELECT * FROM xxx WHERE id=:id
$sql = "SELECT * FROM my_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// 4. データ表示
$view = "";
if ($status == false) {
    sql_error($stmt);
} else {
    $row = $stmt->fetch();
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>詳細・更新</title>
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/e53e6d346a.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
        }

        input[type="text"],
        select {
            height: 30px;
            padding: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .btn-primary {
            background-color: #3085d6;
            border-color: #3085d6;
        }

        .btn-primary:hover {
            background-color: #2b79c5;
            border-color: #2b79c5;
        }
    </style>
</head>

<body>
    <!-- Head[Start] -->
    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">Update to BOOKSHELF</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <form method="POST" action="update.php">
        <div class="container">
            <fieldset>
                <legend>詳細・編集</legend>
                <div>
                    <div>
                        <label for="isbn">ISBN:</label>
                        <input type="text" name="isbn" id="isbn" value="<?= h($row["isbn"]) ?>">
                    </div>
                    <div>
                        <label for="name">タイトル:</label>
                        <input type="text" name="name" id="name" value="<?= h($row["name"]) ?>">
                    </div>
                    <div>
                        <label for="author">著者・編者:</label>
                        <input type="text" name="author" id="author" value="<?= h($row["author"]) ?>">
                    </div>
                    <!-- <div>
                        <label for="py">出版年:</label>
                        <input type="text" name="py" id="py" value="<?= h($row["py"]) ?>">
                    </div> -->
                    <div>
                        <label for="tekiyou">摘要:</label>
                        <textarea name="tekiyou" rows="2" cols="32"><?= h($row["tekiyou"]) ?></textarea>
                    </div>
                    <div>
                        <label for="status">ステータス:</label>
                        <select name="status">
                            <option value="" <?php if ($row['status'] == '') echo 'selected'; ?>></option>
                            <option value="未読" <?php if ($row['status'] == '未読') echo 'selected'; ?>>読みたい</option>
                            <option value="読了" <?php if ($row['status'] == '読了') echo 'selected'; ?>>読んだ</option>
                            <option value="読みかけ" <?php if ($row['status'] == '読みかけ') echo 'selected'; ?>>読みかけ</option>
                        </select>
                    </div>
                    <div>
                        <label for="action">アクション:</label>
                        <select name="action">
                            <option value="" <?php if ($row['action'] == '') echo 'selected'; ?>></option>
                            <option value="お気に入り" <?php if ($row['action'] == 'お気に入り') echo 'selected'; ?>>お気に入り</option>
                            <option value="売却予定" <?php if ($row['action'] == '売却予定') echo 'selected'; ?>>売却予定</option>
                            <option value="保留" <?php if ($row['action'] == '保留') echo 'selected'; ?>>保留</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?= h($id) ?>">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-rotate"></i> 更新</button>
                </div>
            </fieldset>
        </div>
    </form>
    <!-- Main[End] -->

</body>

</html>