<nav>
  <div style="max-width: 900px; margin: 0 auto; display: flex; justify-content: center; gap: 30px; padding: 12px 0;">
    <a href="{{ url('/home') }}" style="color: white; font-weight: 700; font-size: 1.1rem; text-decoration: none; user-select: none;">Home</a>
    <a href="{{ route('products.index') }}" style="color: white; font-weight: 700; font-size: 1.1rem; text-decoration: none; user-select: none;">Produk</a>

    @auth
      <a href="{{ route('transaksi.index') }}" style="color: white; font-weight: 700; font-size: 1.1rem; text-decoration: none; user-select: none;">Transaksiku</a>
      <a href="{{ route('logout') }}" 
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
         style="color: white; font-weight: 700; font-size: 1.1rem; text-decoration: none; user-select: none;">
         Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    @else
      <a href="{{ route('login') }}" style="color: white; font-weight: 700; font-size: 1.1rem; text-decoration: none; user-select: none;">Login</a>
      <a href="{{ route('register') }}" style="color: white; font-weight: 700; font-size: 1.1rem; text-decoration: none; user-select: none;">Register</a>
    @endauth
  </div>
</nav>
