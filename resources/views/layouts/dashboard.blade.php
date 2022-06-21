<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Tienda Online | Panel de Administración</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  @livewireStyles
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col">
        @if (request()->user()->type === 'admin')
        @livewire('dashboard.type.admin')
        @else
        @livewire('dashboard.type.client')
        @endif
      </div>
    </div>

    <div class="row">
      <div class="col">
        {{ $slot }}
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  <script src="//unpkg.com/alpinejs" defer></script>
  @livewireScripts

  @if (request()->user()->type === 'admin')
  <script>
    const addProductModalElement = document.getElementById('add-product-modal')
    const editProductModalElement = document.getElementById('edit-product-modal')

    if (addProductModalElement) {
      const addProductModal = new bootstrap.Modal(addProductModalElement)

      window.livewire.on('addProduct', () => {
        addProductModal.show()
      });

      window.livewire.on('productCreated', () => {
        addProductModal.hide()
      });
    }

    if (editProductModalElement) {
      const editProductModal = new bootstrap.Modal(editProductModalElement)

      window.livewire.on('editProduct', () => {
        editProductModal.show()
      });

      window.livewire.on('productUpdated', () => {
        editProductModal.hide()
      });
    }

  </script>
  @endif
</body>

</html>
