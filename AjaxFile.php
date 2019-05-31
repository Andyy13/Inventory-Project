
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventarymgt";
$dbname1 = "meetingroomdb";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
// Create connection-2
$conn1 = new mysqli($servername, $username, $password, $dbname1);
// Check connection
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
} 

	$IndvQuery="select * from users";
	$DeptQuery="select * from users order  by Department";

	$IndvQueryResult=$conn1->query($IndvQuery);
	$NameVsPnoArray="";
	while($row=$IndvQueryResult->fetch_assoc())
	{
		$NameVsPnoArray[$row['UserID']]	=$row['Name'];
	}
	$DeptQuery1="select * from users";
	$DeptResult1=$conn->query($DeptQuery);
	while($row=$DeptResult1->fetch_assoc())
	{
		$NameVsPnoArray[$row['UserID']]	=$row['Department'];
	}


if(isset($_GET['ConfirmDelivery']))
{
	$ItemID=$_GET['ConfirmDelivery'];
	$HistoryID=$_GET['HistoryID'];
	$ActionType=$_GET['ActionType'];
	$DateOfDelivery=date("Y-m-d");
	//echo "update itemhistory set DateOfDelivery='$DateOfDelivery',DeliveryStatus=1 where ItemID=$ItemID and HistoryID=$HistoryID";
	if($ActionType==1)
	{
		$conn->query("update itemhistory set DateOfDelivery='$DateOfDelivery',DeliveryStatus=1 where ItemID=$ItemID and HistoryID=$HistoryID");
	}
	else
	{
		$conn->query("update itemhistory set DeliveryStatus=2 where ItemID=$ItemID and HistoryID=$HistoryID");
	}
	
	
}

if(isset($_GET['ShowDetails']))
{
	$InvItemID=$_GET['ShowDetails'];
	$ST_DT=$_GET['ST_DT'];
	$END_DT=$_GET['END_DT'];
	$Reason=$_GET['Reason'];
	$ItemQuery="select Name from itemdescription where ItemID=$InvItemID"; 
	$QueryResult1=$conn->query($ItemQuery);
	$Row1=$QueryResult1->fetch_assoc();
	$ItemName=$Row1['Name'];
	//$ItemName=$_GET['ItemName'];
	if($Reason=="InvIssued")
	{
		$QueryStr="select * from itemhistory where ItemID=$InvItemID and TransType='debit' and ActionType=1 and DateOfAction between '".$ST_DT."' AND '".$END_DT."'";
		$QueryResult=$conn->query($QueryStr);
		if($QueryResult->num_rows)
		{
			echo "<table border='1'  style='border-radius:1px;background:#73AD21;'>";
			echo "<tr>";
			echo "<td>ItemName</td>";
			echo "<td>DateOfIssue</td>";
			echo "<td>Department</td>";
			echo "<td>IssuedTo</td>";
			echo "<td>Quantity</td>";
			echo "<td>Issue Remarks</td>";
			
			echo "</tr>";
			while($row=$QueryResult->fetch_assoc())
			{
			
				$DateOfAction=$row['DateOfAction'];
				$IssueTo=$row['IssuedTo'];
				$IssuedFor=$row['IssuedFor'];
				$Quantity=$row['Quantity'];
				$IssueRem=$row['IssueRem'];
				echo "<tr>";
				echo "<td>$ItemName</td>";
				echo "<td>".date('D, jS F Y ', strtotime($DateOfAction))."</td>";
				echo "<td>".$NameVsPnoArray[$IssueTo]."</td>";
				echo "<td>".$NameVsPnoArray[$IssuedFor]."</td>";

				echo "<td>".$Quantity."</td>";

				echo "<td>".$IssueRem."</td>";
			
			
			
				echo "</tr>";
			}
			echo "</table>";
	 	}
		
	}
	else if($Reason=="InvPending")
	{
		$QueryStr="select * from itemhistory where ItemID=$InvItemID and TransType='debit' and ActionType=0 and DateOfRequest between '".$ST_DT."' AND '".$END_DT."'";
		$QueryResult=$conn->query($QueryStr);
		if($QueryResult->num_rows)
		{
			echo "<table border='1'  style='border-radius:1px;background:#73AD21;'>";
			echo "<tr>";
			echo "<td>ItemName</td>";
			echo "<td>DateOfRequest</td>";
			echo "<td>Department</td>";
			echo "<td>RequestedBy</td>";
			echo "<td>Quantity</td>";
			echo "<td>Remarks</td>";
			
			echo "</tr>";
			while($row=$QueryResult->fetch_assoc())
			{
			
				$DateOfIssue=$row['DateOfRequest'];
				$IssueTo=$row['IssuedTo'];
				$IssuedFor=$row['IssuedFor'];
				$Quantity=$row['Quantity'];
				$RequestRem=$row['RequestRem'];
				//$ItemName=$row['Name'];
				echo "<tr>";
				echo "<td>$ItemName</td>";
				//echo "<td>DateOfRequest</td>";
				echo "<td>".date('D, jS F Y ', strtotime($DateOfIssue))."</td>";
				echo "<td>".$NameVsPnoArray[$IssueTo]."</td>";
				echo "<td>".$NameVsPnoArray[$IssuedFor]."</td>";
				//echo "<td>Reason</td>";
				echo "<td>".$Quantity."</td>";
				echo "<td>".$RequestRem."</td>";
			
			
			
				echo "</tr>";
			}
			echo "</table>";
	 	}
		
	}

	else if($Reason=="InvAdded")
	{
		$QueryStr="select * from itemhistory where ItemID=$InvItemID and TransType='credit' and DateOfIssue between '".$ST_DT."' AND '".$END_DT."'";
		$QueryResult=$conn->query($QueryStr);
		if($QueryResult->num_rows)
		{
			echo "<table border='1'  style='border-radius:1px;background:#73AD21;'>";
			echo "<tr>";
			echo "<td>ItemName</td>";
			echo "<td>DateOfProcurement</td>";
			echo "<td>Quantity</td>";
			echo "<td>Remarks</td>";
			echo "</tr>";
			while($row=$QueryResult->fetch_assoc())
			{
			
				$DateOfIssue=$row['DateOfIssue'];
				//$IssueTo=$row['IssuedTo'];
				$Quantity=$row['Quantity'];
				//$ItemName=$row['Name'];
				$IssueRem=$row['IssueRem'];
				echo "<tr>";
				echo "<td>$ItemName</td>";
				echo "<td>".date('D, jS F Y ', strtotime($DateOfIssue))."</td>";
				//echo "<td>".$NameVsPnoArray[$IssueTo]."</td>";
				echo "<td>".$Quantity."</td>";
				echo "<td>".$IssueRem."</td>";
			
			
			
				echo "</tr>";
			}
			echo "</table>";
	 	}
		
	}
	else
	{
		$QueryStr="select * from itemhistory where ItemID=$InvItemID and TransType='debit' and ActionType=2 and DateOfAction between '".$ST_DT."' AND '".$END_DT."'";
		$QueryResult=$conn->query($QueryStr);
		if($QueryResult->num_rows)
		{
			echo "<table border='1'  style='border-radius:1px;background:#73AD21;'>";
			echo "<tr>";
			echo "<td>ItemName</td>";
			echo "<td>DateOfRejection</td>";
			echo "<td>Department</td>";
			echo "<td>RequestedBy</td>";
			echo "<td>Quantity</td>";
			echo "<td>Reason</td>";
			
			echo "</tr>";
			while($row=$QueryResult->fetch_assoc())
			{
			
				$DateOfIssue=$row['DateOfAction'];
				$IssuedTo=$row['IssuedTo'];
				$IssuedFor=$row['IssuedFor'];
				$Quantity=$row['Quantity'];
				$IssueRem=$row['IssueRem'];
				echo "<tr>";
				echo "<td>".$ItemName."</td>";

				echo "<td>".date('D, jS F Y ', strtotime($DateOfIssue))."</td>";
				echo "<td>".$NameVsPnoArray[$IssuedTo]."</td>";
				echo "<td>".$NameVsPnoArray[$IssuedFor]."</td>";

				echo "<td>".$Quantity."</td>";
				echo "<td>".$IssueRem."</td>";

			
				echo "</tr>";
			}
			echo "</table>";
	 	}
		
	}

	 
echo "<div> <input type='submit' id='HideDetails' value='Hide' onclick='HideDetails()'></div>";	
}

