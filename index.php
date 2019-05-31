<script>
function ChangeUnitType()
{
	var ItemID=document.getElementById("OldInvItemList").value;
	var ItemUnit=document.getElementById("UnitItemID"+ItemID).value;
	//UnitItemID
	var element = document.getElementById('WeighingUnit');
    	element.value = ItemUnit;
	document.getElementById("WeighingUnit").disabled=true;
	//alert(ItemUnit);
}

function ConfirmDelivery(ItemID,HistoryID,ActionType)
{
	//alert(ItemID+"--"+HistoryID);
	var r = confirm("Are You sure to confirm this delivery");
	if (r == true)
     {
   	 	var xmlhttp;
		if (window.XMLHttpRequest)
 		{
            	// code for IE7+, Firefox, Chrome, Opera, Safari
            	xmlhttp = new XMLHttpRequest();
  		} 
		else 
		{
            // code for IE6, IE5
            	xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function()
  		{
  			if (xmlhttp.readyState==4 && xmlhttp.status==200)
    			{
			if(ActionType==1)
			{
				document.getElementById("ConfimationArea"+HistoryID).innerHTML="Delivery Confirmed By User";
			}
			else
			{
				document.getElementById("ConfimationArea"+HistoryID).innerHTML="Received By Indentor";

			}
			//alert(xmlhttp.responseText);
			
			}
		
				
		}
  	var DataStr="AjaxFile.php?ConfirmDelivery="+ItemID+"&HistoryID="+HistoryID+"&ActionType="+ActionType;
	//alert(DataStr);
 	 xmlhttp.open("GET",DataStr,true);
  	xmlhttp.send();

     } 

}
function ShowPopup(ST_DT,END_DT,InvID,Reason)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
 	{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
  	} 
	else 
	{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
			document.getElementById("ShowTransDetails").style.display="";
			document.getElementById("ShowTransDetails").innerHTML=xmlhttp.responseText;
			document.getElementById("InvStatusDetails").style.display="none";
			//alert(xmlhttp.responseText);
			
		}
		
				
	}
  var DataStr="AjaxFile.php?ShowDetails="+InvID+"&ST_DT="+ST_DT+"&END_DT="+END_DT+"&Reason="+Reason;
//alert(DataStr);
  xmlhttp.open("GET",DataStr,true);
  xmlhttp.send();

}
function HideDetails()
{
	document.getElementById("ShowTransDetails").style.display="none";
	document.getElementById("InvStatusDetails").style.display="";
}
function ShowItemList(SelectOption)
{
	if(SelectOption==0)
	{
		document.getElementById("NewInvItemList").style.display="none";
		document.getElementById("NewInvItemList").value="0";
		document.getElementById("OldInvItemList").style.display="";	
	}
	else
	{
		document.getElementById("NewInvItemList").style.display="";
		document.getElementById("NewInvItemList").value="";
		document.getElementById("OldInvItemList").style.display="none";	
		document.getElementById("WeighingUnit").disabled=false;	
	}
}
function ShowValues(ShowField,cb)
{
	if(cb.checked)
	{
		document.getElementById(ShowField).style.display="";
	}
	else
	{
		document.getElementById(ShowField).style.display="none";
		if(ShowField=="DeptSearchValue")
		{
			var y = document.getElementById("IndvSearchValue");
			while(y.length) 
			{
    				y.remove(y.length-1);
			}
			var ddl = document.getElementById('DeptSearchValue'); 
			for (var j = 0; j < ddl.options.length; j++) 
			{
				 var selectedText = ddl .options[j].text;
				 var x = document.getElementsByName(selectedText);
	
				for(var i=0;i<x.length;i++)
				{
					var option = document.createElement("option");
					option.text = x[i].id;
					option.value=x[i].value;
					y.add(option,y[i]);
		
				} 
			}
			
			
			
		}
	}
}
function ChangeEmpList()
{
	var a = document.getElementById("DeptSearchValue");
	var selectedText = a.options[a.selectedIndex].text;
	var x = document.getElementsByName(selectedText);
	var y = document.getElementById("IndvSearchValue");
	while(y.length) 
	{
    		y.remove(y.length-1);
	}
			
	
	for(var i=0;i<x.length;i++)
	{
		var option = document.createElement("option");
		option.text = x[i].id;
		option.value=x[i].value;
		y.add(option,y[i]);
		
	}
	
}
function ShowQuantity()
{
	var InvQuantity=document.getElementById("ItemID"+document.getElementById("InvItemList").value).value;
	var InvQuantitydropDown = document.getElementById("InvQuantity");
	//alert(InvQuantity);
	
	while(InvQuantitydropDown.length) 
	{
    		InvQuantitydropDown.remove(InvQuantitydropDown.length-1);
	}
	for(var i=0;i<InvQuantity;i++) 
	{
    		var option = document.createElement("option");
		//alert(InvQuantitydropDown.length);
		option.text = i+1;
		option.value=i+1;
		InvQuantitydropDown.add(option,InvQuantitydropDown[i]);
	}

	
}
function SubmitForm(ItemID)
{
	var ActionReason = prompt("Please enter reason", "");
    
    if (ActionReason != "")
	{
		document.getElementById("Reason"+ItemID).value=ActionReason;
        	document.getElementById("PendingForm"+ItemID).submit();
    	}
	else
	{
		alert("Enter some reason before action");
	}
	
}
function ShowOptions(ItemID,count)
{
	var maxPending=document.getElementById("TotalPending").value;
	//alert(maxPending);
	for(var i=1;i<=maxPending;i++)
	{		
			if(document.getElementById("DropDownOptions"+i).selectedIndex==0)
			{
				document.getElementById("Options"+i).style.display="none";
				document.getElementById("Pending"+i).style.display="";
			}
	
		
	}
	document.getElementById("Options"+count).style.display="";
	document.getElementById("Pending"+count).style.display="none";
	
	
	//alert(ItemID);
}
function HideOptions(ItemID,count)
{
	var maxPending=document.getElementById("TotalPending").value;
	//alert(maxPending);
	
	
	for(var i=1;i<=maxPending;i++)
	{
		
		if(i!=count && (document.getElementById("DropDownOptions"+i).selectedIndex==0))
		{
			document.getElementById("Options"+i).style.display="none";
			document.getElementById("Pending"+i).style.display="";
			document.getElementById("DropDownOptions"+i).selectedIndex=0;	
		}
	}

	
}

