<?php
$error=$_FILES['File1']['error'];
$type=$_FILES['File1']['type'];
$size=$_FILES['File1']['size'];
$name=iconv("UTF-8","BIG-5",$_FILES['File1']['name']);
$nameEcho=$_FILES['File1']['name'];
$tmp_name=$_FILES['File1']['tmp_name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>自動改檔名、任何檔案</title>
</head>

<body>
<?php
if($error>0){
	echo "錯誤代碼：".$error."</br>";
}
else{
	$sizemb=round($size/1024000,2);
	echo "檔案類型：".$type."</br>";
	echo "檔案大小：".$sizemb."MB</br>";
	echo "檔案名稱：".$nameEcho."</br>";
	echo "暫存名稱：".$tmp_name."</br>";

	if($sizemb < 5){
			$file=explode(".",$name);
			$new_name=$file[0]."-".date(ymdhis)."-".rand(0,10);
			$chi_name=iconv("BIG-5","UTF-8",$new_name);
			echo "</br>已修改為新檔名:".$chi_name."後上傳成功";
			move_uploaded_file($tmp_name,"file/".$new_name.".".$file[1]);
			echo "上傳成功";
			//這個改檔名是在後面加上時間
	}	
	else{
		echo "檔案太大，上傳失敗";
	}
}
?>
</body>
</html>
