<?php
require 'connect.php';
//表示
$sql = 'SELECT * FROM file_table';
$stmt = $pdo->query($sql);
//var_dump($stmt);
$results = $stmt->fetchAll();
/* foreach ($results as $row){
  print_r($row);
echo "<hr>";
} */

//エスケープfunction
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
}

?>

<!-- ①フォームの説明 -->
<!-- ②$_FILEの確認 -->
<!-- ③バリデーション -->
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>アップロードフォーム</title>
  </head>
  <style>
    body {
      padding: 30px;
      margin: 0 auto;
      width: 50%;
    }
    textarea {
      width: 98%;
      height: 60px;
    }
    .file-up {
      margin-bottom: 10px;
    }
    .submit {
      text-align: right;
    }
    .btn {
      display: inline-block;
      border-radius: 3px;
      font-size: 18px;
      background: #67c5ff;
      border: 2px solid #67c5ff;
      padding: 5px 10px;
      color: #fff;
      cursor: pointer;
    }
    img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    }

    .img-container--table-cell {
    position: relative;
    width: 600px;
    height: 600px;
    display: table-cell;
    vertical-align: middle;
    text-align: center;
    border: 1px solid darkgray;
    img {
    vertical-align: middle;
    }
    }


    
  </style>
  <body>
    <form enctype="multipart/form-data" action="file_upload.php" method="POST">
      <div class="file-up">
        <input type="hidden" name="MAX_FILE_SIZE" value="5242880" />
        <input name="img" type="file" accept="image/*" />
      </div>
      <div>
        <textarea
          name="caption"
          placeholder="キャプション（140文字以下）"
          id="caption"
        ></textarea>
      </div>
      <div class="submit">
        <input type="submit" value="送信" class="btn" />
      </div>
    </form>
    <div>
    <?php foreach($results as $row): ?>

      <div class="img-container--table-cell">
    <img src="<?php echo "{$row['file_path']}" ;?>" />
  </div>

    <!-- <img src="<?php //echo "{$row['file_path']}" ;?>" alt=""> -->
    <p><?php echo  h("{$row['description']}") ;?></p>
    <?php endforeach; ?>
    </div>
  </body>
</html>
