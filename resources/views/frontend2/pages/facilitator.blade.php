@extends('frontend.layouts.app'.config('theme_layout'))

@push('after-styles')
    <style>
        .content img {
            margin: 10px;
        }
        .about-page-section ul{
            padding-left: 20px;
            font-size: 20px;
            color: #333333;
            font-weight: 300;
            margin-bottom: 25px;
        }
    </style>
@endpush

@section('content')


       <!--  Header  -->



        <!--  Slide  -->

        <section class="slide" style="background-image: url({{ asset('ivory') }}/assets/img/slider/10.jpg);">
            <div class="slide-overlay">
                <div class="slide-content">
                    <h1>FACILITATORS</h1>
                </div>
            </div>
        </section>

        <!--  Slide  -->


        <!--  About  -->

        <section class="about pt-35 pb-35">
            <div class="about-overlay">
                <div class="container-about">
                    <div class="about-content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="img-about text-center mb-35">
                                    <img src="{{ asset('ivory') }}/assets/img/about/1.png" alt="About" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="disc-about mb-35">
                                    <div class="grid-6 last" style="text-align: justify;">
                                        <div class="grid-6 last">To coach a big role effectively and impact on the success of the training program and increase the effectiveness of training. Since the training program’s success or failure largely depends on the coach.</div>
                                        <div class="grid-6 last">Therefore, the quality of the training system as a whole is largely dependent on the coach .olhzh efficiency reasons, the selection and training of trainers and the development of standards for the design employed in the task of training systems.</div>
                                        <div class="grid-6 last">And coach under the scientific and technological revolution is no longer a role the role of source and transmission of knowledge, but his role has become organized and prepared for the conditions and terms of atmosphere and environment training.</div>
                                        <div class="grid-6 last">In this sense, we in Ivory cooperate with a number of professional and trained experts in their fields, from around the world joined us</div>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="join">
                            <div class="head-join">
                                <h4>
                                    <div class="span-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <span>JOIN US</span>
                                </h4>
                            </div>
                            <div class="body-join">
                                <div class="body-content">
                                    <form action="#">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="name">Name <span style="color: red;">*</span></label>
                                                    <input type="text" name="join" id="name" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="email">Email <span style="color: red;">*</span></label>
                                                    <input type="email" name="join" id="email" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="phone">Phone <span style="color: red;">*</span></label>
                                                    <input id="phone" name="phone" type="tel" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="heading-group">
                                                        <label>
                                                            Training Categories <span style="color: red;">*</span>
                                                        </label>
                                                    </div>
                                                    <ul class="list-unstyled checkboxs">
                                                        <li>
                                                            <input type="checkbox" name="categ" id="1" class="mr-10">
                                                            <label for="1">Artificial intelligence</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="2" class="mr-10">
                                                            <label for="2">Banking and financial services</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="3" class="mr-10">
                                                            <label for="3">Customers service</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="4" class="mr-10">
                                                            <label for="4">Digital transformation</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="5" class="mr-10">
                                                            <label for="5">Artificial intelligence</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="6" class="mr-10">
                                                            <label for="6">Banking and financial services</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="7" class="mr-10">
                                                            <label for="7">Customers service</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="8" class="mr-10">
                                                            <label for="8">Digital transformation</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="9" class="mr-10">
                                                            <label for="9">Artificial intelligence</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="10" class="mr-10">
                                                            <label for="10">Banking and financial services</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="11" class="mr-10">
                                                            <label for="11">Customers service</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="12" class="mr-10">
                                                            <label for="12">Digital transformation</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="13" class="mr-10">
                                                            <label for="13">Banking and financial services</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="14" class="mr-10">
                                                            <label for="14">Customers service</label>
                                                        </li>
                                                        <li>
                                                            <input type="checkbox" name="categ" id="15" class="mr-10">
                                                            <label for="15">Digital transformation</label>
                                                        </li>
                                                    </ul>
                                                    <span class="field" style="color: #990000;font-size: 12px;">
                                                        This field is required.
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="cv">CV <span style="color: red;">*</span></label>
                                                    <div style="visibility:hidden; opacity:0" id="dropzone">
                                                        <div id="textnode"></div>
                                                    </div>
                                                    <div class="drag">
                                                        <div id='text' class="">
                                                            <svg viewBox="0 0 1024 1024" focusable="false" class="" data-icon="inbox" width="50px" height="50px" fill="#B1B1B1" aria-hidden="true"><path d="M885.2 446.3l-.2-.8-112.2-285.1c-5-16.1-19.9-27.2-36.8-27.2H281.2c-17 0-32.1 11.3-36.9 27.6L139.4 443l-.3.7-.2.8c-1.3 4.9-1.7 9.9-1 14.8-.1 1.6-.2 3.2-.2 4.8V830a60.9 60.9 0 0 0 60.8 60.8h627.2c33.5 0 60.8-27.3 60.9-60.8V464.1c0-1.3 0-2.6-.1-3.7.4-4.9 0-9.6-1.3-14.1zm-295.8-43l-.3 15.7c-.8 44.9-31.8 75.1-77.1 75.1-22.1 0-41.1-7.1-54.8-20.6S436 441.2 435.6 419l-.3-15.7H229.5L309 210h399.2l81.7 193.3H589.4zm-375 76.8h157.3c24.3 57.1 76 90.8 140.4 90.8 33.7 0 65-9.4 90.3-27.2 22.2-15.6 39.5-37.4 50.7-63.6h156.5V814H214.4V480.1z"></path></svg>
                                                            <p>Click or drag a file to this area to upload.</p>
                                                        </div>
                                                    </div>
                                                    <span id="field">This field is required.</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <button type="submit">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--  About  -->


        <div class="line">
            <img src="{{ asset('ivory') }}/assets/img/slider/7.jpg" alt="Untitled" class="img-fluid">
        </div>


        <section class="experts pb-85 pt-85">
            <div class="experts-overlay">
                <div class="container-about">
                    <div class="experts-content">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/1.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>د. عبد العزيز طاحون</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>Ahmad Ghazi</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>أ. أحمد أبو المكارم</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>أ. علاء السيد</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>د. عبد العزيز طاحون</h3>
                                            <h5>
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/5.jpg" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>Ahmad Ghazi</h3>
                                            <h5>
                                                An expert in key performance indicators and human resource development
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>أ. أحمد أبو المكارم</h3>
                                            <h5>
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>أ. علاء السيد</h3>
                                            <h5>
                                            </h5>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>د. عبد العزيز طاحون</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>Ahmad Ghazi</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>أ. أحمد أبو المكارم</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/4.jpg" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>أ. علاء السيد</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>د. عبد العزيز طاحون</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>Ahmad Ghazi</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>أ. أحمد أبو المكارم</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="expert">
                                    <a href="#">
                                        <div class="img-expert">
                                            <img src="{{ asset('ivory') }}/assets/img/team/2.png" alt="Expert" class="img-fluid">
                                        </div>
                                        <div class="name-expert">
                                            <h3>أ. علاء السيد</h3>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



@endsection