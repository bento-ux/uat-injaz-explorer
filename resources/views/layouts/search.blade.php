<form method="GET" action="{{ url('/search-proses') }}">
    @csrf
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Cari Campaign / Token / Txn Hash">
        <div class="input-group-append">
            <button class="btn btn-primary rounded-1" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>
