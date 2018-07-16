<?php
    // ここにDBに接続する処理を記述する
    $dsn = 'mysql:dbname=skill_test;host=localhost';
    // 変数定義
    $user = 'root';
    $password='';
    $dbh = new PDO($dsn, $user, $password);
    $dbh ->query('SET NAMES utf8');

// ２．SQL文を実行する
    $sql = 'SELECT * FROM tasks ORDER BY date ASC';
    // SQLを実行
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $comments = array();
    while (1) {
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($rec == false) {
        break;
      }
      $comments[] = $rec;
    }

    // ３．データベースを切断する
    $dbh = null;
?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Skill Test</title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px">

  <div class="container">
    <div class="row">
      <div class="col-xs-10 col-xs-offset-1">

        <h2 class="text-center content_header">タスク管理</h2>


        <div class="col-xs-4">
          <!-- hrefでpost.phpに戻らす -->
          <a href="post.php" class="btn btn-primary button">追加</a>
        </div>

        <div class="col-xs-8">
          <div class="task">
             <?php foreach ($comments as $comment): ?>
              <h3><?php echo $comment ['date']?></h3>
              <div class="content">
              <h3 style="font-weight: bold;"><?php echo $comment ['title']?></h3>
              <h4><?php echo $comment ['detail']?></h4>
               <a href="edit.php?id=<?php echo $comment["id"]; ?>" class="btn btn-success" style="color: white">編集</a>
                   <a href="delete.php?id=<?php echo $comment["id"]; ?>" class="btn btn-danger" style="color: white">削除</a>
            </div>
           <?php endforeach; ?>
          </div>
        </div>
      </div>

    </div>
  </div>


  <script src="assets/js/jquery-3.1.1.js"></script>
  <script src="assets/js/jquery-migrate-1.4.1.js"></script>
  <script src="assets/js/bootstrap.js"></script>
</body>
</html>