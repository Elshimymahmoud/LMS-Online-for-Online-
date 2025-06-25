/*!
* Start Bootstrap - Simple Sidebar v6.0.3 (https://startbootstrap.com/template/simple-sidebar)
* Copyright 2013-2021 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-simple-sidebar/blob/master/LICENSE)
*/
// 
// Scripts
// 

function toggleShow() {
    var x = document.getElementById("sidebar-right");
    var Y= document.getElementById("accordion");

    
    if (x.style.display === "none") {
    //   x.style.display = "block";
   
      x.classList.remove('animate')
      setTimeout(() => {
      x.style.display = "block";
      
      Y.classList.add('fadeInX')
      }, 1000);
    } else {
        x.classList.add('animate')
        
        setTimeout(() => {
      x.style.display = "none";
      Y.classList.add('fadeInX')
        }, 1000);
    }
  }
