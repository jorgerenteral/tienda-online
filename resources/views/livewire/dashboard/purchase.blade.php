<form wire:submit.prevent="submit" class="row justify-content-center p-5">
  <div class="col-lg-5">
    <div class="row">
      <div class="col">
        <h1 class="h5 text-center">Elige un Producto para comprar</h1>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <div class="mt-3">
          <label for="product" class="form-label">Producto</label>
          <select wire:model="product_id" class="form-select" name="product" id="product">
            <option>Elige un Producto</option>

            @foreach ($products as $product)
            <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
          </select>
          @error('product_id') <small class="d-block px-2 text-danger">{{ $message }}</small> @enderror
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col mt-2 text-center">
        <button type="submit" class="btn btn-success">Comprar</button>
      </div>
    </div>

    @if($success)
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      {{ $success }}
      <button type="button" class="btn-close" aria-label="Close" wire:click="resetSuccess"></button>
    </div>
    @endif

    @if($warning)
    <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
      {{ $warning }}
      <button type="button" class="btn btn-warning ms-auto" aria-label="Close" wire:click="forcePurchase">Si</button>
    </div>
    @endif
  </div>
</form>
