@extends('frontend.layouts.app'.config('theme_layout'))

@push('after-styles')
    <style>
                
        @font-face {
        font-family: 'FontAwesome';
        src: url('{{ asset('ivory') }}/assets/fonts/fontawesome-webfont.eot?v=4.6.3');
        src: url('{{ asset('ivory') }}/assets/fonts/fontawesome-webfont.eot?#iefix&v=4.6.3') format('embedded-opentype'), url('{{ asset('ivory') }}/assets/fonts/fontawesome-webfont.woff2?v=4.6.3') format('woff2'), url('{{ asset('ivory') }}/assets/fonts/fontawesome-webfont.woff?v=4.6.3') format('woff'), url('{{ asset('ivory') }}/assets/fonts/fontawesome-webfont.ttf?v=4.6.3') format('truetype'), url('{{ asset('ivory') }}/assets/fonts/fontawesome-webfont.svg?v=4.6.3#fontawesomeregular') format('svg');
        font-weight: normal;
        font-style: normal;
        }  

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

        .bold_timeline_container_has_line_style .bold_timeline_container_line {
            border-color: #878787;
        }

        .bold_timeline_container_line_position_vertical.bold_timeline_container_line_style_solid.bold_timeline_container.bold_timeline_container_has_line_style .bold_timeline_container_line {
            border-left-style: solid;
        }

        .bold_timeline_container_line_position_center.bold_timeline_container.bold_timeline_container_has_line_style .bold_timeline_container_line {
            -webkit-transform: translateX(-50%);
            -moz-transform: translateX(-50%);
            -ms-transform: translateX(-50%);
            transform: translateX(-50%);
        }

        .bold_timeline_container_line_thickness_normal.bold_timeline_container.bold_timeline_container_has_line_style .bold_timeline_container_line {
            border-width: 2px;
        }

        .bold_timeline_container_line_position_center.bold_timeline_container.bold_timeline_container_has_line_style .bold_timeline_container_line {
            top: 0;
            bottom: 0;
            left: 50%;
            right: auto;
        }

        .bold_timeline_container.bold_timeline_container_has_line_style .bold_timeline_container_line {
            content: '';
            position: absolute;
            right: auto;
            border-color: ##3bcfcb;
        }

        body,
        .normal_font,
        .h6.normal_font,
        body.rtl.rtl-demo .stm_testimonials_wrapper_style_2 .stm_lms_testimonials_single__excerpt p,
        .stm_product_list_widget.widget_woo_stm_style_2 li a .meta .title {
            font-family: Cairo;
            color: #58595b;
            font-size: 15px;
        }

        body,
        .normal_font,
        .h6.normal_font,
        body.rtl.rtl-demo .stm_testimonials_wrapper_style_2 .stm_lms_testimonials_single__excerpt p,
        .stm_product_list_widget.widget_woo_stm_style_2 li a .meta .title {
            line-height: 24px;
            font-size: 16px !important;
        }

        .bold_timeline_container.bold_timeline_container_has_line_style {
            position: relative;
        }

        #content .wpb_alert p:last-child,
        #content .wpb_text_column :last-child,
        #content .wpb_text_column p:last-child,
        .wpb_alert p:last-child,
        .wpb_text_column :last-child,
        .wpb_text_column p:last-child {
            margin-bottom: 0;
        }

        .bold_timeline_item .bold_timeline_item_inner {
            background: #eeeeee;
        }

        .bold_timeline_container.bold_timeline_container_item_style_filled_header .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner,
        .bold_timeline_container .bold_timeline_item_override_style_filled_header.bold_timeline_item .bold_timeline_item_inner {
            border: none;
        }

        .bold_timeline_container_item_shape_square .bold_timeline_item_override_shape_inherit.bold_timeline_item .bold_timeline_item_inner,
        .bold_timeline_container .bold_timeline_item_override_shape_square.bold_timeline_item .bold_timeline_item_inner {
            border-radius: 0;
            overflow: visible;
        }

        .bold_timeline_item .bold_timeline_item_inner {
            z-index: 1;
        }

        #content .wpb_alert p:last-child,
        #content .wpb_text_column :last-child,
        #content .wpb_text_column p:last-child,
        .wpb_alert p:last-child,
        .wpb_text_column :last-child,
        .wpb_text_column p:last-child {
            margin-bottom: 0;
        }

        .bold_timeline_container_line_position_center .bold_timeline_group {
            text-align: center;
        }

        .bold_timeline_container_group_style_filled .bold_timeline_group_override_style_inherit.bold_timeline_group .bold_timeline_group_header,
        .bold_timeline_group_override_style_filled.bold_timeline_group .bold_timeline_group_header {
            background: #58595b;
        }

        .bold_timeline_container_group_shape_square .bold_timeline_group_override_shape_inherit.bold_timeline_group .bold_timeline_group_header,
        .bold_timeline_container .bold_timeline_group_override_shape_square.bold_timeline_group .bold_timeline_group_header {
            padding: .5em 1em;
            border-radius: 0;
            height: auto;
            width: auto;
            text-align: inherit;
        }

        .bold_timeline_container .bold_timeline_item.bold_timeline_animated,
        .bold_timeline_container .bold_timeline_animate .bold_timeline_group_header,
        .bold_timeline_container .bold_timeline_animate .bold_timeline_group_show_button {
            -webkit-transform: scale(1) translate3d(0, 0, 0);
            -moz-transform: scale(1) translate3d(0, 0, 0);
            -ms-transform: scale(1) translate3d(0, 0, 0);
            transform: scale(1) translate3d(0, 0, 0);
            opacity: 1;
        }

        .bold_timeline_container_line_position_center .bold_timeline_item:nth-child(even) {
            margin-left: -webkit-calc(50% + 2.5rem);
            margin-left: -moz-calc(50% + 2.5rem);
            margin-left: calc(50% + 2.5rem);
        }

        .bold_timeline_container .bold_timeline_item.bold_timeline_animate,
        .bold_timeline_container .bold_timeline_animate .bold_timeline_group_header,
        .bold_timeline_container .bold_timeline_animate .bold_timeline_group_show_button {
            -webkit-transition: transform 2000ms cubic-bezier(.190, 1, .220, 1), opacity 2000ms cubic-bezier(.190, 1, .220, 1);
            -moz-transition: transform 2000ms cubic-bezier(.190, 1, .220, 1), opacity 2000ms cubic-bezier(.190, 1, .220, 1);
            transition: transform 2000ms cubic-bezier(.190, 1, .220, 1), opacity 2000ms cubic-bezier(.190, 1, .220, 1);
        }

        .bold_timeline_container_line_position_vertical .bold_timeline_group .bold_timeline_group_header {
            margin-bottom: 3em;
        }

        .bold_timeline_group .bold_timeline_group_header {
            display: -ms-inline-flexbox;
            display: -webkit-inline-flex;
            display: inline-flex;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            background: white;
        }

        .bold_timeline_group .bold_timeline_group_header .bold_timeline_group_header_inner {
            -webkit-flex: 1;
            -ms-flex: 1;
            flex: 1;
        }

        .bold_timeline_container_group_title_size_normal .bold_timeline_group_override_title_size_inherit.bold_timeline_group .bold_timeline_group_header_title,
        .bold_timeline_container .bold_timeline_group_override_title_size_normal.bold_timeline_group .bold_timeline_group_header_title {
            font-size: 1.5em;
        }

        .bold_timeline_group .bold_timeline_group_header .bold_timeline_group_header_inner .bold_timeline_group_header_title {
            margin: 0;
            padding: 0;
            line-height: 1;
            color: inherit;
        }

        .bold_timeline_container.bold_timeline_container_item_connection_type_line .bold_timeline_item_override_connection_type_inherit.bold_timeline_item,
        .bold_timeline_container .bold_timeline_item_override_connection_type_line.bold_timeline_item {
            position: relative;
        }

        .bold_timeline_container .bold_timeline_item.bold_timeline_animated,
        .bold_timeline_container .bold_timeline_animate .bold_timeline_group_header,
        .bold_timeline_container .bold_timeline_animate .bold_timeline_group_show_button {
            -webkit-transform: scale(1) translate3d(0, 0, 0);
            -moz-transform: scale(1) translate3d(0, 0, 0);
            -ms-transform: scale(1) translate3d(0, 0, 0);
            transform: scale(1) translate3d(0, 0, 0);
            opacity: 1;
        }

        .bold_timeline_container .bold_timeline_item.bold_timeline_animate,
        .bold_timeline_container .bold_timeline_animate .bold_timeline_group_header,
        .bold_timeline_container .bold_timeline_animate .bold_timeline_group_show_button {
            -webkit-transition: transform 2000ms cubic-bezier(.190, 1, .220, 1), opacity 2000ms cubic-bezier(.190, 1, .220, 1);
            -moz-transition: transform 2000ms cubic-bezier(.190, 1, .220, 1), opacity 2000ms cubic-bezier(.190, 1, .220, 1);
            transition: transform 2000ms cubic-bezier(.190, 1, .220, 1), opacity 2000ms cubic-bezier(.190, 1, .220, 1);
        }

        .bold_timeline_container_item_alignment_center .bold_timeline_item_override_alignment_inherit.bold_timeline_item,
        .bold_timeline_container .bold_timeline_item_override_alignment_center.bold_timeline_item {
            text-align: center;
        }

        .bold_timeline_container_line_position_center .bold_timeline_item:nth-child(odd) {
            margin-right: -webkit-calc(50% + 2.5rem);
            margin-right: -moz-calc(50% + 2.5rem);
            margin-right: calc(50% + 2.5rem);
        }

        .bold_timeline_container_item_icon_style_outline .bold_timeline_item_override_icon_style_inherit.bold_timeline_item .bold_timeline_item_icon,
        .bold_timeline_item_override_icon_style_outline.bold_timeline_item .bold_timeline_item_icon {
            -webkit-box-shadow: 0 0 0 2px ##3bcfcb;
            box-shadow: 0 0 0 2px ##3bcfcb;
            color: ##3bcfcb;
        }

        .bold_timeline_container_line_position_center.bold_timeline_container_item_icon_position_line .bold_timeline_item_override_icon_position_inherit.bold_timeline_item:nth-child(odd) .bold_timeline_item_icon,
        .bold_timeline_container_line_position_center.bold_timeline_container .bold_timeline_item_override_icon_position_line.bold_timeline_item:nth-child(odd) .bold_timeline_item_icon {
            -webkit-transform: translateX(50%) translateY(-50%);
            -moz-transform: translateX(50%) translateY(-50%);
            -ms-transform: translateX(50%) translateY(-50%);
            transform: translateX(50%) translateY(-50%);
            right: -webkit-calc(-2.5rem);
            right: -moz-calc(-2.5rem);
            right: calc(-2.5rem);
            left: auto;
        }

        .bold_timeline_container_line_position_center.bold_timeline_container_item_icon_position_line .bold_timeline_item_override_icon_position_inherit.bold_timeline_item .bold_timeline_item_icon,
        .bold_timeline_container_line_position_center.bold_timeline_container .bold_timeline_item_override_icon_position_line.bold_timeline_item .bold_timeline_item_icon {
            top: -webkit-calc(2rem);
            top: -moz-calc(2rem);
            top: calc(2rem);
            left: -webkit-calc(-2.5rem);
            left: -moz-calc(-2.5rem);
            left: calc(-2.5rem);
            -webkit-transform: translateX(-50%) translateY(-50%);
            -moz-transform: translateX(-50%) translateY(-50%);
            -ms-transform: translateX(-50%) translateY(-50%);
            transform: translateX(-50%) translateY(-50%);
            right: auto;
        }

        .bold_timeline_container_item_icon_shape_hard_rounded .bold_timeline_item_override_icon_shape_inherit.bold_timeline_item .bold_timeline_item_icon,
        .bold_timeline_container .bold_timeline_item_override_icon_shape_hard_rounded.bold_timeline_item .bold_timeline_item_icon {
            border-radius: 50%;
        }

        .bold_timeline_item .bold_timeline_item_icon {
            position: absolute;
            z-index: 2;
            width: 2em;
            line-height: 2em;
            font-size: 1.5em;
            text-align: center;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
        }

        .bold_timeline_item .bold_timeline_item_icon:before {
            display: block;
        }

        [data-ico-fa]:before {
            font-family: "FontAwesome";
            content: attr(data-ico-fa);
        }

        .bold_timeline_container_group_style_filled .bold_timeline_group_override_style_inherit.bold_timeline_group .bold_timeline_group_header,
        .bold_timeline_group_override_style_filled.bold_timeline_group .bold_timeline_group_header {
            background: #58595b;
        }

        .bold_timeline_container_item_connection_type_line .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection,
        #id_60680075adb7d .bold_timeline_item_override_connection_type_line.bold_timeline_item .bold_timeline_item_connection {
            background: ##3bcfcb;
        }

        .bold_timeline_container_item_style_filled_header .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header,
        #id_60680075adb7d .bold_timeline_item_override_style_filled_header.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header {
            background: ##3bcfcb;
        }

        .bold_timeline_container.bold_timeline_container_item_style_filled_header .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_content,
        .bold_timeline_container .bold_timeline_item_override_style_filled_header.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_content {
            padding: 1em;
        }

        .bold_timeline_container.bold_timeline_container_item_style_filled_header .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header,
        .bold_timeline_container .bold_timeline_item_override_style_filled_header.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header {
            color: white;
            padding: 1em;
        }

        .bold_timeline_container.bold_timeline_container_item_content_display_show .bold_timeline_item_override_content_display_inherit.bold_timeline_item .bold_timeline_item_header,
        .bold_timeline_container .bold_timeline_item_override_content_display_show.bold_timeline_item .bold_timeline_item_header {
            cursor: initial;
        }

        .bold_timeline_container.bold_timeline_container_item_style_filled_header .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header *,
        .bold_timeline_container .bold_timeline_item_override_style_filled_header.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header * {
            position: relative;
            z-index: 1;
        }

        .bold_timeline_container.bold_timeline_container_item_title_size_normal .bold_timeline_item_override_title_size_inherit.bold_timeline_item .bold_timeline_item_header .bold_timeline_item_header_supertitle,
        .bold_timeline_container .bold_timeline_item_override_title_size_normal.bold_timeline_item .bold_timeline_item_header .bold_timeline_item_header_supertitle {
            font-size: .9em;
        }

        .bold_timeline_container.bold_timeline_container_item_title_size_normal .bold_timeline_item_override_title_size_inherit.bold_timeline_item .bold_timeline_item_header .bold_timeline_item_header_title,
        .bold_timeline_container .bold_timeline_item_override_title_size_normal.bold_timeline_item .bold_timeline_item_header .bold_timeline_item_header_title {
            font-size: 1.5em;
            margin: 0;
            padding: 0;
        }

        .bold_timeline_item_text_inner ul {
            text-align: right;
        }

        .bold_timeline_item_text_inner ol li,
        .bold_timeline_item_text_inner ul li {
            margin-bottom: 8px;
        }

        .bold_timeline_group_header_title {
            color: #fff !important;
        }

        .bold_timeline_item_icon {
            font-family: "FontAwesome" !important;
            content: attr(data-ico-fa);
            background: #fff;
        }

        .bold_timeline_container_item_icon_style_outline .bold_timeline_item_override_icon_style_inherit.bold_timeline_item .bold_timeline_item_icon,
        #id_60680075adb7d .bold_timeline_item_override_icon_style_outline.bold_timeline_item .bold_timeline_item_icon {
            -webkit-box-shadow: 0 0 0 2px ##3bcfcb;
            box-shadow: 0 0 0 2px ##3bcfcb;
            color: ##3bcfcb;
        }
        .bold_timeline_container_item_connection_type_line .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection, #id_60680075adb7d .bold_timeline_item_override_connection_type_line.bold_timeline_item .bold_timeline_item_connection {
            background: #3bcfcb!important;
        }
        .bold_timeline_container_line_position_vertical.bold_timeline_container_item_connection_type_line:not(.bold_timeline_container_item_style_outline_top).bold_timeline_container_item_frame_thickness_normal .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item.bold_timeline_item_override_connection_type_inherit:not(.bold_timeline_item_override_style_outline_top) .bold_timeline_item_connection, .bold_timeline_container_line_position_vertical.bold_timeline_container_item_connection_type_line:not(.bold_timeline_container_item_style_outline_top).bold_timeline_container .bold_timeline_item_override_frame_thickness_normal.bold_timeline_item.bold_timeline_item_override_connection_type_inherit:not(.bold_timeline_item_override_style_outline_top) .bold_timeline_item_connection {
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
        .bold_timeline_container_line_position_center.bold_timeline_container.bold_timeline_container_item_connection_type_line .bold_timeline_item_override_connection_type_inherit.bold_timeline_item:nth-child(odd) .bold_timeline_item_connection, .bold_timeline_container_line_position_center.bold_timeline_container .bold_timeline_item_override_connection_type_line.bold_timeline_item:nth-child(odd) .bold_timeline_item_connection {
            right: -webkit-calc(-2.5rem);
            right: -moz-calc(-2.5rem);
            right: calc(-2.5rem);
            left: 100%;
        }
        .bold_timeline_container_line_position_center.bold_timeline_container.bold_timeline_container_item_connection_type_line .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection, .bold_timeline_container_line_position_center.bold_timeline_container .bold_timeline_item_override_connection_type_line.bold_timeline_item .bold_timeline_item_connection {
            top: 2rem;
            -webkit-transform: translateY(-50%);
            -moz-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
            left: -2.5rem;
            right: 100%;
        }
        .bold_timeline_container_line_position_vertical.bold_timeline_container_item_frame_thickness_normal .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item .bold_timeline_item_connection, .bold_timeline_container_line_position_vertical.bold_timeline_container .bold_timeline_item_override_frame_thickness_normal.bold_timeline_item .bold_timeline_item_connection {
            height: 2px;
        }
        .bold_timeline_container.bold_timeline_container_item_connection_type_line .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection, .bold_timeline_container .bold_timeline_item_override_connection_type_line.bold_timeline_item .bold_timeline_item_connection {
            content: ' ';
            position: absolute;
            display: block;
            background: #eeeeee;
        }
        .bold_timeline_item .bold_timeline_item_connection {
            display: none;
            -webkit-backface-visibility: hidden;
            -moz-backface-visibility: hidden;
            backface-visibility: hidden;
        }
    </style>
@endpush

@section('content')



    <!--  Slide  -->

    <section class="slide" style="background-image: url({{ asset('ivory') }}/assets/img/slider/8.jpg);">
        <div class="slide-overlay">
            <div class="slide-content">
                <h1>WHY IVORY?</h1>
            </div>
        </div>
    </section>

    <!--  Slide  -->


    <!--  Services About  -->

    <section class="services-about services-why">
        <div class="services-about-overlay">
            <div class="container-about">
                <div class="services-about-conetnt">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="service about-why">
                                <div class="service-front">
                                    <div class="front-content">
                                        <div class="icon">
                                            <i class="far fa-edit"></i>
                                        </div>
                                        <div class="title-icon">
                                            Professionalism
                                        </div>
                                    </div>
                                </div>
                                <div class="service-back">
                                    <div class="back-content">
                                        <p>
                                            IVORY aims achieve a high level of excellence in its training programs within
                                            accurate and specific work mechanisms, according to priorities that show a deep
                                            understanding of customer expectations and act accordingly
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="service about-why">
                                <div class="service-front">
                                    <div class="front-content">
                                        <div class="icon">
                                            <i class="fas fa-suitcase"></i>
                                        </div>
                                        <div class="title-icon">
                                            Credibility and Commitment
                                        </div>
                                    </div>
                                </div>
                                <div class="service-back">
                                    <div class="back-content">
                                        <p>
                                            IVORY aims achieve a high level of excellence in its training programs within
                                            accurate and specific work mechanisms, according to priorities that show a deep
                                            understanding of customer expectations and act accordingly
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="service about-why">
                                <div class="service-front">
                                    <div class="front-content">
                                        <div class="icon">
                                            <i class="fas fa-cubes"></i>
                                        </div>
                                        <div class="title-icon">
                                            Entrepreneurship and Innovation
                                        </div>
                                    </div>
                                </div>
                                <div class="service-back">
                                    <div class="back-content">
                                        <p>
                                            IVORY aims achieve a high level of excellence in its training programs within
                                            accurate and specific work mechanisms, according to priorities that show a deep
                                            understanding of customer expectations and act accordingly
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="service about-why">
                                <div class="service-front">
                                    <div class="front-content">
                                        <div class="icon">
                                            <i class="far fa-thumbs-up"></i>
                                        </div>
                                        <div class="title-icon">
                                            Quality and Efficiency
                                        </div>
                                    </div>
                                </div>
                                <div class="service-back">
                                    <div class="back-content">
                                        <p>
                                            IVORY aims achieve a high level of excellence in its training programs within
                                            accurate and specific work mechanisms, according to priorities that show a deep
                                            understanding of customer expectations and act accordingly
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--  Services About  -->


    <!--  Slide  -->

    <section class="slide" style="background-image: url({{ asset('ivory') }}/assets/img/slider/9.jpg);height: 255px;">
        <div class="slide-overlay">
            <div class="slide-content">
                <h1 style="font-size: 45px;">CHANGE IS INEVITABLE. WE ANTICIPATE IT.</h1>
            </div>
        </div>
    </section>

    <!--  Slide  -->


    <!--  Services About  -->

    <section class="services-about services-why">
        <div class="services-about-overlay">
            <div class="container-about">
                <div class="services-about-conetnt">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="service">
                                <div class="service-front">
                                    <div class="front-content">
                                        <div class="icon">
                                            <i class="fas fa-globe-americas"></i>
                                        </div>
                                        <div class="title-icon">
                                            Professionalism
                                        </div>
                                    </div>
                                </div>
                                <div class="service-back">
                                    <div class="back-content">
                                        <p>
                                            IVORY aims achieve a high level of excellence in its training programs within
                                            accurate and specific work mechanisms, according to priorities that show a deep
                                            understanding of customer expectations and act accordingly
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="service">
                                <div class="service-front">
                                    <div class="front-content">
                                        <div class="icon">
                                            <i class="fas fa-graduation-cap"></i>
                                        </div>
                                        <div class="title-icon">
                                            Credibility and Commitment
                                        </div>
                                    </div>
                                </div>
                                <div class="service-back">
                                    <div class="back-content">
                                        <p>
                                            IVORY aims achieve a high level of excellence in its training programs within
                                            accurate and specific work mechanisms, according to priorities that show a deep
                                            understanding of customer expectations and act accordingly
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="service">
                                <div class="service-front">
                                    <div class="front-content">
                                        <div class="icon">
                                            <i class="far fa-check-square"></i>
                                        </div>
                                        <div class="title-icon">
                                            Entrepreneurship and Innovation
                                        </div>
                                    </div>
                                </div>
                                <div class="service-back">
                                    <div class="back-content">
                                        <p>
                                            IVORY aims achieve a high level of excellence in its training programs within
                                            accurate and specific work mechanisms, according to priorities that show a deep
                                            understanding of customer expectations and act accordingly
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="service">
                                <div class="service-front">
                                    <div class="front-content">
                                        <div class="icon">
                                            <i class="fas fa-university"></i>
                                        </div>
                                        <div class="title-icon">
                                            Quality and Efficiency
                                        </div>
                                    </div>
                                </div>
                                <div class="service-back">
                                    <div class="back-content">
                                        <p>
                                            IVORY aims achieve a high level of excellence in its training programs within
                                            accurate and specific work mechanisms, according to priorities that show a deep
                                            understanding of customer expectations and act accordingly
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="services-about services-why">
        <div class="services-about-overlay">
            <div class="container-about">
                <div class="services-about-conetnt">
                    <div class="row">

                        <div class="vc_row wpb_row vc_row-fluid">
                            <div class="wpb_column vc_column_container vc_col-sm-12">
                                <div class="vc_column-inner">
                                    <div class="wpb_wrapper">
                                        <div class="wpb_text_column wpb_content_element ">
                                            <div class="wpb_wrapper">
                                                <div class="bold_timeline_container bold_timeline_container_line_style_solid bold_timeline_container_has_line_style bold_timeline_container_line_thickness_normal bold_timeline_container_item_style_filled_header bold_timeline_container_line_position_vertical bold_timeline_container_line_position_overlap bold_timeline_container_line_position_center bold_timeline_container_item_frame_thickness_normal bold_timeline_container_item_shape_square bold_timeline_container_item_icon_position_line bold_timeline_container_item_icon_shape_hard_rounded bold_timeline_container_item_icon_style_outline bold_timeline_container_item_connection_type_line bold_timeline_container_item_content_display_show bold_timeline_container_item_marker_type_dot bold_timeline_container_item_title_size_normal bold_timeline_container_item_supertitle_style_inherit bold_timeline_container_item_alignment_default bold_timeline_container_item_media_position_top bold_timeline_container_item_images_columns_2 bold_timeline_container_group_style_filled bold_timeline_container_group_shape_soft_rounded bold_timeline_container_group_thickness_thin bold_timeline_container_group_content_display_show bold_timeline_container_button_style_filled bold_timeline_container_button_shape_soft_rounded bold_timeline_container_button_size_small bold_timeline_container_group_title_size_small"
                                                    id="id_6067fd8799299"
                                                    data-css-override=".bold_timeline_container.bold_timeline_container_has_line_style .bold_timeline_container_line{ border-color: #878787;}}.bold_timeline_container.bold_timeline_container_group_style_outline .bold_timeline_group_override_style_inherit.bold_timeline_group .bold_timeline_group_header, .bold_timeline_container .bold_timeline_group_override_style_outline.bold_timeline_group .bold_timeline_group_header{ border-color: #58595b;}.bold_timeline_container.bold_timeline_container_group_style_filled .bold_timeline_group_override_style_inherit.bold_timeline_group .bold_timeline_group_header, .bold_timeline_container .bold_timeline_group_override_style_filled.bold_timeline_group .bold_timeline_group_header{ background: #58595b;}.bold_timeline_container.bold_timeline_container_group_style_shadow .bold_timeline_group_override_style_inherit.bold_timeline_group .bold_timeline_group_header, .bold_timeline_container .bold_timeline_group_override_style_shadow.bold_timeline_group .bold_timeline_group_header{ color: #58595b;}.bold_timeline_container_group_show_button_style_outline .bold_timeline_group_override_show_button_style_inherit.bold_timeline_group .bold_timeline_group_show_button .bold_timeline_group_show_button_inner, .bold_timeline_container .bold_timeline_group_override_show_button_style_outline.bold_timeline_group .bold_timeline_group_show_button .bold_timeline_group_show_button_inner{border: 2px solid #008ed4;}.bold_timeline_container_group_show_button_style_filled .bold_timeline_group_override_show_button_style_inherit.bold_timeline_group .bold_timeline_group_show_button .bold_timeline_group_show_button_inner, .bold_timeline_container .bold_timeline_group_override_show_button_style_filled.bold_timeline_group .bold_timeline_group_show_button .bold_timeline_group_show_button_inner{background: #008ed4;}.bold_timeline_container .bold_timeline_item .bold_timeline_item_inner{background: #eeeeee;}.bold_timeline_container.bold_timeline_container_item_style_outline .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner, .bold_timeline_container .bold_timeline_item_override_style_outline.bold_timeline_item .bold_timeline_item_inner{ border-color: ##3bcfcb;}.bold_timeline_container.bold_timeline_container_item_style_outline_full .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner, .bold_timeline_container .bold_timeline_item_override_style_outline_full.bold_timeline_item .bold_timeline_item_inner{ border-color: ##3bcfcb;}.bold_timeline_container.bold_timeline_container_item_style_outline_full .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header, .bold_timeline_container .bold_timeline_item_override_style_outline_full.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header{ border-bottom-color: ##3bcfcb;}.bold_timeline_container.bold_timeline_container_item_style_outline_top .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner, .bold_timeline_container .bold_timeline_item_override_style_outline_top.bold_timeline_item .bold_timeline_item_inner{ border-top-color: ##3bcfcb;}.bold_timeline_container.bold_timeline_container_item_style_filled_header .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header, .bold_timeline_container .bold_timeline_item_override_style_filled_header.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header{background: ##3bcfcb;}.bold_timeline_container.bold_timeline_container_item_style_filled_header_outline .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner, .bold_timeline_container .bold_timeline_item_override_style_filled_header_outline.bold_timeline_item .bold_timeline_item_inner{ border-color: ##3bcfcb;}.bold_timeline_container.bold_timeline_container_item_style_filled_header_outline .bold_timeline_item_override_style_inherit.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header, .bold_timeline_container .bold_timeline_item_override_style_filled_header_outline.bold_timeline_item .bold_timeline_item_inner .bold_timeline_item_header{background: ##3bcfcb;}.bold_timeline_container.bold_timeline_container_item_marker_type_dot .bold_timeline_item_override_marker_type_inherit.bold_timeline_item .bold_timeline_item_marker, .bold_timeline_container .bold_timeline_item_override_marker_type_dot.bold_timeline_item .bold_timeline_item_marker{ background: #58595b;}.bold_timeline_container.bold_timeline_container_item_marker_type_circle .bold_timeline_item_override_marker_type_inherit.bold_timeline_item .bold_timeline_item_marker, .bold_timeline_container .bold_timeline_item_override_marker_type_circle.bold_timeline_item .bold_timeline_item_marker{ border-color: #58595b;}.bold_timeline_container.bold_timeline_container_item_marker_type_circle_small .bold_timeline_item_override_marker_type_inherit.bold_timeline_item .bold_timeline_item_marker, .bold_timeline_container .bold_timeline_item_override_marker_type_circle_small.bold_timeline_item .bold_timeline_item_marker{ border-color: #58595b;}.bold_timeline_container.bold_timeline_container_item_connection_type_line .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection, .bold_timeline_container .bold_timeline_item_override_connection_type_line.bold_timeline_item .bold_timeline_item_connection{ background: ##3bcfcb;}.bold_timeline_container_line_position_left.bold_timeline_container.bold_timeline_container_item_connection_type_triangle .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection, .bold_timeline_container_line_position_left.bold_timeline_container .bold_timeline_item_override_connection_type_triangle.bold_timeline_item .bold_timeline_item_connection{ border-right-color: ##3bcfcb;}.bold_timeline_container_line_position_right.bold_timeline_container.bold_timeline_container_item_connection_type_triangle .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection, .bold_timeline_container_line_position_right.bold_timeline_container .bold_timeline_item_override_connection_type_triangle.bold_timeline_item .bold_timeline_item_connection{ border-left-color: ##3bcfcb;}.bold_timeline_container_line_position_top.bold_timeline_container.bold_timeline_container_item_connection_type_triangle .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection, .bold_timeline_container_line_position_top.bold_timeline_container .bold_timeline_item_override_connection_type_triangle.bold_timeline_item .bold_timeline_item_connection{ border-right-color: ##3bcfcb;}.bold_timeline_container_line_position_bottom.bold_timeline_container.bold_timeline_container_item_connection_type_triangle .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection, .bold_timeline_container_line_position_bottom.bold_timeline_container .bold_timeline_item_override_connection_type_triangle.bold_timeline_item .bold_timeline_item_connection{ border-right-color: ##3bcfcb;}.bold_timeline_container_line_position_center.bold_timeline_container.bold_timeline_container_item_connection_type_triangle .bold_timeline_item_override_connection_type_inherit.bold_timeline_item .bold_timeline_item_connection, .bold_timeline_container_line_position_center.bold_timeline_container .bold_timeline_item_override_connection_type_triangle.bold_timeline_item .bold_timeline_item_connection{border-right-color: ##3bcfcb; border-left-color: ##3bcfcb;}.bold_timeline_container_item_icon_style_outline.bold_timeline_container.bold_timeline_container_item_frame_thickness_thin .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item .bold_timeline_item_icon, .bold_timeline_container.bold_timeline_container_item_frame_thickness_thin .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon, .bold_timeline_container_item_icon_style_outline.bold_timeline_container .bold_timeline_item_override_frame_thickness_thin.bold_timeline_item .bold_timeline_item_icon, .bold_timeline_container .bold_timeline_item_override_frame_thickness_thin.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon{-webkit-box-shadow: 0 0 0 1px ##3bcfcb; box-shadow: 0 0 0 1px ##3bcfcb;}.bold_timeline_container_item_icon_style_outline.bold_timeline_container_item_frame_thickness_normal .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item .bold_timeline_item_icon, .bold_timeline_container_item_frame_thickness_normal .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon, .bold_timeline_container_item_icon_style_outline.bold_timeline_container .bold_timeline_item_override_frame_thickness_normal.bold_timeline_item .bold_timeline_item_icon, .bold_timeline_container .bold_timeline_item_override_frame_thickness_normal.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon{-webkit-box-shadow: 0 0 0 2px ##3bcfcb; box-shadow: 0 0 0 2px ##3bcfcb;}.bold_timeline_container_item_icon_style_outline.bold_timeline_container.bold_timeline_container_item_frame_thickness_thick .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item .bold_timeline_item_icon, .bold_timeline_container.bold_timeline_container_item_frame_thickness_thick .bold_timeline_item_override_frame_thickness_inherit.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon, .bold_timeline_container_item_icon_style_outline.bold_timeline_container .bold_timeline_item_override_frame_thickness_thick.bold_timeline_item .bold_timeline_item_icon, .bold_timeline_container .bold_timeline_item_override_frame_thickness_thick.bold_timeline_item.bold_timeline_container_item_override_icon_style_outline .bold_timeline_item_icon{-webkit-box-shadow: 0 0 0 4px ##3bcfcb; box-shadow: 0 0 0 4px ##3bcfcb;}.bold_timeline_container.bold_timeline_container_item_icon_style_filled .bold_timeline_item_override_icon_style_inherit.bold_timeline_item .bold_timeline_item_icon, .bold_timeline_container .bold_timeline_item_override_icon_style_filled.bold_timeline_item .bold_timeline_item_icon{background: ##3bcfcb;}.bold_timeline_container.bold_timeline_container_item_icon_style_outline .bold_timeline_item_override_icon_style_inherit.bold_timeline_item .bold_timeline_item_icon, .bold_timeline_container .bold_timeline_item_override_icon_style_outline.bold_timeline_item .bold_timeline_item_icon{ -webkit-box-shadow: 0 0 0 2px ##3bcfcb; box-shadow: 0 0 0 2px ##3bcfcb; color: ##3bcfcb;}.bold_timeline_container.bold_timeline_container_item_icon_style_shadow .bold_timeline_item_override_icon_style_inherit.bold_timeline_item .bold_timeline_item_icon, .bold_timeline_container .bold_timeline_item_override_icon_style_shadow.bold_timeline_item .bold_timeline_item_icon{ color: ##3bcfcb;}.bold_timeline_container .bold_timeline_slick_dots{ color: ##3bcfcb;}.bold_timeline_container_slider_arrows_style_filled.bold_timeline_container button.bold_timeline_slick_arrow{ background: ##3bcfcb;}.bold_timeline_container_slider_arrows_style_filled.bold_timeline_container button.bold_timeline_slick_arrow.slick-disabled:hover{ background: ##3bcfcb;}.bold_timeline_container_slider_arrows_style_outline.bold_timeline_container button.bold_timeline_slick_arrow{ border-color: ##3bcfcb; color: ##3bcfcb;}.bold_timeline_container_slider_arrows_style_outline.bold_timeline_container button.bold_timeline_slick_arrow:hover{border-color: #878787; color: #878787;}.bold_timeline_container_slider_arrows_style_shadow.bold_timeline_container button.bold_timeline_slick_arrow{ color: ##3bcfcb;}.bold_timeline_container_slider_arrows_style_shadow.bold_timeline_container button.bold_timeline_slick_arrow:hover{border-color: #878787;}.bold_timeline_container.bold_timeline_container_button_style_filled .bold_timeline_item_button_style_inherit.bold_timeline_item_button .bold_timeline_item_button_inner, .bold_timeline_container .bold_timeline_item_button_style_filled.bold_timeline_item_button .bold_timeline_item_button_inner{background: #58595b;}.bold_timeline_container.bold_timeline_container_button_style_outline .bold_timeline_item_button_style_inherit.bold_timeline_item_button .bold_timeline_item_button_inner, .bold_timeline_container .bold_timeline_item_button_style_outline.bold_timeline_item_button .bold_timeline_item_button_inner{ border-color: #58595b; color: #58595b;}.bold_timeline_container.bold_timeline_container_button_style_shadow .bold_timeline_item_button_style_inherit.bold_timeline_item_button .bold_timeline_item_button_inner, .bold_timeline_container .bold_timeline_item_button_style_shadow.bold_timeline_item_button .bold_timeline_item_button_inner{ color: #58595b;}">
                                                    <div class="bold_timeline_container_line"
                                                        style="bottom: 578.6px; top: 40px;"></div>
                                                    <div class="bold_timeline_container_content">
                                                        <div class="bold_timeline_group bold_timeline_group_override_style_inherit bold_timeline_group_override_thickness_inherit bold_timeline_group_override_shape_square bold_timeline_group_override_content_display_inherit bold_timeline_group_override_title_size_normal bold_timeline_animate"
                                                            id="id_6067fa8584356" data-css-override="">
                                                            <div class="bold_timeline_group_inner">
                                                                <div class="bold_timeline_group_header">
                                                                    <div class="bold_timeline_group_header_inner">
                                                                        <h2 class="bold_timeline_group_header_title">منهجية
                                                                            التدريب</h2>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="bold_timeline_group_content">
                                                                <div class="bold_timeline_item bold_timeline_item_override_style_inherit bold_timeline_item_override_shape_inherit bold_timeline_item_override_frame_thickness_inherit bold_timeline_item_override_connection_type_inherit bold_timeline_item_override_content_display_inherit bold_timeline_item_override_animation_inherit bold_timeline_animate bold_timeline_item_override_marker_type_inherit bold_timeline_item_override_icon_position_inherit bold_timeline_item_override_icon_style_inherit bold_timeline_item_override_icon_shape_inherit bold_timeline_item_override_media_position_left bold_timeline_item_override_title_size_inherit bold_timeline_item_override_supertitle_style_inherit bold_timeline_item_override_alignment_center bold_timeline_item_has_icon bold_timeline_item_override_images_columns_1"
                                                                    id="id_6067fa85845cd" data-css-override=""
                                                                    data-margin-top="0">
                                                                    <div class="bold_timeline_item_icon"  data-ico-fa="&#xf002;"></div>
                                                                    <div class="bold_timeline_item_marker"></div>
                                                                    <div class="bold_timeline_item_connection"></div>
                                                                    <div class="bold_timeline_item_inner">
                                                                        <div class="bold_timeline_item_header">
                                                                            <div class="bold_timeline_item_header_inner">
                                                                                <p
                                                                                    class="bold_timeline_item_header_supertitle">
                                                                                    <span
                                                                                        class="bold_timeline_item_header_supertitle_inner">الخطوة
                                                                                        1</span>
                                                                                </p>
                                                                                <h2 class="bold_timeline_item_header_title">
                                                                                    تحديد الاحتياجات التدريبية بشكل دقيق
                                                                                    بالاعتماد على </h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="bold_timeline_item_content">
                                                                            <div class="bold_timeline_item_content_inner">
                                                                                <div class="bold_timeline_item_text"
                                                                                    id="id_6067fa8584703">
                                                                                    <div
                                                                                        class="bold_timeline_item_text_inner">
                                                                                        <p><img class="aligncenter size-full wp-image-4259"
                                                                                                src="https://beta.ivorytraining.net/wp-content/uploads/2020/05/Untitled-2_0000s_0003_business-communication-connection-people-concept-PZ28RMT.jpg"
                                                                                                alt="" width="500"
                                                                                                height="200" /></p>
                                                                                        <ul>
                                                                                            <li>الهدف العام للبرنامج
                                                                                                التدريبي وفق رؤية الشركة
                                                                                            </li>
                                                                                            <li>اختبارات واستبيانات قبل
                                                                                                التنفيذ</li>
                                                                                        </ul>
                                                                                        <p><strong>* أسبوع قبل بداية
                                                                                                البرنامج</strong></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="bold_timeline_item bold_timeline_item_override_style_inherit bold_timeline_item_override_shape_inherit bold_timeline_item_override_frame_thickness_inherit bold_timeline_item_override_connection_type_inherit bold_timeline_item_override_content_display_inherit bold_timeline_item_override_animation_inherit bold_timeline_animate bold_timeline_item_override_marker_type_inherit bold_timeline_item_override_icon_position_inherit bold_timeline_item_override_icon_style_inherit bold_timeline_item_override_icon_shape_inherit bold_timeline_item_override_media_position_left bold_timeline_item_override_title_size_inherit bold_timeline_item_override_supertitle_style_inherit bold_timeline_item_override_alignment_center bold_timeline_item_has_icon bold_timeline_item_override_images_columns_1"
                                                                    id="id_6067fa858490a" data-css-override=""
                                                                    data-margin-top="0">
                                                                    <div class="bold_timeline_item_icon"
                                                                        data-ico-fa="&#xf085;"></div>
                                                                    <div class="bold_timeline_item_marker"></div>
                                                                    <div class="bold_timeline_item_connection"></div>
                                                                    <div class="bold_timeline_item_inner">
                                                                        <div class="bold_timeline_item_header">
                                                                            <div class="bold_timeline_item_header_inner">
                                                                                <p
                                                                                    class="bold_timeline_item_header_supertitle">
                                                                                    <span
                                                                                        class="bold_timeline_item_header_supertitle_inner">الخطوة
                                                                                        2</span>
                                                                                </p>
                                                                                <h2 class="bold_timeline_item_header_title">
                                                                                    الاستعداد لتنفيذ البرنامج من خلال </h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="bold_timeline_item_content">
                                                                            <div class="bold_timeline_item_content_inner">
                                                                                <div class="bold_timeline_item_text"
                                                                                    id="id_6067fa85849bb">
                                                                                    <div
                                                                                        class="bold_timeline_item_text_inner">
                                                                                        <p><img class="aligncenter size-full wp-image-4265"
                                                                                                src="https://beta.ivorytraining.net/wp-content/uploads/2020/05/Untitled-2_0000s_0002_group-of-young-multicultural-co-workers-getting-re-4LCFKBH.jpg"
                                                                                                alt="" width="500"
                                                                                                height="200" /></p>
                                                                                        <ul>
                                                                                            <li>مواءمة المحتوى التدريبي
                                                                                                للبرنامج مع الاحتياجات
                                                                                                المطلوبة</li>
                                                                                            <li>تحديد 70 % من وقت التنفيذ
                                                                                                للجانب التطبيقي العملي و 30%
                                                                                                للجانب النظري</li>
                                                                                            <li>استخدام تقنيات التدريب
                                                                                                الحديثة حسب المتطلب التدريبي
                                                                                            </li>
                                                                                            <li>تحديد الجدول الزمني للبرنامج
                                                                                                التدريبي</li>
                                                                                            <li>التعرف على البرنامج التدريبي
                                                                                                من خلال ارسال مقال تخصصي
                                                                                                مختصر يسلط الضوء على مكونات
                                                                                                ومفردات البرنامج التدريبي
                                                                                            </li>
                                                                                            <li>استعراض التوقعات قبل بداية
                                                                                                البرنامج من قبل المدرب</li>
                                                                                        </ul>
                                                                                        <p style="padding-left: 40px;">
                                                                                            <strong>* أسبوع قبل بداية
                                                                                                البرنامج</strong>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="bold_timeline_item bold_timeline_item_override_style_inherit bold_timeline_item_override_shape_inherit bold_timeline_item_override_frame_thickness_inherit bold_timeline_item_override_connection_type_inherit bold_timeline_item_override_content_display_inherit bold_timeline_item_override_animation_inherit bold_timeline_animate bold_timeline_item_override_marker_type_inherit bold_timeline_item_override_icon_position_inherit bold_timeline_item_override_icon_style_inherit bold_timeline_item_override_icon_shape_inherit bold_timeline_item_override_media_position_left bold_timeline_item_override_title_size_inherit bold_timeline_item_override_supertitle_style_inherit bold_timeline_item_override_alignment_center bold_timeline_item_has_icon bold_timeline_item_override_images_columns_1"
                                                                    id="id_6067fa8584ba6" data-css-override=""
                                                                    data-margin-top="0">
                                                                    <div class="bold_timeline_item_icon"
                                                                        data-ico-fa="&#xf044;"></div>
                                                                    <div class="bold_timeline_item_marker"></div>
                                                                    <div class="bold_timeline_item_connection"></div>
                                                                    <div class="bold_timeline_item_inner">
                                                                        <div class="bold_timeline_item_header">
                                                                            <div class="bold_timeline_item_header_inner">
                                                                                <p
                                                                                    class="bold_timeline_item_header_supertitle">
                                                                                    <span
                                                                                        class="bold_timeline_item_header_supertitle_inner">الخطوة
                                                                                        3</span>
                                                                                </p>
                                                                                <h2 class="bold_timeline_item_header_title">
                                                                                    تنفيذ البرنامج التدريبي </h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="bold_timeline_item_content">
                                                                            <div class="bold_timeline_item_content_inner">
                                                                                <div class="bold_timeline_item_text"
                                                                                    id="id_6067fa8584c54">
                                                                                    <div
                                                                                        class="bold_timeline_item_text_inner">
                                                                                        <p><img class="aligncenter size-full wp-image-4261"
                                                                                                src="https://beta.ivorytraining.net/wp-content/uploads/2020/05/Untitled-2_0000s_0000_meeting-of-the-colleagues-a-team-sitting-at-the-ta-HX6FYZM.jpg"
                                                                                                alt="" width="500"
                                                                                                height="200" /></p>
                                                                                        <ul>
                                                                                            <li>المتابعة خطوة بخطوة مع مراحل
                                                                                                التنفيذ</li>
                                                                                            <li>التأكد من حسن سير عملية
                                                                                                التنفيذ واستخدام الأساليب
                                                                                                التدريبية الملائمة للمشاركين
                                                                                            </li>
                                                                                            <li>متابعة مدى رضا المشاركين
                                                                                            </li>
                                                                                            <li>قياس الفجوة بين ما قبل وما
                                                                                                بعد التدريب من خلال
                                                                                                الاستبيانات والاختبارات
                                                                                                المعرفية و المهارية</li>
                                                                                        </ul>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="bold_timeline_item bold_timeline_item_override_style_inherit bold_timeline_item_override_shape_inherit bold_timeline_item_override_frame_thickness_inherit bold_timeline_item_override_connection_type_inherit bold_timeline_item_override_content_display_inherit bold_timeline_item_override_animation_inherit bold_timeline_animate bold_timeline_item_override_marker_type_inherit bold_timeline_item_override_icon_position_inherit bold_timeline_item_override_icon_style_inherit bold_timeline_item_override_icon_shape_inherit bold_timeline_item_override_media_position_left bold_timeline_item_override_title_size_inherit bold_timeline_item_override_supertitle_style_inherit bold_timeline_item_override_alignment_center bold_timeline_item_has_icon bold_timeline_item_override_images_columns_1"
                                                                    id="id_6067fa8584e1f" data-css-override=""
                                                                    data-margin-top="0">
                                                                    <div class="bold_timeline_item_icon"
                                                                        data-ico-fa="&#xf080;"></div>
                                                                    <div class="bold_timeline_item_marker"></div>
                                                                    <div class="bold_timeline_item_connection"></div>
                                                                    <div class="bold_timeline_item_inner">
                                                                        <div class="bold_timeline_item_header">
                                                                            <div class="bold_timeline_item_header_inner">
                                                                                <p
                                                                                    class="bold_timeline_item_header_supertitle">
                                                                                    <span
                                                                                        class="bold_timeline_item_header_supertitle_inner">الخطوة
                                                                                        4 أ</span>
                                                                                </p>
                                                                                <h2 class="bold_timeline_item_header_title">
                                                                                    تقييم أثر التدريب بعد نهاية كل برنامج
                                                                                </h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="bold_timeline_item_content">
                                                                            <div class="bold_timeline_item_content_inner">
                                                                                <div class="bold_timeline_item_text"
                                                                                    id="id_6067fa8584ebf">
                                                                                    <div
                                                                                        class="bold_timeline_item_text_inner">
                                                                                        <p><img class="aligncenter size-full wp-image-4263"
                                                                                                src="https://beta.ivorytraining.net/wp-content/uploads/2020/05/Untitled-2_0000s_0001_excellent-customer-satisfaction-feedback-9MBJV4A.jpg"
                                                                                                alt="" width="500"
                                                                                                height="200" /></p>
                                                                                        <ul>
                                                                                            <li>تمرين تفاعلي يسلم للمشاركين
                                                                                                للتطبيق العملي</li>
                                                                                            <li>عمل لقاء أون لاين من خلال
                                                                                                قاعة تمهير الالكترونية لمدة
                                                                                                ساعتين لاستعراض التطبيقات
                                                                                                بشكل مباشر من قبل المشاركين
                                                                                                وتبادل الخبرات والتوصيات من
                                                                                                قبل المدرب</li>
                                                                                        </ul>
                                                                                        <p style="padding-left: 40px;">
                                                                                            <strong>*أيّام بعد انتهاء
                                                                                                البرنامج</strong>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="bold_timeline_item bold_timeline_item_override_style_inherit bold_timeline_item_override_shape_inherit bold_timeline_item_override_frame_thickness_inherit bold_timeline_item_override_connection_type_inherit bold_timeline_item_override_content_display_inherit bold_timeline_item_override_animation_inherit bold_timeline_animate bold_timeline_item_override_marker_type_inherit bold_timeline_item_override_icon_position_inherit bold_timeline_item_override_icon_style_inherit bold_timeline_item_override_icon_shape_inherit bold_timeline_item_override_media_position_left bold_timeline_item_override_title_size_inherit bold_timeline_item_override_supertitle_style_inherit bold_timeline_item_override_alignment_center bold_timeline_item_has_icon bold_timeline_item_override_images_columns_1"
                                                                    id="id_6067fa8585070" data-css-override=""
                                                                    data-margin-top="0">
                                                                    <div class="bold_timeline_item_icon"
                                                                        data-ico-fa="&#xf080;"></div>
                                                                    <div class="bold_timeline_item_marker"></div>
                                                                    <div class="bold_timeline_item_connection"></div>
                                                                    <div class="bold_timeline_item_inner">
                                                                        <div class="bold_timeline_item_header">
                                                                            <div class="bold_timeline_item_header_inner">
                                                                                <p
                                                                                    class="bold_timeline_item_header_supertitle">
                                                                                    <span
                                                                                        class="bold_timeline_item_header_supertitle_inner">الخطوة
                                                                                        4 ب</span>
                                                                                </p>
                                                                                <h2 class="bold_timeline_item_header_title">
                                                                                    تقييم أثر التدريب بعد نهاية كل برنامج
                                                                                </h2>
                                                                            </div>
                                                                        </div>
                                                                        <div class="bold_timeline_item_content">
                                                                            <div class="bold_timeline_item_content_inner">
                                                                                <div class="bold_timeline_item_text"
                                                                                    id="id_6067fa8585128">
                                                                                    <div
                                                                                        class="bold_timeline_item_text_inner">
                                                                                        <p><img class="aligncenter size-full wp-image-4476"
                                                                                                src="https://beta.ivorytraining.net/wp-content/uploads/2020/05/five-stars-printed-on-craft-paper-with-stamp-ratin-P84ES7Z.jpg"
                                                                                                alt="" width="500"
                                                                                                height="200" /></p>
                                                                                        <ul>
                                                                                            <li>تمرين دراسة حالة عملية في
                                                                                                نفس محتوى البرنامج</li>
                                                                                            <li>عمل لقاء أون لاين من خلال
                                                                                                قاعة تمهير الالكترونية لمدة
                                                                                                ساعتين لاستعراض الحالة
                                                                                                والحلول التي تمت بشكل مباشر
                                                                                                من قبل المشاركين وتبادل
                                                                                                الخبرات والتوصيات من قبل
                                                                                                المدرب</li>
                                                                                            <li>تزويد المشاركين بقائمة
                                                                                                المراجع المعرفية المتخصصة
                                                                                                والفيديوهات المتخصصة في نفس
                                                                                                مجال البرامج.</li>
                                                                                            <li>تجهيز منتدى متخصص لتبادل
                                                                                                الخبرات والمعارف والآراء
                                                                                                والاستشارات والاستفسارات
                                                                                                خلال فترة البرنامج</li>
                                                                                        </ul>
                                                                                        <p style="padding-left: 40px;">
                                                                                            <strong>* أسابيع بعد انتهاء
                                                                                                البرنامج</strong>
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Services About  -->


@endsection
