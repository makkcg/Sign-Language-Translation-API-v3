@include('auth.home.base')



<div class="header-v5">

@include('auth.home.partials.navbar')


</div>
    <div class="container content profile">	
    	<div class="row">
            <!--Left Sidebar-->
            <div class="col-md-3 md-margin-bottom-40">
                <img class="img-responsive profile-img margin-bottom-20" src="../assets/img/team/img1-md.jpg" alt="">

                @include('auth.home.partials.profileMenu') 
             
            </div>
            <!--End Left Sidebar-->
            
            <!-- Profile Content -->
            <div class="col-md-9">
                <div class="profile-body">
                    <div class="profile-bio">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <h2>اهلا بك يا علي</h2>
                                <span><strong>موبايل:</strong> 01065850605</span>
                                <span><strong>بريد الكترونى:</strong> pm1.kcg@gmail.com</span>
                                <span><strong>نوع الخطة:</strong> سوبر</span>
                                <span><strong>عدد الكلمات المتاحة للترجمة:</strong> 5000</span>
                                <span><strong>عدد نقاط الاتصال المتاحة:</strong>4444</span>
                     <form style="display:none;" id="EditProfileForm" class="log-reg-block sky-form">
                   
                        <section>
                            <label class="input login-input">
                                <div class="input-group">
									<label>الاسم</label>
                                    <input type="text"   id="first_name"  name="first_name" class="form-control" value="{{ user.first_name}}">
                                </div>
                            </label>
                        </section> 
                                  <section>
                            <label class="input login-input">
                                <div class="input-group">
									<label>موبايل</label>
                                    <input type="text"   id="mobile1" name="mobile1" class="form-control" value="{{ user.mobile1}}">
                                </div>
                            </label>
                        </section>          
                        <section>
                                <label class="input">
                                    <input type="password"  name="password" placeholder="كلمة المرور" id="password" class="form-control">
                                </label>
                            </section>                                
                            <section>
                                <label class="input">
                                    <input type="password" name="passwordConfirm"  id="passwordConfirm"  placeholder="تاكيد كلمة المرور" class="form-control">
                                </label>
                            </section>        
                        <button id="editprofilebtn" class="btn-u btn-u-sea-shop btn-block margin-bottom-20" type="button">تعديل</button>

                        <div class="border-wings">
                           
                        </div>
                            

                    </form>
                                <button id="showUpgrade">ترقية الحساب</button>
                                <button id="EditProfile">تعديل بياناتى</button>
                                <div id="upgradeAcc" style="display:none;">

<div class="">
  <span for=""> اختر الباقة</span>
                        

                      
                        <div class="form-group">
                          <input type="radio"  id="" value=" plan 1" name="chosenPlan">
                                                    <label for="">7777 (عدد الكلمات : 66666/ عدد نقاط الاتصال : 55555</label>
                          
                        </div>

                      </div>                   
                      
                                             <button id="sendRequest"'>اختيار الباقة</button>
                        
                                </div>
                                <hr>
                           </div>
                        </div> 
                        <div class="row">
                           <!--Basic Table Option (Spacing)-->
                <div class="panel panel-red margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> كلمات تم ترجمتها سابقا</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    
                                    <th>الكلمة</th>
                                    <th>التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                            
 
        <tr >
        <td></td>
        <td>
        
       
        	<span>ياللا</span>
         
        </td>
        <td>10-1-2022</td>
        </tr>
        
             
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--End Basic Table-->
                        </div>
     <div class="row">
                           <!--Basic Table Option (Spacing)-->
                <div class="panel panel-red margin-bottom-40">
                    <div class="panel-heading">
                        <h3 class="panel-title"><i class="fa fa-user"></i> كلمات مقترحة و جارى ترجمتها</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    
                                    <th>الكلمة</th>
                                    <th>معدل الاستخدام</th>
                                    <th>التاريخ</th>
                                </tr>
                            </thead>
                            <tbody>
                            
        
        <tr >
        <td>7</td>
        <td>
     			سبعاوي
       
        </td>
          <td>
     			   7
       
        </td>
        <td>10-10-2020</td>
        </tr>
       
             
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!--End Basic Table-->
                        </div>
                    </div><!--/end row-->
                            
                    <hr>


                </div>
            </div>
            <!-- End Profile Content -->
        </div>
    </div>		
    <!--=== End Profile ===-->

    <!--=== Footer v4 ===-->
    	
    @include('auth.home.partials.footer.php')