function ShowNotice(Value)
{
	if(Value)
	{
		document.getElementById("Notice").innerHTML+="<b>("+Value+")</b>";
		document.getElementById("Notice").style.color="red";
	}
}
function DefineLimit(ItemId)
{
	var Unit=document.getElementById("LimitType"+ItemId).value;
	var Value=document.getElementById("LimitValue"+ItemId).value;
	if(Unit=='Percentage' && Value>100)
	{
		alert("Percentage<=100");
		return 0;
	}
	var xmlhttp;
	if (window.XMLHttpRequest)
 	{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
  	} 
	else 
	{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
			alert(xmlhttp.responseText);
			
		}
		
				
	}
  
var DataStr="AjaxFile.php?SetLimit="+ItemId+"&Unit="+Unit+"&Value="+Value;
//alert(DataStr);

        xmlhttp.open("GET",DataStr,true);
       xmlhttp.send();
}
function ShowResultPage()
{
	document.getElementById("ResultTable").style.display="";
	document.getElementById("Hide").style.display="none";
	document.getElementById("HistoryResult").style.display="none";
}
function ShowHistory(ItemID)
{
	var xmlhttp;
	if (window.XMLHttpRequest)
 	{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
  	} 
	else 
	{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
  	{
  		if (xmlhttp.readyState==4 && xmlhttp.status==200)
    		{
			//alert(xmlhttp.responseText);
			document.getElementById("HistoryResult").style.display="";
			document.getElementById("ResultTable").style.display="none";
			document.getElementById("HistoryResult").innerHTML=xmlhttp.responseText;
		}
		
				
	}
  
var 
DataStr="AjaxFile.php?HistoryItemID="+ItemID;
//alert(DataStr);

        xmlhttp.open("GET",DataStr,true);
        xmlhttp.send();
}
function ShowList(ListType)
{
	var IndvListArr = document.getElementById("IndvList");
	var DeptListArr = document.getElementById("DeptList");
	var InvIssuedTo = document.getElementById("InvIssuedTo");
	while(InvIssuedTo.length) 
	{
    		InvIssuedTo.remove(InvIssuedTo.length-1);
	}
	if(ListType=='Dept')
	{		
		
		
		for(var i=0;i<DeptListArr.length;i++) 
		{
    			var option = document.createElement("option");
			//alert(DeptListArr.length);
			option.text = DeptListArr[i].text;
			option.value=DeptListArr[i].value;
			InvIssuedTo.add(option,InvIssuedTo[i]);
		}
	}
	else
	{
		for(var i=0;i<IndvListArr.length;i++) 
		{
    			var option = document.createElement("option");
			//alert(DeptListArr.length);
			option.text = IndvListArr[i].text;
			option.value=IndvListArr[i].value;
			InvIssuedTo.add(option,InvIssuedTo[i]);
		}
	}

}
function StockPage(PageNum,ItemID)
{
	//alert(PageNum+ItemID);
	document.getElementById("StockPageNum").value=PageNum;
	document.getElementById("StockItemID").value=ItemID;
	document.getElementById("StockForm").submit();
}
function ChangeSearchParameter()
{
	var DropdownValue=document.getElementById("SearchAttr").value;
	if(DropdownValue=="IssueTo")
	{
		document.getElementById("DeptSearchValue").style.display="";
		document.getElementById("SearchValue").style.display="none";
		document.getElementById("IndvSearchValue").style.display="none";
		document.getElementById("SearchType").value="DeptDropDown";
		document.getElementById("DateFrom").style.display="none";
		document.getElementById("DateTo").style.display="none";
	}
	else if(DropdownValue=="Individual")
	{
		document.getElementById("DeptSearchValue").style.display="none";
		document.getElementById("SearchValue").style.display="none";
		document.getElementById("IndvSearchValue").style.display="";
		document.getElementById("SearchType").value="IndvDropDown";
		document.getElementById("DateFrom").style.display="none";
		document.getElementById("DateTo").style.display="none";
	}
	else if(DropdownValue=="Duration")
	{	
		document.getElementById("DeptSearchValue").style.display="none";
		document.getElementById("SearchValue").style.display="none";
		document.getElementById("IndvSearchValue").style.display="none";
		document.getElementById("SearchType").value="Duration";
		document.getElementById("DateFrom").style.display="";
		document.getElementById("DateTo").style.display="";
		
	}
	else
	{
		document.getElementById("DeptSearchValue").style.display="none";
		document.getElementById("SearchValue").style.display="";
		document.getElementById("IndvSearchValue").style.display="none";
		document.getElementById("SearchType").value="TextBox";
		document.getElementById("DateFrom").style.display="none";
		document.getElementById("DateTo").style.display="none";
	}
	//alert(DropdownValue);
}
function FillForm()
{
	var ItemID=document.getElementById("InvItemID").value;
	var ActionType=document.getElementById("ActionType").value;
	var xmlhttp;
	if (window.XMLHttpRequest)
 	{
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
  	} 
	else 
	{
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
  	{
  	if (xmlhttp.readyState==4 && xmlhttp.status==200)
    	{
		//alert(xmlhttp.responseText);
		var TypeArr=xmlhttp.responseText.split(",");
		document.getElementById("InvType").readOnly=true;
		document.getElementById("InvSubType").readOnly=true;
		document.getElementById("InvType").value=TypeArr[0];
		document.getElementById("InvSubType").value=TypeArr[1];
		if(ActionType==3)
		{
			
			var x = document.getElementById("IndvList");
			//alert(x.length);
			while(x.length) 
			{
    				x.remove(x.length-1);
			}
			//alert(x.length);
			for(var i=0;i<TypeArr[2];i++) 
			{
    				var option = document.createElement("option");
				option.text = i+1;
				option.value=i+1;
				x.add(option,x[i]);
			}

		

		}
		
				
		

		
    	}
  }
var 
DataStr="AjaxFile.php?InvItemID="+ItemID;
//alert(DataStr);

        xmlhttp.open("GET",DataStr,true);
        xmlhttp.send();
	
}


</script>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "inventarymgt";
$dbname1 = "meetingroomdb";
// Create connection-1
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

$PageNumber=1;
$colorArr[1]=$colorArr[2]=$colorArr[3]=$colorArr[4]=$colorArr[5]=$colorArr[6]=$colorArr[7]=$colorArr[8]="#778899";
$ShowingWhat[1]="Add Items to Inventory";
$ShowingWhat[3]="Request For New Asset";
$ShowingWhat[4]="Asset History ";
$ShowingWhat[6]="Inventory Alerts ";
$ShowingWhat[7]="Department Asset Request Status ";
$ShowingWhat[8]="Inventory Status ";
$SearchStr="";
$SearchPos=2;
$DeptQuery="select * from users order  by Department";
$DeptResult=$conn->query($DeptQuery);
$IndvQuery="select * from users where Department='$DeptName' order by Name";
$IndvQueryResult=$conn1->query($IndvQuery);
if(isset($_POST['ItemID']))
{
	$ItemID=$_POST['ItemID'];
	$HistoryID=$_POST['HistoryID'];
	$Action=$_POST['DropDownOptions'];
	$DateOfAction=date("Y-m-d");
	$Reason=$_POST['Reason'];
	//echo "update itemhistory set IssuedBy=$UserID,IssueRem='$Reason', DateOfAction='$DateOfAction',ActionType=$Action where ItemID=$ItemID and HistoryID=$HistoryID";
	$conn->query("update itemhistory set IssuedBy=$UserID,IssueRem='$Reason', DateOfAction='$DateOfAction',ActionType=$Action where ItemID=$ItemID and HistoryID=$HistoryID");
	$PageNumber=7;
}
$ST_DT="1970-01-01";
$END_DT="2100-01-01";
if(isset($_POST['ShowStatus']))
{
	$ST_DT=$_POST['ST_DT'];
	$END_DT=$_POST['END_DT'];
	$PageNumber=8;
	if($ST_DT=="")
	{
		$ST_DT="1970-01-01";
	}
	if($END_DT=="")
	{
		$END_DT="2100-01-01";
	}

	//echo $ST_DT."--".$END_DT;
	$IsSearchSet=1;
}
else
{
	$IsSearchSet=0;
}

if(isset($_POST['SearchPageNum']))
{
	$PageNumber=$_POST['SearchPageNum'];
	$SearchStr="";
	$CondCount=1;
	$IsStatusSet=0;
	if(isset($_POST['ItemName']))
	{
		$InvItemName=$_POST['InvItemListSearch'];
		if($CondCount==0)
		{
			$SearchStr.=" where ItemID=".$InvItemName;
		}
		else
		{
			$SearchStr.=" and ItemID=".$InvItemName;
		}
		$CondCount++;
	}
	if(isset($_POST['Department']))
	{
		$DeptName=$_POST['DeptSearchValue'];
		if($CondCount==0)
		{
			$SearchStr.=" where IssuedTo=".$DeptName;
		}
		else
		{
			$SearchStr.=" and IssuedTo=".$DeptName;
		}
		$CondCount++;
	}
	if(isset($_POST['Individual']))
	{
		$IndvName=$_POST['IndvSearchValue'];
		if($CondCount==0)
		{
			$SearchStr.=" where IssuedFor='".$IndvName."'";
		}
		else
		{
			$SearchStr.=" and IssuedFor='".$IndvName."'";
		}
		$CondCount++;
	}
	if(isset($_POST['InvRequestStatus']))
	{
		$ReqStatus=$_POST['InvRequestStatusValue'];
		if($ReqStatus!=-1)
		{
			$SearchStr.=" and ActionType=".$ReqStatus;
			if($ReqStatus==0)
			{
				$IsStatusSet=1;
			}
	
		}
		else
		{
			
		}
		
		
	}
	if(isset($_POST['Duration']))
	{
		$DurationFrom=$_POST['DateFrom'];
		$DurationTo=$_POST['DateTo'];
		if($IsStatusSet)
		{
			$DateOfAction="DateOfRequest";
		}
		else
		{
			$DateOfAction="DateOfAction";
		}
		if($DurationFrom!="" and $DurationTo!="")
		{
			$SearchStr.=" and ".$DateOfAction.">='".$DurationFrom."' and ".$DateOfAction."<='".$DurationTo."'";
		
		}	
		else if($DurationFrom!="")
		{
			$SearchStr.=" and ".$DateOfAction.">='".$DurationFrom."'";
		
		}
		else if($DurationTo!="")
		{
			$SearchStr.=" and ".$DateOfAction.">='".$DurationTo."'";
		
		}
		else
		{

		}
		$IsDurationSet=1;
		
	}
	

	
	//echo "<script>alert('".$SearchStr1."')</script>";
}
if(isset($_POST['AddStock']) or isset($_POST['RemoveStock']))
{
	$PageNumber=4;
	$ActionType=$_POST['ActionType'];
	$DateOfEntry=date("Y-m-d");
	$InvQuantity=$_POST['InvQuantity'];
	$Remarks=$_POST['Remarks'];
	//echo "<script>alert('Item Added Successfully')</script>";
	
	if($ActionType==1)
	{
		$ItemListType=$_POST['ItemOption'];
		if($ItemListType==1)
		{
			$InvName=$_POST['NewInvItemList'];
			$WeighingUnit1=$_POST['ItemWeighingUnit'];
			$QueryStr="insert into itemdescription (Name,InitialStock,WeighingUnit) values  ('$InvName',$InvQuantity,'$WeighingUnit1')";
			//echo $QueryStr;
			$CheckQuery1=$conn->query($QueryStr);
		}
		else
		{
			$InvItemID=$_POST['OldInvItemList'];
			//echo "<script>alert('Item Added Successfully')</script>";
			$CheckQuery1=$conn->query("insert into itemhistory (ItemId,DateOfIssue,Quantity,TransType,IssueRem,IssuedBy) values ($InvItemID,'$DateOfEntry',$InvQuantity,'credit','$Remarks',$UserID)");
		}
		if($CheckQuery1)
		{
			echo "<script>alert('Item Added Successfully')</script>";
			/*
			$Result=$conn->query("select max(ItemId) from itemdescription");
			$Row=$Result->fetch_assoc();
			$MaxItemID=$Row['max(ItemId)'];
			$CheckQuery2=$conn->query("insert into itemhistory (ItemId,DateOfIssue,Quantity,TransType,IssueRem) values ($MaxItemID,'$DateOfEntry',$InvQuantity,'credit','$Remarks')");
			if($CheckQuery2)
			{
				echo "<script>alert('Item Added Successfully')</script>";	
			}
			else
			{
				$conn->query("delete from itemdescription where ItemId=$MaxItemID");
				echo "<script>alert('Unable To Add this Item')</script>";	
			}
			*/
		}
		else
		{
			echo "<script>alert('Unable To Add this Item')</script>";
		}
			
		
		
	}
	else if($ActionType==2)
	{
		$InvItemID=$_POST['InvItemList'];
		$DateOfRequest=date("Y-m-d");
		$CheckQuery2=$conn->query("insert into itemhistory (ItemId,DateOfIssue,Quantity,TransType,IssueRem) values ($MaxItemID,'$DateOfEntry',$InvQuantity,'credit','$Remarks')");
		if($CheckQuery2)
		{
			echo "<script>alert('Item Credited Successfully')</script>";	
		}
		else
		{
			echo "<script>alert('Unable To Credit this Item')</script>";	
		}
		

	}
	else if($ActionType==3)
	{
		$InvItemID=$_POST['InvItemList'];
		$IssuedFor=$_POST['InvIssuedFor'];
		$IssuedTo=$UserID;
		echo "insert into itemhistory (ItemId,DateOfRequest,IssuedTo,IssuedFor,Quantity,TransType,RequestRem) values ($InvItemID,'$DateOfEntry',$IssuedTo,$IssuedFor,$InvQuantity,'debit','$Remarks')";
		$CheckQuery2=$conn->query("insert into itemhistory (ItemId,DateOfRequest,IssuedTo,IssuedFor,Quantity,TransType,RequestRem) values ($InvItemID,'$DateOfEntry',$IssuedTo,'$IssuedFor',$InvQuantity,'debit','$Remarks')");
		if($CheckQuery2)
		{
			echo "<script>alert('Item Debited Successfully')</script>";	
		}
		else
		{
			echo "<script>alert('Unable To Debit this Item')</script>";	
		}
	}


}
$QueryStr="select ItemID,Name,Type,(select sum(Quantity) from itemhistory where ItemID=itemdescription.ItemID and TransType='credit') as Credit,(select sum(Quantity) from itemhistory where ItemID=itemdescription.ItemID and TransType='debit') as Debit from itemdescription";
$QueryResult=$conn->query($QueryStr);
if(isset($_POST['PageNumber']))
{

	$PageNumber=$_POST['PageNumber'];
	$colorArr[$PageNumber]="#B8860B";

}
if(isset($_POST['StockPageNum']))
{

	$PageNumber=$_POST['StockPageNum'];
	$StockItemID=$_POST['StockItemID'];
}
?>
<div align="center" style="font-size:20px;color:red" ><b>CET Inventory Management System</div>
<br>
<body>
<table width="100%">
<table width='100%'><tr><td>
<table>
<tr>
<?php
if($UserType==0)
{	
	if($PageNumber==1)
	{
		$PageNumber=3;
	}
?>
	<td style='border-radius:5px;' bgcolor="<?php echo $colorArr[3];?>"><a style="color:black" href="#" onclick="ChangePage('3')"><b>Request</b></a><td>
	<td  style='border-radius:5px;' bgcolor="<?php  echo $colorArr[4];?>"><a  style="color:black" href="#" onclick="ChangePage('4')"><b>History</b></a><td>
	<td style='border-radius:5px;' bgcolor="<?php echo $colorArr[7];?>"><a  style="color:black" href="#" onclick="ChangePage('7')"><b>RequestStatus</b></a><td>
<?php
}
else
{
?>
<td  style='border-radius:5px;' bgcolor="<?php echo $colorArr[7];?>"><a  style="color:black" href="#" onclick="ChangePage('7')"><b>Requests</b></a><td>
<td style='border-radius:5px;' bgcolor="<?php echo $colorArr[8];?>"><a  style="color:black" href="#" onclick="ChangePage('8')"><b>StockStatus</b></a><td>
<td  style='border-radius:5px;' bgcolor="<?php echo $colorArr[1];?>"><a style="color:black" href="#" onclick="ChangePage('1')"><b>Add New Stock</b></a><td>
<!--td bgcolor="<?php echo $colorArr[5];?>"><a  style="color:black" href="#" onclick="ChangePage('5')"><b>Define Stock Limit</b></a><td!-->
<td  style='border-radius:5px;' bgcolor="<?php echo $colorArr[4];?>"><a  style="color:black" href="#" onclick="ChangePage('4')"><b>History</b></a><td>
<td style='border-radius:5px;' bgcolor="<?php echo $colorArr[6];?>" id="Notice"><a  style="color:black" href="#" onclick="ChangePage('6')"><b>Notification</b></a><td>
<?php
}
?>

</table>
<form id="MainForm" Name="MainForm" action="Login.php" method="POST">
<input type="hidden" id="PageNumber" Name="PageNumber" value="0">
</form>
</td>
</tr>
</table>
<div style='text-align:center;font-size:20px;'><?php  echo $ShowingWhat[$PageNumber];?></div><br>
<?php 
if($PageNumber<4)
{
?>

<table align='center' style='border-radius:10px;background:#73AD21;'>
<form Name="AddInventary" action="Login.php" method="POST">
<tr>

<?php 

if($PageNumber==3)
{
	echo"<td><b> ItemName</b></td>";
	echo "<td> <b>RequestFor</b></td>";
}
else
{
	echo"<td><b> ItemName</b><input type='radio' name='ItemOption' value='0' Checked onclick='ShowItemList(0)'>Existing<input type='radio' name='ItemOption' value='1' onclick='ShowItemList(1)'>New</td>";
}
?>
</tr>
<tr>
<td style='width:180px'>
<?php
if($PageNumber>1)
{
	
	//echo"<select name='InvItemID' id='InvItemID' onchange='FillForm()'>";
	//echo"<option value='0'>Select</option>";
	$QueryStr="select ItemID,Name,InitialStock,(select sum(Quantity) from itemhistory where itemId=itemdescription.ItemId and TransType='Credit') as CreditNum,(select sum(Quantity) from itemhistory where itemId=itemdescription.ItemId and TransType='Debit' and ActionType=1) as DebitNum  from itemdescription";
	$QueryResult=$conn->query($QueryStr);
	echo "<select name='InvItemList' id='InvItemList' onchange='ShowQuantity()'>";
	$Count=0;
	$FirstItemQuantity=0;
	while($row=$QueryResult->fetch_assoc())
	{
		$ItemId=$row['ItemID'];
		$Name=$row['Name'];
		$InitialStock=$row['InitialStock'];
		//$Type=$row['Type'];
		//$SubType=$row['SubType'];
		$Quantity=$InitialStock+$row['CreditNum']-$row['DebitNum'];
		$QuantityArr[$ItemId]=$Quantity;
		//echo "<input type='hidden' name='ItemID$ItemId' id='ItemID$ItemId' value='$Quantity'>";
		echo"<option value='$ItemId'>$Name</option>";
		if($Count++==0)
		{
			$FirstItemQuantity=$Quantity;	
		}
		
		
	}
	echo "</select>";
	foreach($QuantityArr as $key=>$value)
	{
		echo "<input type='hidden' name='ItemID$key' id='ItemID$key' value='$value'>";
	}


}
else
{
	$UnitVsItemArr="";
	$QueryStr="select WeighingUnit,ItemID,Name,InitialStock,(select sum(Quantity) from itemhistory where itemId=itemdescription.ItemId and TransType='Credit') as CreditNum,(select sum(Quantity) from itemhistory where itemId=itemdescription.ItemId and TransType='Debit' and ActionType=1) as DebitNum  from itemdescription";
	$QueryResult=$conn->query($QueryStr);
	echo "<select name='OldInvItemList' id='OldInvItemList' onchange='ChangeUnitType()'>";
	while($row=$QueryResult->fetch_assoc())
	{
		$ItemId=$row['ItemID'];
		$Name=$row['Name'];
		$InitialStock=$row['InitialStock'];
		$UnitVsItemArr[$row['ItemID']]=$row['WeighingUnit'];
		$Quantity=$InitialStock+$row['CreditNum']-$row['DebitNum'];
		echo"<option value='$ItemId'>$Name</option>";
		
		
		
	}

	echo "</select>";
	echo "<input type='text' name='NewInvItemList' id='NewInvItemList' style='width:180px;display:none' value='0' required>";
	echo "<td>Unit: <select id='WeighingUnit' Name='ItemWeighingUnit'>";
	echo "<option value='NUMBER'>NUMBER</option>";
	echo "<option value='KG'>KG</option>";
	echo "<option value='LITRE'>LITRE</option>";
	echo "<option value='PACKET'>PACKET</option>";
	echo "<option value='LOT'>LOT</option>";
	echo "</select></td>";
	foreach($UnitVsItemArr as $key=>$value)
	{
		echo "<input type='hidden' name='WeighingUnit' id='UnitItemID$key' value='$value'>";
	}
}
?>

</td>
<?php 
if($PageNumber==3)
{
?>
<td style='width:180px'> 
<select name='InvIssuedFor' id='InvIssuedFor' style='width:250px' required>


	<?php
	if(isset($_COOKIE['LoginID']))
	{
		$Dept_CD=$_COOKIE['LoginID'];
	}
	if(isset($_COOKIE['Dept-Name']))
	{
		$Dept_Name=$_COOKIE['Dept-Name'];
	}
	echo "<option value='$Dept_CD'>$Dept_Name</option>";
	while($IndvRow=$IndvQueryResult->fetch_assoc())
	{
		$IndvName=$IndvRow['Name'];
		$Sail_No=$IndvRow['UserID'];
		echo "<option value='$Sail_No'>$IndvName</option>";

	}
	?>
	
</<select>

</td>
<?php 
}
?>
</tr>


<tr>
<td> <b> Quantity</b></td>
<td><b> Remarks</b></td>
</tr>
<td>
<?php if($PageNumber==3)
{
 	echo "<select name='InvQuantity' id='InvQuantity' style='width:180px'>";
	for ($i=1;$i<=$FirstItemQuantity;$i++)
 	{
		echo "<option value='$i'>$i</option>";
	}
	echo "</select>";
}
else
{
?>
 <input type='number' name='InvQuantity'  style='width:180px' min='1' required>
<?php
}
?>
</td>
<td> <input type='text' name='Remarks'  style='width:180px' required></td>
</tr>
<tr>
<td></td>
<?php
}
if($PageNumber==1 or $PageNumber==2)
{
	echo "<td> <input type='submit' name='AddStock' value='RECEIPT'></td>";
}
else if($PageNumber==3)
{
	echo "<td> <input type='submit' name='RemoveStock' value='REQUEST'></td>";

}
echo "<input type='hidden' name='ActionType' id='ActionType' value='$PageNumber'>";
echo"</tr></table></form>";
	$IndvQuery="select * from users";
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
if($PageNumber==4 or $PageNumber==5)
{
	//$EmployeeQuery="select * from users order by Department";
	$IndvQuery="select * from users order by Department";
	$IndvQueryResult=$conn1->query($IndvQuery);
	while($row=$IndvQueryResult->fetch_assoc())
	{
		$Emp_Cd=$row['UserID'];
		$Emp_Name=$row['Name'];
		$Dept_name=$row['Department'];
		echo "<input type='hidden' name='$Dept_name' id='$Emp_Name' value='$Emp_Cd'>";
	}
	if($UserType==0)
	{
		$Dept_Cond=" and IssuedTo=".$UserID;
		$EmployeeQuery="select * from users  where Department='$DeptName' order by Name";
	}
	else
	{
		$Dept_Cond="";
		$EmployeeQuery="select * from users order by Name";
	}
	$EmployeeQueryResult=$conn1->query($EmployeeQuery);
	$QueryStr="select ItemID,DateOfAction,ActionType,(select Name from itemdescription where ItemID=itemhistory.ItemID) as ItemName,DateOfIssue,DateOfRequest,IssuedBy,IssuedTo,IssuedFor,Quantity,RequestRem,issueRem,DateOfDelivery,DeliveryStatus,HistoryID from itemhistory where  TransType='debit' ".$Dept_Cond." ".$SearchStr." order by DateOfRequest Desc";
	$QueryResult=$conn->query($QueryStr);
	
	
?>

	<form id="StockForm" Name="StockForm" action="Login.php" method="POST">
	<input type="hidden" id="StockPageNum" Name="StockPageNum" value="0"> 
	<input type="hidden" id="StockItemID" Name="StockItemID" value="0">
	</form>
	
	<form id="SearchForm" Name="SearchForm" action="Login.php" method="POST">
	<input type='hidden' name='SearchType'  id='SearchType' value='TextBox'>
	<table align='center'>
	<tr>
	<td>
	<input type='checkbox' name='ItemName' id='ItemName' onclick="ShowValues('InvItemListSearch',this)">ItemName
	</td>
	<td>
	<?php
	$InvNameQueryStr="select ItemID,Name from itemdescription";
	$InvNameQueryResult=$conn->query($InvNameQueryStr);
	echo "<select name='InvItemListSearch' id='InvItemListSearch' style='display:none'>";
	while($row=$InvNameQueryResult->fetch_assoc())
	{
		$ItemId=$row['ItemID'];
		$Name=$row['Name'];
		echo"<option value='$ItemId'>$Name</option>";
		
		
		
	}
	echo "</select>";
	?>
	</td>
	</tr>
	<tr>
	<td>
	<input type='checkbox' name='Individual' id='Individual' onclick="ShowValues('IndvSearchValue',this)">Individual
	</td>
	<td>
	<select  name='IndvSearchValue' id='IndvSearchValue' style='display:none'>
	<?php
	while($EmployeeRow=$EmployeeQueryResult->fetch_assoc())
	{
		$EmployeeName=$EmployeeRow['Name'];
		$EmployeeNo=$EmployeeRow['UserID'];
		echo "<option value='$EmployeeNo'>$EmployeeName</option>";

	}
	?>
	</select>
	</td>
	</tr>
	<?php
	//$Dept_Cond="";
	if($UserType!=0)
	{
		//$Dept_Cond=" and IssuedTo=".$UserID;
	?>
	<tr>
	<td>
	<input type='checkbox' name='Department' id='Department' onclick="ShowValues('DeptSearchValue',this)">Department
	</td>
	<td>
	<select  name='DeptSearchValue' id='DeptSearchValue'  onchange="ChangeEmpList()" style='display:none'>
	<?php
	while($DeptRow=$DeptResult->fetch_assoc())
	{
		$DeptName=$DeptRow['Department'];
		$Dept_cd=$DeptRow['UserID'];
		echo "<option value='$Dept_cd'>$DeptName</option>";

	}
	?>
	</<select>
	</td>
	</tr>
	<?php
	}
	?>
	<tr>
	<td>
	<input type='checkbox' name='Duration' id='Duration' onclick="ShowValues('DateRange',this)">Duration
	</td>
	<td name='DateRange' id='DateRange' style='display:none'>
	<input type='date' name='DateFrom' id='DateFrom' >
	<input type='date' name='DateTo' id='DateTo'>
	</td>
	</tr>
	<tr>
	<td>
	<input type='checkbox' name='InvRequestStatus' id='InvRequestStatus' onclick="ShowValues('InvRequestStatusValue',this)">Request Status
	</td>
	<td >
	<select name='InvRequestStatusValue' id='InvRequestStatusValue' style='display:none'>
	<option value='-1'>Any</option>
	<option value='0'>Pending</option>
	<option value='1'>Issued</option>
	<option value='2'>Not Issued</option>
	</select>
	</td>
	</tr>
	<td><input type='submit' name='Searching' id='Searching' value='Search'></td>
	<tr>
	</table>
	<input type='hidden' name='SearchPageNum' id='SearchPageNum' value='<?php echo $PageNumber;?>'>
	</form>

<?php
	if($QueryResult->num_rows==0)
	{
		echo "<script>alert('No Result Found')</script>";
	}
	else
	{
		echo "<table border='1' align='center' style='border-radius:1px;background:#73AD21;' id='ResultTable'>";
		echo"<tr><td>SlNo.</td>";
		echo"<td>ItemName.</td>";
		echo"<td>DateOfRequest</td>";
		if($UserType==1)
		{
			echo"<td>RequestedBy</td>";
		}
		echo"<td>RequestedFor</td>";
		echo"<td>Quantity</td>";
		echo"<td>Request Remarks</td>";
		echo"<td>Status</td>";
		
		
		if($PageNumber==4)
		{
			//echo"<td>Issue</td>";
			//echo"<td>Receipt</td>";
			//echo"<td>ItemHistory</td></tr>";
		}
		else
		{	echo"<td>TotalReceipt</td>";
			echo"<td>TotalIssue</td>";
			echo"<td>MaxUnits</td>";
			echo"<td>CurrentLimit</td>";
			echo"<td>DefineLimit</td>";
			
		}
		$count=0;
		$LastItemID=0;
	
	
		while($row=$QueryResult->fetch_assoc())
		{
		
		$InvName=$row['ItemName'];
		$DateOfIssue=date('D, jS F Y ', strtotime($row['DateOfIssue']));
		$DateOfRequest=date('D, jS F Y ', strtotime($row['DateOfRequest']));
		$IssuedBy=$row['IssuedBy'];
		$IssuedFor=$NameVsPnoArray[$row['IssuedFor']];
		$IssuedTo=$NameVsPnoArray[$row['IssuedTo']];
		$Quantity=$row['Quantity'];
		$ItemID=$row['ItemID'];
		$ActionType=$row['ActionType'];
		$DeliveryStatus=$row['DeliveryStatus'];
		$DateOfDelivery=$row['DateOfDelivery'];
		$HistoryID=$row['HistoryID'];
		$RequestRem=$row['RequestRem'];
		$count++;
		echo "<tr>";
		echo "<td>".$count."</td>";
		echo "<td>".$InvName."</td>";
		echo "<td>".$DateOfRequest."</td>";
		

		if($UserType==1)
		{
			echo "<td>".$IssuedTo."</td>";
		}
		echo "<td>".$IssuedFor."</td>";
		echo "<td>".$Quantity."</td>";
		echo "<td>".$RequestRem."</td>";
		if($IssuedBy==0)
		{
			
				echo "<td>Pending</td>";
			
		}
		else
		{
			
			if($ActionType==1)
			{
				//echo "<td>Processed On ".date('D, jS F Y ', strtotime($row['DateOfAction']))."</td>";
				if($DeliveryStatus==0)
				{
					echo "<td id='ConfimationArea$HistoryID'>Processed On ".date('D, jS F Y ', strtotime($row['DateOfAction']))." (<a href='#' "."onclick="."ConfirmDelivery('$ItemID','$HistoryID',1)>Confirm Delivery</a>)</td>";
				}
				else
				{
						if($DeliveryStatus==1 and $UserType==1)
						{
							echo "<td id='ConfimationArea$HistoryID'>Delivered On ".date('D, jS F Y ', strtotime($DateOfDelivery))." (<a href='#' "."onclick="."ConfirmDelivery('$ItemID','$HistoryID',2)>Acknowledge</a>)</td>";
						}
						else
						{
							echo "<td>Delivered On ".date('D, jS F Y ', strtotime($DateOfDelivery))." (Received By Indentor)</td>";
						}
				}

			}
			else
			{
				echo "<td style='color:red'>Said Sorry On ".date('D, jS F Y ', strtotime($row['DateOfAction'])). " for this item</td>";
			}
			
			
		}
		echo "</tr>";

		
	
			if($PageNumber==4)
			{
			?>
			
			<?php
			}
			else
			{
				?>
			<!--td><input Type="submit" name="StockLimit" id="StockLimit" value="StockLimit" onclick="DefineLimit()"></td--!>
			<td><?php echo $CreditNum;?></td>
			<td><?php echo $DebitNum;?></td>
			<td><?php echo $MaxValue;?></td>
			<td><?php echo $Value.'('.$Unit.')';?></td>
			<td><select name='LimitType<?php echo $ItemId;?>' id='LimitType<?php echo $ItemId;?>'><option value='Percentage'>Percentage</option><option value='Unit'>Unit</option></select>
			<input Type="number" name="LimitValue<?php echo $ItemId;?>" id="LimitValue<?php echo $ItemId;?>" min='1'  value='80' style='width:50px' required>
			<input Type="submit" name="SetLimit<?php echo $ItemId;?>" id="SetLimit<?php echo $ItemId;?>" value="SetLimit"  onclick="DefineLimit('<?php echo $ItemId;?>')"></td>
			
			<?php
			}
			?>
			</tr>
			<?php
		
	
		
		}
	
	echo"</table>";
	}
echo"<div id='HistoryResult' align='center'></div>";	
}

?>

</table>
<?php
if($PageNumber==6)
{
	$Display='';
}
else
{
	$Display='none';

}

	$QueryStr="select ItemID,Name,Type,Unit,MaxUnit,Value,(select sum(Quantity) from itemhistory where itemId=itemdescription.ItemId and TransType='Credit') as CreditNum,(select sum(Quantity) from itemhistory where itemId=itemdescription.ItemId and TransType='Debit') as DebitNum  from itemdescription";
	$QueryResult=$conn->query($QueryStr);
	$count=0;
	echo "<table border='1' align='center' style='border-radius:1px;background:#73AD21; display:".$Display."'>";
	while($row=$QueryResult->fetch_assoc())
	{
		$Unit=$row['Unit'];
		$MaxUnit=$row['MaxUnit'];
		$Value=$row['Value'];
		$Name=$row['Name'];
		$Type=$row['Type'];
		$Quantity=$row['CreditNum']-$row['DebitNum'];
		if($Unit=='Unit')
		{
			if($Value>$Quantity)
			{
				$IsNotification=1;
			}
			else
			{
				$IsNotification=0;
			}
		}
		else
		{
			if((($Value*$MaxUnit)/100)>$Quantity)
			{
				$IsNotification=1;
			}
			else
			{
				$IsNotification=0;
			}
		}
		if($IsNotification)
		{
			echo "<tr>";
			echo "<td>".++$count."</td>";	
			echo "<td>".$Name."</td>";	
			echo "<td>".$Type."</td>";
			echo"</tr>";
		}

	}
	echo"</table>";
	echo "<script>ShowNotice(".$count.")</script>";
if($PageNumber==8)
{
	if($IsSearchSet==0)
	{
		$sqlStr="select ItemID,Name,InitialStock,WeighingUnit,(select IFNULL(sum(Quantity),0) from itemhistory where ItemID=itemdescription.ItemID and TransType='credit') as 		ItemAdded,(select IFNULL(sum(Quantity),0) from itemhistory where ItemID=itemdescription.ItemID and TransType='debit' and ActionType=1) as IssuedCount,(select   	IFNULL(sum(Quantity),0) from itemhistory where ItemID=itemdescription.ItemID and TransType='debit' and ActionType=0) as PendingCount,(select IFNULL(sum(Quantity),0) from 	itemhistory where ItemID=itemdescription.ItemID and TransType='debit' and ActionType=2) as SorryCount from itemdescription";
	}
	else
	{
		$sqlStr="select ItemID,Name,InitialStock,WeighingUnit,(select IFNULL(sum(Quantity),0) from itemhistory where ItemID=itemdescription.ItemID and TransType='credit' and DateOfIssue between '".$ST_DT."' AND '".$END_DT."') as ItemAdded,(select IFNULL(sum(Quantity),0) from itemhistory where ItemID=itemdescription.ItemID and TransType='debit' and ActionType=1 and DateOfAction between '".$ST_DT."' AND '".$END_DT."') as IssuedCount,(select IFNULL(sum(Quantity),0) from itemhistory where ItemID=itemdescription.ItemID and TransType='debit' and ActionType=0 and DateOfRequest between '".$ST_DT."' AND '".$END_DT."') as PendingCount,(select IFNULL(sum(Quantity),0) from 	itemhistory where ItemID=itemdescription.ItemID and TransType='debit' and ActionType=2 and DateOfAction between '".$ST_DT."' AND '".$END_DT."') as SorryCount from itemdescription";
		
	}
	$sqlStrRow=$conn->query($sqlStr);
	echo "<table align='center' ><form name='InvStatusByDate' action='Login.php' method='POST'>";
	echo "<tr><td>From:<input type='date' name='ST_DT'></td><td>To:<input type='date' name='END_DT'></td></td></tr>";
	echo "<tr><td><input type='submit' name='ShowStatus' value='Submit'></td>";
	echo "</form></table>";
	if($IsSearchSet)
	{
		if($ST_DT=="1970-01-01")
		{
			if($END_DT=="2100-01-01")
			{
				//echo"<div id='Searchduration' align='center'>Inventory details for the period ( ".date('D, jS F Y ', strtotime($ST_DT))." To ".$END_DT.")";
			}
			else
			{
				echo"<div id='Searchduration' align='center'>Inventory details till ".date('D, jS F Y ', strtotime($END_DT)).")";
			}
		}
		else
		{
			if($END_DT=="2100-01-01")
			{
				echo"<div id='Searchduration' align='center'>Inventory details till ".date('D, jS F Y ', strtotime($ST_DT)).")";
			}
			else
			{
				echo"<div id='Searchduration' align='center'>Inventory details for the period ( ".date('D, jS F Y ', strtotime($ST_DT))." To ".date('D, jS F Y ', strtotime($END_DT)).")";
			}

		}
		
	}
	?>
	<div id='ShowTransDetails' align='center' style='display:none'></div>
	<table border='1' id='InvStatusDetails' align='center' style='border-radius:1px;background:#73AD21;'>
	<tr><td>ItemName</td>
	<td>StockAdded</td>
	<td>ItemIssued</td>
	<td>PendingRequests</td>
	<td>NotIssued</td>
	<td>AvailableStock</td><td>Unit</td></tr>
	<?php
	while($row=$sqlStrRow->fetch_assoc())
	{
		$InvName=$row['Name'];
		$InvID=$row['ItemID'];
		$InvInitial=$row['InitialStock'];
		$InvAdded=$row['ItemAdded'];
		$InvIssuedCount=$row['IssuedCount'];
		$InvPendingCount=$row['PendingCount'];
		$InvSorryCount=$row['SorryCount'];
		$WeighingUnit=$row['WeighingUnit'];
		$StockLeft=$InvAdded+$InvInitial-$InvIssuedCount;
		echo"<tr>";
		echo "<td>$InvName</td>";
		//echo "<td>$InvInitial</td>";
		echo "<td>$InvAdded";
		if($InvAdded)
		{
			echo "<br><a href='#' onclick="."ShowPopup('$ST_DT','$END_DT',$InvID,'InvAdded')>Details</a>";
		}
		echo"</td>";
		echo "<td>$InvIssuedCount"; 
		if($InvIssuedCount)
		{
			echo "<br><a href='#' onclick="."ShowPopup('$ST_DT','$END_DT',$InvID,'InvIssued')>Details</a>";
		}
		echo"</td>";
		echo "<td>$InvPendingCount"; 
		if($InvPendingCount)
		{
			echo "<br><a href='#' onclick="."ShowPopup('$ST_DT','$END_DT',$InvID,'InvPending')>Details</a>";
		}
		echo"</td>";
		echo "<td>$InvSorryCount"; 
		if($InvSorryCount)
		{
			echo "<br><a href='#' onclick="."ShowPopup('$ST_DT','$END_DT',$InvID,'InvSorry')>Details</a>";
		}
		echo"</td>";
		echo "<td>$StockLeft</td>";
		echo "<td>$WeighingUnit</td>";
		echo"</tr>";
	}
}
if($PageNumber==7)
{
	
	if($UserType==0)
	{
		$CondStr=" and IssuedTo=".$UserID;
	}
	else
	{
		$CondStr="";
	}
	echo "<table border='1' align='center' style='border-radius:1px;background:#73AD21;'>";
	$RequestStatusQueryStr="select ItemID,DateOfAction,ActionType,(select Name from itemdescription where ItemID=itemhistory.ItemID) as ItemName,DateOfIssue,DateOfRequest,IssuedBy,IssuedTo,IssuedFor,Quantity,RequestRem,issueRem,HistoryID,DateOfDelivery,DeliveryStatus from itemhistory where  TransType='debit' $CondStr"." order by DateOfRequest Desc";
	//echo $RequestStatusQueryStr;
	$RequestStatusQueryRow=$conn->query($RequestStatusQueryStr);
	echo "<tr>";
	if($UserType==0)
	{
		echo "<td>ItemName</td>";
		echo "<td>DateOfRequest</td>";
		echo "<td>IssueFor</td>";
		echo "<td>Quantity</td>";
		echo "<td>RequestRemarks</td>";
		echo "<td>Status</td>";
	}
	else
	{
		echo "<td>ItemName</td>";
		echo "<td>DateOfRequest</td>";
		echo "<td>RequestBy</td>";
		echo "<td>RequestFor</td>";
		echo "<td>Quantity</td>";
		echo "<td>RequestRemarks</td>";
		echo "<td>Status</td>";
	}

	echo "<tr>";
	$count=0;
	while($row=$RequestStatusQueryRow->fetch_assoc())
	{
		$InvName=$row['ItemName'];
		$DateOfIssue=$row['DateOfIssue'];
		$DateOfRequest=$row['DateOfRequest'];
		$IssuedBy=$row['IssuedBy'];
		$IssuedFor=$NameVsPnoArray[$row['IssuedFor']];
		$IssuedTo=$NameVsPnoArray[$row['IssuedTo']];
		$Quantity=$row['Quantity'];
		$ItemID=$row['ItemID'];
		$ActionType=$row['ActionType'];
		$HistoryID=$row['HistoryID'];
		$DeliveryStatus=$row['DeliveryStatus'];
		$DateOfDelivery=$row['DateOfDelivery'];
		$RequestRem=$row['RequestRem'];
		echo "<tr>";
		echo "<td>".$InvName."</td>";
		echo "<td>".date('D, jS F Y ', strtotime($DateOfRequest))."</td>";
		if($UserType==1)
		{
			echo "<td>".$IssuedTo."</td>";
		}
		echo "<td>".$IssuedFor."</td>";
		echo "<td>".$Quantity."</td>";
		echo "<td>".$RequestRem."</td>";

		if($IssuedBy==0)
		{
			if($UserType==0)
			{
				echo "<td>Pending</td>";
			}
			else
			{
				$count++;
				echo "<form name='PendingForm$ItemID' id= 'PendingForm$ItemID' action='Login.php' method='POST'><input type='hidden' name='ItemID' value='$ItemID'><input type='hidden' name='HistoryID' value='$HistoryID'><td id='Pending$count'><input type='submit' name='Pending' value='Pending' onmouseover='ShowOptions($ItemID,$count)' ></td>";
				echo "<td style='display:none' id='Options$count'><select id='DropDownOptions$count'  name='DropDownOptions' onmouseout='HideOptions($ItemID,$count)' onchange='SubmitForm($ItemID)'> <option value='0'>NoAction</option><option value='1'>Accept</option><option value='2'>Sorry</option></select></td><input type='hidden' value='' id='Reason$ItemID' name='Reason'></form>";
			}
		}
		else
		{
			if($ActionType==1)
			{
				if($DeliveryStatus==0)
				{
					if($UserType==0)
					{
						echo "<td id='ConfimationArea$HistoryID'>Processed On ".date('D, jS F Y ', strtotime($row['DateOfAction']))." (<a href='#' "."onclick="."ConfirmDelivery('$ItemID','$HistoryID',1)>Confirm Delivery</a>)</td>";
					}
					else
					{
							echo "<td id='ConfimationArea$HistoryID'>Processed On ".date('D, jS F Y ', strtotime($row['DateOfAction']))."</td>";
					}
				}
				else
				{
					if($UserType==0)
					{
						echo "<td>Delivered On ".date('D, jS F Y ', strtotime($DateOfDelivery))."</td>";
					}
					else
					{
						if($DeliveryStatus==1)
						{
							echo "<td id='ConfimationArea$HistoryID'>Delivered On ".date('D, jS F Y ', strtotime($DateOfDelivery))." (<a href='#' "."onclick="."ConfirmDelivery('$ItemID','$HistoryID',2)>Acknowledge</a>)</td>";
						}
						else
						{
							echo "<td>Delivered On ".date('D, jS F Y ', strtotime($DateOfDelivery))." (Received By Indentor)</td>";
						}
					}
				}
			}
			else
			{
				echo "<td style='color:red'>Said Sorry On ".date('D, jS F Y ', strtotime($row['DateOfAction'])). " for this item</td>";
			}
		}
		echo "</tr>";

		
	}
	echo "<input type='hidden' id='TotalPending' value='$count'>";
	echo "</table>";

}

?>


</body>

