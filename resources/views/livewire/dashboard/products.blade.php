<div class="row">
  <div class="col">
    <h4 class="my-4">
      <div class="row align-items-center">
        <div class="col-auto">
          Productos
        </div>

        <div class="col text-end">
          <button class="btn btn-success  btn-sm" type="button" wire:click="addProduct">
            Crear Producto
          </button>
        </div>
      </div>
    </h4>

    @if ($success)
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      {{ $success }}
      <button type="button" class="btn-close" aria-label="Close" wire:click="resetSuccess"></button>
    </div>
    @endif

    <div class="row">
      <div class="col">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Descripción</th>
              <th class="text-end">Impuesto</th>
              <th class="text-end">Precio (Impuesto Incluido)</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
            <tr>
              <td>{{ $product->name }}</td>
              <td>{{ $product->description ?? 'N/D' }}</td>
              <td class="text-end">{{ number_format($product->tax, 2, '.', ',') }}%</td>
              <td class="text-end">${{ number_format($product->price, 2, '.', ',') }}</td>
              <td class="text-end">
                <button class="btn btn-danger btn-sm" wire:click="deleteProduct({{ $product->id }})">Eliminar</button>
                <button class="btn btn-success btn-sm" wire:click="editProduct({{ $product->id }})">Editar</button>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-auto">
        {{ $products->links() }}
      </div>
    </div>
  </div>

  <!-- Add Product Modal -->
  <div wire:ignore.self class="modal fade" id="add-product-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form wire:submit.prevent="createProduct" class="modal-dialog modal-sm modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header bg-success text-white">
          <h5 class="modal-title">Agregar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="form-floating">
                <input wire:model.debounce.500ms="name" type="name" class="form-control" id="addProductName" placeholder="ej. PC">
                <label for="addProductName">Nombre</label>
              </div>
              @error('name') <small class="d-block px-2 text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mt-3">
            <div class="col">
              <div class="form-floating">
                <input wire:model.debounce.500ms="price" type="number" class="form-control" id="addProductPrice" placeholder="ej. PC">
                <label for="addProductPrice">Precio (impuesto incluido)</label>
              </div>
              @error('price') <small class="d-block px-2 text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mt-3">
            <div class="col">
              <div class="form-floating">
                <input wire:model.debounce.500ms="tax" type="number" class="form-control" id="addProductTax" placeholder="ej. PC">
                <label for="addProductTax">Impuesto (tasa %)</label>
              </div>
              @error('tax') <small class="d-block px-2 text-danger">{{ $message }}</small> @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="submimt" class="btn btn-success">Guardar</button>
        </div>
      </div>
    </form>
  </div>

  <!-- Edit Product Modal -->
  <div wire:ignore.self class="modal fade" id="edit-product-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form wire:submit.prevent="updateProduct({{ $updateId }})" class="modal-dialog modal-sm modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header bg-info text-white">
          <h5 class="modal-title">Editar Producto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col">
              <div class="form-floating">
                <input wire:model.debounce.500ms="name" type="name" class="form-control" id="editProductName" placeholder="ej. PC">
                <label for="editProductName">Nombre</label>
              </div>
              @error('name') <small class="d-block px-2 text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mt-3">
            <div class="col">
              <div class="form-floating">
                <input wire:model.debounce.500ms="price" type="number" class="form-control" id="editProductPrice" placeholder="ej. PC">
                <label for="editProductPrice">Precio (impuesto incluido)</label>
              </div>
              @error('price') <small class="d-block px-2 text-danger">{{ $message }}</small> @enderror
            </div>
          </div>

          <div class="row mt-3">
            <div class="col">
              <div class="form-floating">
                <input wire:model.debounce.500ms="tax" type="number" class="form-control" id="editProductTax" placeholder="ej. PC">
                <label for="editProductTax">Impuesto (tasa %)</label>
              </div>
              @error('tax') <small class="d-block px-2 text-danger">{{ $message }}</small> @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
          <button type="submimt" class="btn btn-success">Guardar</button>
        </div>
      </div>
    </form>
  </div>

</div>
