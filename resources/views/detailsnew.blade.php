<!DOCTYPE html>
<html>

<head>
    <title>Details </title>
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />
    <link rel="stylesheet" href="https://cdn.plyr.io/3.6.8/plyr.css" />

    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>
    <style>
        body {
            direction: rtl;
        }

        #student-screen .cont {

            text-align: center;
            height: 100%;
            width: 98%;
            margin-left: auto;
            margin-right: auto
        }
        #content {
            display: none;
        }
        #student-screen .tabs h1 {
            border: 1px solid #4f198d;
            padding: 5px;
            font-size: 25px;

        }

        a {
            text-decoration: none;

        }

        #student-screen {
            padding: 50px 0;
        }
#toggleButton2,#toggleButton2{
    display: block
}
        .tabs-details .tabs {
            display: flex;
            cursor: pointer;
            margin-bottom: 20px;
            justify-content: center;
            flex-wrap: wrap;
            flex-direction: column
        }

        .tabs-details .tab {
            padding: 10px 0px;
            color: #4f198d;
            border: 1px solid #eee;
            margin: 5px 0;
            font-size: 20px;
            border-radius: 6px;
            cursor: pointer;
           
        }

        .tabs-details .tab.active {
            background-color: #4f198d;
            color: #fff;
            /* box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; */
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

        .two-part .small-part .links-part {
            border: 1px solid #eee;
            display: flex;
            flex-direction: column;
            padding: 20px;
            box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
        }

        .two-part .small-part .tab {
            display: block;
            background-color: #4f198d;
            color: #fff;
            margin: 1% 0;
            padding: 10px 5px;
            border-radius: 5px;
            cursor: pointer;
        }

        .two-part .small-part .tab a {
            color: #fff;
            line-height: 28px;
            font-weight: 500;
        }

        .display-content {
            font-size: 20px;
            line-height: 32px;
            font-weight: 600;
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
            margin: 5px 0;
            border-radius: 5px
        }
        .tab h1{
            margin: 0 !important;
            font-size: 25px;
            width: 100%;
        }
        .tab {
           
            width: 100%;
        }
        .collapse-content {
            padding: 10px 0;
            /* border: 1px solid #ccc; */
            border-top: none;
            display: none;
            text-align: right;
            background-color: #fff;
            transition: .5s ease;
            margin: 10px 0;
        }

        .collapse-content.active {
            display: block;

            color: #fff;
            border-radius: 5px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            text-align: center;
        }

        #student-screen .two-part .three {
            border: 1px solid #eee;
            border-radius: 10px;
            padding: 20px;
        }

        .video-player {
            margin-bottom: 40px;

        }

        .plyr--video {
            border-radius: 8px;
        }
        .email-field {
      margin-bottom: 10px;
    }
    .invite-part  input[type="email"] {
      padding: 8px;
      margin-right: 10px;
      border-radius: 5px;
      width: 70%;
      border: 1px solid #ccc;

    }
    .invite-part button {
      padding: 8px 15px;
      cursor: pointer;
    }
    .invite-part{
        margin: 20px 0;
        border: 2px solid #eee;
        padding: 20px ;
        border-radius: 5px;

    }
    .invite-part .newbtn{
        background: #4f198d;
        color: #fff;
        border: none;
        min-width: 50px;
        font-size: 18px;
         border-radius: 5px;
         margin-right: 2px;
    }
    #chat {
    border: 1px solid #ccc;
    height: 300px;
    padding: 10px;
    overflow-y: scroll;
    background: #fff;
}

#message-form {
    margin-top: 10px;
    display: flex;
}

#message-input {
    width: 80%;
    padding: 8px;
    border-radius: 5px;
}


#rating {
    display: inline-block;
}

.star {
    font-size: 30px;
    color: #ccc;
    cursor: pointer;
    margin-right: 5px;
}

