<div class="row p-5" x-data="{subtotal: 0, total: 0, tax: 0}">
  <div class="col">

    <div class="row">
      <div class="col">
        <p class="mb-0">Cliente</p>
        <h1 class="h2">{{ $invoice->user->name }}</h1>
        <p class="mb-0">Fecha de Facturación</p>
        <h1 class="h3">{{ $invoice->created_at->locale('es')->translatedFormat('D, j \\de M \\de Y') }}</h1>
        <h1 class="h3 mt-4">Desglose</h1>
      </div>
    </div>

    <div class="row">
      <div class="col">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Producto</th>
              <th class="text-center">Fecha de Compra</th>
              <th class="text-end">Subtotal</th>
              <th class="text-end">Impuesto</th>
              <th class="text-end">Total</th>
            </tr>
          </thead>
          <tbody>
            @php
            $purchases = $invoice->purchase_invoices->sortByDesc('purchase.created_at');
            @endphp
            @foreach ($purchases as $item)
            <tr x-init="
                  subtotal = parseFloat((subtotal + {{ $item->purchase->product->price - $item->purchase->product->tax_charged }}).toFixed(2));
                  tax = parseFloat((tax + {{ $item->purchase->product->tax_charged }}).toFixed(2));
                  total = parseFloat((total + {{ $item->purchase->product->price }}).toFixed(2));
                ">
              <td>{{ $item->purchase->product->name }}</td>
              <td class="text-center">{{ $item->purchase->created_at->locale('es')->translatedFormat('D, j \\de M \\de Y') }}</td>
              <td class="text-end">${{ number_format($item->purchase->product->price - $item->purchase->product->tax_charged, 2, '.', ',') }}</td>
              <td class="text-end">
                <small>
                  <strong>(Tasa {{ $item->purchase->product->tax }}%)</strong>
                </small> ${{ number_format($item->purchase->product->tax_charged, 2, '.', ',') }}</td>
              <td class="text-end">${{ number_format($item->purchase->product->price, 2, '.', ',') }}</td>
            </tr>
            @endforeach
            <tr>
              <td class="text-end" colspan="4">
                <strong>Subtotal</strong>
              </td>
              <td class="text-end">
                <strong>
                  $<span x-text="subtotal"></span>
                </strong>
              </td>
            </tr>
            <tr>
              <td class="text-end" colspan="4">
                <strong>Impuesto Cobrado</strong>
              </td>
              <td class="text-end">
                <strong>
                  $<span x-text="tax"></span>
                </strong>
              </td>
            </tr>
            <tr>
              <td class="text-end" colspan="4">
                <strong>Total</strong>
              </td>

              <td class="text-end">
                <strong>
                  $<span x-text="total"></span>
                </strong>
              </td>
            </tr>
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
