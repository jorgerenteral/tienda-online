<div class="row">
  <div class="col">
    <nav class="navbar navbar-expand-lg bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Tienda Online</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard.products') }}">Productos</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard.purchases') }}">Compras</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="{{ route('dashboard.invoices') }}">Facturas</a>
            </li>
          </ul>

          <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <button class="btn btn-danger ms-auto" wire:click.prevent="logout">Salir</button>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>
