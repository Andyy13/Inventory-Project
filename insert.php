<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventarymgt";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

if(isset($_POST['ChangePasswd']))
{
	$Passwd1=md5($_POST['Passwd1']);
	$Passwd2=md5($_POST['Passwd2']);
	$UserID=$_COOKIE['Conf-Meeting-Login'];
	if($Passwd1==$Passwd2)
	{
		$QueryStr="update  Users set Passwd='$Passwd1'  where UserID='$UserID'";
		//echo $QueryStr;
		$conn->query($QueryStr);
		echo "Password Changed Successfully";
	}
	else
	{
		echo "Password Not Matched";
		$ResetFailure=1;
	}
}


if(isset($_POST['LogOut']))
{
 	unset($_COOKIE['Conf-Meeting-Login']);	
 	unset($_COOKIE['Login-Name']);	
 	unset($_COOKIE['UserType']);	
	setcookie("Conf-Meeting-Login", "", time()-3600);
	setcookie ("Login-Name", "", time()-3600);
	setcookie ("UserType", "", time()-3600);

}
else if(isset($_POST['Login']))
{
	$UserName=$_POST['UserName'];
	$Passwd=md5($_POST['Passwd']);
	
		$QueryStr="select * from Users where UserID='$UserName' and Passwd='$Passwd'";
		//echo $QueryStr;
		$row=$conn->query($QueryStr);
		if($row->num_rows>0)
		{
			$IsLogin=1;
			$a=$row->fetch_assoc();
			$LoginName=$a['Name'];
			$UserType=$a['UserType'];
			setcookie ("Conf-Meeting-Login", $UserName, time() + 3600);
			setcookie ("Login-Name", $LoginName, time() + 3600);
			setcookie ("UserType", $UserType, time() + 3600);
			//echo $UserType;

			
			
		}	
		else
		{
			
			$LoginFailure=1;
		}	
	
}


?>
<div align="center" style="font-size:20px;" ><b>Inventary System</div>
<?php
if(!isset($_COOKIE['Conf-Meeting-Login']) && !isset($IsLogin))
{
?>
<br>
<body>
<table width="100%">
<form action="index.php" name="LoginForm" method="POST">
<?php
if(isset($LoginFailure))
{
	echo"<tr>
	<td align='center' style='color:red;'>LogIn Failed</td>
	</tr>";
}
if(isset($ResetFailure))
{
	echo"<tr>
	<td align='center' style='color:red;'>Both Passwords didn't match</td>
	</tr>";
}
?>
<tr>
<td align="center"> <b>UserName: 
<input Type="text" id="UserName" name="UserName">
</td>
</tr>
<tr>
<td align="center"><b>Password : <input Type="password" id="Passwd" name="Passwd">
</td>
</tr>
<tr>
<td  align="center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input Type="Submit" id="Login" name="Login" value="Login">
</td>
</tr>
<tr>
<td align="center"  style='display:none'><input Type="Submit" id="ResetPassword" name="ResetPassword" value="ResetPassword">
</td>
</tr>
<?php
?>
</form>
<?php
}
else
{
if(isset($_COOKIE['UserType']))
{
	$UserType=$_COOKIE['UserType'];
	
}



if(isset($_COOKIE['Conf-Meeting-Login']))
{
	//echo"Welcome  Mr ".$_COOKIE['Conf-Meeting-Login'];
	$LoginName=$_COOKIE['Login-Name'];
	$UserName=$_COOKIE['Conf-Meeting-Login'];
	
}
else if(isset($IsLogin))
{
	//echo"Welcome  Mr ".$UserName;
	
}

?>
<!--body style="background-image:url(GuestHouse.JPG)"-->
<table align='right'>
<form id='ChangeForm' Name='ChangeForm' action='index.php' method='POST'>
<tr><td align='right' ><b>Welcome  Mr <?php echo $LoginName;?></b></td></tr><tr><td align='right' ><input Type='Submit' id='ChangePassword' name='ChangePassword' value='ChangePassword'>
<input Type="submit" name="LogOut" value="LogOut"></td></tr>
</form>
</table>
</td>
</tr>
</table>
<form id="MainForm" Name="MainForm" action="index.php" method="POST">
<input type="hidden" id="PageNumber" Name="PageNumber" value="0">
</form>
</body>
<?php
if(isset($_POST['ChangePassword']))
{
//echo"------------";
?>
<form action="index.php" name="LoginForm" method="POST">
<table width="100%">
<tr>
<td align="center">Password: 
<input Type="password" id="Passwd1" name="Passwd1">
</td>
</tr>
<tr>
<td align="center">ReEnter: <input Type="password" id="Passwd2" name="Passwd2">
</td>
</tr>
<tr>
<td  align="center" ><input Type="Submit"  name="ChangePasswd" value="Change">
</td>
</tr>
</table>
<?php
}
}
?>