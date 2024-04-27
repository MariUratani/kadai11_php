<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <title>ログイン</title>
  <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
  <script src="https://kit.fontawesome.com/e53e6d346a.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }

    input[type="text"],
    input[type="password"] {
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

    .login-container {
      max-width: 400px;
      margin: 0 auto;
    }

    .login-container fieldset {
      margin-top: 30px;
    }

    .login-container label {
      display: block;
      margin-bottom: 5px;
    }

    .login-container input[type="text"],
    .login-container input[type="password"] {
      width: 100%;
      margin-bottom: 10px;
    }

    .login-container input[type="submit"] {
      margin-top: 10px;
    }

    /* .password-wrapper {
      position: relative;
    }

    .password-toggle {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
    } */
  </style>
</head>

<body>
  <!-- Head[Start] -->
  <header>
    <nav class="navbar">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="login.php">LOGIN</a>
        </div>
      </div>
    </nav>
  </header>
  <!-- Head[End] -->

  <!-- Main[Start] -->
  <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
  <!-- ログインフォーム -->
  <form method="post" action="login_act.php">
    <div class="login-container">
      <fieldset>
        <legend>アカウントをお持ちの方はこちら</legend>
        <div>
          <div>
            <label for="lid_login">ID:</label>
            <input type="text" name="lid" id="lid_login" required>
            <!-- <label for="lid">ID:</label>
            <input type="text" name="lid" id="lid" required> -->
          </div>
          <div>
            <label for="lpw_login">PW:</label>
            <input type="password" name="lpw" id="lpw_login" autocomplete="current-password" required>
            <i class="fa fa-eye password-toggle" aria-hidden="true"></i>
          </div>

          <!-- <label for="lpw_reg">Login PW:</label>
          <input type="password" name="lpw" id="lpw_reg" required>
          <i class="fa fa-eye password-toggle" aria-hidden="true"></i> -->
          <!-- <label for="lpw">PW:</label>
            <input type="password" name="lpw" id="lpw" autocomplete="current-password" required> -->
          <!-- <input type="password" name="lpw" id="lpw" required> -->
          <!-- <i class="fa fa-eye password-toggle" aria-hidden="true"></i> -->
        </div>
        <button type="submit" class="btn btn-primary">
          <i class="fa fa-sign-in" aria-hidden="true"></i> ログイン
        </button>
    </div>
    </fieldset>
    </div>
  </form>
  <!-- ユーザー登録フォーム -->
  <form id="registrationForm">
    <div class="login-container">
      <fieldset>
        <legend>新規アカウント登録はこちら</legend>
        <div>
          <label for="username">User Name:</label>
          <input type="text" name="username" id="username" required>
        </div>

        <div>
          <label for="email">E-mail:</label>
          <input type="text" name="email" id="email" required>
        </div>
        <div>

          <label for="lid_reg">Login ID:</label>
          <input type="text" name="lid" id="lid_reg" required>
          <!-- <label for="lid">Login ID:</label>
          <input type="text" name="lid" id="lid" required> -->
        </div>
        <div>
          <label for="lpw_reg">Login PW:</label>
          <input type="password" name="lpw" id="lpw_reg" required>
          <i class="fa fa-eye password-toggle" aria-hidden="true"></i>
        </div>
        <div>
          <label>管理区分:</label>
          <label><input type="radio" name="kanri_flg" value="0" checked>一般ユーザー</label>
          <label><input type="radio" name="kanri_flg" value="1">システム管理者</label>
        </div>
        <!-- <button type="submit" class="btn btn-primary">新規アカウント登録</button> -->
        <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus"></i> アカウント登録
        </button>

      </fieldset>
    </div>
  </form>
  <!-- Main[End] -->

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const passwordToggles = document.querySelectorAll('.password-toggle');
    passwordToggles.forEach(function(toggle) {
      toggle.addEventListener('click', function() {
        const passwordInput = this.previousElementSibling;
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          this.classList.remove('fa-eye');
          this.classList.add('fa-eye-slash');
        } else {
          passwordInput.type = 'password';
          this.classList.remove('fa-eye-slash');
          this.classList.add('fa-eye');
        }
      });
    });

    const registrationForm = document.getElementById('registrationForm');
    registrationForm.addEventListener('submit', function(event) {
      event.preventDefault();

      const username = document.getElementById('username').value;
      const email = document.getElementById('email').value;
      const lid = document.getElementById('lid_reg').value; // idが変更された要素の参照
      const lpw = document.getElementById('lpw_reg').value; // idが変更された要素の参照
      const kanri_flg = document.querySelector('input[name="kanri_flg"]:checked').value;

      if (!username || !email || !lid || !lpw) {
        Swal.fire('エラー', '全ての項目を入力してください。', 'error');
        return;
      }

      if (!isValidEmail(email)) {
        Swal.fire('エラー', '有効なメールアドレスを入力してください。', 'error');
        return;
      }

      Swal.fire({
        title: '確認',
        text: email + ' で登録します。よろしいですか？',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'はい',
        cancelButtonText: 'いいえ'
      }).then((result) => {
        if (result.isConfirmed) {
          const formData = new FormData();
          formData.append('username', username);
          formData.append('email', email);
          formData.append('lid', lid);
          formData.append('lpw', lpw);
          formData.append('kanri_flg', kanri_flg);

          fetch('user_insert.php', {
              method: 'POST',
              body: formData
            })
            .then(response => response.text())
            .then(data => {
              Swal.fire('登録完了', 'ユーザー登録が完了しました。', 'success');
              registrationForm.reset();
            })
            .catch(error => {
              console.error('Error:', error);
              Swal.fire('エラー', 'ユーザー登録に失敗しました。', 'error');
            });
        }
      });
    });

    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }
  });
</script>
</body>

</html>