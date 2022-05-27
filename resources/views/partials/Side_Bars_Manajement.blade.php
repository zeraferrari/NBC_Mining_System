<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}">Yudora</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="">Yo</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main Dashboard</li>
            <li class="{{ ($title === 'Manajement Main Dashboard') ? 'active' : '' }}"><a href="{{ route('Manajement.Dashboard.index') }}" class="nav-link"><i class="fas fa-chart-bar"></i><span>Dashboard</span></a></li>
            <li class="{{ ($title === 'Main Naive Bayes Dashboard') ? 'active' : '' }}"><a href="{{ route('Manajement.NBC_Dashboard.index') }}" class="nav-link"><i class="fab fa-react"></i><span>Naive Bayes Dashboard</span></a></li>

        @role('Administrator')
            <li class="menu-header">Manajement</li>
            <li class="nav-item dropdown @if($title === 'Manajement Dashboard Role' OR $title === 'Manajement Dashboard Hak Akses' OR $title === 'Manajement Dashboard Rhesus' OR $title === 'Manajement Dashboard User' OR $title === 'Manajement Dashboard Data Training' OR $title === 'Manajement Dashboard Data Testing') active @endif">
                <a href="" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ ($title === 'Manajement Dashboard Role') ? 'active' : '' }}"><a href="{{ route('Manajement.Roles.index') }}" class="nav-link"><i class="fas fa-id-badge"></i>Role</a></li>
                    <li class="{{ ($title === 'Manajement Dashboard Hak Akses') ? 'active' : '' }}"><a href="{{ route('Manajement.Permissions.index') }}" class="nav-link"><i class="fas fa-user-check"></i>Hak Akses</a></li>
                    <li class="{{ ($title === 'Manajement Dashboard Rhesus') ? 'active' : '' }}"><a href="{{ route('Manajement.Rhesus.index') }}" class="nav-link"><i class="fas fa-tint"></i>Kategori Rhesus</a></li>
                    <li class="{{ ($title === 'Manajement Dashboard User') ? 'active' : '' }}"><a href="{{ route('Manajement.Users.index') }}" class="nav-link"><i class="fas fa-users"></i>User</a></li>
                    <li class="{{ ($title === 'Manajement Dashboard Data Training') ? 'active' : '' }}"><a href="{{ route('Manajement.DataTrainings.index') }}" class="nav-link"><i class="fas fa-database"></i>Data Training</a></li>
                    <li class="{{ ($title === 'Manajement Dashboard Data Testing') ? 'active' : '' }}"><a href="{{ route('Manajement.DataTestings.index') }}" class="nav-link"><i class="fas fa-database"></i>Data Testing</a></li>
                </ul>
            </li>
        @endrole
            <li class="menu-header">Pelayanan</li>
        @role('Petugas Medis|Administrator')
            <li class="{{ ($title === 'Manajement Antrian Donor Darah') ? 'active' : '' }}"><a href="{{ route('Manajement.Transaction.index') }}" class="nav-link"><i class="fas fa-user-friends"></i><span>Antrian Transaksi Donor</span></a></li>    
            <li class="{{ ($title === 'Manajement Hasil Transaksi Donor') ? 'active' : '' }}"><a href="{{ route('Manajement.Hasil_Transaksi_Donor.index') }}" class="nav-link"><i class="fas fa-file-alt"></i><span>Hasil Klasifikasi Donor</span></a></li>
        @endrole
        </ul>
    </aside>
</div>