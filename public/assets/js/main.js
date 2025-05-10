(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();

    // Custom Toggler Active State
    var toggler = document.querySelector('.custom-toggler');
    var navbarCollapse = document.getElementById('navbarNav');

    if (toggler && navbarCollapse) {
    navbarCollapse.addEventListener('shown.bs.collapse', function () {
        toggler.classList.add('active');

        if (window.innerWidth < 992) {
            document.body.style.overflow = 'hidden'; // Kunci scroll body saat toggler buka
        }
    });

    navbarCollapse.addEventListener('hidden.bs.collapse', function () {
        toggler.classList.remove('active');

        if (window.innerWidth < 992) {
            document.body.style.overflow = ''; // Balik scroll normal saat toggler tutup
        }
    });
    }

    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // testimonial carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        margin: 25,
        loop: true,
        center: true,
        dots: false,
        nav: true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ],
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });

    // Pastikan event delegation supaya semua thumb klik bisa ganti foto
    $(document).ready(function() {
    $('.detail-lapangan').on('click', '.thumb-photo', function() {
        var mainPhoto = document.getElementById('mainPhoto');
        mainPhoto.src = this.src;
    });
    });

    
})(jQuery);

