<!DOCTYPE html>
@if (config('app.display_type') == 'rtl' || (session()->has('display_type') && session('display_type') == 'rtl'))
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl"> --}}
{{-- @else --}}
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
{{-- @endlangrtl --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', app_name())</title>
    <meta name="description" content="@yield('meta_description', 'Laravel 5 Boilerplate')">
    <meta name="author" content="@yield('meta_author', 'Anthony Rappa')">
    @if (config('favicon_image') != '')
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('storage/logos/' . config('favicon_image')) }}" />
    @endif
    @yield('meta')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link href="{{asset('/bootstrap/js/bootstrap.min.js')}}" rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.css') }}">
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link rel="stylesheet" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" />

    {{-- flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    {{-- <link rel="stylesheet" --}}
    {{-- href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.min.css"/> --}}
    {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
    <style>
        #phone {
            text-align: left !important;
            direction: ltr !important;
        }

    </style>
    {{-- twilio phone international code --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    {{-- /////// --}}
    {{-- twilio phone international code --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    {{-- twilio phone international code --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    {{-- /////// --}}

    <script>
     

        setTimeout(() => {
            const phoneInputField = document.querySelector("#phone");

            const phoneInput = window.intlTelInput(phoneInputField, {
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
            });

            const phoneNumber = phoneInput.getNumber();
         
            $('#phone').on('change', () => {
                const phoneNumber = phoneInput.getNumber();

                $('#phone').val(phoneNumber);
                
            })
                   
 
            //    $('#phone').on('keyPress',()=>{
            //     const phoneNumber = phoneInput.getNumber();
            //     console.log(phoneNumber,"Dddd");
            //     $('#phone').val(phoneNumber);
            //     console.log(phoneNumber);
            //    })
            $('#iti-0__country-listbox').on('change', () => {
                const phoneNumber = phoneInput.getNumber();

                $('#phone').val(phoneNumber);
                console.log(phoneNumber);
            })

            let phoneInput2=document.querySelector("#phone");
        window.intlTelInput(phoneInput2, {
  initialCountry: "auto",
  geoIpLookup: function(success, failure) {
    $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
      var countryCode = (resp && resp.country) ? resp.country : "us";
      success(countryCode);
    });
  },
});
        }, 1000);
    
    </script>

    @stack('before-styles')

    <!-- Check if the language is set to RTL, so apply the RTL layouts -->
    <!-- Otherwise apply the normal LTR layouts -->
    {{ style(mix('css/backend.css')) }}


    @stack('after-styles')
    <style>
        label {
            font-size: 14px;
            line-height: 22px;
            padding: 5px;
            font-weight: 600;
        }

        * {
            font-family: 'Cairo', sans-serif;
        }
        #notify-item-count {
            background-color: #3bcfcb;
            color: white;
            border-radius: 33%;
            padding: 0px 2px;
            margin-left: 6px;
            font-size: 12px;
            position: absolute;
            right: 9px;
            height: 15px;
            top: -5px;
            font: -webkit-small-control;
        }
    </style>
    @if (config('app.display_type') == 'rtl' || session('display_type') == 'rtl')
        <style>
            .float-left {
                float: right !important;
            }

            .float-right {
                float: left !important;
            }

        </style>
    @endif

    @stack('head-scripts')
    @stack('country-dropdown')

</head>

<body class="{{ config('backend.body_classes') }}">
    @include('backend.includes.header')

    <div class="app-body">
        @include('backend.includes.sidebar')

        <main class="main">
            @include('includes.partials.logged-in-as')
            {{-- {!! Breadcrumbs::render() !!} --}}

            <div class="container-fluid" style="padding-top: 30px">
                <div class="animated fadeIn">
                    <div class="content-header">
                        @yield('page-header')
                    </div>
                    <!--content-header-->

                    @include('includes.partials.messages')
                    @yield('content')
                </div>
                <!--animated-->
            </div>
            <!--container-fluid-->
        </main>
        <!--main-->

        {{-- @include('backend.includes.aside') --}}
    </div>
    <!--app-body--> 

    @include('backend.includes.footer')

    <!-- Scripts -->
    @stack('before-scripts')
    {!! script(mix('js/manifest.js')) !!}
    {!! script(mix('js/vendor.js')) !!}
    {!! script(mix('js/backend.js')) !!}
    <script>
        //Route for message notification
        var messageNotificationRoute = '{{ route('admin.messages.unread') }}'
    </script>
    <script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
    <script src="//cdn.datatables.net/buttons/1.2.4/js/buttons.flash.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="{{ asset('js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/vfs_fonts.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('vendor/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
    {{-- twilio phone international code --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    {{-- /////// --}}

    <script>
        tinymce.init({
            selector: '.editor',
            language: 'en',
            directionality: 'ltr',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            },
            plugins: "link image code table lists contextmenu",
            contextmenu: "paste | link ",
            menubar: true,
            a11y_advanced_options: true,
            relative_urls: false,
            image_dimensions: true,
            document_base_url: 'https://ucas.e-9.co',
            content_style: "@import  url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');",
            font_formats: "Tajawal=Tajawal,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black;  Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times",
            toolbar: 'code | bold italic | alignleft aligncenter alignright alignjustify link | table | styleselect | fontselect  forecolor  backcolor fontsizeselect  | image | outdent indent|numlist bullist',

            image_title: false,
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/user/upload-image');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
        });

        tinymce.init({
            selector: '.editor_ar',
            language: 'ar',
            directionality: 'rtl',
            setup: function(editor) {
                editor.on('change', function() {
                    editor.save();
                });
            },
            plugins: "link image code table lists  contextmenu",
            contextmenu: "paste | link ",
            menubar: true,
            a11y_advanced_options: true,
            relative_urls: false,
            image_dimensions: true,
            document_base_url: 'https://ucas.e-9.co',
            content_style: "@import  url('https://fonts.googleapis.com/css2?family=Tajawal:wght@200;300;400;500;700;800;900&display=swap');",
            font_formats: "Tajawal=Tajawal,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black;  Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica;Tahoma=tahoma,arial,helvetica,sans-serif;Times New Roman=times new roman,times",
            toolbar: 'code | bold italic | alignleft aligncenter alignright alignjustify link | table | styleselect | fontselect  forecolor  backcolor fontsizeselect  | image | outdent indent|numlist bullist',
            image_title: false,
            automatic_uploads: true,

            file_picker_types: 'image',
            /* and here's our custom image picker*/
            images_upload_handler: function(blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/user/upload-image');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            },
        });
    </script>

    <script src="{{ asset('js/select2.full.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/main.js') }}" type="text/javascript"></script>
    <script>
        window._token = '{{ csrf_token() }}';
    </script>

    @stack('after-scripts')

</body>

</html>
