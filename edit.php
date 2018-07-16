<?php
    $dsn = 'mysql:dbname=skill_test;host=localhost';
    // 変数定義
    $user = 'root';
    $password='';
    $dbh = new PDO($dsn, $user, $password);
    $dbh ->query('SET NAMES utf8');

    $id = $_GET['id'];

        //.SQL文を実行する
    // 削除する処理
    $sql = 'SELECT* FROM `tasks` WHERE `id` = ?';
    $data[] = $id;
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);


    $comment = $stmt->fetch(PDO::FETCH_ASSOC);

    // $date = $_POST['date'];
    // $title = $_POST['title'];
    // $detail = $_POST['detail'];
    // $id = $_POST['id'];


    //.SQL文を実行する
    // $sql = 'UPDATE `posts` SET `nickname` = "' . $nickname . '", `comment` = "' . $comment . '" WHERE `id` = ' . $id;
 if(!empty($_POST)){
        $date = htmlspecialchars($_POST['date']);
        $title = htmlspecialchars($_POST['title']);
        $id = htmlspecialchars($_POST['id']);
        $detail = htmlspecialchars($_POST['detail']);

    $update_sql = 'UPDATE `tasks` SET `date`= ?,`title` = ?, `detail` = ? WHERE `id` = ?';
    $update_data[] = $date;
    $update_data[] = $title;
    $update_data[] = $detail;
    $update_data[] = $id;
    // $data = [$nickname, $comment, $id];
    $update_stmt = $dbh->prepare($update_sql);
    $update_stmt->execute($update_data);

    // var_dump($_POST);


    // データベースを切断する
    $dbh = null;

        // 戻る時の処理を書く
    // リダイレクト(他のページに飛ばす)
    header("Location: schedule.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>スキルテスト</title>

  <!-- CSS -->
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px">
  <div class="container">
    <div class="row">
      <div class="col-xs-8 col-xs-offset-2 thumbnail">
        <h2 class="text-center content_header">タスク追加</h2>

<!-- method acrion送り先 name情報の名前 を書き換える -->
        <form method="post" action="">
          <div class="form-group">
            <label for="task">タスク</label>
            <input type = "text" name="title" class="form-control">
          </div>
          <input type="hidden" name="id" value="<?php echo $comment['id'] ?>">
          <div class="form-group">
            <label for="date">日程</label>
            <input type="date" name="date" class="form-control">
          </div>
          <div class="form-group">
            <label for="detail">詳細</label>
            <textarea name="detail" class="form-control" rows="3"></textarea><br>
          </div>
          <input type="submit" class="btn btn-primary" value="投稿">
        </form>

      </div>
    </div>
  </div>
  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>