if(isset($_GET['SetLimit']))
{
	$InvItemID=$_GET['SetLimit'];
	$Unit=$_GET['Unit'];
	$Value=$_GET['Value'];
	$QueryStr="update itemdescription set Unit='$Unit',Value=$Value where ItemID=$InvItemID";
	$QueryResult=$conn->query($QueryStr);
	if($QueryResult)
	{
		echo "Updated Successfully";
	}
	else
	{
		echo "Updation Failed";
	}
}


if(isset($_GET['InvItemID']))
{
	$InvItemID=$_GET['InvItemID'];
	$QueryStr="select sum(Quantity),TransType from itemhistory where ItemID=$InvItemID group by TransType";
	$QueryResult=$conn->query($QueryStr);
	
	if($QueryResult->num_rows==2)
	{
		$DebitArr=$QueryResult->fetch_assoc();
		$CreditArr=$QueryResult->fetch_assoc();
		$Remaining=$CreditArr['sum(Quantity)']-$DebitArr['sum(Quantity)'];
	}
	else
	{
		$CreditArr=$QueryResult->fetch_assoc();
		$Remaining=$CreditArr['sum(Quantity)'];
	}
	
	$Result=$conn->query("select Type from itemdescription where ItemId=$InvItemID");
	$Row=$Result->fetch_assoc();
	$ReturnStr=$Row['Type'].",".$Remaining;
	echo $ReturnStr;
}
else if(isset($_GET['HistoryItemID']))
{
	$InvItemID=$_GET['HistoryItemID'];
	$QueryStr="select * from itemhistory where ItemID=$InvItemID order by DateOfIssue";
	$QueryResult=$conn->query($QueryStr);
	
	if($QueryResult->num_rows)
	{
		echo "<table border='1'  style='border-radius:1px;background:#73AD21;'>";
			echo "<tr>";
			
			echo "<td>DateOfIssue</td>";
			echo "<td>IssuedTo</td>";
			echo "<td>IssuedBy</td>";
			echo "<td>Quantity</td>";
			echo "<td>TransactionType</td>";
			//echo "<td>Remarks</td>";
			
			echo "</tr>";
		while($row=$QueryResult->fetch_assoc())
		{
			
			$DateOfIssue=$row['DateOfIssue'];
			$IssueTo=$row['IssuedTo'];
			$IssueBy=$row['IssuedBy'];
			$Quantity=$row['Quantity'];
			$TransType=$row['TransType'];
			//$Remarks=$row['Remarks'];
			
			echo "<tr>";
			
			echo "<td>".$DateOfIssue."</td>";
			echo "<td>".$IssueTo."</td>";
			echo "<td>".$IssueBy."</td>";
			echo "<td>".$Quantity."</td>";
			echo "<td>".$TransType."</td>";
			//echo "<td>".$Remarks."</td>";
			
			echo "</tr>";
		}
		echo "</table>";
		echo "<div> <input type='submit' id='Hide' value='Hide' onclick='ShowResultPage()'></div>"; 
		
	}
	else
	{
		
	}
	
	
	//echo $ReturnStr;
}
?>