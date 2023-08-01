<?php


?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
if(temp=="") window.location.replace("../index.php");
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
			alert(data);
			if(data=="ok")  window.location.replace("userslist.php");
			else window.location.replace("../");
					 
				   },
      error : function(jqXHR, textStatus, error)
                                            {
												 
                                             }		 
											 
                       });
}

</script>

