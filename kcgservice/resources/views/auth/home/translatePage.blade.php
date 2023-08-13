
@include('auth.home.base')



<!--=== Header v5 ===-->

<style>
.loading {
  position: fixed;
  z-index: 999;
  height: 2em;
  width: 2em;
  overflow: visible;
  margin: auto;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
}

/* Transparent Overlay */
.loading:before {
  content: '';
  display: block;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.3);
}

/* :not(:required) hides these rules from IE9 and below */
.loading:not(:required) {
  /* hide "loading..." text */
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.loading:not(:required):after {
  content: '';
  display: block;
  font-size: 10px;
  width: 1em;
  height: 1em;
  margin-top: -0.5em;
  -webkit-animation: spinner 1500ms infinite linear;
  -moz-animation: spinner 1500ms infinite linear;
  -ms-animation: spinner 1500ms infinite linear;
  -o-animation: spinner 1500ms infinite linear;
  animation: spinner 1500ms infinite linear;
  border-radius: 0.5em;
  -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
  box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) -1.5em 0 0 0, rgba(0, 0, 0, 0.75) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
}

/* Animation */

@-webkit-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-moz-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@-o-keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
@keyframes spinner {
  0% {
    -webkit-transform: rotate(0deg);
    -moz-transform: rotate(0deg);
    -ms-transform: rotate(0deg);
    -o-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
    -moz-transform: rotate(360deg);
    -ms-transform: rotate(360deg);
    -o-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}
</style>

<div class="header-v5">



@include('auth.home.partials.navbar')

	<!-- End Navbar -->
</div>
<!--=== End Header v5 ===-->

 <!--=== Profile ===-->
    <div ng-app="translateApp" class="container content profile content-wrapper">	
    	<div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
                <img class="img-responsive profile-img margin-bottom-20" src="{{URL::asset('assets/img/team/img1-md.jpg')}}" alt="">

              
        
                @include('auth.home.partials.profileMenu') 
	

             

             
            </div>
            <!--End Left Sidebar-->
               <!-- Profile Content -->            
            <div  class="col-md-9">
             <div class="profile-body margin-bottom-20">
               
				<div class="row margin-bottom-20">
    <!--Profile Blog-->
    <!--video creation-->
     <!-- Advanced settings -->
          <div  class="show-hide row">
            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">

                <!-- Card Header - Accordion -->
                <div class="d-block card-header py-3"    >
                  <h6 class="m-0 font-weight-bold text-primary">الاعدادت المتقدمة </h6>
                </div>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="">
                  <!-- Select  type of video -->
                  <div class="row">
                    <!--<div class="col-md-4 left-bord">
                      <div class="trans-options">
                        <span> نوع ملفات الفيديو المترجمة </span>
                        <select ng-model="settings.videoext" name="extention" aria-controls="" class="custom-select  form-control">
                          <option selected value="webm">Webm</option>
                          <option disabled value="mp4">Mp4 </option>
                          <option disabled value="mov"> Mov</option>
                          <option disabled value="base64">Base 64 </option>

                        </select>
                        <span> نظام التشغيل </span>
                        <select name="os" ng-model="settings.os"  aria-controls="" class="custom-select  form-control">
                          <option selected value="web"> Web</option>
                          <option disabled value="ios"> IOS</option>
                          <option disabled  value="android"> Android</option>

                        </select>
                      </div>
                    </div>-->
                    <!-- End of Select  type of video -->
                    <!-- Select how to show video-->
                    <div class="col-md-6 left-bord">
                      <!--<div class="trans-options">
                        <span for=""> عرض الفيديو Stream</span>
                        <div class="form-group">
                          <label for="">Yes</label>
                          <input type="radio" id="" value="1" name="video-show">
                        </div>
                        <div class="form-group">
                          <label>File Links </label>
                          <input type="radio" id="" value="0"  name="video-show">
                        </div>
                      </div>-->
                      <!--<div class="trans-options">
                        <span for=""> ترجمة قطعة او جملة </span>
                        <div class="form-group">
                          <label for="">ترجمة القطعة كاملة</label>
                          <input type="radio" id="" value="1" name="translate-size">
                        </div>
                        <div class="form-group">
                          <label>ترجمة جملة جملة </label>
                          <input type="radio" id="" value="0" name="translate-size">
                        </div>
                       
                      </div>-->
                     <div class="trans-options">
                        <span for=""> اختر المترجم</span>
                        <div class="form-group">
                        <input ng-checked = "true" ng-model="instructor_id" type="radio"  onclick="choosePerson(1)"  value="4" name="instructor_id">
                          <label for="">عمرو جمال</label>
                         
                        </div>
                        <div class="form-group">
                        <input ng-model="instructor_id" type="radio"  onclick="choosePerson(2)"  value="5"  name="instructor_id">  
                        <label>هاجر</label>
                          
                        </div>
                       
                      </div>
                     
                      
                    </div>
                    <div class="col-md-6 left-bord">
                    <div class="switcher">
                        <span for=""> تفعيل قواعد اللغة العربية </span>

                        <input type="checkbox" id=""  ng-model="settings.taf3el"  name=""  value="true">
                        
                      </div>
                      <div class="switcher">

                       
                        <span for=""> تـعطيــل الترجمــة الآلـــية </span>
                        <input type="checkbox" id=""  ng-model="settings.tashkel"  name=""  value="true">

                       </div>
                    </div>
                    <!-- End of Select how to show video-->
                     <!--<div class="col-md-4 ">
                      <div class="trans-options">
                        <span for=""> طريقة عرض الترجمة</span>
                        <div class="form-group">
                          <label for="">عرض الترجمة فى PoPup</label>
                          <input type="radio" id="" ng-model="settings.videopopup" value="1"  ng-disabled="true" name="frame-video">

                        </div>
                        <div class="form-group">
                          <label>عرض الترجمة فى عارض فيديو</label>
                          <input type="radio" id="" ng-model="settings.videopopup" value="0" name="frame-video">
                        </div>

                      </div>
                      <div class="trans-options">
                        <span for=""> نوع الرد فى السيرفيس</span>
                        <div class="form-group">
                          <label for="">JSON File</label>
                          <input type="radio"  ng-model="settings.serviceResult" value="json" id="" name="services-req">

                        </div>
                        <div class="form-group">
                          <label>XML File</label>
                          <input type="radio" id="" ng-model="settings.serviceResult" value="xml" ng-disabled="true" name="services-req">
                        </div>

                      </div>
                    </div>-->
                  </div>
                </div>

              </div>
            </div>
          </div>
          <!-- End  of Advanced settings -->
    
          <div  class="row">

            <div class="col-lg-12 mb-4">

              <!-- About the Project -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">مترجم النصوص العربية الى لغة الاشارة</h6>
                                 <button class="btn bg-gradient-info dropdown-toggle" type="button" id="dropdownMenuButton"
                    ng-click="showSettings=!showSettings" aria-haspopup="true" aria-expanded="false">
                    ضبط الإعدادت
                  </button>
                </div>
                </div>
                <!-- End of About the Project -->

                <!-- video Tag-->

      <!--<div ng-show="dataIsLoading"  class="loading">Loading&#8230;</div>-->
 
             <div  ng-show="showVideo"  class="row">
                <div  class="video-container">
                <video id="videosToPlay"  autoplay="autoplay"  onended="nextvideo()"  width="100%"  controls="controls" >
                
                 <source src="" type="video/webm">
								</video>
                <div id="worddiv" style="text-align:center;background:#000 ;color:#fff;width:100%;font-size:16px;">
                </div> 
                  <!--<div class="current-text bg-gradient-danger">
                  
                   <span ng-if="showFinalWords">
                  <div ng-repeat="word in finalWords">
                 <span  ng-if="word.vocalized">	مشكل</span>
                  
                   <span  ng-if="!word.vocalized">	بدون تشكيل</span>
    
                  </div>
                  </span>
                  
                  </div>-->
                </div>

                <!-- End of video Tag -->
                <!-- confirm & no confirm btns -->
                <!--<div  class="actions-btn">
                  <button ng-click="satisfaied()" class="btn  bg-gradient-success" id="confirm"> الترجمة صحيحة</button>
                  <button ng-click="notSatisfied()"class="btn  bg-gradient-danger" id="unconfirm"> الترجمة خاطئة</button>
                </div>-->
                </div>
                <!-- End of confirm & no confirm btns -->
           
                <!-- End of rest button -->
      	<div class="row">
           
          	  <!--     <div ng-show="spellerror" class="col-lg-12 mb-4">
             
              <div class="card shadow mb-4">
              
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button"
                  aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">النصوص المقترحة</h6>
                </a>
               
                <div class="collapse show" id="collapseCardExample">
                <div class="content-sugestion" >                
                </div>
                                 <ul class="list-words">
                
                   <li  ng-repeat="x in suggested" class="bg-gray-200 border-bottom-primary  ">
                      
                      
                      <div  class="txt">
                      <button >بدون تشكيل</button>
                            <nav class="Sugesstionmenu">
                              <ul>
                                <li ng-if="instructor_id ==v.instructor_id" ng-repeat="(k,v) in x.asVerbCondition track by $index">
                                  <button>
                                  مشكل
                                  </button>
                                </li>
                               
                              </ul>
                            </nav>
                      <nav ng-if="x.asNounCondition" class="Sugesstionmenu">
                              <ul>
                                <li ng-if="instructor_id ==v.instructor_id" ng-repeat="(k,v) in x.asNounCondition track by $index">
                                  <button ng-mouseover="vplayer( [v.video_url]) "  ng-click="x.chosen=v">
                                   مشكل
                                  </button>
                                </li>
                               
                              </ul>
                            </nav>
                    <nav ng-if="x.asMainNoun" class="Sugesstionmenu">
                              <ul>
                                <li  ng-if="instructor_id ==v.instructor_id" ng-repeat="(k,v) in x.asMainNoun track by $index">
                                  <button ng-mouseover="vplayer( [v.video_url]) " ng-click="x.chosen=v">
                                   مشكل
                                  </button>
                                </li>
                               
                              </ul>
                            </nav>

                  <nav ng-if="x.asPrepositionCondition" class="Sugesstionmenu">
                              <ul>
                                <li ng-if="instructor_id ==v.instructor_id"  ng-repeat="(k,v) in x.asPrepositionCondition track by $index">
                                  <button ng-mouseover="vplayer( [v.video_url]) "   ng-click="x.chosen=v">
                                   مشكل
                                  </button>
                                </li>
                               
                              </ul>
                            </nav>                               
                      </div> 
      
                    </li> 

                  </ul>
                  <div class="btns">
                    <button id="select-sug-word" ng-click="CorrectedTranslation()" class="btn bg-gradient-success">
                      اختيار الجملة المقترحة
                    </button>
                  
                  </div>
                </div>
              </div>


            </div>-->
          	
          	</div>
       
       
       
       
       
          	 <div class="card shadow mb-4">
                <div class="card-header py-3">
       <div class="row">
                <!-- text input-->
              <form  name="formtranslate" id="formtranslate"
                class="text-center sky-form contact-style">
                <fieldset class="">
                    <h1>النص المراد ترجمته </h1>
                    <div class="row sky-space-20">
                        <div class="col-md-11 col-md-offset-0">
                            <div>
                                <textarea rows="8"  style="width:100%!important" name="toTranslate"  id="toTranslate" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <p><button onclick=" getTrans()" class="" type="button" class="btn-u">ترجم الان</button></p>
                </fieldset>

                <div class="message">
                    <i class="rounded-x fa fa-check"></i>
                    <p>Your message was successfully sent!</p>
                </div>
            </form>
            </div>
            </div>
            </div>
            <div class="clearfix margin-bottom-20"></div>
            <hr>
                <!-- End of text input -->
             
            </div>

         
          </div>
        
   <!-- <div class="col-sm-12 sm-margin-bottom-20">
        <div class="profile-blog">
            <div class="name-location">
                <strong>مترجم النص
                </strong>
            </div>
            <div class="clearfix margin-bottom-20"></div>
            <hr>
        
            <form action="" name="formtranslate" id="formtranslate"
                class="sky-form contact-style">
                <fieldset class="no-padding">
                    <label>النص المراد ترجمته <span class="color-red">*</span></label>
                    <div class="row sky-space-20">
                        <div class="col-md-11 col-md-offset-0">
                            <div>
                                <textarea rows="8" name="toTranslate" id="toTranslate" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>

                    <p><button class="totranslate" type="submit" class="btn-u">ترجم الان</button></p>
                </fieldset>

                <div class="message">
                    <i class="rounded-x fa fa-check"></i>
                    <p>Your message was successfully sent!</p>
                </div>
            </form>
            <div class="clearfix margin-bottom-20"></div>
            <hr>
         
        </div>
    </div>
 -->
    <!--End Profile Blog-->
</div>
<!--/end row-->             
              </div>
            </div>
            <!-- End Profile Content -->     
        
        </div>
    </div>		
    <!--=== End Profile ===-->

    <!--=== Footer v4 ===-->
    
    @include('auth.home.partials.footer')
 <script>
      var vindex=0;
      var words=[];
      var videos=[];
        var person=1;
        var obj;
function choosePerson(param)
{
  person=param;
}
  function getTrans()
 {

words=[];
videos=[];

	 $.ajax({
                  url : 'Api/transit',
                  type : 'GET',	
				                  
				          async:true,
                  data : { 
                    text:$("#toTranslate").val(),
                    translator:person
                 
                  },
					
             
                  success : function(data) {
                    console.log(data);  
                    obj=JSON.parse(data);
                    vindex=0;
                    for(var i=0;i<obj.length;i++)
                    {
                      for(var j=0;j<obj[i].matches[0].video.length;j++)
                      {
                         words.push(obj[i].matches[0].word);
                         videos.push(obj[i].matches[0].video[j])	;		
                      }
                    }
                    if(words.length>0)
                    {
                      console.log("video:"+videos[vindex].replace("https://kcgwebservices.net/deafservice/","storage/"));
                      console.log("word:"+words[0]);
                      $("#worddiv").html(words[vindex]);
                      $('#videosToPlay').attr('src', videos[vindex].replace("https://kcgwebservices.net/deafservice/","storage/"));
                      $('#videosToPlay').load();
                     //
                      
                    }
                    //console.log(videos);                            					
					   },
                   error : function(jqXHR, textStatus, error)
                                            {
												 
                                             }		 
											 
                       });
 }
 function nextvideo()
 { 
  if(vindex<(videos.length-1))
  {
     // var currentvideo=videos[vindex].replace("https://kcgwebservices.net/deafservice/","storage/");
     // alert(currentvideo);
    vindex=vindex+1;
   $("#worddiv").html(words[vindex]);
   $('#videosToPlay').prop('src', '');
    displaynext();

  }

 }
 
 function displaynext()
 {

var currentvideo=videos[vindex].replace("https://kcgwebservices.net/deafservice/","storage/");
console.log("vindex:"+vindex+"/"+videos.length);
console.log("word:"+words[vindex]);
console.log("video:"+currentvideo);
 $('#videosToPlay').attr('src',currentvideo);
 $('#videosToPlay')[0].load();
 $('#videosToPlay')[0].play();  
 }
    </script>