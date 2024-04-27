<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>データ登録</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <div class="navbar-header"><a class="navbar-brand" href="select.php">Add to BOOKSHELF</a></div>
      </div>
    </nav>
  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->
  <form method="POST" action="insert.php" id="registrationForm">
    <!-- <form method="POST" action="insert.php"> -->
    <div class="container">
      <fieldset>
        <!-- <legend>BOOKSHELF</legend> -->
        <div>
          <div id="bookInfo">
            <div>
              <label for="isbn">ISBN(13桁):</label>
              <label><input type="text" name="isbn" id="isbn" required pattern="\d{13}"></label><br>
              <!-- <label>ISBN：<input type="text" name="isbn" id="isbn" required pattern="\d{13}"></label><br> -->
            </div>
            <div>
              <label for="name">タイトル:</label>
              <input type="text" name="name" id="name" readonly>
            </div>
            <div>
              <label for="author">著者・編者:</label>
              <input type="text" name="author" id="author" readonly>
            </div>
            <!-- <div>
              <label for="py">出版年:</label>
              <input type="text" name="py" id="py" readonly>
            </div> -->
            <div>
              <label for="tekiyou">摘要:</label>
              <textarea name="tekiyou" rows="2" cols="32"></textarea>
            </div>
            <div>
              <label for="status">ステータス:</label>
              <select name="status">
                <option value=""></option>
                <option value="未読">読みたい</option>
                <option value="読了">読んだ</option>
                <option value="読みかけ">読みかけ</option>
              </select>
            </div>
            <div>
              <label for="action">アクション:</label>
              <select name="action">
                <option value=""></option>
                <option value="お気に入り">お気に入り</option>
                <option value="売却予定">売却予定</option>
                <option value="保留">保留</option>
              </select>
            </div>
            <!-- 登録ボタンのonclickイベント -->
            <input type="submit" value="登録" class="btn btn-primary">
      </fieldset>
    </div>
  </form>
  <!-- Main[End] -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  <script src="script.js"></script>
  <script>
    document.getElementById('registrationForm').addEventListener('submit', function(event) {
      event.preventDefault(); // フォームのデフォルトの送信を防ぐ

      // 入力値を取得
      var title = document.getElementById('name').value;

      // 確認ダイアログを表示
      Swal.fire({
        title: '登録確認',
        text: `「${title}」を登録しますか？`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: '登録',
        cancelButtonText: 'キャンセル'
      }).then((result) => {
        if (result.isConfirmed) {
          // 確認ダイアログで「登録」が選択された場合に、フォームを送信
          event.target.submit();
        }
      });
    });
  </script>
</body>
</html>