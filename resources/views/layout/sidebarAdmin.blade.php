
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="/Admin/index">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    
                    <div class="sb-sidenav-menu-heading">Menus</div>
                    <a class="nav-link" href="/adm/siswabaru">
                        <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                        Siswa Baru
                    </a>
                    <a class="nav-link" href="/adm/dataskelas">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Data Kelas 
                    </a>

                      <a class="nav-link" href="/adm/dataguru">
                        <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                        Data Guru
                    </a>


                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                {{Auth::user()->name}}
            </div>
        </nav>
    </div>