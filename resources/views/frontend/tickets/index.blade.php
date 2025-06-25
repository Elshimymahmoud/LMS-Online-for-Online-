@extends('frontend.layouts.app'.config('theme_layout'))

@section('title', trans('labels.frontend.tickets.title').' | '.app_name())
@section('meta_description', '')
@section('meta_keywords','')


@push('after-styles')
    <link rel="stylesheet" href="{{ asset('iv') }}/css/plan.css"/>
    <style>
        p {
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

        .fnt-wght-900 {
            font-weight: 900;

        }

        .welcome {
            padding: 15px;
            border-radius: 10px;
        }
        .modal-header{
            display: flex;
            align-items: center;
            flex-direction: row;
        }
    </style>
@endpush

@section('content')

    <section class="row the-slider" id="slider">
        <div style="background-size: cover;height:fit-content;background-color: #f1f3f3;padding-bottom: 20px;">
            <div class="container">
                <div class="row benefit-notes">
                    <div class="col-sm-12 col-md-12   wow fadeInUp2  register-parent mt-0">

                        <!--========== /.navbar-collapse ==========-->
                    </div>
                    <!--========== /.container-fluid ==========-->


                </div>


                <div class="row">

                    <div class="container">
                        <!--========== old tickets ==========-->
                        <div class="col-sm-12 col-md-3   wow fadeInUp ptb-50  mt-0">

                            @if(count($tickets) > 0)
                                <section class="welcome">

                                    <div class="head-welcome">
                                        <h2></h2>
                                    </div>
                                    {{-- start first --}}
                                    <div class="first">
                                        <div class="middle-welcome">
                                            <h5>
                                                التذاكر السابقه:
                                            </h5>
                                            <p>
                                            <ol type="1">
                                                @foreach($tickets as $ticket)
                                                    <li>
                                                        <a href="{{route('tickets.show', $ticket->code)}}">{{
                                                        $ticket->subject }}</a>
                                                        <span>{{$ticket->created_at->diffForHumans()
                                                        }}</span>
                                                    </li>
                                                @endforeach
                                            </ol>
                                            </p>
                                        </div>
                                    </div>
                                    {{-- end first --}}


                                </section>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-8 plan  wow fadeInUp ptb-50  mt-0">
                            <div class="plan1">


                                <!--  Slide  -->

                                <section class="slide"
                                         style="border-radius: 10px;background-image: url({{asset('ivory')}}/assets/img/slider/4.jpg);">
                                    <div class="slide-overlay" style="padding: 10px">
                                        <div class="slide-content">
                                            <h3>@lang('labels.frontend.tickets.title')</h3>
                                        </div>
                                    </div>
                                </section>

                                <!--  Slide  -->


                                <!--  Welcome  -->

                                <section class="welcome">

                                    <div class="head-welcome">
                                        <h2></h2>
                                    </div>
                                    {{-- start first --}}
                                    <div class="first">
                                        <div class="middle-welcome">
                                            <h5>
                                                المعلومات العامة:
                                            </h5>
                                            <p>
                                                <ol type="1">
                                                    <li>
                                                        نهدف إلى حل جميع استفساراتكم التقنية في أقرب وقت ممكن.
                                                    </li>
                                                    <li>
                                                    يرجى التأكد من البحث في قاعدة المعرفة أو الأسئلة الشائعة قبل إنشاء تذكرة جديدة، فقد تجد الإجابة على استفسارك هناك.
                                                    </li>
                                                    <li>تتوفر قاعدة المعرفة والأسئلة الشائعة <a href="{{route('contact')}}">هنا</a>.
                                                    </li>

                                                </ol>
                                            </p>
                                            <h5>إنشاء تذكرة دعم فني:</h5>
                                            <p>
                                                <ol type="1">
                                                    <li>
                                                        يرجى تقديم وصف واضح وموجز لمشكلتكم عند إنشاء تذكرة جديدة.
                                                    </li>
                                                    <li>
                                                        كلما زادت تفاصيل المشكلة، كان بإمكان فريق الدعم الفني مساعدتكم بشكل أسرع.

                                                    </li>
                                                    <li>
                                                        تشتمل المعلومات المفيدة على:
                                                        <ol>
                                                            <li>
                                                                نوع المشكلة التي تواجهها.
                                                            </li>
                                                            <li>
                                                                الخطوات التي أدت إلى ظهور المشكلة (إذا كانت قابلة للتكرار).
                                                            </li>
                                                            <li>
                                                                أي رسائل خطأ تظهر على الشاشة.
                                                            </li>
                                                            <li>
                                                                لقطات شاشة أو ملفات أخرى ذات صلة (إذا كانت متوفرة).
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </ol>
                                            </p>
                                            <h5>إدارة تذاكر الدعم الفني:</h5>
                                            <p>

                                                <ol type="1">
                                                    <li>
                                                        سيتم تعيين كل تذكرة تلقائيًا بموظف دعم فني واحد سيكون مسؤولاً عن مساعدتكم على حل مشكلتكم.

                                                    </li>
                                                    <li>
                                                        ستتلقى إشعارًا بالبريد الإلكتروني عند إنشاء تذكرة جديدة أو تحديثها من قبلكم أو من قبل موظف الدعم الفني.
                                                    </li>
                                                    <li>
                                                        يرجى تجنب إنشاء تذاكر متعددة لنفس المشكلة.
                                                    </li>
                                                    <li>
                                                        يرجى الرد على رسائل البريد الإلكتروني التي تتلقاها بشأن تذكرتكم لضمان استمرار المحادثة ومتابعة حل المشكلة.
                                                    </li>
                                                </ol>
                                            </p>

                                            <h5>ملاحظات مهمة:

                                            </h5>
                                            <p>
                                            <ol type="1">
                                                <li>
                                                    يرجى الامتناع عن استخدام ألفاظ نابية أو غير لائقة في تذاكر الدعم الفني.

                                                </li>
                                                <li>
                                                    سيتم إغلاق التذاكر التي لا تتضمن معلومات كافية أو التي تنتهك شروط الاستخدام.


                                                </li>
                                            </ol>
                                            <br>
                                            نقدر تفهمكم ونتطلع إلى مساعدتكم في حل أي مشكلة تقنية تواجهونها.
                                            </p>
                                        </div>


                                        <div class="middle-welcome">
                                            <button id="create-ticket-button" class="btn btn-primary" style="border-radius: 8px;padding: 7px;width: 12rem;">
                                                @lang('labels.frontend.tickets.fields.create')
                                            </button>

                                        </div>

                                    </div>
                                    {{-- end first --}}


                                </section>

                                <!--  Welcome  -->

                            </div>

                            <!-- <div class="comment">

                            </div> -->
                        </div>
                        <div class="col-sm-12 col-md-1   wow fadeInUp ptb-50  mt-0">
                        </div>
                        <!--==========blog details  ==========-->
                        <!--========== more blog details  ==========-->


                    </div>
                </div>
            </div>


        </div>
        </div>
    </section>

    <div id="ticket-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">@lang('labels.frontend.tickets.fields.create')</h5>

                </div>
                <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="form-group">
                            <label for="title">@lang('labels.frontend.tickets.fields.title')</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">@lang('labels.frontend.tickets.fields.description')</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="attachment">@lang('labels.frontend.tickets.fields.attachment')</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="submit-ticket-button">@lang('labels.frontend.tickets.fields.submit')</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('labels.frontend.tickets.fields.close')</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('after-scripts')
<script>
    $(document).ready(function() {
        $('#create-ticket-button').on('click', function() {
            $('#ticket-modal').modal('show');
        });

        $('#submit-ticket-button').on('click', function(e) {
            // e.preventDefault();

            var formData = new FormData($('#ticket-form')[0]);
            // Log the form data for debugging
            for (var pair of formData.entries()) {
                console.log(pair[0]+ ', ' + pair[1]);
            }


            $('#ticket-modal').modal('hide');
        });
    });
</script>
@endpush
    