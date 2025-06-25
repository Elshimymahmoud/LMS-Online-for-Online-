<!-- resources/views/details.blade.php -->
<!DOCTYPE html>
<html>

<head>
    <title>Details </title>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            direction: rtl;
        }
        #course-details .cont {
          
          text-align: center;
          height: 100%;
          width:98%;
          margin-left: auto;
          margin-right: auto
      }
       

        a {
            text-decoration: none;

        }

        .collapse-header::after {
            content: "+";
            position: absolute;
            left: 10px;
            font-size: 22px;
            font-weight: 700;
        }

        .collapse-header.active::after {
            content: "-";
        }

        a:hover {
            text-decoration: none
        }

        #course-details {
            padding: 40px 0;
            height: 200vh;
        }

        #course-details .two-part .text-part {
         
            margin-bottom: 20px;
             width:100%
        }
        #course-details .image-part{
            width: 100%
        }

        #course-details .image-part img {
            width: 100%;
            height: 350px;
            max-width: 100%;
        }
        

        #course-details  h3 {
            font-size: 25px;
            line-height: 32px;
            margin-bottom: 20px;
            color: #4f198d;
        }

        #course-details .two-part p {
            line-height: 32px;
            text-align: justify;
            font-size: 20px;
        }

        #course-details .two-part {
            display: flex;
            width: 100%;
          
            flex-direction: column;


        }

        #course-details .two-part a {
            display: inline-block;
            padding: 10px 20px;
            min-width: 180px;
            border-radius: 10px;
            transition: .5s ease-in-out;
            margin: 10px 10px;
            text-align: center;
            line-height: 28px;
            font-size: 18px;
            font-weight: 500;
        }

        #course-details .two-part a.fbtn {
            background: #4f198d;
            color: #fff;
            border: 1px solid transparent;
        }

        #course-details .two-part a.fbtn:hover {
            background-color: transparent;
            border: 1px solid #4f198d;
            color: #4f198d;
        }

        #course-details .two-part a.sbtn {
            background-color: transparent;
            color: #4f198d;
            border: 1px solid #4f198d;

        }

        #course-details .two-part a.sbtn:hover {
            background: #4f198d;
            color: #fff;
        }

        #course-details .two-part .image-part,
        #course-details .two-part .text-part {
            width: 100%;
        }

        .two-buttons {
            display: flex;
            justify-content: start;
            flex-wrap: wrap;
            justify-content: center
        }

      
