@include('auth.home.base')

<div class="header-v5">
@include('auth.home.partials.navbar')

</div>
    <div class="container content profile" >
    	<div class="row">
            <!--Left Sidebar-->
             <div class="col-md-3 md-margin-bottom-40">
                <img class="img-responsive profile-img margin-bottom-20" src="../assets/img/team/img1-md.jpg" alt="">

                          
                @include('auth.home.partials.profileMenu') 

	    
          

              

               
            </div> 
                     
                    

                                
                                    
            <div class="col-md-9">
              <span style="font-weight:bold;">مرحبــا بـك&nbsp;{{$accounts[0]->name}}</span><br><br>
             <div class="profile-body">
                    <!--Service Block v3-->
                    <div class="row col-12 margin-bottom-10">
                      
                        <div class="col-sm-6 sm-margin-bottom-20">
                        <span>الكلمات المستهلكة<span>
                        <div class="service-block-v3 service-block-u">
                             <i class="fa fa-hourglass-end" aria-hidden="true"></i>
                                <span class="service-heading"></span>
                                <span class="counter">{{$accounts[0]->used_words}}</span>
                                
                                <div class="clearfix margin-bottom-10"></div>
                                
                 
          
                            </div>
                        </div>
                        <div class="col-sm-6">
                        <span>الكلمات المتبقية<span>
                        <div class="service-block-v3 service-block-blue">
                               <i class="fa fa-rss" aria-hidden="true"></i>

                                <span class="service-heading"></span>
                                <span class="counter">{{$accounts[0]->remain_words}}</span>
                                
                                <div class="clearfix margin-bottom-10"></div>
                               
                            </div>
                        </div>
                    </div><!--/end row-->
                    <!--End Service Block v3-->
              
                    <hr>

                
                    
                  
                </div>
             <!-- general settings -->
          <div class="row" id="general-settings">
            <div class="col-lg-12 mb-4">

              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#generalCard" class="d-block card-header py-3" data-toggle="collapse" role="button"
                  aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">الاعدادت العامة</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="generalCard">
                  <!--select the translator-->
                  <div class="row">
                    <div class="col-md-4 left-bord">
                      <ul class="translators">
                        <li>
                          <div class="top-info">
                            <img src="./img/defualt-profile.png" class="" id="translator-img" alt="">
                            <input type="radio" id="trans-selector" value="عمرو" name="translators">
                          </div>

                          <div id="translat-name">أ/عمرو</div>
                        </li>
                        <li>
                          <div class="top-info">
                            <img src="./img/defualt-profile.png" class="" id="translator-img" alt="">
                            <input type="radio" id="trans-selector" value="هاجر" name="translators">
                          </div>

                          <div id="translat-name">أ/هاجر</div>
                        </li>
                      </ul>


                    </div>
                    <!-- End  of select the translator-->

                    <div class="col-md-8 left-bord">
                      <div class="row">
                        <div class="col-md-6">
                          <!-- Select language & cuntery -->
                          <div class="">
                            <span> إختيار اللغة</span>
                            <select name="languages" aria-controls="" class="custom-select  form-control">
                              <option selected value="1">اللغةالعربية</option>
                              <option disabled value="0">اللغة الانجليزية</option>
                            </select>
                            <span> إختيار الدولة</span>
                            <select name="locations" aria-controls="" class="custom-select  form-control">
                              <option selected value="1"> مصر</option>
                              <option disabled value="0"> السعودية</option>
                              <option disabled value="0"> الامارات</option>

                            </select>
                          </div>

                        </div>
                        <div class="col-md-6">
                          <!-- select options translate-->
                          <div class="trans-options">
                            <span for=""> إختيار الكلمات بالتشكيل</span>
                            <div class="form-group">
                              <label for="">المترجم الذكى</label>
                              <input type="radio" id="" checked name="type-translate" value="1">
                            </div>
                            <div class="form-group">
                              <label>التشكيل اثناء الترجمة </label>
                              <input type="radio" id=""  name="type-translate" value="0">
                            </div>
                           
                          </div>
                          <div class="switcher">

                            <label class="switch" for="general-word">
                              <input name="general-word" type="checkbox" id="general-word"   />
                              <div class="slider round"></div>
                            </label>
                            <span for="">تفعيل الكلمات العامية</span>
                          </div>

                        </div>
                      </div>
                    </div>
                   
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End of general settings -->

          <!-- Advanced settings -->
          <div class="row">
            <div class="col-lg-12 mb-4">
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#advancedCard" class="d-block card-header py-3" data-toggle="collapse" role="button"
                  aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">الاعدادت المتقدمة</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="advancedCard">
                  <!-- Select  type of video -->
                  <div class="row">
                    <div class="col-md-4 left-bord">
                      <div class="trans-options">
                        <span> نوع ملفات الفيديو المترجمة </span>
                        <select name="extention" aria-controls="" class="custom-select  form-control">
                          <option selected value="1">Webm</option>
                          <option disabled value="0">Mp4 </option>
                          <option disabled value="0"> Mov</option>
                          <option disabled value="0">Base 64 </option>

                        </select>
                        <span> نظام التشغيل </span>
                        <select name="os" aria-controls="" class="custom-select  form-control">
                          <option selected value="1"> Web</option>
                          <option disabled value="0"> IOS</option>
                          <option disabled  value="0"> Android</option>

                        </select>
                      </div>
                    </div>
                    <!-- End of Select  type of video -->
                    <!-- Select how to show video-->
                    <div class="col-md-4 left-bord">
                      <div class="trans-options">
                        <span for=""> عرض الفيديو Stream</span>
                        <div class="form-group">
                          <label for="">Yes</label>
                          <input type="radio" id="" value="1" name="video-show">
                        </div>
                        <div class="form-group">
                          <label>File Links </label>
                          <input type="radio" id="" value="0"  name="video-show">
                        </div>
                      </div>
                      <div class="trans-options">
                        <span for=""> ترجمة قطعة او جملة </span>
                        <div class="form-group">
                          <label for="">ترجمة القطعة كاملة</label>
                          <input type="radio" id="" value="1" name="translate-size">
                        </div>
                        <div class="form-group">
                          <label>ترجمة جملة جملة </label>
                          <input type="radio" id="" value="0" name="translate-size">
                        </div>
                       
                      </div>
                      <div class="switcher">

                        <label class="switch" for="roules-word">
                          <input type="checkbox" id="roules-word" name="roules-word" />
                          <div class="slider round"></div>
                        </label>
                        <span for=""> تفعيل قواعد اللغة العربية </span>
                      </div>
                    </div>
                    <!-- End of Select how to show video-->
                    <div class="col-md-4 ">
                      <div class="trans-options">
                        <span for=""> طريقة عرض الترجمة</span>
                        <div class="form-group">
                          <label for="">عرض الترجمة فى PoPup</label>
                          <input type="radio" id="" name="frame-video">

                        </div>
                        <div class="form-group">
                          <label>عرض الترجمة فى عارض فيديو</label>
                          <input type="radio" id="" name="frame-video">
                        </div>

                      </div>
                      <div class="trans-options">
                        <span for=""> نوع الرد فى السيرفيس</span>
                        <div class="form-group">
                          <label for="">JSON File</label>
                          <input type="radio" id="" name="services-req">

                        </div>
                        <div class="form-group">
                          <label>XML File</label>
                          <input type="radio" id="" name="services-req">
                        </div>

                      </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
          <!-- End  of Advanced settings -->

            </div>
            <!-- End Profile Content -->            
        </div>
    </div><!--/container-->    

	