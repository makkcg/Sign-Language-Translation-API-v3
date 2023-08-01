/* Write here your custom javascript codes */


/*
 * hatem kamel
 * 
 * App controllers
 * 
 * 19/9/2019
 */


var khalifa = function () {

//const public_end = "http://kcgaccessibility.com/kcgprojects/so3obat/public/";
	 const public_end = "http://kcgwebservices.net/arabicsigntranslator/public/";
//	 const public_end = "http://localhost/khalifatranslationapi/public/";

function showUpgrade(){
	$("#passwordBtn").on('click',function(){
        var newpassword=$("#newpassword").val();
        var hash=$("#hash").val();
        var email=$("#email").val();
if(!newpassword){
	$.notify({
   		// options
   		message: 'برجاء كتابة كلمة المرور الجديدة' 
   	},{
   		// settings
   		type: 'danger',
   		z_index:'999999'
   	});
	return false;
}
							       	$
									.ajax({
										type : "POST",
										url : public_end + "crm/updatePasswordCustomer",
										dataType : 'json',
										 data:{
									          password: newpassword,
									          hash:hash,
									          email:email
									        },
										async : false,
										complete : function(data, status, xhttp) {
											$.notify({
								   	    		// options
								   	    		message: 'تم تغيير كلمة المرور بنجاح' 
								   	    	},{
								   	    		// settings
								   	    		type: 'success',
								   	    		z_index:'999999'
								   	    	});
										},
										success : function(data, status, xhttp) {

										
//											 $( "#upgradeAcc" ).toggle();
										}
									});
	

	});
	$("#EditProfile").on('click',function(){
		$("#editprofilebtn").on('click',function(){
			var first_name=$("#first_name").val();
			var mobile1=$("#mobile1").val();
			var password=$("#password").val();
			var passwordConfirm=$("#passwordConfirm").val();
			var data={};
			if(mobile1){
				 data.mobile1=mobile1;
			}
			if(first_name){
				 data.first_name=first_name;			
			}
			if(password &&passwordConfirm ){
				if(password!=passwordConfirm){
					$.notify({
		   	    		// options
		   	    		message: 'كلمة المرور غير متطابقة' 
		   	    	},{
		   	    		// settings
		   	    		type: 'danger',
		   	    		z_index:'999999'
		   	    	});
				}else{
					data.password=password;
				}
			}
			
			$
			.ajax({
				type : "POST",
				url : public_end + "crm/updateCustomerProfile",
				dataType : 'json',
				 data:data,
				async : false,
				complete : function(data, status, xhttp) {
					$.notify({
		   	    		// options
		   	    		message: 'تم تحديث بياناتك' 
		   	    	},{
		   	    		// settings
		   	    		type: 'success',
		   	    		z_index:'999999'
		   	    	});
				},
				success : function(data, status, xhttp) {

				
					 $( "#EditProfileForm" ).toggle();
				}
			});
		});
		 $( "#EditProfileForm" ).toggle();

	});
	$("#showUpgrade").on('click',function(){
		return $( "#upgradeAcc" ).toggle();
	});
	$("#sendRequest").on('click',function(){
        var requested=$('input[name="chosenPlan"]:checked').val();

							       	$
									.ajax({
										type : "POST",
										url : public_end + "crm/UpgradeRequest",
										dataType : 'json',
										 data:{
									          plan: requested
									        },
										async : false,
										complete : function(data, status, xhttp) {
											$.notify({
								   	    		// options
								   	    		message: 'سيقوم احد مسئولى النظام بالتواصل معكم' 
								   	    	},{
								   	    		// settings
								   	    		type: 'success',
								   	    		z_index:'999999'
								   	    	});
										},
										success : function(data, status, xhttp) {

										
											 $( "#upgradeAcc" ).toggle();
										}
									});
	

	})
}
    function isLogged() {
    	var loggeduser=Cookies.get('_khalifa');
    	if(loggeduser==undefined){
    		//user is not logged in change menues text but creat needed cookies and set parameters
    		//1 create cart cookies
//    		Cookies.set('alyashmacCart' );
//    		Cookies.set('alyashmacUser' );
//    		
    		return false;
    	}else{
    		return true;
    	}
    }
    
    
    
    function handleResponse(responseText, statusText, xhr, $form)  { 
    if(xhr.status==201){

		var respo=xhr.responseJSON;
			if(respo.status==123){
					$.notify({
   	    		// options
   	    		message: respo.msg 
   	    	},{
   	    		// settings
   	    		type: 'danger',
   	    		z_index:'999999'
   	    	}); 	    	
			}else{
			$.notify({
   	    		// options
   	    		message: 'تم انشاء الحساب بنجاح' 
   	    	},{
   	    		// settings
   	    		type: 'success',
   	    		z_index:'999999'
   	    	});
			window.location.replace(public_end+"crm/CustomerLogin");

			}
  
    	  
    }else{

	    	$.notify({
   	    		// options
   	    		message: 'حدث خطأ برجاء التواصل مع مسئول الموقع' 
   	    	},{
   	    		// settings
   	    		type: 'danger',
       	    		z_index:'999999'

   	    	});
    }

    } 
    function SignupForm(){
    	var signup=$("#signup");
    	var options = { 
//    	        target:        '',   // target element(s) to be updated with server response 
//    	        beforeSubmit:  showRequest,  // pre-submit callback 
    	        success:       handleResponse,  // post-submit callback 
    	 
    	        // other available options: 
    	        url:       public_end+'crm/CreateCustomerAccount',         // override for form's 'action' attribute 
    	        type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
    	        dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
    	        clearForm: true        // clear all form fields after successful submit 
    	        //resetForm: true        // reset the form after successful submit 
    	 
    	        // $.ajax options can be used here too, for example: 
    	        //timeout:   3000 
    	    }; 
    	signup.validate({                   
            // Rules for form validation
            rules:
            {
                
                email:
                {
                    required: true,
                    email: true
                },
                password:
                {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                },
                passwordConfirm:
                {
                    required: true,
                    minlength: 3,
                    maxlength: 20,
                    equalTo: '#password'
                },
			national_id_number:{ 
			required: true,
			number:true
			},
			mobile:{ 
			required: true,
			number:true
			},
                firstname:
                {
                    required: true
                },
                lastname:
                {
                    required: true
                },
                terms:
                {
                    required: true
                }
            },
            
            // Messages for form validation
            messages:
            {
               
                email:
                {
                    required: 'من فضلك ادخل بريدك الالكترونى ',
                    email: 'من فضلك ادخل بريدك الالكترونى بشكل صحيح'
                },
                password:
                {
                    required: 'من فضلك ادخل كلمة المرور'
                },
                passwordConfirm:
                {
                    required: 'من فضلك ادخل كلمة المرور مرة اخرى',
                    equalTo: 'يجب ان تدخل نفس كلمة المرور السابق ادخالها'
                },
                firstname:
                {
                    required: 'من فضلك ادخل اسمك الاول'
                },
                lastname:
                {
                    required: 'من فضلك ادخل اسم العائلة'
                },
                terms:
                {
                    required: 'يجب ان توافق على سياسة الاستخدام و الخصوصية'
                }
            },                  
            submitHandler: function(form) {
            	signup.ajaxSubmit(options); 
            	    return false; 

            	},
            errorPlacement: function(error, element)
            {
                error.insertAfter(element.parent());
            }
        });
    }
    function ResetPassword(){
       	var login=$("#resetform");
    	var options = { 
//    	        target:        '',   // target element(s) to be updated with server response 
//    	        beforeSubmit:  showRequest,  // pre-submit callback 
    	        success:       handleReset,  // post-submit callback 
    	 
    	        // other available options: 
    	        url:       public_end+'crm/ResetAccount',         // override for form's 'action' attribute 
    	        type:      'post',        // 'get' or 'post', override for form's 'method' attribute 
    	        dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
    	        clearForm: true        // clear all form fields after successful submit 
    	        //resetForm: true        // reset the form after successful submit 
    	 
    	        // $.ajax options can be used here too, for example: 
    	        //timeout:   3000 
    	    }; 
    	login.validate({
            // Rules for form validation
            rules:
            {
            	username:
                {
                    required: true,
                    email: true
                },
               
            },
                                
            // Messages for form validation
            messages:
            {
                username:
                {
                    required: ' ارجوا ادخال بريدك الالكتروني',
                    email: ' يرجى ادخال بريد الكتروني صحيح'
                },
               
            },                  
            submitHandler: function(form) {
            	login.ajaxSubmit(options); 
            	    return false; 

            	},
            errorPlacement: function(error, element)
            {
                error.insertAfter(element.parent());
            }
        }); 
    }
    function handleReset(responseText, statusText, xhr, $form)  { 
        if(xhr.status==201){

    		var respo=xhr.responseJSON;
    			if(respo.status==2034){
    					$.notify({
       	    		// options
       	    		message: respo.msg 
       	    	},{
       	    		// settings
       	    		type: 'danger',
       	    		z_index:'999999'
       	    	}); 	    	
    			}else{
    			$.notify({
       	    		// options
       	    		message: 'تم ارسال تعليمات اعادة تعيين كلمة المرور الى بريدك الالكتروني المسجل لدينا' 
       	    	},{
       	    		// settings
       	    		type: 'success',
       	    		z_index:'999999'
       	    	});
//    			window.location.replace(public_end+"crm/CustomerLogin");

    			}
      
        	  
        }else{

    	    	$.notify({
       	    		// options
       	    		message: 'حدث خطأ برجاء التواصل مع مسئول الموقع' 
       	    	},{
       	    		// settings
       	    		type: 'danger',
           	    		z_index:'999999'

       	    	});
        }

        } 
    function loginForm(){
       	var login=$("#loginform");
       
    	login.validate({
            // Rules for form validation
            rules:
            {
            	username:
                {
                    required: true,
                    email: true
                },
                password:
                {
                    required: true,
                    minlength: 3,
                    maxlength: 20
                }
            },
                                
            // Messages for form validation
            messages:
            {
                username:
                {
                    required: ' ارجوا ادخال بريدك الالكتروني',
                    email: ' يرجى ادخال بريد الكتروني صحيح'
                },
                password:
                {
                    required: 'من فضلك ادخل كلمة المرور الخاصة بحسابك',
					minlength: 'كلمة السر لا تقل عن 3 حروف',
                }
            },                  
            submitHandler: function(form) {
            	var username = $("input#username").val();
               	var password = $("input#password").val();

               
               	$.ajax
               	  ({
               	    type: "POST",
               	    url: public_end+"customer_token",
               	    dataType: 'json',
               	    async: false,
               	 beforeSend: function (xhr) {
               	    xhr.setRequestHeader ("Authorization", "Basic " + btoa(username + ":" + password));
               	},
                complete: function (data, status, xhttp){
               	    if(data.status==201){
               	    	$.notify({
               	    		// options
               	    		message: 'تم تسجيل الدخول بنجاح' 
               	    	},{
               	    		// settings
               	    		type: 'success',
               	    		z_index:'999999'
               	    	});
//               	  sessionStorage.setItem('_Alyashmac', data.token); //set
               	    }else{
               	    	$.notify({
               	    		// options
               	    		message: 'كلمة السر خاطئة! يرجى اعادة المحاولة أو استعادة كلمة السر باختيار (نسيت كلمة السر)' 
               	    	},{
               	    		// settings
               	    		type: 'danger',
                   	    		z_index:'999999'

               	    	});
               	    }
               	    },
               	    success: function (data, status, xhttp){
      
                    	window.location.href = public_end+"home";


               	    }
               	});
            	    return false; 

            	},
            errorPlacement: function(error, element)
            {
                error.insertAfter(element.parent());
            }
        });
    }

    function submitForm(formid,url,type,dataType){
//    	var signup= 	$("#"+formid+"");
	   	 var options = { 
//	    	        target:        '',   // target element(s) to be updated with server response 
	    	        beforeSubmit: hatemovich ,  // pre-submit callback 
	    	        success:       function(){
	    		  		$("#modalsurvey").modal( 'hide' ).data( 'bs.modal', null );
	    	        	$.notify({
	          	    		// options
	          	    		message: 'تم تسجيل الاستبيان بنجاح' 
	          	    	},{
	          	    		// settings
	          	    		type: 'success',
	          	    		z_index:'999999'
	          	    	});
	    	        },  // post-submit callback 
	    	 
	    	        // other available options: 
//	    	        url:       url,         // override for form's 'action' attribute 
	    	        type:      type,        // 'get' or 'post', override for form's 'method' attribute 
	    	        dataType:  dataType,        // 'xml', 'script', or 'json' (expected server response type) 
	    	        clearForm: true        // clear all form fields after successful submit 
	    	        //resetForm: true        // reset the form after successful submit 
	    	 
	    	        // $.ajax options can be used here too, for example: 
	    	        //timeout:   3000 
	    	    }; 
	   	$("#"+formid+"").ajaxForm(options); 


 
    }

    function hatemovich(formData, jqForm, options){  
    	  for (var i=0; i < formData.length; i++) { 
    	        if (formData[i].value=="") { 
    	        	$.notify({
          	    		// options
          	    		message: 'يجب الاجابة عن جميع الاسئلة' 
          	    	},{
          	    		// settings
          	    		type: 'danger',
          	    		z_index:'999999'
          	    	});
    			return false;
    	        } 
    	    } 

     	
    }

    questionObj={
   			questionid:'',
   			question_program:'',
   			question_group:'',
   			answer:''
   	   			};

    function progManagement(zz){

    	   var question_group=zz.parent().data("qgroup")
    	   var question_program=zz.parent().data("programid")
    	   var questionid=zz.parent().data("qid")
    	   var value=zz.val();
    	   
 	     questionObj={
   			questionid:questionid,
   			question_program:question_program,
   			question_group:question_group,
   			answer:value
   	   			};

 	 	//calculate persentage no back button exist
 	    var yesCountspan=$("#yes_"+question_group+"").text();
 	    var noCountspan=$("#no_"+question_group+"");
 	    var totalCountspan=$("#question_count_"+question_group+"");
 	     switch (value) {
		case "1":
			var inc=$("#yes_"+question_group+"");
			break;
		case "2":
			var inc=$("#no_"+question_group+"");

			break;
		case"":
			return false;

			break;
		
		}
 var res=parseInt(inc.text())+1
 	    inc.text(res);
 var proglimit=Math.round((30/100) * parseInt(totalCountspan.text())) ;

 var indicator=(parseInt(noCountspan.text()) > parseInt(proglimit))?true:false;
 if(indicator){
	 var input = document.createElement("input");

	 input.setAttribute("type", "hidden");

	 input.setAttribute("name", "question_group");

	 input.setAttribute("value", question_group);

	 //append to form element that you want .{{
	 var surveyid=zz.closest('form').attr('id');
	 document.getElementById(""+surveyid+"").appendChild(input);
	 //submit survey result and close 
	 uncompletedResults(surveyid,'','post','json');
	  var popupWin = window.open(''+public_end+'assets/programes/'+question_program+'.doc', '_blank', 'width=600,height=600,scrollbars=no,menubar=no,toolbar=no,location=no,status=no,titlebar=no');
      popupWin.window.focus();
 }


 	    }
	

    function LoadSurvey() {
    	
        jQuery('.surveybtn').on('click', function(event) {
        	  event.preventDefault();
      		var url=$(this).data('url');
      		 surveyid=$(this).data('surveyid');
        	  $.ajax({
        	      type: "GET",
        	      url: url,
        	      contentType: "application/x-www-form-urlencoded",
        	      dataType: "html",
        	      success: function (data) {
//
        	      },
        	      error: function () {
        	      },
        	      complete: function (jqXHR) {
        	    	  if(jqXHR.readyState === 4) {
        	    	      //everything is kewayesa draw the modal w ne3esh
        	    		  $("#ajaxmodal").html(jqXHR.responseText)
        	    		  .promise().done(function() {
        	    			  $("#modalsurvey").modal({   
        	    				  backdrop: 'static',
        	    				    keyboard: false
        	    			  	}).promise().done(function(){  
        	    				   $signupForm =   $("#"+surveyid+"");

        	    				  $signupForm.validate({errorElement: 'em'});

        	    				  $signupForm.formToWizard({
        	    				    submitButton: 'SaveSurvey',
        	    				    nextBtnClass: 'btn btn-primary next',
        	    				    prevBtnClass: 'btn btn-default prev',
        	    				    buttonTag:    'button',
        	    				    validateBeforeNext: function(form, step) {
//declare 
        	    				    	
        	    				    	   var zz= $(":selected", step);
        	    				    	    progManagement(zz);
        	    				    	   var value=zz.val();
//        	    				    	   callWatchers(questionObj, "answer"); //invoke the watcher​​



        	    				    	   //##FIX determine if this is the last step or not to validate
        	    				    	   steps = $( document ).find( "fieldset" )
        	    				           count = steps.length

        	    				           if(value ==1 || value ==2){


        	    				        	   	
       	    				    			return true;
       	    				    		}else{
       	    				    			$.notify({
       	    		               	    		// options
       	    		               	    		message: 'يجب الاجابة عن السؤال' 
       	    		               	    	},{
       	    		               	    		// settings
       	    		               	    		type: 'danger',
       	    		               	    		z_index:'999999'
       	    		               	    	});
       	    				    			zz.parent().addClass('add_shaker');
       	    				    			return false;

       	    				    		}
        	    				

        	    				    },
        	    				    progress: function (i, count) {
        	    				      $('#progress-complete').width(''+(i/count*100)+'%');
        	    				    }
        	    				  });
        	    			  }).promise().done(function(){
        	    				 submitForm(surveyid,'','post','json'); });

        	    			
        	    			  });
        	    		
        	    	    }
        	    	  
        	      }
        	    });  // end Ajax        
         
        });
    }
function uncompletedResults(formid,url,type,dataType){
	var uncompleted=$("#"+formid+"");
	var options = { 
// 	        target:        '',   // target element(s) to be updated with server response 
// 	        beforeSubmit: hatemovich ,  // pre-submit callback 
 	        success:       function(){
 		  		$("#modalsurvey").modal( 'hide' ).data( 'bs.modal', null );
 	        	$.notify({
       	    		// options
       	    		message: 'تم تسجيل الاستبيان بنجاح' 
       	    	},{
       	    		// settings
       	    		type: 'success',
       	    		z_index:'999999'
       	    	});
 	        },  // post-submit callback 
 	 
 	        // other available options: 
// 	        url:       url,         // override for form's 'action' attribute 
 	        type:      type,        // 'get' or 'post', override for form's 'method' attribute 
 	        dataType:  dataType,        // 'xml', 'script', or 'json' (expected server response type) 
 	        clearForm: true        // clear all form fields after successful submit 
 	        //resetForm: true        // reset the form after successful submit 
 	 
 	        // $.ajax options can be used here too, for example: 
 	        //timeout:   3000 
 	    }; 
	uncompleted.ajaxSubmit(options); 
	
}
function translateService(){
   	
    jQuery('.totranslate').on('click', function(event) {
    	  event.preventDefault();
    	  console.log('as');
    	  var options = { 
//	    	        target:        '',   // target element(s) to be updated with server response 
//	    	        beforeSubmit: hatemovich ,  // pre-submit callback 
	    	        success:       function(){
	    	        	$.notify({
	          	    		// options
	          	    		message:'تم اضافة حساب الطفل بنجاح'
	          	    	},{
	          	    		// settings
	          	    		type: 'success',
	          	    		z_index:'999999'
	          	    	});
	    	        },  // post-submit callback 
	    	 
	    	        // other available options: 
//	    	        url:       url,         // override for form's 'action' attribute 
	    	        type:     'post',        // 'get' or 'post', override for form's 'method' attribute 
	    	        dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
	    	        clearForm: true        // clear all form fields after successful submit 
	    	        //resetForm: true        // reset the form after successful submit 
	    	 
	    	        // $.ajax options can be used here too, for example: 
	    	        //timeout:   3000 
	    	    }; 
    	  
    	  $("#formtranslate").ajaxSubmit(options); 
    	  


    });
}
function translationSettings(){
   	
    jQuery('.translatesettings').on('click', function(event) {
    	  event.preventDefault();
    	  console.log('as');
    	  var options = { 
//	    	        target:        '',   // target element(s) to be updated with server response 
//	    	        beforeSubmit: hatemovich ,  // pre-submit callback 
	    	        success:       function(){
	    	        	$.notify({
	          	    		// options
	          	    		message:'تم اضافة حساب الطفل بنجاح'
	          	    	},{
	          	    		// settings
	          	    		type: 'success',
	          	    		z_index:'999999'
	          	    	});
	    	        },  // post-submit callback 
	    	 
	    	        // other available options: 
//	    	        url:       url,         // override for form's 'action' attribute 
	    	        type:     'post',        // 'get' or 'post', override for form's 'method' attribute 
	    	        dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
	    	        clearForm: true        // clear all form fields after successful submit 
	    	        //resetForm: true        // reset the form after successful submit 
	    	 
	    	        // $.ajax options can be used here too, for example: 
	    	        //timeout:   3000 
	    	    }; 
    	  
    	  $("#formtranslate").ajaxSubmit(options); 
    	  


    });
}
    return {
        init: function () {
        	isLogged();
//        	AlyashmacTinyCart();
        	SignupForm();
        	loginForm();
        	LoadSurvey();
        	translateService();
        	translationSettings();
			ResetPassword();
			showUpgrade();
        },

     
    };
	
}();
