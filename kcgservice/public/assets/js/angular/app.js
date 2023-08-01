/*
 * pollyfills
 */
if (!Array.isArray) {
  Array.isArray = function(arg) {
    return Object.prototype.toString.call(arg) === '[object Array]';
  };
}

var app = angular.module("translateApp",['ngAnimate','toastr','xeditable']).config(function($interpolateProvider){
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');
}).constant('API', 'http://kcgwebservices.net/arabicsigntranslator/public/').factory('redirectInterceptor', function($q,$location,$window,API){
    return  {
        'response':function(response){
        if (typeof response.data === 'string' && response.data.indexOf("سجل دخول")>-1) {
            console.log("LOGIN!!");
            console.log(response.data);
            $window.location.href = API+"public/crm/CustomerLogin";
            return $q.reject(response);
        }else{
            return response;
        }
        }
    }

    });
app.config(['$httpProvider',function($httpProvider) {
    $httpProvider.interceptors.push('redirectInterceptor');
}]); 
app.factory('NotificationService',
        ['toastr', 'toastrConfig',
            function (toastr, toastrConfig) {
                var service = this;
                service.openToaster=function(){
              	  toastr.success('Hello world!', 'Toastr fun!');
                }
                return service;
            }]);
app.controller("TranslateCTRL",function($scope,toastr,$http,API,$filter){
	$scope.dataIsLoading = false;

	//var will be used incase user corrected some items
	$scope.finalWords=null;
	//retrive user default settings.
	$scope.showSettings=false;
	$scope.settings={};
	$scope.instructor_id=4;
	 var url=API+"Users/GetUserPrefrences";
	$http.post(url, null).then(function (response) {
		if(response.data!=false){
			var r=response.data;
			$scope.settings.videoext=r.videoext
			$scope.settings.tashkel=r.tashkel
			$scope.settings.videopopup=r.videopopup
			$scope.settings.serviceResult=r.serviceResult
			$scope.settings.taf3el=false;
			$scope.settings.tashkel=true;
		}else{
			//something went wrong ..load default settings
			$scope.settings.videoext="webm";
			$scope.settings.os="web";
			$scope.settings.tashkel=false;
			$scope.settings.videopopup=0;
			$scope.settings.serviceResult="json";
		}
	 });
	$scope.settings.tashkel=true;
	 $scope.$watch('$scope.settings.tashkel',function(newValue,oldValue){
	      if($scope.settings.tashkel==true){
	    	   $scope.spellerror=true;
			 	$scope.settings.tashkel=true;
	      }else{
	    	  $scope.spellerror=false;
			 	$scope.settings.tashkel=false;
	      }
	 });
	
	$scope.SaveSettings=function(){
		
	}
	$scope.satisfaied=function(){
 var data={
		 wordObj:$scope.finalWords,
		 videoArr:$scope.videoSource
 }

 
//		 var config = {
//	             headers : {
//	                 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
//	             }
//		 }
		 var url=API+"TranslateApi/SaveTranslatedRecord";
			$http.post(url,data ).then(function (response) {
				if(response.data!=false){
	              	  toastr.success('شكرا لمساهمتك');

				}else{
					//something went wrong ..load default settings
				
				}
			 });
		
	};
	$scope.notSatisfied=function(){
		 $scope.spellerror=true;
		 	$scope.settings.tashkel=true;
		 	
	};
	//hide video until text is there
//	SpellingService()
	$scope.showVideo=false;
	$scope.SpellingService=function(){
		$scope.dataIsLoading = true;

		 var url=API+"TranslateApi/Analyzer";
		 if(!$scope.toTranslate){
			 toastr.error('يرجى ادخال نص لترجمته الى لغة الاشارة');
			 return false;
		 }else{
		 var data=$.param({
	       "toTranslate":$scope.toTranslate,
	     });

	
		 var config = {
	             headers : {
	                 'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
	             }
		 }
		 $http.post(url, data, config).then(function (responses) {
			 if(responses.status==201){
				 var r=responses.data;
				 if(r.error){
					 toastr.error(r.error,r.msg);
				 }else{
					 //all suggestion loaded no need to return back to server.
					 if($scope.settings.tashkel==true){
						 $scope.spellerror=true;
					 }
					 
					 $scope.suggested=r.split;
					 $scope.kbase=r.kbase;
					 $scope.pronouns=r.pronouns;
					 $scope.core=r.core;
					 //start auto translate.
		$scope.showFinalWords=true;
						 $scope.finalWords=[];
						 var array=$scope.suggested;
//						if($scope.settings.tashkel==false){
							//extract the most common used  and immediatly translate based on .freq value

						 $scope.showFinalWords=true;
						 $scope.finalWords=[];
						  angular.forEach($scope.suggested, function(value, key) {
							  //check for each result.
							  //choose instructor if not choosen 	$scope.instructor_id=4;
							  //asNounCondition
							  //asMainNoun
							  //asPrepositionCondition
							  //asVerbCondition
							  var asVerbCondition=value.asVerbCondition;
							  var asPrepositionCondition=value.asPrepositionCondition;
							  var asMainNoun=value.asMainNoun;
							  var asNounCondition=value.asNounCondition;
							  var asPronoun=value.asPronoun;
								 var arr=value;

							  $scope.flag=true;
							  if(Array.isArray(asVerbCondition)){
									 //it have value now  filter with instructor then filter with maximum freq.
									 
									 $scope.finalChoosen = $filter('filter')( asVerbCondition, {instructor_id: $scope.instructor_id});
									 var len=$scope.finalChoosen.length;
if (len==0){
	$scope.flag=false;
}
							  }
							  else if(Array.isArray(asPrepositionCondition)){
								 //it have value now  filter with instructor then filter with maximum freq.
								 
								 $scope.finalChoosen = $filter('filter')( asPrepositionCondition, {instructor_id: $scope.instructor_id});
								 var len=$scope.finalChoosen.length;
								 if (len==0){
								 	$scope.flag=false;
								 }
							 }
							  else if(Array.isArray(asMainNoun)){
									 $scope.finalChoosen = $filter('filter')( asMainNoun, {instructor_id: $scope.instructor_id});
									 var len=$scope.finalChoosen.length;
									 if (len==0){
									 	$scope.flag=false;
									 }
							 }	
							  else if(Array.isArray(asNounCondition)){
									 $scope.finalChoosen = $filter('filter')( asNounCondition, {instructor_id: $scope.instructor_id});
									 var len=$scope.finalChoosen.length;
									 if (len==0){
									 	$scope.flag=false;
									 }

							 }
							   else if (Array.isArray(asPronoun)){
									 
									 $scope.finalChoosen = $filter('filter')( asPronoun, {instructor_id: $scope.instructor_id});
									 var len=$scope.finalChoosen.length;
									 if (len==0){
									 	$scope.flag=false;
									 }
								 }
							  else{
								 //didn't find the words
								 // paste the same value and pass it to next itteration to split and display letter to sign translation
								
								 $scope.finalChoosen=value;
								 $scope.flag=false;
							 }	

							  		
								
							  	if($scope.flag!=false){
								 var finalToTranslate=$scope.finalChoosen;
								 var lastchoice = finalToTranslate.reduce((max, auto) => max.freq > auto.votes ? max : auto);
								 $scope.finalWords.push(lastchoice);
							  		}else{
							  			 $scope.finalChoosen=value;
							  			$scope.finalChoosen.video_hash=null;
							  			 $scope.finalWords.push($scope.finalChoosen);
							  		}
							});

						  //start video 
						  console.log($scope.finalWords);
						  $scope.videoSource=[];

							  
						  angular.forEach( $scope.finalWords, function(value, key) {
						  		if(value.video_hash==null){
						  			//translate 1 by 1 and store the word
						  			var chars=value.unvocalized;
						  			var charsToVideo = chars.split('');
						  		//filter from the core lib sent by server
						  			for (var i = 0; i < charsToVideo.length; i++) {
						  				var k=charsToVideo[i];
						  				var Object=$scope.core.Alphabet;
						  				if(k in Object){
									  		this.push('http://kcgwebservices.net/arabicsigntranslator/Media/constants/'+$scope.instructor_id+'/alphabet/'+Object[k]);
	
						  				}
									}
						  			//store 
						  			 var url=API+"TranslateApi/SaveNoWordRec";
						  			 var data={
						  					 'tostore':chars
						  			 			}
						  			 
						 			$http.post(url,data ).then(function (response) {
						 				if(response.data!=false){
						 	              	  toastr.success('شكرا لمساهمتك');

						 				}else{
						 					//something went wrong ..load default settings
						 				
						 				}
						 			 });
						  		}else{
						  			//check whether we enable Arabic logic or not.
						  			
						  			if ($scope.settings.taf3el==true){
						  				//check what extra videos needs to be added.
						  				//check if verb to perform the below.
						  			//check for pronounce first
						  				//pronounce is allocated if is verb 
						  		var filterProunounVideo= $filter('filter')(  $scope.pronouns, {pronoun_id:value.pronounce_id});
						  		var LastfilterProunounVideo= $filter('filter')(  filterProunounVideo, {instructor_id:$scope.instructor_id});

						  		var pronoun_url= LastfilterProunounVideo[0].video_url; 
						  		console.log(pronoun_url);
						  		this.push(pronoun_url);
						  				//is_female if is_female is false then its male
						  				//is_plural if is_plural is false and is_doubled then its single.
						  				//is_doubled if true then plural and single false
if(value.is_doubled=='1')
{
//	alert('الفعل مثنى');
}
else if(value.is_plural=='1')
{
//	alert('الفعل جمع')
}else if (value.is_doubled=='0' && value.is_plural=='0'){
	//its single.
//	salert('الفعل مفرد');
}
						  				
						  
						  			 /*
						  			  * 						  				//tense_id
						  			  */
var Verbtense=$scope.core.VerbTensesID;

		var vv=value.tense_id;
		if(vv in Verbtense){
  		this.push('http://kcgwebservices.net/arabicsigntranslator/Media/constants/'+$scope.instructor_id+'/tenses/'+Verbtense[vv]);

		}

						  			}
						  			this.push(value.video_url);
						  		}
						  	},$scope.videoSource);
							

						  console.log($scope.videoSource);
							$scope.showVideo=true;
							$scope.dataIsLoading = false;
							
						  vplayer($scope.videoSource);
						
						
//						} 
						 
						 
						 
						 
						 
//						 angular.forEach(, function(value, key) {
//							  if(value.hasOwnProperty("chosen") ){
//							  this.push($scope.suggested[key].chosen);
//							  }else{
//								  this.push($scope.suggested[key]);
//							  }
//							}, $scope.finalWords);
				 }
			 }else{
			 }
		 });
	}//end if totranslate is not empty
	}
	//register watchers
$scope.CorrectedTranslation=function(){
	$scope.dataIsLoading = true;
	 var url=API+"TranslateApi/Analyzer";

		$scope.showFinalWords=true;
	 $scope.finalWords=[];
	  angular.forEach($scope.suggested, function(value, key) {
		  if(value.hasOwnProperty("chosen") ){
		  this.push($scope.suggested[key].chosen);
		  }else{
			  this.push($scope.suggested[key]);
		  }
		}, $scope.finalWords);
 //start video 
$scope.videoSource=[];
angular.forEach( $scope.finalWords, function(value, key) {
		if(value.video_hash==null){
			//translate 1 by 1 and store the word
			var chars=value.unvocalized;
			var charsToVideo = chars.split('');
  			for (var i = 0; i < charsToVideo.length; i++) {
  				var k=charsToVideo[i];
  				var Object=$scope.core.Alphabet;
  				if(k in Object){
			  		this.push('http://kcgwebservices.net/arabicsigntranslator/Media/constants/'+$scope.instructor_id+'/alphabet/'+Object[k]);

  				}
			}

		}else{

			 this.push(value.video_url);
		}
	},$scope.videoSource);

console.log($scope.videoSource);
$scope.showVideo=true;
$scope.dataIsLoading = false;
vplayer($scope.videoSource);

}
	$scope.vplayer=function(videoSource){
		return vplayer(videoSource);
	}
});

function vplayer(videoSource){


var videoCount = videoSource.length;
var video_index     = 0;

function onload(){
          videosToPlay = document.getElementById("videosToPlay");
          videosToPlay.addEventListener('ended',onVideoEnded,false);
          videosToPlay.src=videoSource[video_index];
          videosToPlay.play();
      }

function onVideoEnded(){    
          video_index++;
          if (video_index > videoCount-1) video_index = 0;
          videosToPlay.src=videoSource[video_index];
          videosToPlay.play();
      }


onload();
}
