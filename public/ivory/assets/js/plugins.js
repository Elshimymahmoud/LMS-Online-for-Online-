$(window).ready(function(){
    
    $('.loading').fadeOut(1000)
    $('body').removeClass('active')

    /*======== Search Field ===========*/
    var sField = document.getElementById('search-field')
    sField.oninput = function() {
      var inputLen = $('#search-field').val().length;
      if( inputLen > 0 ){
        $('.search-courses form .found').addClass('active');

        
        input = $('#search-field').val();
        filter = input.toUpperCase();
        a = $( ".search-item" );
        for (i = 0; i < a.length; i++) {
            txtValue = a[i].textContent || a[i].innerText;
            console.log(txtValue);
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
            } else {
            a[i].style.display = "none";
            }
        }

      }
      else{
        $('.search-courses form .found').removeClass('active')
      }
    }


    $('.search-courses form .found ul li a,.request form .ads .list-ads ul li').hover(
        function(){
            $('.search-courses form .found ul li a,.request form .ads .list-ads ul li').removeClass('active')
            $(this).addClass('active')
        },
        function(){
            $(this).addClass('active')
        }
    )
    /*======== Search Field ============*/



    /*============ Swiper Sliders ===============*/
    var swiper = new Swiper('.swiper-sliders', {
        loop: true,
        autoHeight: true,
        navigation: {
          nextEl: '.swiper-sliders-next',
          prevEl: '.swiper-sliders-prev',
        },
        autoplay: {
            delay: 20000,
            disableOnInteraction: false,
        },
        spaceBetween: 0,
    });
    /*============ Swiper Sliders ===============*/




    /*============ Training ===============*/
    $('.training .training-overlay .training-body .links ul li').click(function(){
        var $this = $('.' + $(this).data('content'))
        $(this).addClass('active').siblings().removeClass('active')/*
        $('.training .training-overlay .training-body .training-found').animate({height:'0'},00,function(){
            $this.animate({height:'auto'},200)
        })*/
        $this.addClass('active').siblings().removeClass('active')
    })
    /*============ Training ===============*/





    /*============ Swiper Locations ===============*/
    $('.owl-carousel.owl-locations').owlCarousel({
        loop:true,
        margin: 0,
        mouseDrag: true,
        pullDrag: true,
        slideBy:5,
        nav: true,
        navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
        nav:true,
        responsive:{
            0:{
                items:1
            },
            500:{
                items:3
            },
            1200:{
                items:5
            }
        }
    });
    /*============ Swiper Locations ===============*/

    
    /*============ Clients Partners ===============*/
    $('.owl-carousel.owl-clients,.owl-carousel.owl-partners').owlCarousel({
        loop:true,
        margin: 0,
        mouseDrag: true,
        pullDrag: true,
        slideBy:4,
        nav: true,
        navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });
    /*============ Clients Partners ===============*/

    
    /*============ People Partners ===============*/
    $('.owl-carousel.owl-people').owlCarousel({
        loop:true,
        margin: 0,
        mouseDrag: true,
        pullDrag: true,
        slideBy:2,
        nav: true,
        navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:2
            }
        }
    });
    /*============ People Partners ===============*/
    $('.owl-carousel.owl-prouds').owlCarousel({
        loop:true,
        margin: 30,
        mouseDrag: true,
        pullDrag: true,
        slideBy:1,
        nav: true,
        navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
        nav:true,
        responsive:{
            0:{
                items:1
            },
            500:{
                items:1
            },
            767:{
                items:2
            }
        }
    });
    $('.owl-carousel.owl-topics').owlCarousel({
        loop:true,
        margin: 30,
        mouseDrag: true,
        pullDrag: true,
        slideBy:1,
        nav: true,
        navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
        nav:true,
        responsive:{
            0:{
                items:2
            },
            500:{
                items:2
            },
            767:{
                items:4
            }
        }
    });
    $('.owl-carousel.owl-stories').owlCarousel({
        loop:true,
        margin: 0,
        mouseDrag: true,
        pullDrag: true,
        slideBy:1,
        nav: true,
        navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
        nav:true,
        responsive:{
            0:{
                items:1
            },
            500:{
                items:1
            },
            767:{
                items:2
            }
        }
    });
    $('.owl-carousel.owl-partner').owlCarousel({
        loop:true,
        margin: 15,
        mouseDrag: true,
        pullDrag: true,
        slideBy: 6,
        nav: true,
        navText: ['<i class="fas fa-angle-left"></i>','<i class="fas fa-angle-right"></i>'],
        nav:true,
        responsive:{
            0:{
                items:2
            },
            500:{
                items:4
            },
            767:{
                items:5
            },
            1024:{
                items:6
            }
        }
    });


 
    $('.open-popup').click(function(e){
        e.preventDefault()
        $('.model').fadeIn(500)
        $('.wrapper-page').addClass('active')
    })
