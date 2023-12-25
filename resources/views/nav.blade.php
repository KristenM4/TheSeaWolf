<header id="main-nav">
    <div class="container">
        <div class="logo">
            <a href="/" title="Home">Logo</a>
            <div id="nav-mobile">
                <button class="items-center px-3 py-1 rounded">
                    <div class="bg-brand-dark-green rounded drop-shadow-3xl mb-2 mt-1 w-10 h-[5px]"></div>
                    <div class="bg-brand-dark-green rounded drop-shadow-3xl my-2 w-10 h-[5px]"></div>
                    <div class="bg-brand-dark-green rounded drop-shadow-3xl mt-2 mb-1 w-10 h-[5px]"></div>
                </button>
            </div>
        </div>
        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="">About</a>
            @auth
            <a href="">My Profile</a>
            <a href="/logout">Sign out</a>
            @else
            <a href="/signup/">Sign Up</a>
            @endauth
        </nav>
    </div>
</header>