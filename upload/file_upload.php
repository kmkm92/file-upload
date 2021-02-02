<?php
require 'connect.php';

//fileの概要
$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$file_err = $file['error'];
$filesize = $file['size'];
$caption = $_POST['caption'];
$upload_dir = 'images/';
$save_filename = date('YmdHis') . $filename;
$err_msgs = array();
$save_path = $upload_dir.$save_filename;

//文が入力されているか
if(empty($caption)){
    array_push($err_msgs, '文章が未入力です。');
    //echo '文章が未入力です。'.'<br>';
}
//140文字以内か
if(strlen($caption) > 140){
    array_push($err_msgs, '140字以内で入力してください。');
    //echo '140字以内で入力してください。'.'<br>';
}

//ファイルサイズが3MB未満か
if($filesize > 5242880 || $file_err==2){
    array_push($err_msgs, 'ファイルサイズは5MB未満にしてください。');
    //echo 'ファイルサイズは5MB未満にしてください。'.'<br>';
}
//拡張子は？
$allow_ext = array('jpg','jpeg','png');
$file_ext = pathinfo($filename,PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext),$allow_ext)){
    //echo '画像ファイルを添付してください。'.'<br>';
}

if(count($err_msgs) === 0){
//ファイルはあるか
    if(is_uploaded_file($tmp_path)){
        if(move_uploaded_file($tmp_path, $save_path)){
            echo $filename.'を'.$upload_dir.'にアップしました。'.'<br>';
            
            //DBに保存
            //$result = fileSave($filename, $save_path, $caption);
            $sql = $pdo -> prepare("INSERT INTO file_table (file_name, file_path, description) VALUES (:file_name, :file_path, :description)");
	        $sql -> bindValue(':file_name', $filename, PDO::PARAM_STR);
            $sql -> bindValue(':file_path', $save_path, PDO::PARAM_STR);
            $sql -> bindValue(':description', $caption, PDO::PARAM_STR);
            $sql -> execute();



        }else{
            echo 'ファイルを保存できませんでした。';
        }
        
    }else{
        echo 'ファイルが選択されていません。';
    }

}else{
    foreach($err_msgs as $msg){
        echo $msg."<br>";
    }
}

?>

<a href= "./upload_form.php">戻る</a>