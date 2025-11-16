<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

  <div class="app-brand demo">
    <a href="/" class="app-brand-link">
      <span class="app-brand-logo demo">
        <!-- LOGO DI SINI -->
      </span>
      <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none d-block">
      <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>

  <ul class="menu-inner py-1">

    <!-- Dashboard -->
    <li class="menu-item">
      <a href="/" class="menu-link">
        <i class="menu-icon tf-icons bx bx-home-circle"></i>
        <div>Dashboard</div>
      </a>
    </li>

    <!-- MASTER -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Master</span>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-store"></i>
        <div>Katalog Produk</div>
      </a>

      <ul class="menu-sub">

        <!-- Daftar Produk -->
        <li class="menu-item">
          <a href="{{ route('products.index') }}" class="menu-link">
            <div>Daftar Produk</div>
          </a>
        </li>

        <!-- Tambah Data -->
        <li class="menu-item">
          <a href="{{ route('products.create') }}" class="menu-link">
            <div>Tambah Data</div>
          </a>
        </li>

      </ul>
    </li>

    <!-- TRANSAKSI -->
    <li class="menu-header small text-uppercase">
      <span class="menu-header-text">Transaksi</span>
    </li>

    <li class="menu-item">
      <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-collection"></i>
        <div>Daftar Pesanan</div>
      </a>
    </li>

    <li class="menu-item">
      <a href="javascript:void(0)" class="menu-link menu-toggle">
        <i class="menu-icon tf-icons bx bx-box"></i>
        <div>Pembayaran</div>
      </a>

      <ul class="menu-sub">
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div>Daftar Pembayaran</div>
          </a>
        </li>
        <li class="menu-item">
          <a href="#" class="menu-link">
            <div>Verifikasi Pembayaran</div>
          </a>
        </li>
      </ul>
    </li>

  </ul>
</aside>
