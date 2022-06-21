<div class="row">
  <div class="col">
    <h4 class="my-4">Facturas Emitidas</h4>

    <table class="table table-striped table-responsive">
      <thead class="thead-inverse">
        <tr>
          <th>Cliente</th>
          <th class="text-end">Subtotal</th>
          <th class="text-end">Impuesto</th>
          <th class="text-end">Total</th>
          <th></th>
        </tr>
      </thead>
      @if (!count($invoices))
      <tbody>
        <tr>
          <th colspan="5" class="text-center">Aún no hay facturaras generadas</th>
        </tr>
      </tbody>
      @endif
      <tbody>
        @foreach ($invoices as $invoice)
        <tr>
          <td>{{ $invoice->user->name }}</td>
          <td class="text-end">${{ number_format($invoice->subtotal, 2, '.', ',') }}</td>
          <td class="text-end">${{ number_format($invoice->tax, 2, '.', ',') }}</td>
          <td class="text-end">${{ number_format($invoice->total, 2, '.', ',') }}</td>
          <td class="text-end">
            <a class="btn btn-success btn-sm" href="{{ route('dashboard.invoice', ['invoice' => $invoice->id]) }}">Detalle</a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="row justify-content-center">
      <div class="col-auto">
        {{ $invoices->links() }}
      </div>
    </div>
  </div>
</div>
