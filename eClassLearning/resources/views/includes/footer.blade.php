<!-- Footer Starts -->
<footer class="bg-gray-900 ">
    <div class="flex md:max-w-6xl mx-auto justify-between text-gray-100 space-x-12 pt-10 pb-14">
        <div class="footer-section-one md:basis-4/12">
            <img src="{{ asset('images/logo-bw.png') }}" alt="Logo">
            <p class="mt-4 tracking-wide text-justify">eClassLearning is online course marketplace that offers
                various
                premium courses for your skill development.
                You can learn anywhere anytime with best quility content.</p>
            <div class="text-2xl mt-4 space-x-2">
                <a href="#"><i class="fa-brands fa-facebook"></i></a>
                <a href="#"><i class="fa-brands fa-twitter"></i></a>
                <a href="#"><i class="fa-brands fa-instagram"></i></a>
                <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                <a href="#"><i class="fa-brands fa-facebook-messenger"></i></a>
            </div>
        </div>

        <div class="footer-section-two md:basis-2/12">
            <h4 class="uppercase mb-2 font-semibold">Categories</h4>
            <a href="#" class="block">Web Development</a>
            <a href="#" class="block">Business</a>
            <a href="#" class="block">Advanced Level</a>
            <a href="#" class="block">O/L</a>
            <a href="#" class="block">Grade 6-9</a>

        </div>

        <div class="footer-section-two md:basis-2/12">
            <h4 class="uppercase mb-2 font-semibold">Usefull Links</h4>
            <a href="#" class="block">Home</a>
            <a href="#" class="block">Course</a>
            <a href="#" class="block">About</a>
            <a href="#" class="block">Contact</a>
        </div>

        <div class="footer-section-two md:basis-3/12">
            <h4 class="uppercase mb-2 font-semibold">Contact</h4>

            <div class="footer-address flex space-x-3">
                <div><i class="fa-solid fa-location-dot"></i></div>
                <div>
                    123
                    S. De S. Jayasinghe Mawatha,
                    Nugegoda 10250
                    Sri Lanka
                </div>
            </div>

            <div class="footer-contact-no flex space-x-3 mt-2">
                <div><i class="fa-solid fa-phone"></i></div>
                <div>+94 77 123 4567</div>
            </div>

            <div class="footer-email flex space-x-3 mt-2">
                <div><i class="fa-regular fa-envelope"></i></div>
                <div>contact@eclasslearning.co</div>
            </div>
        </div>
    </div>

    <div class="md:max-w-6xl mx-auto pb-4">
        <hr>
        <p class="mt-4 text-center text-gray-100 select-none">© 2022 eClassLearning All Rights Reserved | Developed by Dilshan
            Shanaka</p>
    </div>
</footer>
<!-- Footer Ends -->

<script>
    const btn = document.querySelector("button.mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");

    btn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });
</script>
