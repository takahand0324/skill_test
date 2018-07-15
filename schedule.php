<?php
    // ここにDBに接続する処理を記述する
    $dsn = 'mysql:dbname=skill_test;host=localhost';
    // 変数定義
    $user = 'root';
    $password='';
    $dbh = new PDO($dsn, $user, $password);
    $dbh ->query('SET NAMES utf8');

      //   //2.SQL文を実行する
      //   // WHEREはどういう条件か
      //   // 定義しなくても使える変数　スーパーグローバル変数

          if(!empty($_POST)){
        $title = htmlspecialchars($_POST['title']);
        $date = htmlspecialchars($_POST['date']);
        $detail = htmlspecialchars($_POST['detail']);



$sql = 'INSERT INTO `tasks`(`title`,`date`,`detail`)VALUES (?,?,?)';

// $data = [$_POST['nickname'],[$_POST['comment'],[$_POST['created']

// 'created' = now'

// インジェクション
    $data[] = $title;
    $data[] = $date;
    $data[] = $detail;
    $stml = $dbh->prepare($sql);
    $stml->execute($data);
// }


}

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
            <h3><?php echo $_POST['date'];?></h3>
            <div class="content">
              <h3 style="font-weight: bold;"><?php echo $_POST['title'];?></h3>
              <h4><?php echo $_POST['detail'];?></h4>
<?php
// ２．SQL文を実行する
$sql = 'SELECT * FROM `tasks`';
// SQLを実行
$stmt = $dbh->prepare($sql);
$stmt->execute();


while (1) {
  $rec = $stmt->fetch(PDO::FETCH_ASSOC);
  if ($rec == false) {
    break;
  }

  echo $rec['title'] . '<br>';
  echo $rec['date'] . '<br>';
  echo $rec['detail'] . '<br>';
  echo '<hr>';
}

// ３．データベースを切断する
$dbh = null;
?>

            </div>
          </div>

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