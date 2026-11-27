<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: var(--pressing-teal);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('orders.index') }}">
            <span class="d-inline-flex align-items-center justify-content-center rounded-2 bg-white p-1" style="width: 34px; height: 34px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#3B182D" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M12 6a2 2 0 1 0-2-2" />
                    <path d="M12 6v2l8.5 5.5A1.5 1.5 0 0 1 19.7 16H4.3a1.5 1.5 0 0 1-.8-2.5L12 8Z" />
                    <path d="M18 4l.5 1.5L20 6l-1.5.5L18 8l-.5-1.5L16 6l1.5-.5L18 4Z" />
                </svg>
            </span>
            <span>Pressing Manager</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Afficher le menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 gap-1">
                <li class="nav-item">
                    <a class="nav-link px-3 rounded text-white {{ request()->routeIs('customers.*') ? 'active fw-semibold' : '' }}"
                       @if(request()->routeIs('customers.*')) style="background-color: var(--pressing-violet);" @endif
                       href="{{ route('customers.index') }}">
                        Clients
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 rounded text-white {{ request()->routeIs('orders.*') ? 'active fw-semibold' : '' }}"
                       @if(request()->routeIs('orders.*')) style="background-color: var(--pressing-violet);" @endif
                       href="{{ route('orders.index') }}">
                        Commandes
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 rounded text-white {{ request()->routeIs('items.*') ? 'active fw-semibold' : '' }}"
                       @if(request()->routeIs('items.*')) style="background-color: var(--pressing-violet);" @endif
                       href="{{ route('items.index') }}">
                        Vêtements
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 rounded text-white {{ request()->routeIs('services.*') ? 'active fw-semibold' : '' }}"
                       @if(request()->routeIs('services.*')) style="background-color: var(--pressing-violet);" @endif
                       href="{{ route('services.index') }}">
                        Mes Services
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-3 rounded text-white {{ request()->routeIs('payments.*') ? 'active fw-semibold' : '' }}"
                       @if(request()->routeIs('payments.*')) style="background-color: var(--pressing-violet);" @endif
                       href="{{ route('payments.index') }}">
                        Paiements
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-medium" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mon Profil
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="#">Paramètres</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="#">Déconnexion</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div style="height: 4px; background-color: var(--pressing-violet); width: 100%;"></div>