{{-- @dd(asset('public/').'uploads/'.$course->course_image) --}}

<div class="category-box thumbnail " style="height: 405px;background-color: #4f198d; border-radius: 7px;">
                                    <div class="row m0 " style="font-size: 60px;color:#d6d6d6;height:60%;padding: 8px 8px; ">
                                        
                                        <span class="item_price price">
                                        {{$course->minPricelocation()}}  
                @if($course->minPricelocationCurr()=='SAR'){{$course->minPricelocationCurr()}}@else $ @endif
                                       
                                        </span>
                                        <img style="height:100%;border-radius: 10px;" @if($course->course_image != "" &&  file_exists('storage/uploads/'.$course->course_image)) src="{{ asset('storage/uploads/'.$course->course_image)}}" @else  src="{{asset('images/course-default.jpeg')}}"   @endif>
                                        <!-- <span class="price" style="display:inline-block;padding-bottom:5px;">$20</span> -->
                                    </div>
                                    <div class="inner-contain">
                                        <a  href="{{route('courses.category',['category'=>$course->category->slug])}}">
                                            <h4 class="title text-color" style="text-align: right;color: white;height:19px;">
                                            @if(session('locale') == 'ar') {{ $course->category->name_ar }} @else {{$course->category->name}}  @endif
                                           
                                            </h4>
                                        </a>
                                        <a href="{{route('courses.show',['course'=>$course->slug])}}" >
                                        <p style="text-align: right;color:white;font-size: small">
                                        @if(session('locale') == 'ar') {{ $course->title_ar }} @else {{$course->title}}  @endif
                                      </p>
                                       </a>
                                      <p style="text-align: right;color: white;font-size: small">
                                      {{ $course->lessons()->count() }} @lang('labels.frontend.layouts.home.lectures')
                                      </p>
                                      
                                    <a href="{{route('courses.show',['course'=>$course->slug])}}">  
                                    <h6 style="text-align: left;color: white;font-size: small">
                                      @lang('labels.general.more') >>
                                     </h6>
                                    </a>
                                    </div>
                                    
                                </div>