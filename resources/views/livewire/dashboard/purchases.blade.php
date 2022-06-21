<div class="row">
  <div class="col">
    <h4 class="my-4">Compras por Facturar</h4>

    @if($success)
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
      {{ $success }}
      <button type="button" class="btn-close" aria-label="Close" wire:click="resetSuccess"></button>
    </div>
    @endif


    <table class="table table-striped table-responsive">
      <thead class="thead-inverse">
        <tr>
          <th>Cliente</th>
          <th class="text-center">Compras por Facturar</th>
          <th></th>
        </tr>
      </thead>
      @if (!count($clients))
      <tbody>
        <tr>
          <th colspan="3" class="text-center">Aún no hay compras por facturar</th>
        </tr>
      </tbody>
      @endif
      @foreach ($clients as $client)
      <tbody x-data="{ details: false }">
        <tr>
          <td>{{ $client->name }}</td>
          <td class="text-center">{{ $client->purchases->count() }}</td>
          <td class="text-end">
            <button class="btn btn-primary btn-sm" x-on:click="details = !details">
              <span x-show="details">
                Ocultar Compras
              </span>
              <span x-show="!details">
                Mostrar Compras
              </span>
            </button>
            <button class="btn btn-success btn-sm" wire:click="invoice({{ $client->id }})">
              Facturar
            </button>
          </td>
        </tr>
        <tr x-show="details">

          <td colspan="3" x-data="{subtotal: 0, tax: 0, total: 0}">
            <table class="table table-sm table-striped">
              <thead>
                <tr>
                  <th>Producto</th>
                  <th class="text-end">Subtotal</th>
                  <th class="text-end">Impuesto</th>
                  <th class="text-end">Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($client->purchases as $purchase)
                <tr x-init="
                  subtotal = parseFloat((subtotal + {{ $purchase->product->price - $purchase->product->tax_charged }}).toFixed(2));
                  tax = parseFloat((tax + {{ $purchase->product->tax_charged }}).toFixed(2));
                  total = parseFloat((total + {{ $purchase->product->price }}).toFixed(2));
                ">
                  <td>{{ $purchase->product->name }}</td>
                  <td class="text-end">${{ number_format($purchase->product->price - $purchase->product->tax_charged, 2, '.', ',') }}</td>
                  <td class="text-end">
                    <small>
                      <strong>(Tasa {{ $purchase->product->tax }}%)</strong>
                    </small> ${{ number_format($purchase->product->tax_charged, 2, '.', ',') }}</td>
                  <td class="text-end">${{ number_format($purchase->product->price, 2, '.', ',') }}</td>
                </tr>
                @endforeach
                <tr>
                  <td class="text-end"></td>
                  <td class="text-end">
                    <strong>
                      $<span x-text="subtotal"></span>
                    </strong>
                  </td>
                  <td class="text-end">
                    <strong>
                      $<span x-text="tax"></span>
                    </strong>
                  </td>
                  <td class="text-end">
                    <strong>
                      $<span x-text="total"></span>
                    </strong>
                  </td>
                </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
      @endforeach
    </table>

    <div class="row justify-content-center">
      <div class="col-auto">
        {{ $clients->links() }}
      </div>
    </div>
  </div>
</div>
