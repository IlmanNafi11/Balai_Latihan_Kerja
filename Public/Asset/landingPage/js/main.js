(function () {
    "use strict";

    /**
     * Apply .scrolled class to the body as the page is scrolled down
     */
    function toggleScrolled() {
        const selectBody = document.querySelector('body');
        const selectHeader = document.querySelector('#header');
        if (!selectHeader || (!selectHeader.classList.contains('scroll-up-sticky') &&
            !selectHeader.classList.contains('sticky-top') &&
            !selectHeader.classList.contains('fixed-top'))) return;
        window.scrollY > 100 ? selectBody.classList.add('scrolled') : selectBody.classList.remove('scrolled');
    }

    document.addEventListener('scroll', toggleScrolled);
    window.addEventListener('load', toggleScrolled);

    /**
     * Mobile nav toggle
     */
    const mobileNavToggleBtn = document.querySelector('.mobile-nav-toggle');

    if (mobileNavToggleBtn) {
        mobileNavToggleBtn.addEventListener('click', function () {
            document.querySelector('body').classList.toggle('mobile-nav-active');
            mobileNavToggleBtn.classList.toggle('bi-list');
            mobileNavToggleBtn.classList.toggle('bi-x');
        });
    }

    /**
     * Hide mobile nav on same-page/hash links
     */
    document.querySelectorAll('#navmenu a').forEach(navmenu => {
        navmenu.addEventListener('click', () => {
            if (document.querySelector('.mobile-nav-active')) {
                document.querySelector('body').classList.toggle('mobile-nav-active');
            }
        });
    });

    /**
     * Toggle mobile nav dropdowns
     */
    document.querySelectorAll('.navmenu .toggle-dropdown').forEach(navmenu => {
        navmenu.addEventListener('click', function (e) {
            e.preventDefault();
            this.parentNode.classList.toggle('active');
            this.parentNode.nextElementSibling.classList.toggle('dropdown-active');
        });
    });

    /**
     * Preloader
     */
    const preloader = document.querySelector('#preloader');
    const overlay = document.querySelector('.overlay-container-loader');
    const bodyContainer = document.querySelector('body');
    const subtitleOverlay = document.querySelector('.subtitle-overlay-container');
    window.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            if (preloader) {
                overlay.classList.add('overlay-hidden');
                bodyContainer.classList.add('overlay');
                preloader.remove();
                subtitleOverlay.remove();
                overlay.remove();
            }
        }, 3000);
    });


    /**
     * Scroll top button
     */
    const scrollTop = document.querySelector('.scroll-top');

    if (scrollTop) {
        function toggleScrollTop() {
            window.scrollY > 100 ? scrollTop.classList.add('active') : scrollTop.classList.remove('active');
        }

        scrollTop.addEventListener('click', (e) => {
            e.preventDefault();
            window.scrollTo({top: 0, behavior: 'smooth'});
        });

        window.addEventListener('load', toggleScrollTop);
        document.addEventListener('scroll', toggleScrollTop);
    }

    /**
     * Animation on scroll function and init
     */
    function aosInit() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600,
                easing: 'ease-in-out',
                once: true,
                mirror: false
            });
        }
    }

    window.addEventListener('load', aosInit);

    /**
     * Initiate glightbox
     */
    if (typeof GLightbox !== 'undefined') {
        GLightbox({selector: '.glightbox'});
    }

    /**
     * Initiate Pure Counter
     */
    if (typeof PureCounter !== 'undefined') {
        new PureCounter();
    }

    /**
     * Init isotope layout and filters
     */
    document.querySelectorAll('.isotope-layout').forEach(function (isotopeItem) {
        const layout = isotopeItem.getAttribute('data-layout') || 'masonry';
        const filter = isotopeItem.getAttribute('data-default-filter') || '*';
        const sort = isotopeItem.getAttribute('data-sort') || 'original-order';

        imagesLoaded(isotopeItem.querySelector('.isotope-container'), function () {
            const initIsotope = new Isotope(isotopeItem.querySelector('.isotope-container'), {
                itemSelector: '.isotope-item',
                layoutMode: layout,
                filter: filter,
                sortBy: sort
            });

            isotopeItem.querySelectorAll('.isotope-filters li').forEach(function (filters) {
                filters.addEventListener('click', function () {
                    isotopeItem.querySelector('.isotope-filters .filter-active').classList.remove('filter-active');
                    this.classList.add('filter-active');
                    initIsotope.arrange({filter: this.getAttribute('data-filter')});
                    if (typeof aosInit === 'function') aosInit();
                });
            });
        });
    });

    /**
     * Mockup Content Carousel
     */
    const mockupContent = document.getElementById("mockupContent");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    if (mockupContent && prevBtn && nextBtn) {
        const totalSlides = document.querySelectorAll(".mockup-content img").length;
        let currentIndex = 0;

        function updateSlide() {
            const offset = -currentIndex * 100;
            mockupContent.style.transform = `translateX(${offset}%)`;
        }

        prevBtn.addEventListener("click", () => {
            currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
            updateSlide();
        });

        nextBtn.addEventListener("click", () => {
            currentIndex = (currentIndex + 1) % totalSlides;
            updateSlide();
        });

        updateSlide();
    }

    /**
     * Video Modal
     */
    const videoButton = document.getElementById('videoButton');
    const videoModal = document.getElementById('videoModal');
    const videoIframe = document.getElementById('videoIframe');

    if (videoButton && videoModal && videoIframe) {
        videoButton.addEventListener('click', () => videoModal.style.display = 'block');

        document.querySelector('.close').addEventListener('click', () => {
            videoModal.style.display = 'none';
            videoIframe.src = videoIframe.src; // Reset video
        });

        window.addEventListener('click', (event) => {
            if (event.target === videoModal) {
                videoModal.style.display = 'none';
                videoIframe.src = videoIframe.src; // Reset video
            }
        });
    }

})();
