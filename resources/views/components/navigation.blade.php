<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: var(--pressing-teal);">
    <div class="container">
        
        <a class="navbar-brand fw-bold" href="{{ route('customers.index') }}">
            👔 Pressing Manager
        </a>
        
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        
       
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                   
                    <a class="nav-link active px-3 rounded text-white" style="background-color: var(--pressing-violet);" href="{{ route('customers.index') }}">
                        Clients
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Commandes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Vetements</a>
                </li>
                <li class="nav-item">
                    <a href="nav-link text-white" href="#">Mes Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#">Paiements</a>
                </li>
            </ul>
        
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white fw-medium" href="#" role="button" data-bs-toggle="dropdown">
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