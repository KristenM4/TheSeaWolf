<header id="main-nav">
    <div class="container">
        <div class="logo"><a href="/" title="Home">Logo</a></div>
        <nav>
            <a href="/">Home</a>
            <a href="">About</a>
            @auth
            <a href="">My Profile</a>
            @else
            <a href="/signup/">Sign Up</a>
            @endauth
        </nav>
    </div>
</header>