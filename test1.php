<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script language="javascript" src="functions/jquery-1.4.2.min.js"></script>
<script>
var queryString = "data.php";//alert(queryString)
passdata = '';
 $.ajax(
		{
			type: "POST",url: queryString, data: passdata, cache: false,datatype: "json",
			success: function(ajaxresponse,status)
			{	
				
				var response1 = JSON.parse(ajaxresponse);
				$("#div1").html(response1['name']);
				$("#div2").html(response1['phone']);
				$("#div3").html(response1['email']);
				$("#div4").html(response1['district']);
			}, 
			error: function(a,b)
			{
				alert('2');
			}
	});	
</script>
</head>

<body>
<div id='div1'></div>
<div id='div2'></div>
<div id='div3'></div>
<div id='div4'></div>
</body>
</html>