.tabs-details{
    margin-top:60px;
}
        .tabs-details .tabs {
            display: flex;
            cursor: pointer;
            margin-bottom: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }
        .tabs-details .tab {
            padding: 10px 20px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            margin-right: 5px;
            font-size: 20px;
          
            margin: 5px;
            border-radius: 6px;
          
        }
        .tabs-details .tab.active {
            background-color: #4f198d;
            border-bottom: none;
            color: #fff;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        }
        .tabs-details .tab-content {
            display: none;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            border-radius: 10px;
        }
        .tabs-details .tab-content.active {
            display: block;
        }
.tab-content .two{
    text-align: start
}

.tab-content .two li{
    line-height: 32px;
    font-size: 20px;
    margin: 5px 0;
}
.tab-content .two h5{
    font-size: 20px;
    font-weight: 600;
    margin: 10px 0;
}
.tab-content .second{
    border: 1px solid #eee;
    box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
    padding: 10px 20px;
    width: 25%
}
.tab-content .second .icons {
    font-size: 20px;
    color: #aaa;
    margin: 10px 0;
    display: flex;
    align-items: center;
    
}
.tab-content .second .icons i{
    color: #4f198d;

}
.tab-content .second .icons span{
    margin-left: 5px;
    font-size: 16px;
}
.tab-content .second .icons b{
    margin-right: 5px;
}
.tab-content .goals p{
    font-size: 18px;
    font-weight: 600;
    line-height: 30px
}
.tab-content .goals{
    text-align: start;
    padding: 0
}
.tab-content .goals li{
    font-size: 16px;
    color: #aaa;
    line-height: 25px;
    list-style: none;
    padding-right: 40px
}
.tab-content .goals li i{
    color: #aaa
}
.fa-circle{
    font-size: 16px;
    
}
.collapse-header {
            cursor: pointer;
            padding: 10px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            text-align: right;
            font-weight: bold;
            position: relative;
            transition: .5s ease;
        }

        .collapse-content {
            padding: 10px;
            border: 1px solid #ccc;
            border-top: none;
            display: none;
            text-align: right;
            background-color: #fff;
            transition: .5s ease;
        }

        .collapse-content.active {
            display: block;
        }
        .tab-content iframe{
            border-radius: 20px;
            width:100%;
            margin-bottom: 20px;
        }
        .rowLocation {
            display: flex;
           
            align-items: center;
            border-radius: 10px;
        }
        .date-section{
            display: flex;
            align-items: center
        }
        .groups-data{
            background-color: #fff;
            padding: 10px;
            margin: 10px 0;
            position: relative;

        }
        .basket{
           
           
            background: #aaa;
            color: rgba(0, 0, 0,.7);
            left:10px;
            margin:0 10px ;
            border-radius:10px;
            padding: 10px;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        }
        .loc-cont{
            display: flex;
            align-items: center;
            margin: 20px 0;
        }
        .loc-cont .icon{
            margin-left: 10px;
        }
        .newbtn{
            background: #4f198d;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: block;
        }
        .newbtn a{
            color:#fff;
        }
        .teacher-img {
    border-style: solid;
    border-width: 1px;
    width: 40px;
    height: 42px;
    object-fit: cover;
    border-radius: 53%;
    /* margin-top: 2px; */
    margin-top: 2px;
    margin-right: 5px;
        }
        .trns-1 span{
            display: flex;
            align-items: center;
            font-size: 16px;
            font-weight: 600
        }
        .trns-1 span img {
            margin-left: 10px;
        }
        .trns-1{
            background: #fff;
            box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
            border: 1px solid #eee;
            padding: 10px 20px;
            border-radius: 10px;
            margin: 10px 0;
            display: block;
            position: relative;
        }
        .trns-1 .teacher-icon-download{
            position: absolute;
            top: 20px;
            left: 10px;
            border-radius: 10px;
            font-size: 20px;
            color: #aaa;
        }
@media(max-width:775px){

    #course-details .cont {
          
          text-align: center;
          height: 100%;
          width: 98%;
          margin-left: auto;
          margin-right: auto
      }
}

       

        @media (min-width:776px) {
         
            #course-details .cont {
                width: 85%;
                margin-left: auto;
                margin-right: auto;
                max-width: 85%
          
        }}
        @media (min-width: 992px) {
            
            #course-details .two-part{
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: start;
            }
            #course-details .two-part .text-part {
         
        width:55%;
     }
     .two-buttons {
        justify-content: start;
     }
     #course-details .two-part .image-part {
         width: 40%;
        
     }
     .tab-content .two{
        display: flex;
        justify-content: space-between;
        align-items: start;
     }
     .groups-data{
        display: flex;
        justify-content: space-between;
        align-items: center;
        /* flex-direction: column */
     }
        }

    </style>
</head>