///////////////////////////////////////////
    $('.close-popup').click(function(){
        $(this).parent().removeClass('active').fadeOut(500)
        $('.wrapper-page').removeClass('active')
    })
    $('.menu .overlay .close-popup,.search .overlay .close-popup,.login-register .overlay .close-popup').click(function(){
        $(this).parent().parent().removeClass('active')
        $('.wrapper-page').removeClass('active')
    })
    $('.openpop').click(function(e){
        e.preventDefault()
        $('.' + $(this).data('value')).addClass('active')
        $('.wrapper-page').addClass('active')
    })
/////////////////////////////////////////

    var b=0;
    $('.open-list').click(function(e){
        var othis = $(this)
        e.preventDefault();
        if( othis.hasClass('active') === true ){
            othis.parent().find('ul').removeClass('active')
            othis.removeClass('active')
            console.log('a')
        }
        else{
            othis.parent().find('ul').addClass('active')
            othis.addClass('active')
            console.log('b')
        }
    })




    $(window).scroll(function(){
        var bodyTop = $('html').scrollTop();
        if(bodyTop >= 30){
            $('.count').each(function () {
                $(this).prop('Counter',0).animate({
                    Counter: $(this).data('value')
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    }
                });
            });
        }
        if(bodyTop > 320){
            $('.get-course').addClass('active')
        }
        else{
            $('.get-course').removeClass('active')
        }
        console.log(bodyTop)
    });





    var a=0;
    $('.ad.form-control').click(function(){
        var ad = $(this).parent()
        if( a % 2 === 0){
            ad.find('.list-ads').addClass('active');
            ad.find('.list-ads input').attr('autofocus','autofocus')
            a++
        }
        else{
            ad.find('.list-ads').removeClass('active');
            a++
        }
    })

    $('.body-tour').click(function(){
        $(this).find('.tour-content').addClass('active')
        //$(this).find('iframe').addClass('active')
        console.log('a')
    })

    var Fheight = $('footer').height()

    $('.wrapper-page').css('paddingBottom' , Fheight)








    /////////// about page
    $('.welcome .body-welcome .top-content ul li,.details .detail-course .top-content ul li').click(function(){
        $(this).addClass('active').siblings().removeClass('active')
        $('.' + $(this).data('list')).addClass('active').siblings().removeClass('active')
    })
    $('.welcome .body-welcome.mob .head-content h4').click(function(){
        $('.welcome .body-welcome.mob .head-content h4').removeClass('active')
        $(this).addClass('active')
        $('.welcome .body-welcome.mob .content').removeClass('active')
        $('.' + $(this).data('list')).addClass('active')
    })


    var countAbout = 0;
    $('.about .join .head-join').click(function(){
        if( countAbout % 2 === 0){
            $(this).find('.span-icon').find('i').removeClass('fa-plus').addClass('fa-minus')
            $(this).siblings().addClass('active')
            countAbout++
        }
        else{
            $(this).find('.span-icon').find('i').removeClass('fa-minus').addClass('fa-plus')
            $(this).siblings().removeClass('active')
            countAbout++
        }
    })


    var countWish = 0;
    $('.details .wishlist .wish').click(function(){
        if( countWish % 2 === 0){
            $(this).find('span').text('Wishlisted')
            $(this).addClass('active')
            countWish++
        }
        else{
            $(this).find('span').text('Add to Wishlist')
            $(this).removeClass('active')
            countWish++
        }
    })



