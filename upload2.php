<?php
$error=$_FILES['File1']['error'];
$type=$_FILES['File1']['type'];
$size=$_FILES['File1']['size'];
$name=iconv("UTF-8","BIG-5",$_FILES['File1']['name']);
$nameEcho=$_FILES['File1']['name'];
$tmp_name=$_FILES['File1']['tmp_name'];
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>不可重複上傳 限制pdf、mp3、圖片</title>
</head>

<body>
<?php
if($error>0){
	echo "錯誤代碼：".$error."</br>";
	//還沒看出錯誤代碼的用途
}
else{
	$sizemb=round($size/1024000,2);
	echo "檔案類型：".$type."</br>";
	echo "檔案大小：".$sizemb."MB</br>";
	echo "檔案名稱：".$nameEcho."</br>";
	echo "暫存名稱：".$tmp_name."</br>";
	//要新增一個放圖片的資料夾，可以限制檔案格式，也可以不要
	if($type=="application/pdf" || $type=="image/jpeg" || $type=="audio/mp3"){
		if($sizemb < 5){
			if(file_exists("file/".$name)){
				echo "檔案已經存在，請勿重複上傳";
			}
			else{
				move_uploaded_file($tmp_name,"file/".$name);
				echo "上傳成功";
			}
		}	
		else{
			echo "檔案太大，上傳失敗";
		}
	}
	else{
		echo "檔案格式錯誤，上傳失敗";
	}
}
?>
</body>
</html>
