<?php
/*
changken-phpforum v9.2
Author:changken(admin@changken.biz)
*/

/*=========================================================
	login function
	cpf_login(string username,string password);
===========================================================*/
function cpf_login($ty_username,$ty_password)
{	
	global $conn,$config,$prefix;
	
	//過濾資料
	$username = mysqli_real_escape_string($conn,$ty_username);
	$password = mysqli_real_escape_string($conn,$ty_password);
	$password_md5 = md5($password);//密碼加密

	//搜尋資料庫資料
	$row = cpf_getUserInfo($username,1);

	//判斷帳號與密碼是否為空白
	//以及MySQL資料庫裡是否有這個會員
	if($username==null)//檢查使用者名稱是否為空
	{
		$returnCode = 0;
	}
	elseif($password==null)//檢查密碼是否為空
	{
		$returnCode = 1;
	}
	elseif($row[1] != $username)//檢查使用者名稱是否錯誤
	{
		$returnCode = 2;
	}
	elseif($row[3] != $password_md5)//檢查密碼是否錯誤
	{
		$returnCode = 3;
	}
	else //如不符合以上條件，即進入此區
	{
		if($row[4] == 10){ //檢查會員權限是否是10
			//將帳號寫入session，方便驗證使用者身份
			$_SESSION[$config["cookie_prefix"].'username'] = $username;
			$returnCode = 4;
		}
		else if($row[4] == 100){ //檢查會員權限是否是100
			//將帳號寫入session，方便驗證使用者身份
			$_SESSION[$config["cookie_prefix"].'username'] = $username;
			$_SESSION[$config["cookie_prefix"].'admin'] = $username;
			$returnCode = 5;
		}
		else if($row[4] == 50){ //檢查會員權限是否是50
			//將帳號寫入session，方便驗證使用者身份
			$_SESSION[$config["cookie_prefix"].'username'] = $username;
			$_SESSION[$config["cookie_prefix"].'mod'] = $username;
			$returnCode = 6;
		}
		else //極有可能為level欄為空or值不對！
		{
			$returnCode = 7;
		}
	}
	return $returnCode;
}

/*=========================================================
	logout function
	cpf_logout();
===========================================================*/
function cpf_logout()
{
	global $config;
	//將session清空
	unset($_SESSION[$config["cookie_prefix"].'admin']);
	unset($_SESSION[$config["cookie_prefix"].'mod']);
	unset($_SESSION[$config["cookie_prefix"].'username']);
	return true;
}

/*=========================================================
	register function
	cpf_reg(string username,string email,string password,string password_again,int level);
===========================================================*/
function cpf_reg($ty_username,$ty_email,$ty_password,$ty_password2,$ty_level)
{
	global $conn,$prefix;
	
	//過濾使用者輸入的資料
	$username = mysqli_real_escape_string($conn,$ty_username);
	$email = mysqli_real_escape_string($conn,$ty_email);
	$password = mysqli_real_escape_string($conn,$ty_password);
	$password2 = mysqli_real_escape_string($conn,$ty_password2);
	$level = $ty_level;//開發者自行輸入
	
	$password_md5 = md5($password);//密碼加密
	
	//搜尋資料庫資料
	$row = cpf_getUserInfo($username,1);

	//判斷帳號密碼是否為空值
	//確認密碼輸入的正確性
	if($username==null)//檢查使用者名稱是否為空
	{
			$returnCode = 0;
	}
	elseif($password==null)//檢查密碼是否為空
	{
			$returnCode = 1;
	}
	elseif($password2==null)//檢查密碼(再輸入一次)是否為空
	{
			$returnCode = 2;
	}
	elseif($password!=$password2)//檢查密碼是否輸入一致
	{
			$returnCode = 3;
	}
	elseif($username==$row[1])//檢查使用者名稱是否已經被使用了
	{
			$returnCode = 4;
	}
	else
	{
        //新增資料進資料庫語法
        $sql = "INSERT INTO `".$prefix."user` (`username`, `email`, `password`, `level`) VALUES ('$username', '$email', '$password_md5', '$level');";
        if(mysqli_query($conn,$sql))
        {
			$returnCode = 5;
        }
        else
        {
			$returnCode = 6;
        }
	}
	return $returnCode;
}

/*=========================================================
	Update information function
	cpf_update(string username,string email,string password,string password2,int level);
===========================================================*/
function cpf_update($ty_username,$ty_email,$ty_password,$ty_password2,$ty_level)
{
	global $conn,$prefix;
	
	//過濾使用者輸入的資料
	$username = mysqli_real_escape_string($conn,$ty_username);
	$email = mysqli_real_escape_string($conn,$ty_email);
	$level = $ty_level;//開發者自行輸入
	
	//如果使用者沒有輸入密碼及密碼(再輸入一次)的話，就用維持原樣
	if($ty_password == null and $ty_password2 == null)
	{
		$row = cpf_getUserInfo($username,1);
		$password = $row['password'];
		$password2 = $row['password'];
	}
	else //如果有輸入，就用原本
	{
		$password = mysqli_real_escape_string($conn,$ty_password);
		$password2 = mysqli_real_escape_string($conn,$ty_password2);
	}
	
	$password_md5 = md5($password);//密碼加密

	//判斷帳號密碼是否為空值
	//確認密碼輸入的正確性
	if($password==null)//檢查密碼是否為空
	{
		$returnCode = 0;
	}
	elseif($password2==null)//檢查密碼(再輸入一次)是否為空
	{
		$returnCode = 1;
	}
	elseif($password!=$password2)//檢查密碼是否輸入一致
	{
		$returnCode = 2;
	}
	else
	{
		//更新資料庫資料語法
		$sql = "UPDATE `".$prefix."user` SET `password`='$password_md5', `email`='$email', `level`='$level' WHERE `username`='$username';";
		if(mysqli_query($conn,$sql))
		{
			$returnCode = 3;
		}
		else
		{
			$returnCode = 4;
		}
	}
	return $returnCode;
}

/*=========================================================
	Get User information function
	cpf_getUserInfo(string value,int type);
	type = 1 => username
	type = other(2) => NO
===========================================================*/
function cpf_getUserInfo($value,$type = 1)
{
	global $conn,$prefix;
	
	if($type == 1)
	{
		$sql = "SELECT * FROM `".$prefix."user` WHERE `username` = '$value';";
	}
	else
	{
		$sql = "SELECT * FROM `".$prefix."user` WHERE `NO` = '$value';";
	}
	//搜尋資料庫資料
	$result = mysqli_query($conn,$sql);
	$row = @mysqli_fetch_array($result);
	return $row;
}

/*=========================================================
	Check User information function
	cpf_check(string username);
===========================================================*/
function cpf_check($ty_username)
{
	global $conn,$prefix;
	//搜尋資料庫資料
	$row = cpf_getUserInfo($ty_username,1);

	if($ty_username==null)//檢查使用者名稱是否為空
	{
		$returnCode = 0;
	}
	elseif($row[1]==null)//檢查使用者名稱是否已經被使用了
	{
		$returnCode = 1;
	}
	elseif($row[1]!=null)//檢查使用者名稱是否已經被使用了
	{
		$returnCode = 2;
	}
	else //系統有問題
	{
		$returnCode = 3;
	}
	return $returnCode;
}
?>