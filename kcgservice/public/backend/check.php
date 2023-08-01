<?php
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data
	
	
?>
<!doctype html>
<html class="no-js" lang="zxx">

<!-- Mirrored from preview.colorlib.com/theme/abcbook/about.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 09 Nov 2022 23:08:40 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>check</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>
function getAuthCookie() {
   var cn = "Authorization=";
   var idx = document.cookie.indexOf(cn)

   if (idx != -1) {
       var end = document.cookie.indexOf(";", idx + 1);
       if (end == -1) end = document.cookie.length;
       return unescape(document.cookie.substring(idx + cn.length, end));
   } else {
       return "";
  }
}

var temp=getAuthCookie() ;
//alert(temp);
if(temp=="") window.location.replace("../");

else {
$.ajax({
        url : '../techservice.php',
        type : 'POST',	
				                  
	async:true,
	beforeSend: function(xhr) {
        xhr.setRequestHeader("Authorization", getAuthCookie());
                      },
        data : { 
		order:8
		 
				  
		},
					
             
        success : function(data) {
			//alert(data);
			//if(data=="go away")  window.location.replace("../");

			if(data=="go away")  window.location.replace("userslist.php");
			else
			 window.location.replace("userslist.php");
					 
				   },
      error : function(jqXHR, textStatus, error)
                                            {
												 
                                             }		 
											 
                       });
}

</script>
</head>
<body>
</body>
</html>