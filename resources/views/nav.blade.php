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
            <div class="user-section" tabindex="1">
                <img id="user-icon" src="{{url('/images/user-icon.svg')}}" alt="User dropdown icon">
                <div class="user-dropdown">
                    <a href="/user-profile/" title="User Profile">Profile</a>
                    <a href="/logout" title="Sign Out">Sign out</a>
                </div>
            </div>
            @else
            <a href="/signup/">Sign Up</a>
            @endauth
        </nav>
    </div>
</header>