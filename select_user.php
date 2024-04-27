<?php
session_start();
include("funcs.php");
$pdo = db_conn();

// ログインチェック
sschk();

// 書籍情報の取得
$stmt = $pdo->prepare("SELECT * FROM my_bm_table ORDER BY id ASC");
$status = $stmt->execute();

if ($status == false) {
    sql_error($stmt);
}

$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>書籍一覧</title>
    <style>
        .book-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }
        .book-item {
            border: 1px solid #ccc;
            padding: 10px;
        }
        .book-cover img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1>書籍一覧</h1>
        <nav>
            <ul>
                <li><a href="logout.php">ログアウト</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="book-list">
            <?php foreach ($books as $book): ?>
                <div class="book-item">
                    <div class="book-cover">
                        <?php displayImage($book['isbn']); ?>
                    </div>
                    <div class="book-details">
                        <h2><?= $book['name'] ?></h2>
                        <p>著者・編者: <?= $book['author'] ?></p>
                        <p>出版年: <?= $book['py'] ?></p>
                        <p>ISBN: <?= $book['isbn'] ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>

    <footer>
        <p>&copy; 2023 My Bookshelf. All rights reserved.</p>
    </footer>
</body>
</html>

<?php
// 画像のキャッシュと表示
// function displayImage($isbn) {
//     $cacheDir = '/path/to/cache/directory/';
//     $cachePath = $cacheDir . $isbn . '.jpg';

//     if (file_exists($cachePath)) {
//         // キャッシュされた画像があれば、それを表示
//         echo '<img src="' . $cachePath . '" alt="Book Cover">';
//     } else {
//         // キャッシュされた画像がない場合、APIから取得
//         $apiUrl = 'https://ndlsearch.ndl.go.jp/thumbnail/' . $isbn . '.jpg';
//         $imageData = file_get_contents($apiUrl);

//         if ($imageData !== false) {
//             // 画像の保存
//             file_put_contents($cachePath, $imageData);
//             echo '<img src="' . $cachePath . '" alt="Book Cover">';
//         } else {
//             // APIから取得できない場合、デフォルト画像を表示
//             echo '<img src="/path/to/default/image.jpg" alt="Default Cover">';
//         }
//     }
// }

function displayImage($isbn) {
    $cacheDir = '/path/to/cache/directory/';
    $cachePath = $cacheDir . $isbn . '.jpg';

    if (file_exists($cachePath)) {
        echo "キャッシュされた画像が見つかりました: " . $cachePath . "<br>";
        echo '<img src="' . $cachePath . '" alt="Book Cover">';
    } else {
        echo "キャッシュされた画像が見つかりませんでした。APIから取得します。<br>";
        $apiUrl = 'https://ndlsearch.ndl.go.jp/thumbnail/' . $isbn . '.jpg';
        $imageData = file_get_contents($apiUrl);

        if ($imageData !== false) {
            echo "APIから画像を取得しました。<br>";
            file_put_contents($cachePath, $imageData);
            echo '<img src="' . $cachePath . '" alt="Book Cover">';
        } else {
            echo "APIから画像を取得できませんでした。デフォルト画像を表示します。<br>";
            echo '<img src="/path/to/default/image.jpg" alt="Default Cover">';
        }
    }
}




?>