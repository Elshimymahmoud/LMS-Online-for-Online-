<html>
    <head>
        <style>
            .b-not_found {
                padding-bottom: 100px;
                padding-top: 50px;
            }
    
            .b-not_found .b-page_header {
                border-bottom: 0;
                padding-bottom: 0;
                margin: 0;
                margin-bottom: 10px;
                position: relative;
                overflow: hidden;
            }
    
            
    
            .b-not_found .b-page_header h1 {
                margin: auto;
                padding: 115px 0;
                text-align: center;
                text-transform: uppercase;
                color: #17d0cf;
                opacity: .8;
                letter-spacing: 3px;
                font-size: 75px;
                font-weight: 700;
            }
    
            .b-not_found h2 {
                font-size: 36px;
                letter-spacing: 1px;
                line-height: 1.5;
                color: #1B1919;
                font-weight: bold;
            }
    
            .b-not_found p {
                line-height: 1.7;
                color: #8E8E8E;
                margin-bottom: 20px;
            }
    
            .b-not_found .b-searchform {
                max-width: 350px;
                margin: auto;
                position: relative;
            }
    
            .b-not_found .b-searchform input {
                width: 100%;
                height: 40px;
                position: relative;
                padding-right: 105px;
                border: 1px solid rgba(129, 129, 129, 0.25);
                font-size: 14px;
                line-height: 18px;
                padding: 0 10px;
                transition: border-color .5s;
                box-shadow: none;
                border-radius: 0;
            }
    
            .b-not_found .b-searchform .btn {
                cursor: pointer;
                background-color: #1daaa3;
                color: #fff;
                position: absolute;
                right: 0;
                top: 0;
            }
    
            .b-not_found .b-searchform .btn:hover {
                opacity: 0.75;
            }
    
            @media (max-width: 990px) {
                .b-not_found .b-page_header::before {
                    font-size: 300px;
                }
    
                .b-not_found h2 {
                    font-size: 28px;
                }
            }
    
            @media (max-width: 767px) {
                .b-not_found .b-page_header h1 {
                    font-size: 35px;
                    padding: 55px 0;
                }
    
                .b-not_found .b-page_header::before {
                    font-size: 150px;
                    line-height: 150px;
                }
    
                .b-not_found h2 {
                    font-size: 22px;
                }
    
                .b-not_found .b-searchform {
                    max-width: 300px;
                }
            }
        </style>
    </head>
    <body>
           <!-- Start of breadcrumb section
    
        ============================================= -->
    <section id="breadcrumb" class="breadcrumb-section relative-position backgroud-style">
        <div class="blakish-overlay"></div>
        <div class="container">
            <div class="page-breadcrumb-content text-center">
                {{-- <div class="page-breadcrumb-title"><h2 class="breadcrumb-head black bold"><span>@lang('http.404.title2')</span></h2></div> --}}

            </div>
        </div>
    </section>    <!-- End of breadcrumb section
    
        ============================================= -->
    <section id="about-page" class="about-page-section pb-0">
        <div class="container">
            <div class="row">
                <div class="b-not_found w-100">
                    <div id="loading">
                        <div id="loading-center">
                           <img style="margin-left: 28%;"
                            src="{{asset('iv')}}/loader.gif" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> 
    <script>
        setTimeout(() => {
         window.location.href ='{{url('/')}}';
    }, 5000);
        
    </script>   
    </body>
</html>
   