.star.selected, .star:hover, .star:hover ~ .star {
    color: #ffcc00;
}




        @media(max-width:775px) {

            #student-screen .cont {

                text-align: center;
                height: 100%;
                width: 98%;
                margin-left: auto;
                margin-right: auto
            }
        }



        @media (min-width:776px) {

            #student-screen .cont {
                width: 85%;
                margin-left: auto;
                margin-right: auto;
                max-width: 85%
            }
        }

        @media (min-width: 992px) {

            #student-screen .two-part {
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                align-items: start;
            }

            #student-screen .two-part .three {
                width: 55%
            }

            .two-buttons {
                justify-content: start;
            }

            #student-screen .two-part .small-part {
                width: 35%;
                border-radius: 5px;

            }

            .tab-content .two {
                display: flex;
                justify-content: space-between;
                align-items: start;
            }

            .groups-data {
                display: flex;
                justify-content: space-between;
                align-items: end;
                flex-direction:row;
            }
        }
    </style>
</head>

<body>
    <div id='student-screen'>
        <div class="cont">

            <div class='two-part'>
                <div class="three">
                    <div class="text-part">

                        <div class="tabs-details">
                            <div id="tab-content-1" class="tab-content active ">
                                <div class="video-player">
                                    <p class="display-content">
                                        إدارة المساهمين وأصحاب المصلحة في المشروع
                                    </p>
                                    <video id="player" controls crossorigin>
                                        <source src="{{ asset('assets/images/videos/720p.mp4') }}" type="video/mp4" />
                                        <!-- Add other sources if needed -->
                                        Your browser does not support the video tag.
                                    </video>

                                </div>
                            </div>

                            <div id="tab-content-2" class="tab-content">
                                <div id="chat">
                                    
                                    <div id="chat-messages"></div>
                                </div>
                            
                             
                                <div id="message-form" class='invite-part'>
                                    <input type="text" id="message-input" placeholder="أدخل رسالتك هنا" />
                                    <button onclick="addMessage()" class='newbtn'>إرسال</button>
                                </div>
                            </div>
                            <div id="tab-content-3" class="tab-content">
                                محتوى الدورات الحضورية
                            </div>
                            <div id="tab-content-5" class="tab-content">
                                محتوى الدورات الحضورية
                            </div>
                            <div id="tab-content-10" class="tab-content">
                                10
                            </div>
                            <div id="tab-content-11" class="tab-content">
                                11
                            </div>
                            <div id="tab-content-12" class="tab-content">
                                12
                            </div>
                            <div id="tab-content-13" class="tab-content">
                           <div class="div6">
                            <h5>تقيم</h5>
                            <p>text</p>
                          
                            <div id="rating">
                               
                                <span class="star" data-rate="1">&#9733;</span>
                                <span class="star" data-rate="2">&#9733;</span>
                                <span class="star" data-rate="3">&#9733;</span>
                                <span class="star" data-rate="4">&#9733;</span>
                                <span class="star" data-rate="5">&#9733;</span>
                         
                           </div>
                           </div>
                            </div>
                        </div>

                    </div>
                    <div class="tabs-part">
                        <div class="tabs-details">
                            <div class="div1">
                            <h1>محتوى الدورة </h1>

                            <div class="tabs">


                                <div class="collapse-section">
                                    <div class="collapse-header" data-target="content-1"><i class="fas fa-play"
                                            style="margin-left:10px"></i> محتويات الجلسه التانيه</div>
                                    <div id="content-1" class="collapse-content">
                                        <div class="tab active" data-tab="1"><span>

                                                إدارة المساهمين وأصحاب المصلحة في المشروع

                                                ساعات
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse-section">
                                    <div class="collapse-header" data-target="content-2"><i class="fas fa-play"
                                            style="margin-left:10px"></i> محتويات الجلسه التانيه</div>
                                    <div id="content-2" class="collapse-content">
                                        <div class="tab" data-tab="2">دورات الأونلاين</div>
                                    </div>
                                </div>
                                <div class="collapse-section">
                                    <div class="collapse-header" data-target="content-5"><i class="fas fa-play"
                                            style="margin-left:10px"></i> محتويات الجلسه التانيه</div>
                                    <div id="content-2" class="collapse-content">
                                        <div class="tab" data-tab="5">دورات الأونلاين</div>
                                    </div>
                                </div>
                            </div>
                            <div class="div2">
                              
                                <div class="tab" data-tab="2">  <h1> النقاشات </h1> </div>
                              
                            </div>
                              
                                <div class="tab" data-tab="13"> <h1>التقييمات </h1></div>
                                

                              
                            </div>
                            <div class="div4">
                                <button id="toggleButton2" class='tab'><h1>النشاط</h1></button>
                               
                                
                                <div id="content1" style="display: none;">
                                    <div class="collapse-section">
                                        <div class="collapse-header" data-target="content-11"><i class="fas fa-play"
                                                style="margin-left:10px"></i> محتويات الجلسه التانيه</div>
                                        <div id="content-11" class="collapse-content">
                                            <div class="tab " data-tab="11"><span>
    
                                                    إدارة المساهمين وأصحاب المصلحة في المشروع
    
                                                    ساعات
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse-section">
                                        <div class="collapse-header" data-target="content-12"><i class="fas fa-play"
                                                style="margin-left:10px"></i> محتويات الجلسه التانيه</div>
                                        <div id="content-12" class="collapse-content">
                                            <div class="tab" data-tab="12">دورات الأونلاين</div>
                                        </div>
                                    </div>
                                    <div class="collapse-section">
                                        <div class="collapse-header" data-target="content-5"><i class="fas fa-play"
                                                style="margin-left:10px"></i> محتويات الجلسه التانيه</div>
                                        <div id="content-2" class="collapse-content">
                                            <div class="tab" data-tab="5">دورات الأونلاين</div>
                                        </div>
                                    </div>
                                </div>
                                </div>



                            <div class="div5">
                            <button id="toggleButton" class='tab'><h1>النماذج</h1></button>
                           
                            
                            <div id="content" style="display: none;">
                                <div class="collapse-section">
                                    <div class="collapse-header" data-target="content-11"><i class="fas fa-play"
                                            style="margin-left:10px"></i> محتويات الجلسه التانيه</div>
                                    <div id="content-11" class="collapse-content">
                                        <div class="tab " data-tab="11"><span>

                                                إدارة المساهمين وأصحاب المصلحة في المشروع

                                                ساعات
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse-section">
                                    <div class="collapse-header" data-target="content-12"><i class="fas fa-play"
                                            style="margin-left:10px"></i> محتويات الجلسه التانيه</div>
                                    <div id="content-12" class="collapse-content">
                                        <div class="tab" data-tab="12">دورات الأونلاين</div>
                                    </div>
                                </div>
                                <div class="collapse-section">
                                    <div class="collapse-header" data-target="content-5"><i class="fas fa-play"
                                            style="margin-left:10px"></i> محتويات الجلسه التانيه</div>
                                    <div id="content-2" class="collapse-content">
                                        <div class="tab" data-tab="5">دورات الأونلاين</div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="small-part">
                    <div class='links-part'>
                    <div class="tabs-part">
                        <div class="tabs-details">
                            <div class="tab" data-tab="10">
                                <a class="list-group-item list-group-item-action list-group-item-light p-3 active "
                                    href="">
                                    <i class="fa fa-area-chart primary-color"></i> دوراتي
                                </a>
                            </div>
                            <div class="tab" data-tab="11">
                                <a class="list-group-item list-group-item-action list-group-item-light p-3 active"
                                    href="https://e-training.ivorytraining.com/user/certificates">
                                    <i class="fa fa-graduation-cap primary-color"></i> شهاداتي
                                </a>
                            </div>
                            <div class="tab" data-tab="12">
                                <a class="list-group-item list-group-item-action list-group-item-light p-3 active"
                                    href="https://e-training.ivorytraining.com/user/account">
                                    <i class="fa fa-user primary-color"></i> الملف الشخصي
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="second">
                    <div class="invite-part">
                        <div id="emailFieldsContainer">
                            <div class="email-field">
                              <input type="email" name="email[]" placeholder="Enter friend's email" required>
                              <button type="button" class='newbtn'  onclick="addEmailField()">+</button>
                            </div>
                          </div>
                        
                          <button type="button"  class='newbtn' onclick="sendInvitations()">دعوه</button>
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
                document.getElementById(`tab-content-${tab.getAttribute('data-tab')}`).classList.add(
                    'active');
            });
        });
    </script>
    <script src="https://cdn.plyr.io/3.6.8/plyr.polyfilled.js"></script>
    <script>
        const player = new Plyr('#player');
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
     <script>
       function addEmailField() {
    const emailFieldsContainer = document.getElementById("emailFieldsContainer");
    const newField = document.createElement("div");
    newField.classList.add("email-field");

    const newInput = document.createElement("input");
    newInput.type = "email";
    newInput.name = "email[]";
    newInput.placeholder = "Enter friend's email";
    newInput.required = true;

    newField.appendChild(newInput);

    const newButton = document.createElement("button");
    newButton.type = "button";
    newButton.textContent = "+";
    newButton.classList.add("newbtn"); 
    newButton.onclick = addEmailField;
    newField.appendChild(newButton);

    // Append the new div to the container
    emailFieldsContainer.appendChild(newField);
}

      </script>

