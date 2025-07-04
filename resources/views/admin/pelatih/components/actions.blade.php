<div class="btn-group">
    <a class="btn btn-sm btn-primary" href="{{ route('pelatih.detail', $Atlet->id) }}">Detail</a>
    @if (Auth::user()->role == 'Operator' && $Atlet->status != 'Distujui')
        <button class="btn btn-sm btn-danger " onclick="deleteCustomers({{ $Atlet->id }})">Batalkan</button>
    @endif
</div>