//    var bodyCurri = 0
    $('.details .bottom-content .content.curri .body-curri.body-slide').click(function(){
        var bodyCurri = $(this)
        if( bodyCurri.hasClass('active') === true ){
            $(this).removeClass('active')
            bodyCurri++
        }
        else{
            bodyCurri++
            $(this).addClass('active')
        }
    })



    
    /*============= Scoll body =========*/
    $(".toGetCourse").on('click', function (e) {
        var className = $(this).attr("href");
        console.log (className);
        if (className.charAt(0) === "#") {
            e.preventDefault();
            var scrollTopOffset = $(className).offset().top;
            $('html, body').animate({
                scrollTop: scrollTopOffset
            }, 500);
        }
        
    });

















    ///////////////////////////////////////////// CV /////////////////////////////////////////////
    var lastTarget = null;

    function isFile(evt) {
        var dt = evt.dataTransfer;

        for (var i = 0; i < dt.types.length; i++) {
            if (dt.types[i] === "Files") {
                return true;
            }
        }
        return false;
    }

    window.addEventListener("dragenter", function (e) {
        if (isFile(e)) {
            lastTarget = e.target;
            document.querySelector("#dropzone").style.visibility = "";
            document.querySelector("#dropzone").style.opacity = 1;
            //document.querySelector("#textnode").style.fontSize = "48px";
        }
    });

    window.addEventListener("dragleave", function (e) {
        e.preventDefault();
        if (e.target === lastTarget || e.target === document) {
            document.querySelector("#dropzone").style.visibility = "hidden";
            document.querySelector("#dropzone").style.opacity = 0;
            //document.querySelector("#textnode").style.fontSize = "42px";
        }
    });

    window.addEventListener("dragover", function (e) {
        e.preventDefault();
    });

    window.addEventListener("drop", function (e) {
        e.preventDefault();
        document.querySelector("#dropzone").style.visibility = "hidden";
        document.querySelector("#dropzone").style.opacity = 0;
        //document.querySelector("#textnode").style.fontSize = "42px";
        if(e.dataTransfer.files.length == 1)
        {
            document.querySelector("#text").innerHTML =
                "<img src"+ e.dataTransfer.files[0].src +" style='width:50px;height:50px;display:inline' class='img-fluid mr-20'> <div class='data'> <div class='d-size'> <strong>" + e.dataTransfer.files[0].size/1000 + "</strong> KB </div> <div class='d-name'>" + e.dataTransfer.files[0].name + "</div><div class='remove'><i class='fas fa-times'></i></div></div>";
                document.querySelector("#text").style.display = "flex"
                document.querySelector("#field").style.display = "none"
                document.querySelector("#cv").style.display = "none"
        }
        $('.data .remove').click(function(){
            e.dataTransfer.files.length == 0;
            document.querySelector("#text").innerHTML = '<svg viewBox="0 0 1024 1024" focusable="false" class="" data-icon="inbox" width="50px" height="50px" fill="#B1B1B1" aria-hidden="true"><path d="M885.2 446.3l-.2-.8-112.2-285.1c-5-16.1-19.9-27.2-36.8-27.2H281.2c-17 0-32.1 11.3-36.9 27.6L139.4 443l-.3.7-.2.8c-1.3 4.9-1.7 9.9-1 14.8-.1 1.6-.2 3.2-.2 4.8V830a60.9 60.9 0 0 0 60.8 60.8h627.2c33.5 0 60.8-27.3 60.9-60.8V464.1c0-1.3 0-2.6-.1-3.7.4-4.9 0-9.6-1.3-14.1zm-295.8-43l-.3 15.7c-.8 44.9-31.8 75.1-77.1 75.1-22.1 0-41.1-7.1-54.8-20.6S436 441.2 435.6 419l-.3-15.7H229.5L309 210h399.2l81.7 193.3H589.4zm-375 76.8h157.3c24.3 57.1 76 90.8 140.4 90.8 33.7 0 65-9.4 90.3-27.2 22.2-15.6 39.5-37.4 50.7-63.6h156.5V814H214.4V480.1z"></path></svg><p>Click or drag a file to this area to upload.</p>';
            document.querySelector("#text").style.display = "inherit"
            document.querySelector("#field").style.display = "inherit"
            document.querySelector("#cv").style.display = "inherit"
        })
    });
})