<script>
  
    const toggleButton = document.getElementById('toggleButton');
    const toggleButton2 = document.getElementById('toggleButton2');
    const content = document.getElementById('content');

    toggleButton.addEventListener('click', () => {
     
        if (content.style.display === 'none') {
            content.style.display = 'block';
           
        } else {
            content.style.display = 'none';
          
        }
    });
    toggleButton2.addEventListener('click', () => {
     
        if (content1.style.display === 'none') {
            content1.style.display = 'block';
           
        } else {
            content1.style.display = 'none';
          
        }
    });
</script>
<script>
    function openTab(evt, tabName) {
    
    var tabcontent = document.getElementsByClassName("tabcontent");
    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

   
    var tablinks = document.getElementsByClassName("tablinks");
    for (var i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    
    document.getElementById(tabName).style.display = "block";
    evt.currentTarget.className += " active";
}

function addMessage() {
    var messageInput = document.getElementById("message-input");
    var chatMessages = document.getElementById("chat-messages");

    var messageText = messageInput.value;

   
    if (messageText.trim() !== "") {
        var newMessage = document.createElement("p");
        newMessage.textContent = messageText;

        chatMessages.appendChild(newMessage);

        messageInput.value = "";
    }
}

</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    var stars = document.querySelectorAll('.star');

    stars.forEach(function(star) {
        star.addEventListener('click', setRating);
        star.addEventListener('mouseover', hoverRating);
        star.addEventListener('mouseleave', resetHover);
    });

    var selectedRating = 0;

    function setRating(event) {
        selectedRating = parseInt(event.target.getAttribute('data-rate'));

        stars.forEach(function(star, index) {
            if (index < selectedRating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });

        alert("لقد قمت بتقييم " + selectedRating + " نجوم!");
    }

    function hoverRating(event) {
        var hoverRating = parseInt(event.target.getAttribute('data-rate'));

        stars.forEach(function(star, index) {
            if (index < hoverRating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
    }

    function resetHover() {
        stars.forEach(function(star, index) {
            if (index < selectedRating) {
                star.classList.add('selected');
            } else {
                star.classList.remove('selected');
            }
        });
    }
});

</script>
</body>

</html>
