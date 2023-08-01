
@include('auth.home.base')


<div class="header-v5">



	
@include('auth.home.partials.navbar')
	



<div class="container content-sm" style="min-height: 700px;">
	
<div class="text-center margin-bottom-50">
            <h2 class="title-v2 title-center">اخر الاخبار</h2>

            <p class="space-lg-hor">
            
            </p>
        </div>
        <div class="row content-boxes-v4">
@php
                                $i = 0;
                                @endphp
                                @foreach ($news as $rep)
                                    @php
                                    $i++
                                    @endphp
                                    <div class=" col-md-4 md-margin-bottom-40">
                                     <i class="pull-left fa fa-lightbulb-o"></i>
                                     <div class="news content-boxes-in-v4">
                                     <h2>{{ $rep->title }}</h2>
						             <p>{{ $rep->report }}</p>
                                    </div>
                                    </div>
                                    @endforeach
     </div>                              

</div>

   

   
  



</div>

@include('auth.home.partials.footer')