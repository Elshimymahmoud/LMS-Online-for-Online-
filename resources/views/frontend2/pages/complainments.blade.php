@extends('frontend.layouts.app'.config('theme_layout'))

@push('after-styles')
<style>
    .content img {
        margin: 10px;
    }

    .about-page-section ul {
        padding-left: 20px;
        font-size: 20px;
        color: #333333;
        font-weight: 300;
        margin-bottom: 25px;
    }

    ul li,ol li {
        margin-bottom: 13px;
        font-weight: 600;
    }
    p{
        font-weight: 600;
        
    }
    h5 {
        font-weight: bold;
        color: #800000;
    }

    h3 {
        color: white;
    }

    li span {
        font-size: 10px;
    }
    .fnt-wght-900{
        font-weight: 900;

    }
</style>

@endpush

@section('content')
    {{--  --}}

    <section class="welcome">
        <div class="welcome-overlay">
            <div class="container-about">
                <div class="welcome-content">
                    <div class="head-welcome">
                        <h2></h2>
                    </div>
                    {{-- start first --}}
                    <div class="first">
                        <div class="middle-welcome">
                            
                            <h5>
                                آليةاستقبال الشكاوى عبراإليميل أونموذج الشكاوى
                            </h5>
                            
                            <p>
                                تعمل وحدة العلاقات العامة علي تنظيم الشكاوى والاعتراضات وتسجيلها في نظام خاص بهاومن ثم يتم تمريرها إلى الاطراف المعنية
                                وسيعمل هذا الملف -بإذن الله- علي مساعدتك في حال رغبت بتقديم شكوى
  
                            </p>
                           
                          <h5>
                            آليةقبول ورفض الشكاوي
                          </h5>
                          <p>
                              صممت هذه الالية لتيسيرتقديم الشكوى من قبل المستفيد حيث يمكن تقديم الشكاوى لاسباب تعلق  بافعال او قرارات يري ان ادارة المركز لم تنجح في القيام بهااو اتخاذها او انه تم تنفيذها بطريقه غير صحيحة او  غير عادله او غير قانونية
                          </p>
                          <p>
                              <ul>
                                  <li>
                                    يمكن لاي شخص تقديم شكوى بشرط ان تكون ضمن مجال عمل مركز العاج الفضي للتدريب والاستشارات
                                  </li>
                                  <li> 
                                        عند تقديم شكوى يرجي من صاحبها تعريف نفسه وتحديد موضوع الشكوى بوضوح وبيان ما يتوقع تحقيقه وتوفير معلومات مفصله وذات صلة بالشكوي اذا كان ذلك ممكنا
                                  </li>
                                  <li>
                                      يتم رفع الشكوى خلال عشره ايام من حدوثها ولا تنظر في الشكاوي التي يتأخر رفعها
                                  </li>
                                  <li>
                                   ارفاق اي مستندات او بريد الكتروني وكل ما يتعلق بالشكوي من اثباتات
                                  </li>
                                  <li>
                                      اطلاع الافراد المعنيين"وحدة العلاقات العامة"  علي الشكوى وتحديد مدي قبولها
                                  </li>
                                  <li>
                                     في حال قبول الشكوى يتم وضع اطار زمني واضح لحل المشكلةوفي الوقت نفسه تقوم بإخطارمقدم الشكوى بالموعد المتوقع عادة
                                    لتلقيه ردا رسميا.
                                  </li>
                                  <li>
                                    في حال رفض الشكوى يتم ابلاغ المستفيد بذلك مع ارفاق الاسباب.
                                  </li>
                                  <li>
                                    في حال ظل مقدم الشكوى غير راضي عن نتيجة الاجراءات المتعلقه بشكواه يمكن رفع شكوى تأكيدية أما فورية او تقديم شكوى آخرى لجهة ذات سلطة أعلى (الإدارة العامة)
                                  </li>
                                  <li>
                                    تعالج  جميع الشكاوى بشكل سري.
                                  </li>
                                  <li>
                                    يحق للافراد المعنيين اجراء تحقيقات او استعراض مدى الامتثال لتحديد درجة التزام الإدارة بالقواعد واللوائح والأحكام ذات الصلة مثل السياسات والمعايير.
                                  </li>
                                  <li>
                                    تختلف معالجة الشكاوى بإختلاف :
                                    <ul>
                                        <li>
                                            نوع الشكوى مدى تعقيدها
                                        </li>
                                        <li>
                                            الإجراءات المتبعة
                                        </li>
                                        <li>
                                            التقييم الأولي الذي يشير إلى ما اذا كانت هناك أسباب تبرر الشكوى 
                                        </li>
                                        <li>
                                            الحقائق التى افصح عنها خلال عملية التقييم او التحقيق
                                        </li>
                                      
                                        </ul> 
                                  </li>
                                  <li>
                                    يتخذ الافراد المعنيين القرار النهائي ويتم توثيق التوصيات وكتابة التقرير بشأن الشكوى ثم يتم ابلاغ صاحب الشكوى.
                                  </li>
                              </ul>
                          </p>
                        </div>
                   
                        
                    </div>
                    {{-- end first --}}
                    <div class="first">
                        <div class="middle-welcome">
                            <div >
                                <img style="width: 500px;margin-right: 26%;" src="{{asset('assets/img/complain/complain.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="first">
                        <div class="middle-welcome">
                            <h5>
                                أولا : التعامل مع شكاوي العملاء:
                            </h5>
                            <p>المستفيد دائما على حق حتى يثبت العكس.</p>
                            <ul>
                                <li>يتم ضمان سرية معلومات المشتكي والجهة المقصودة بالشكوى وبيانات كل منهما من خلال عدم السماح بالاطلاع عليها إلا من قبل الموظفين المختصين والمخولين الذين تقتضي طبيعة عملهم ذلك الاطلاع.
                                   
                                </li>
                                <li>
                                    يتخذ الافراد المعنيين كافة التدابير  والإحتياطات اللازمة لضمان سرية الشكاوى المقدمةء وكذلك سرية الوثائق والمعلومات المتعلقة بها وبتفاصيل المشتكي (الورقية والإلكترونية والصوتية المسجلة).
                                </li>
                                <li>
                                   	أي شكوى تعبر عن رأي المتعامل وللمركز حق قبول أو رفض الشكوى اذا كانت غير واضحة أو لا يمكن دراستها نسبة لعدم الحصول على رد المشتكي في الفترة المحددة؛ وأيضاً لا تقبل الشكاوى الوظيفية أو الشكاوى الكيدية.

                                </li>
                            </ul>
                            <ol type="1">
                                <li>

                                    ‏ أسباب شكاوي العملاء:
                                    <ul>
                                        <li>
                                            هناك أسباب عديدة لشكاوي العملاء بعضها يرجع إلى المنظمة والبعض الآخر يرجع إلى مقدم الخدمة والبعض الثالث يرجع إلى العميل نفسه.

                                        </li>
                                        <li>
                                            النوع الأول ما يتعلق بالإجراءات المتبعة في المنظمة.

                                        </li>
                                        <li>
                                            النوع الثاني الأخطاء الشخصية التي يقع فيها مقدم الخدمة.

                                        </li>
                                        <li>
                                            النوع الثالث عدم معرفة العميل بمدى الفائدة المتحققة من الخدمة بعد الحصول عليها أو الجهد المبذول في سبيل انهائها بهذه الصورة.

                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    ٠‏ الآلية المتبعة عند استقبال شكوى:
                                    <ul>
                                        <li>
                                        	تقوم الإدارة باستقبال الشكاوى من خلال الرقم الموحد أو عن طريق البريد الإلكتروني المحدد
                                        </li>
                                        <li>
                                            	يقوم قسم الجودة بتصنيف الشكاوى وتسجيلها ضمن نظام محوسب ومن ثم يتم إرسالها ومتابعتها مع الجهات المعنية من أجل معالجتها والعمل على حلها.

                                        </li>
                                        <li>
                                            	تقوم الجهة المعنية بإعلام الشخص المخول بالإجراءات التي ستتخذها لحل المشكلة

                                        </li>
                                    </ul>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="first">
                        <div class="middle-welcome">
                            <h5>
                                ‏ثانياً: التعامل مع اقتراحات العملاء
                            </h5>
                          
                            <ol type="1">
                                <li>

                                     الإدارة
                                    <ul>
                                        <li>
                                            تقوم الإدارة باتخاذ كافة التدابير والإحتياطات اللازمة لضمان سرية الإقتراحات المقدمة والوثائق والمعلومات المتعلقة بها (الورقية والالكترونية والمسجلة).

                                        </li>
                                        <li>
                                            يتم تسجيل المقترح بأسم مقدمه.

                                        </li>
                                        <li>
                                            	يلتزم كل من يتعامل مع نظام الاقتراحات بالالتزام بالسرية.

                                        </li>
                                        <li>
                                            	ضمان سرية معلومات وبيانات المقترح والجهة المعنية بعدم السماح بالإطلاع عليها إلا من قبل الموظفين المختصين والمخولين الذين تقتضي طبيعة عملهم ذلك

                                        </li>
                                        <li>
                                            ضمان عدم تأثر تقديم الخدمات وجودتها للمقترح نتيجة لتقديمه إقتراح.

                                        </li>
                                        <li>
                                            	ضمان عدم تأثر وضع الموظف المقترح نتيجة إقتراحه.

                                        </li>
                                    </ul>

                                </li>
                                <li>
                                    الموظف:
                                    <ul>
                                        <li>
                                            يقوم الموظف بالمحافظة على سرية الإقتراحات المقدمة والمعلومات والوثائق المتعلقة بها أو المقترح.
                                        
                                        </li>
                                        <li>
                                            	‏يحق للموظف الاطلاع على المعلومات التي تقتضيها طبيعة عمله فقط.

                                        </li>
                                       
                                    </ul>
                                </li>
                                <li>
                                    المستفيد:
                                    <ul>
                                        <li>
                                            	يلتزم المستفيد بادخال بيانات الإقتراح بصورة صحيحة وتفادي أي مغالطات أو معلومات كيدية ضد المركز أو ضد الموظفينء ويقوم بتقديم كافة المعلومات في الوقت المحدد عند طلبها.

                                        </li>
                                    </ul>
                                </li>
                            </ol>
                        </div>
                    </div>

                    <div class="first">
                        <div class="middle-welcome">
                            <h5>
                                ثالثاً: قنوات تقديم الشكاوى:
                               
                            
                            </h5>
                          
                            <ol type="1">
                             <li>
                                ويسرنا استقبال أي من الشكاوى أو الاستفسارات أو الملاحظات عير:
                            <ul>
                                <li>
                                        نموذج الشكاوى  المرفق

                                </li>
                                <li>
                                        رقم الشكاوى(اتصال و واتس اب): 0115209894
                                </li>
                          
                                <li>
                                        الإيميل :  cs@ivorytraining.com
                                </li>
                         </ul>
                             </li>
                             <li>
                                المركز الوطني للتعليم الإلكتروني
                              <ul>
                                  <li>
                                    	رقم الشكاوى: 920015991 
                                  </li>
                                  <li>
                                    	الايميل: info@elc.edu.sa

                                  </li>
                              </ul>
                             </li>
                             <li>
                                المؤسسة العامة للتدريب التقني والمهنيالإدارة العامة للتدريب الاهلي
                              <ul>
                                  <li>
                                    	هاتف : 2088400-011
                                   
                                  </li>
                                  <li>
                                    	فاكس : 2087978-011
                                  </li>
                                  <li>
                                    	الإيميل: gdpci@tvtc.gov.sa

                                  </li>
                              </ul>
                             </li>
                            </ol>
                        </div>
                    </div>
                {{-- Form --}}
                <div class="first">
                    <div class="middle-welcome">
                        {!! Form::open(['method' => 'POST', 'route' => ['admin.answerEvaluate.store'], 'files' => true,]) !!}


                        {{--  --}}
                        @php
                            $quest_count=0;
                            
                        @endphp
                        @foreach ($complaiments as $key => $complaiment)
                        @foreach ($complaiment->questions as $Mainkey => $question)

                        @php
                            $quest_count++;
                            $userAnswers = $complaiment->getUserAnswers();
                          
                        @endphp
                        <input type="hidden" name="rate_ids[]" value="{{$complaiment->id}}">
                        
                        <input type="hidden" name="rateQuestions[]"
                            value="{{ $question->id }}">
                        
                        
                        
                        <p>
                            @if (Lang::locale() == 'en')
                                {{ $question->question }}
                            @else
                                {{ $question->question_ar ? $question->question_ar : $question->question }}
                        
                            @endif
                        </p>
                        
                            {{-- @if ($question->question_type == 'radio')
                        
                                <div style="direction: ltr;display: inline-block;width: 100%">
                                    <input name="{{ $question->id }}-options" id="kartik"
                                        class="rating" data-stars="5" data-step="1"
                                        title="" />
                                </div>
                        
                            @else
                                <textarea name="{{ $question->id }}-options" id="" cols="50"
                                    rows="2"></textarea>
                            @endif
                        
                        
                        @else
                            <p for=""><b>{{ $question->question_ar }}</b></p>
                        
                            @if ($question->question_type == 'radio')
                        
                                <div style="direction: ltr;display: inline-block;width: 100%">
                                    <input name="{{ $question->id }}-options" id="kartik"
                                        class="rating" data-stars="5" data-step="1"
                                        title="" data-rtl=1 />
                                </div>
                        
                        
                            @else
                        
                                <textarea name="{{ $question->id }}-options" id="" cols="50"
                                    rows="2"></textarea>
                            @endif
                        @endif --}}
                        
                        {{--  --}}
                          {{-- /////////////////// --}}
                          <br />
                          <ul class="options-list pl-4">
                        
                        
                              @if (sizeof($question->options) && $question->question_type=="multiple_choice")
                                  @foreach ($question->options as $option)
                        
                                  <div class="radio">
                                    <label>
                                        <input type="radio" name="{{ $question->id }}-options"
                                            value="{{ $option->id }}" />
                                        {{Lang::locale() == 'en'? $option->option_text: $option->option_text_ar}}<br />
                                    </label>
                                </div>
                                  @endforeach
                              @elseif (sizeof($question->options) && $question->question_type=="drop_down")
                                  <select name="{{ $question->id }}-options"    class="form-control">
                                  @foreach ($question->options as $option)
                                      <option @if (($option->answered(@$test_result->id) != null && $option->answered(@$test_result->id) == 1) || $option->correct == true)  selected @endif value="{{ $option->id }}" >
                                        {{Lang::locale() == 'en'? $option->option_text: $option->option_text_ar}}<br />
                        
                                      </option>
                                  @endforeach
                                  </select>
                              @else
                                  @switch($question->question_type)
                                          @case("paragraph")
                                          <textarea type="text" class="form-control editor"   placeholder="paragraph" style="height:100px" name="{{ $question->id }}-options">{{ @test_res($test_result->id, $question->id)->option_id }}</textarea>
                                          @break
                                          @case("short_answer")
                                          <input type="text" class="form-control" value="{{ @test_res($test_result->id, $question->id)->option_id }}" placeholder="short_answer" name="{{ $question->id }}-options" />
                                          @break
                                          @case("date")
                                          <input type="text" class="form-control datepicker" value="{{ @test_res($test_result->id, $question->id)->option_id }}" placeholder="date" name="{{ $question->id }}-options" />
                                          @break
                                          @case("time")
                                          <input type="text" class="form-control timepicker" value="{{ @test_res($test_result->id, $question->id)->option_id }}"  placeholder="time" name="{{ $question->id }}-options" />
                                          @break
                                          @case("file_upload")
                                          <div style="margin-top: 20px">
                                              <label> @lang('labels.frontend.course.or_upload')</label>
                                              <input type="file" name="answer_file_{{ $question->id }}">
                                              <p>{!! get_test_file(auth()->id(), $question->id) !!} </p>
                                          </div>
                                          @break
                                  @endswitch
                              @endif                                                       
                              </ul>
                              <br />
                              <hr>
                          {{-- ////////////////// --}}
                        {{--  --}}
                        @endforeach
                        @endforeach

                        {{--  --}}
                        
                        @if ($complaiments)
                        {{-- @if (count($userAnswers) == 0) --}}
                            <div class="form-group row justify-content-center"
                                style="margin-top: 20px;margin-left: 16%;">
                                <div class="col-4">
                                    <button class="btn btn-success" style="background-color: ##3bcfcb;"
                                        type="submit">{{ __('buttons.general.crud.create') }}</button>
                                </div>
                            </div>
                            <!--col-->
                        {{-- @endif --}}
                        @else
                        <div class="form-group row">
                            <div class="col-12" style="text-align: center">
                                <h3>@lang('labels.general.no_data_available')</h3>
                            </div>
                        </div>
                        @endif
                        
                        {!! Form::close() !!}
                        
                        
                      
                        
                </div>
                </div>
                {{-- Form --}}
    
                </div>
            </div>
        </div>
    </section>
{{--  --}}

@endsection
@push('after-scripts')
<script>
    $(function () {
        var avatar_location = $("#avatar_location");

        if ($('input[name=avatar_type]:checked').val() === 'storage') {
            avatar_location.show();
        } else {
            avatar_location.hide();
        }

        $('input[name=avatar_type]').change(function () {
            if ($(this).val() === 'storage') {
                avatar_location.show();
            } else {
                avatar_location.hide();
            }
        });
    });
    $(document).on('change', '#payment_method', function(){
        if($(this).val() === 'bank'){
            $('.paypal_details').hide();
            $('.bank_details').show();
        }else{
            $('.paypal_details').show();
            $('.bank_details').hide();
        }
    });
</script>
@endpush