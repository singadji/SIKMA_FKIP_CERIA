<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar-brand-box">
                <a href="/dashboard" class="logo logo-dark">
                    <span class="logo-sm">SIKMA</span>
                    <span class="logo-lg">SIKMA FKIP CERIA</span>
                </a>
            </div>
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item" ata-bs-toggle="dropdown">
                    {{ auth()->user()->name ?? 'Administrator' }}
                </button>
            </div>
        </div>
    </div>
</header>
