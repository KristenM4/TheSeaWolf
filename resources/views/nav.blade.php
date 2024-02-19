<header id="main-nav">
    <div class="container">
        <div class="logo">
            <a href="/" title="Home">Logo</a>
            <div id="nav-mobile">
                <button>
                    <div></div>
                    <div></div>
                    <div></div>
                </button>
            </div>
        </div>
        <nav class="nav-links hidden">
            <a href="/">Home</a>
            <a href="">About</a>
            @auth
            <a href="/user-profile/">My Profile</a>
            <a href="/logout">Sign out</a>
            @else
            <a href="/signup/">Sign Up</a>
            @endauth
        </nav>
    </div>
</header>