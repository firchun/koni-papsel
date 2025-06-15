<div class="btn-group">
    <a class="btn btn-sm btn-primary" href="{{ route('atlet.detail', $Atlet->id) }}">Detail</a>
    @if (Auth::user()->role == 'Operator')
        <button class="btn btn-sm btn-danger " onclick="deleteCustomers({{ $Atlet->id }})">Batalkan</button>
    @endif
</div>
