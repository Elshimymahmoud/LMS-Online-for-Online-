<!-- Start of footer area
    ============================================= -->
    @php
    $footer_data = json_decode(config('footer_data'));
@endphp
@if($footer_data != "")
<footer>
    <div class="footer-top pt-60 pb-25">
        <div class="container-custome">
            <div class="row">
                
              
                <div class="vr"></div>
              
                <div class="col-lg-4 col-md-6">
                    <div class="foot">
                        <h3>
                            @lang('labels.backend.general_settings.footer.popular_courses')
                        </h3>
                        <ul class="list-unstyled news">
                           @foreach ($popularCoursesFooter as $popularCourseFooter)
                           <li>
                            <a href="#">
                                <div class="media">
                                    <img @if($popularCourseFooter->course_image != "")src="{{asset('storage/uploads/'.$popularCourseFooter->course_image)}}" @else src="{{asset('images/course-default.jpeg')}}"  @endif alt="media">
                                    <div class="body-media">
                                        <h5>{{Lang::locale()=='ar'?$popularCourseFooter->title_ar:$popularCourseFooter->title}}</h5>
                                        <p>By ivory</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                           @endforeach
                      
                         
                        </ul>
                        <ul class="list-unstyled d-flex">
                            <li>
                                <a href="{{route('plan2021')}}">
                                    <img src="{{asset('ivory')}}/assets/img/home/1.png" alt="Download" style="width: 250px;" class="img-fluid mb-15">
                                </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#RequestModalCenter">
                                    <img src="{{asset('ivory')}}/assets/img/home/2.png" alt="Request" style="width: 250px;" class="img-fluid mb-10 ml-10 mr-10">
                                </a>
                            </li>
                        </ul>
                       
                    </div>
                </div>
                

                <div class="col-lg-4 col-md-6">
                    <div class="foot">
                        <h3>
                            @lang('labels.backend.general_settings.footer.important_link')
                        </h3>
                        <ul class=" news">
                          
                           <li>
                            <a href="{{route('AcademicIntegrity')}}">
                                <div class="media">
                                   
                                    <div class="body-media">
                                        <h5>
                                    @lang('custom-menu.nav-menu.academic-integrity')

                                        </h5>
                                        
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('commonQuestions')}}">
                                <div class="media">
                                   
                                    <div class="body-media">
                                        <h5>
                                    @lang('custom-menu.nav-menu.common-questions')

                                        </h5>
                                        
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="{{route('courses.all')}}">
                                <div class="media">
                                   
                                    <div class="body-media">
                                        <h5>
                                    @lang('custom-menu.nav-menu.courses')

                                        </h5>
                                        
                                    </div>
                                </div>
                            </a>
                        </li>
                          
                        <li>
                            <a href="{{route('plan2021')}}">
                                <div class="media">
                                   
                                    <div class="body-media">
                                        <h5>
                                    @lang('custom-menu.nav-menu.plan2021')

                                        </h5>
                                        
                                    </div>
                                </div>
                            </a>
                        </li>
                         
                        </ul>
                      
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="foot">
                        {{-- <h3>
                            @lang('labels.backend.general_settings.footer.about_ivory')

                        </h3>
                        <p>
                            @lang('labels.backend.general_settings.footer.about_ivory_paragraph')

                        </p> --}}
                        <h3>
                            @lang('labels.backend.general_settings.footer.stay_connected')

                        </h3>
                        <ul class="list-unstyled d-flex social">
                            <li>
                                <a href="#" class="face"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#" class="twit"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="insta"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
                            </li>
                            <li>
                                               {{-- modal --}}
                                 <!-- Button trigger modal -->
                                    <a type="button" style="    color: white;
                                    font-size: 46px;" title="@lang('labels.backend.complainments.title')"  data-toggle="modal" data-target="#complainModalCenter">
                                        {{-- <i class="fas fa-frown-open"></i> --}}
                                        <img style="width: 100%;border-radius: 50%;" src="{{asset('assets/img/review2.png')}}" alt=""/>
                                    </a>
  
                                {{-- end modal --}}
                            </li>
                        </ul>
                        {{-- <h3>
                            @lang('labels.backend.general_settings.footer.about_ivory')
        
                        </h3> --}}
                        <p>
                            @lang('labels.backend.general_settings.footer.about_ivory_paragraph')
        
                        </p>
                        <ul class="list-unstyled info">
                            <li><i class="fas fa-map-marker-alt"></i>
                            @lang('labels.backend.general_settings.footer.ivory_address')

                            </li>
                            <li><i class="fas fa-phone-alt"></i>+96611445518</li>
                            <li><i class="fas fa-mobile-alt"></i>+966533993220</li>
                            <li><i class="far fa-envelope"></i>info@ivorytraining.com</li>
                        </ul>
                        <br>
                       
                    </div>
                </div>
              
                {{-- <div class="col-lg-3 col-md-6">
                    <div class="foot">
                       
                            <a href="{{route('plan2021')}}">
                                <img src="{{asset('ivory')}}/assets/img/home/1.png" alt="Download" style="width: 250px;" class="img-fluid mb-15">
                            </a>
                        
                       
                        <a href="#">
                            <img src="{{asset('ivory')}}/assets/img/home/2.png" alt="Request" style="width: 250px;" class="img-fluid mb-10 ml-10 mr-10">
                        </a>
                       
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
    
    <div class="footer-bottom pt-25 pb-25">
        <div class="container-custome">
            <p>Copyright © 2020 IVORY Training</p>
        </div>
    </div>
</footer>
 <!-- Modal complainments -->
 @php
 $complaiments=App\Models\Forms::where('form_type','complainment')->get();
 @endphp
 <div class="modal fade" id="complainModalCenter" style="z-index: 2000" tabindex="-1" role="dialog" aria-labelledby="complainModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">@lang('labels.backend.complainments.form')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @include('frontend.pages.complainForm')
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('labels.backend.complainments.close')</button>
         
        </div>
      </div>
    </div>
</div>
{{-- //////////////// --}}
      
{{-- Modal Request --}}
<div class="modal fade" id="RequestModalCenter" style="z-index: 2000" tabindex="-1" role="dialog" aria-labelledby="RequestModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
      <div class="modal-content"  >
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">@lang('labels.backend.teachers.fields.request')</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @include('frontend.pages.RequestForm')
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('labels.backend.complainments.close')</button>
         
        </div>
      </div>
    </div>
</div>
{{-- ///////////// --}}
@endif
<!-- End of footer area
============================================= -->