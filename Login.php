<script>
function ChangePage(PageNum)
{
	document.getElementById("PageNumber").value=PageNum;
	document.getElementById("MainForm").submit();
}
</script>
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
	$UserID=$_COOKIE['LoginID'];
	if($Passwd1==$Passwd2)
	{
		$QueryStr="update  Users set Passwd='$Passwd1'  where UserID=$UserID";
		//echo $QueryStr;
		$conn->query($QueryStr);
		echo"<script>alert('Password Changed Successfully')</script>";
		//echo "Password Changed Successfully";
	}
	else
	{
		//echo "Password Not Matched";
		echo"<script>alert('Both Passwords Not Matched')</script>";
		$ResetFailure=1;
	}
}


if(isset($_POST['LogOut']))
{
 	unset($_COOKIE['LoginID']);	
 	unset($_COOKIE['Dept-Name']);	
 	unset($_COOKIE['UserType']);	
	setcookie("LoginID", "", time()-3600);
	setcookie ("Dept-Name", "", time()-3600);
	setcookie ("UserType", "", time()-3600);

}
else if(isset($_POST['Login']))
{
	$UserName=$_POST['UserName'];
	$Passwd=md5($_POST['Passwd']);
	
		$QueryStr="select * from Users where UserID=$UserName and Passwd='$Passwd'";
		//echo $QueryStr;
		$row=$conn->query($QueryStr);
		if($row->num_rows>0)
		{
			$IsLogin=1;
			$a=$row->fetch_assoc();
			$UserID=$a['UserID'];
			$DeptName=$a['Department'];
			$UserType=$a['UserType'];
			$Dept_CD=$UserID;
			$Dept_Name=$DeptName;
			setcookie ("LoginID", $UserID, time() + 3600);
			setcookie ("Dept-Name", $DeptName, time() + 3600);
			setcookie ("UserType", $UserType, time() + 3600);
			//echo $UserType;

			
			
		}	
		else
		{
			
			$LoginFailure=1;
		}	
	
}


?>

<?php
if(!isset($_COOKIE['LoginID']) && !isset($IsLogin))
{
?>
<div align="center" style="font-size:20px;color:red" ><b>CET Inventory System</div>
<br>
<body style="background-image:url(inventory-management.jpg);background-repeat:no-repeat;background-size: cover;">
<table width="100%" >
<form action="Login.php" name="LoginForm" method="POST">
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
$DeptQueryStr="select UserID,Department from Users order by Department";
$Deptrow=$conn->query($DeptQueryStr);
?>
<tr>
<td style="text-align:center;"> <b>Department: 
<!--input Type="text" id="UserName" name="UserName"--!>
<select id="UserName" name="UserName">
<?php
while($row=$Deptrow->fetch_assoc())
{
	$Dept_cd=$row['UserID'];
	$Dept_Name=$row['Department'];
	echo "<option value='$Dept_cd'>$Dept_Name</option>";
}
?>
</select></td>

</tr>
<tr>
<td style="text-align:center;" ><b>Password : <input Type="password" id="Passwd" name="Passwd"></td>

</tr>
<tr>
<td  style="text-align:center" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input Type="Submit" id="Login" name="Login" value="Login">
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



if(isset($_COOKIE['LoginID']))
{
	//echo"Welcome  Mr ".$_COOKIE['Conf-Meeting-Login'];
	$UserID=$_COOKIE['LoginID'];
	$DeptName=$_COOKIE['Dept-Name'];
	
}
else if(isset($IsLogin))
{
	//echo"Welcome  Mr ".$UserName;
	
}

?>
<!--body style="background-image:url(GuestHouse.JPG)"-->
<table align='right' style="color:red;font-size:20">
<form id='ChangeForm' Name='ChangeForm' action='Login.php' method='POST'>
<tr><td align='right' ><b>Welcome  To <?php echo $DeptName;?></b></td></tr><tr><td align='right' ><input Type='Submit' id='ChangePassword' name='ChangePassword' value='ChangePassword'>
<input Type="submit" name="LogOut" value="LogOut"></td></tr>
</form>
</table>
</td>
</tr>
</table>
<form id="MainForm" Name="MainForm" action="Login.php" method="POST">
<input type="hidden" id="PageNumber" Name="PageNumber" value="0">
</form>
</body>
<?php
if(isset($_POST['ChangePassword']))
{
//echo"------------";
?>

<table width="100%">
<form action="Login.php" name="PasswdReset" id="PasswdReset" method="POST">
<tr>
<td align="center">Password: 
<input Type="password" id="Passwd1" name="Passwd1" required>
</td>
</tr>
<tr>
<td align="center">ReEnter: <input Type="password" id="Passwd2" name="Passwd2" required>
</td>
</tr>
<tr>
<td  align="center" ><input Type="Submit"  name="ChangePasswd" value="Change">
</form>
<input Type="Submit"  name="CancelAction" value="Cancel" onclick="ChangePage(3)">
</td>
</tr>
</table>

<?php
}
else
{
include "index.php";
}
}
?>