<body>
    <div id='course-details'>
        <div class="cont">
            <div class="two-part">
                <div class="text-part ">
                    <h3>دوره اونلاين تجريبيه</h3>
                    <p>هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل
                        الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم
                        لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد
                        محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير
                        صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال "lorem ipsum" في أي
                        محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة
                        ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية
                        إليها.
                    </p>
                    <div class="two-buttons">
                        <a href='#' class='fbtn'>دورات الأونلاين</a>
                        <a href='#' class=sbtn>الأمن والسلامة</a>
                    </div>
                </div>
                <div class="image-part ">
                    <img src="{{ asset('assets/img/course/bc-1.jpg') }}" class='w-100 '>
                </div>
            </div>
            <div class="tabs-details">
                <h3>تفاصيل الدورة</h3>
                <div class="tabs">
                    <div class="tab active" data-tab="1"> أهداف الدورة</div>
                    <div class="tab" data-tab="7"> المجموعات</div>

                    <div class="tab" data-tab="2">الفئة المستهدفة</div>
                    <div class="tab" data-tab="3">محاور الدورة</div>
                    <div class="tab" data-tab="4"> المدربون</div>
                    <div class="tab" data-tab="5">محتويات الدورة</div>
                    <div class="tab" data-tab="6">بوايات الدفع</div>
                </div>
            
                <div id="tab-content-1" class="tab-content active">
                    <div class="two">
                        <div class="first">
                            <iframe id="youtube-3273" frameborder="0" allowfullscreen="" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" title="Player for " width="" height="360" src="https://www.youtube.com/embed/qk6tPLhQz2U?autoplay=0&amp;controls=0&amp;disablekb=1&amp;playsinline=1&amp;cc_load_policy=0&amp;cc_lang_pref=auto&amp;widget_referrer=http%3A%2F%2Flocalhost%3A8000%2Fcourse%2Fweb-design&amp;noCookie=false&amp;rel=0&amp;showinfo=0&amp;iv_load_policy=3&amp;modestbranding=1&amp;enablejsapi=1&amp;origin=http%3A%2F%2Flocalhost%3A8000&amp;widgetid=1"></iframe>
                            <h5>سيكون كل مشارك في نهاية الدورة قادراً على: </h5>
                            <ul>
                                <li>توضيح مفهوم الاستدامة وأهميتها في سياق الأعمال الحديثة.</li>
                                <li>تعزيز الفهم للتحديات البيئية والاجتماعية والاقتصادية</li>
                                <li>التزود بالمهارات والأدوات اللازمة لتطبيق مبادئ الاستدامة في استراتيجيات الأعمال وعملياتها.</li>
                                <li>تعزيز الوعي بأفضل الممارسات والتقنيات لتحقيق الاستدامة في مختلف القطاعات والصناعات.</li>
                            </ul>
                        </div>
                        <div class="second">
                            <div class='icons'>
                                <i class="fas fa-clock" style="margin:0 10px;"></i><span>المدة الزمنية</span> -
                                <b>(0 ساعة)</b>
                           </div>
                            <div  class='icons'>
                                <i class="fa fa-book" style="margin: 0 10px"></i><span>محاضرات</span> -
                                <b>(2 محاضرات)</b>
                            </div>
                            <div  class='icons'>
                                <i class="fa fa-line-chart" style="margin: 0 10px"></i><span>المستوى</span> -
                               <b> (مبتدئ)</b>
                            </div>
                        </div>

                    </div>
                </div>
                <div id="tab-content-7" class="tab-content">
                    <div class="groups">
                        <div class="locationsAll">
                            <div class="container" style="width: 100%">
                                <div class="groups-data">
                                <div class="row rowLocation justify-content-center align-items-center">

                                        <div class="col-md-6">
                                            <div class="loc-cont" style="text-align: start">
                                                <img src="http://localhost:8000/iv/icons/location.png" class="icon" alt="">
                                                <span class="title">
                                                                                                                    21
                                                                                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6" style="display: flex;
                                           
                                            justify-content: center;">
                                            <div class="date-section">

                                             
                                                <div class="date-data">
                                                    <img src="http://localhost:8000/iv/icons/calendar.png" class="icon" alt="">
                                                    <span class="title">30-06-2024</span><span class="title">الى</span><span class="title">04-07-2024</span>
                                                    
                                                </div>

                                            </div>

                                        </div><div class="col-md-6">
                                        <div class="loc-cont" style="text-align: end">
                                            <img src="http://localhost:8000/iv/icons/price-tag.png" class="icon icon-price" alt="">
                                            <span class="title"> 5000 SAR </span>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-4" style="display: flex;
                                        justify-content: center; padding: 0;align-items:center">
                                        <div class="col-md-12  col-xs-12 joinbtn newbtn">
                                            <a href="#" disabled="" class="btn btn-primary btn-get-course  link-border">
    انتهت الدورة        </a>

                                        </div>
                                   
                                        <a href="#" class="btn btn-primary btn-white link-border basket
                                            btn-add-course" data-group-id="30" style="">

                                            <i class="fa fa-shopping-cart" style=""></i>
                                        </a>
                                    </div>
                                  

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
                <div id="tab-content-2" class="tab-content">
                   <div class="two">
                    <div class="first">
                        <li>المدراء التنفيذيين ومسؤولو اتخاذ القرار في الشركات والمؤسسات الذين يرغبون في تضمين مبادئ الاستدامة في استراتيجيات أعمالهم.</li>
                        <li>الموظفون في مجالات إدارة البيئة والاستدامة الذين يسعون لتعزيز فهمهم ومعرفتهم بأحدث الممارسات والتقنيات في مجال الاستدامة.</li>
                        <li>الخبراء والاستشاريون الذين يعملون في مجال الاستدامة ويرغبون في تطوير مهاراتهم وزيادة معرفتهم بأساليب تطبيق مفاهيم الاستدامة في الأعمال.</li>
                    </div>
                   </div>
                </div>
                <div id="tab-content-3" class="tab-content">
                    <ul class='goals'>
                        <p>  <i class="fa fa-circle" style="margin:0 10px;"></i>تحليل العمليات الحالية</p>
                        <li><i class="fa fa-check" style="margin:0 10px;"></i>تقنيات تحليل العمليات</li>
                        <li > <i class="fa fa-check" style="margin:0 10px;"></i>توثيق الإجراءات الحالية</li>
                        <li ><i class="fa fa-check" style="margin:0 10px;"></i>تحديد نقاط القوة والضعف</li>
                    </ul>
                    <ul class='goals'>
                        <p>  <i class="fa fa-circle" style="margin:0 10px;"></i> تطوير الإجراءات والأساليب</p>
                        <li> <i class="fa fa-check" style="margin:0 10px;"></i>تقنيات تحليل العمليات</li>
                        <li > <i class="fa fa-check" style="margin:0 10px;"></i>توثيق الإجراءات الحالية</li>
                        <li>  <i class="fa fa-check" style="margin:0 10px;"></i>تحديد نقاط القوة والضعف</li>
                    </ul>
                    <ul class='goals'>
                        <p>   <i class="fa fa-circle" style="margin:0 10px;"></i> تطبيق أدوات التحسين المستمر</p>
                        <li> <i class="fa fa-check" style="margin:0 10px;"></i>تقنيات تحليل العمليات</li>
                        <li > <i class="fa fa-check" style="margin:0 10px;"></i>توثيق الإجراءات الحالية</li>
                        <li>  <i class="fa fa-check" style="margin:0 10px;"></i>تحديد نقاط القوة والضعف</li>
                    </ul>
                    <ul class='goals'>
                        <p>   <i class="fa fa-circle" style="margin:0 10px;"></i> قياس الأداء ومراقبة التحسين</p>
                        <li> <i class="fa fa-check" style="margin:0 10px;"></i>تقنيات تحليل العمليات</li>
                        <li > <i class="fa fa-check" style="margin:0 10px;"></i>توثيق الإجراءات الحالية</li>
                        <li>  <i class="fa fa-check" style="margin:0 10px;"></i>تحديد نقاط القوة والضعف</li>
                    </ul>
                </div>
                <div id="tab-content-4" class="tab-content">
                  <div class="trns">
                    <a  href= '#' class="trns-1">
                        <span>
                            <i class="teacher-img-parent"><img class="teacher-img" src="https://www.gravatar.com/avatar/dbecc8c2244033da9c3f674328dca176.jpg?s=80&amp;d=mm&amp;r=g" alt=""></i>مدرب <i class="teacher-icon-download fa fa-download"></i></span>
                    </a>
                  </div>
                </div>
                <div id="tab-content-5" class="tab-content">
                    <div class="collapse-section">
                        <div class="collapse-header" data-target="content-1">محتويات الجلسه الاولى</div>
                        <div id="content-1" class="collapse-content">
                            <p> <i class="fas fa-file-pdf" style="font-size:24px; margin-left:10px;"></i>تفاصيل الجلسه الاولى...</p>
                        </div>
                    </div>
                
                    <div class="collapse-section">
                        <div class="collapse-header" data-target="content-2">محتويات الجلسه التانيه</div>
                        <div id="content-2" class="collapse-content">
                            <p> <i class="fas fa-file-pdf" style="font-size:24px; margin-left:10px;"></i>تفاصيل الجلسه التانيه...</p>
                        </div>
                    </div>
                </div>
                <div id="tab-content-6" class="tab-content">
                  <div class="gets">
                <div class="get-1">
                    <div class="sc-8a38d207-0 bRWrkE" style="background-image: initial;background-color: rgb(24, 26, 27);border-color: #4f198d;position: relative;cursor: pointer;display: flex;flex-direction:column;-webkit-box-align: center;align-items: center;-webkit-box-pack: start;justify-content: flex-start;background: rgb(255, 255, 255);border-radius: 8px;border: 1px solid #aaa; width: 100%;text-align:center;margin-bottom:20px">
                        <div class="sc-8a38d207-5 gprheV" style="margin:10px auto;display:block;">
                            <img src="https://k.nooncdn.com/s/app/com/noon/images/tabby_logo.svg" alt="" width="100px" height="40px" class="sc-92fbb12b-1 kkpbGz" style="width: 100px;max-width: unset;height: 40px;max-height: unset;">
                        </div>
                        <div class="sc-8a38d207-1 fhYDVM" style="margin-right: auto;width: 100%;display: block;-webkit-box-align: center;align-items: center;-webkit-box-pack: justify;justify-content: space-between;">
                            <span class="sc-8a38d207-2 cWkccj" style="width:100%">
                                                                                <p>قسم على 4 دفعات من 1,250.00 SAR . بدون
                                        فوائد. بدون رسوم تأخير.</p>
                                                                        </span>

                        </div>
                    </div>
                    <div class="sc-f43f071d-0 hJaViW" style="background-image: initial;background-color: rgb(24, 26, 27); border-color: rgb(116, 38, 45);width:100%;position: relative;cursor: pointer;display: flex;flex-direction:column; center;align-items: center;-webkit-box-pack: start;justify-content: flex-start; background: rgb(255, 255, 255);border-radius: 8px;border: 1px solid #aaa; width: 100%;text-align:center">
                        <div class="sc-f43f071d-5 jbdSBD" style="">
                            <img src="http://localhost:8000/images/myfatoura.JFIF" alt="" width="100px" height="40px" class="sc-92fbb12b-1 jhbcOQ" style="width: 100px;max-width: unset;height: 70px; max-height: unset;">
                        </div>
                        <div class="sc-f43f071d-1 bwrdDG" style="margin-right: auto; width: 100%;display: block;-webkit-box-align: center; align-items: center;-webkit-box-pack: justify;justify-content: space-between;">
                            <span class="sc-f43f071d-2 eDOZDt" style="width: 100%;">


                                                                                <p>تستطيع الأن دفع 5,000.00 SAR باستعمال ماي فانوره</p>
                                                                        </span>

                        </div>
                    </div>
                </div>
                  </div>
                </div>
            
            </div>
        </div>
    </div>


    <script>
       
        const tabs = document.querySelectorAll('.tabs-details .tab');
        const contents = document.querySelectorAll('.tabs-details .tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
               
                tabs.forEach(t => t.classList.remove('active'));
                contents.forEach(c => c.classList.remove('active'));

               
                tab.classList.add('active');
                document.getElementById(`tab-content-${tab.getAttribute('data-tab')}`).classList.add('active');
            });
        });
    </script>
    <script>
        
        const headers = document.querySelectorAll('.collapse-header');

        headers.forEach(header => {
            header.addEventListener('click', () => {
                const targetId = header.getAttribute('data-target');
                const content = document.getElementById(targetId);

               
                header.classList.toggle('active');

             
                content.classList.toggle('active');
            });
        });
    </script>
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>
</body>

</html>
