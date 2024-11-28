<style>
    /* Styling untuk sidebar */
    #sidebarMenu {
        background-color: #f8f9fa; /* Warna latar belakang sidebar */
        border-right: 1px solid #dee2e6; /* Batas kanan sidebar */
    }

    #sidebarMenu .nav-link {
        color: #495057; /* Warna teks nav-link */
    }

    #sidebarMenu .nav-link.active {
        color: #007bff; /* Warna teks nav-link aktif */
        background-color: #e9ecef; /* Warna latar belakang nav-link aktif */
    }

    #sidebarMenu .dropdown-menu {
        background-color: #f8f9fa; /* Warna latar belakang dropdown menu */
    }

    #sidebarMenu .dropdown-item {
        color: #495057; /* Warna teks dropdown item */
    }

    #sidebarMenu .dropdown-item:hover {
        background-color: #e9ecef; /* Warna latar belakang dropdown item saat hover */
    }

    #sidebarMenu .nav-link span {
        margin-right: 8px; /* Spasi antara ikon dan teks */
    }

</style>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <x-nav-link class="nav-link" href="/dashboard" :active="request()->is('dashboard')">
                    <span data-feather="bar-chart-2"></span>
                    Dashboard
                </x-nav-link>
            </li>
            <li class="nav-item">
                <x-nav-link class="nav-link" href="/karyawan" :active="request()->is('karyawan')">
                    <span data-feather="users"></span>
                    Karyawan
                </x-nav-link>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="gajiKaryawanDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span data-feather="briefcase"></span>
                    Gaji Karyawan
                </a>
                <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="gajiKaryawanDropdown">
                    <li>
                        <x-nav-link class="dropdown-item" href="/jabatan" :active="request()->is('jabatan')">
                            <span data-feather="briefcase"></span>
                            Jabatan
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link class="dropdown-item" href="/gaji" :active="request()->is('gaji')">
                            <span data-feather="dollar-sign"></span>
                            Gaji Karyawan
                        </x-nav-link>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <x-nav-link class="nav-link" href="/slipgaji" :active="request()->is('slipgaji')">
                    <span data-feather="users"></span>
                    Slip Gaji
                </x-nav-link>
            </li>
        </ul>
    </div>
</nav>

@push('myscript')
<script>
    feather.replace();
</script>

@endpush