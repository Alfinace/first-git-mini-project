
// $('#gestion_produit').click(function (event) {
//     event.preventDefault();
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//   $.ajax({
//     url:'/produit',
//     method:"GET",
//     data:{},
//     dataType:'json',
//     success:function(response){
//       $('#contenth').html(response.output);

//     }
//   });
// })


(function() {
    'use strict';
    window.addEventListener('load', function() {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();
  (function() {
    'use strict';
    window.addEventListener('load', function() {
      // Get the forms we want to add validation styles to
      var forms = document.getElementsByClassName('needs-validation_registration');
      // Loop over them and prevent submission
      var validation = Array.prototype.filter.call(forms, function(form) {
        form.addEventListener('submit', function(event) {
          if (form.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
          }
          form.classList.add('was-validated');
        }, false);
      });
    }, false);
  })();

  $('.loger').click(function () {
    $('#annuler').html('+');
    $('.login').css('marginLeft','0px');
    $('.login').css('transition','0.5s');
  });
   $('#annuler').click(function () {
    $(this).html('');
    $('.login').css('marginLeft','-310px');
    $('.login').css('transition','0.5s');
  });
// Change style of navbar on scroll
window.onscroll = function() {myFunction()};
function myFunction() {
    var navbar = document.getElementById("myNavbar");
    var body = document.getElementById('body1');
    var entete = document.getElementById('entete');

    if (document.documentElement.scrollTop > 80) {
      body.style.backgroundColor="#2a2e33";
      navbar.style.marginTop="0px";
      navbar.style.transition="0.8s";
    } 
    if (document.documentElement.scrollBottom < 80) {
      alert('rrrr');
      navbar.style.marginTop="1000px";
      body.style.backgroundColor="#fff";
    }
}

// Used to toggle the menu on small screens when clicking on the menu button
function toggleFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}

// $('.create_account').click(function(e){
//   e.preventDefault();
//   $('.sous-login').css('display','none');
//   $('.registration').css('display','block');
//     $('sous-login').css('transition','0.8s');

// })

// $('.se_connecter').click(function(e){
//   e.preventDefault();
//   $('.registration').css('display','none');
//   $('.sous-login').css('display','block');
//     $('sous-login').css('transition','0.8s');

// })
