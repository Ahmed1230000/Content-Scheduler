<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-indigo-600 hover:text-indigo-700">
            Content Scheduler
        </a>

        <ul class="flex space-x-4 items-center text-gray-700">
            @guest
            <li><a href="{{ route('login') }}" class="hover:text-indigo-600 transition">Login</a></li>
            <li><a href="{{ route('register.form') }}" class="hover:text-indigo-600 transition">Register</a></li>
            @else
            <li class="relative">
                <button id="dropdownToggle" class="flex items-center space-x-2 focus:outline-none">
                    <span>{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-sm"></i>
                </button>
                <ul id="dropdownMenu" class="absolute right-0 mt-2 w-40 bg-white rounded-md shadow-lg hidden">
                    <li>
                        <form method="POST" action="{{ route('logout.sotre') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-indigo-100">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </li>
            @endguest
        </ul>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggleButton = document.getElementById("dropdownToggle");
        const dropdownMenu = document.getElementById("dropdownMenu");

        toggleButton.addEventListener("click", function(e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle("hidden");
        });

        document.addEventListener("click", function(e) {
            if (!dropdownMenu.contains(e.target) && !toggleButton.contains(e.target)) {
                dropdownMenu.classList.add("hidden");
            }
        });
    });
</script>