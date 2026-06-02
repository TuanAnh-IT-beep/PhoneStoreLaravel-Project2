<footer class="bg-[#0b1a1a] text-white py-12 px-8 font-sans border-t-4 border-[#4ade80]">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">

        <div class="col-span-1 md:col-span-2 space-y-6">
            <div class="flex items-center gap-1" id="logo">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('images/main/Logo.png') }}" alt="Logo" class="logo-image">
                </a>
                <a class="logo-text" href="{{ route('home') }}"><span style="color: #AFF5BF;">BMo</span>bileShop</a>
            </div>

            <div class="space-y-2">
                <p class="font-bold" style="color:white">Contact us:</p>
                <div class="flex items-center gap-3">
                    <div class="text-gray-400">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <div>
                        <p class="footer-contact" style="color:white">Call us:</p>
                        <p class="footer-contact" style="color:white">+84 123456789</p>
                    </div>
                </div>
            </div>

            <div class="space-y-3">
                <p class="font-bold text-gray-200" style="color:white">Our social links:</p>
                <div class="flex gap-1 items-center">
                    <a href="#" class="hover:text-[#4ade80] transition-colors text-2xl" style="color:white">
                        <i class="fa-brands fa-square-instagram fa-fx"></i>
                    </a>
                    <a href="#" class="hover:text-[#4ade80] transition-colors text-2xl" style="color:white">
                        <i class="fa-brands fa-square-facebook fa-fx"></i>
                    </a>
                    <a href="#" class="hover:text-[#4ade80] transition-colors text-2xl"style="color:white">
                        <i class="fa-brands fa-square-twitter fa-fx"></i>
                    </a>
                </div>
            </div>
        </div>

        <div class="space-y-4">
            <h3 class="font-bold text-lg" style="color:white">Support</h3>
            <ul class="space-y-3 text-gray-300">
                <li><a href="#" class="hover:text-[#4ade80] transition-colors"style="color:white">Contact</a></li>
                <li><a href="#" class="hover:text-[#4ade80] transition-colors"style="color:white">Support</a></li>
            </ul>
        </div>

        <!-- Cột 3: Customer Service -->
        <div class="space-y-4">
            <h3 class="font-bold text-lg" style="color:white">Customer Service</h3>
            <ul class="space-y-3 text-gray-300">
                <li><a href="#" class="hover:text-[#4ade80] transition-colors"style="color:white">About us</a>
                </li>
                <li><a href="#" class="hover:text-[#4ade80] transition-colors"style="color:white">FAQ</a></li>
                <li><a href="#" class="hover:text-[#4ade80] transition-colors"style="color:white">Terms &
                        Conditions</a></li>
                <li><a href="#" class="hover:text-[#4ade80] transition-colors"style="color:white">Privacy
                        Policy</a></li>
                <li><a href="#" class="hover:text-[#4ade80] transition-colors"style="color:white">Cancellation &
                        Return Policy</a></li>
            </ul>
        </div>

    </div>
</footer>
