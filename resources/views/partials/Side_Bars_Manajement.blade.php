<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">Yudora</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">Yo</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main Dashboard</li>
            <li><a href="" class="nav-link"><i class="fas fa-chart-bar"></i><span>Dashboard</span></a></li>
            <li><a href="" class="nav-link"><i class="fab fa-react"></i><span>Naive Bayes Dashboard</span></a></li>

        
            <li class="menu-header">Manajement</li>
            <li class="nav-item dropdown active">
                <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ ($title === 'Manajement Dashboard Role') ? 'active' : '' }}"><a href="{{ route('Manajement.Roles.index') }}" class="nav-link"><i class="fas fa-id-badge"></i>Role</a></li>
                    <li class="{{ ($title === 'Manajement Dashboard Hak Akses') ? 'active' : '' }}"><a href="{{ route('permission.index') }}" class="nav-link"><i class="fas fa-user-check"></i>Permission</a></li>
                    <li class="{{ ($title === 'Manajement Dashboard Rhesus') ? 'active' : '' }}"><a href="" class="nav-link"><i class="fas fa-tint"></i>Kategori Rhesus</a></li>
                    <li class="{{ ($title === 'Manajement Dashboard User') ? 'active' : '' }}"><a href="" class="nav-link"><i class="fas fa-users"></i>User</a></li>
                    <li class="{{ ($title === 'Manajement Dashboard Data Training') ? 'active' : '' }}"><a href="" class="nav-link"><i class="fas fa-database"></i>Data Training</a></li>
                </ul>
            </li>

            <li class="menu-header">Pelayanan</li>
            <li><a href="" class="nav-link"><i class="fas fa-user-friends"></i><span>Antrian Donor Darah</span></a></li>
            <li><a href="" class="nav-link"><i class="fas fa-money-check"></i><span>Transaksi Donor Darah</span></a></li>
            <li><a href="" class="nav-link"><i class="fas fa-file-alt"></i><span>Hasil Klasifikasi</span></a></li>
        </ul>
    </aside>
</div>