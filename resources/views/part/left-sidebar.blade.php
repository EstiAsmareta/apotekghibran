<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-solid fa-notes-medical"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Apotek Ghibran <sup></sup></div>
    </a>

    <br>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="dashboard">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    @if(auth()->user()->can('create role'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('manajemen_user.index')}}">
            <i class="fas fa-solid fa-users"></i>
            <span>Manajemen User</span></a>
    </li>
	
	 <li class="nav-item">
        <a class="nav-link" href="{{ route('obat.index')}}">
            <i class="fas  fa-fw fa-regular fa-capsules"></i>
            <span>Manajemen Obat</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="{{ route('rak.index')}}">
            <i class="fas fa-solid fa-inbox"></i>
            <span>Manajemen Rak</span></a>
    </li>
	@else
		<li class="nav-item">
        <a class="nav-link" href="{{ route('transaksi.baru')}}">
            <i class="fas fa-shopping-cart"></i>
            <span>Transaksi</span></a>
    </li>
    @endif

    @if(auth()->user()->can('create role'))
    <li class="nav-item">
        <a class="nav-link" href="{{ route('laporan.index')}}">
            <i class="far fa-file-alt"></i>
            <span>Laporan</span></a>
    </li>

    @endif





    <!-- Divider -->
    <hr class="sidebar-divider">




    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
