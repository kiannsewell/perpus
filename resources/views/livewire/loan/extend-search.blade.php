<form wire:submit.prevent="search">
	@csrf
	<div class="card-header py-3">
		<h2 class="h6 m-0 font-weight-bold text-primary">Pengembalian Buku</h2>
	</div>
	<div class="card-body">
		<div class="form-group">
			<label>Kode Buku</label>
			<input type="text" class="form-control @error('code') is-invalid @enderror" wire:model="code" placeholder="Masukan Kode Buku" autofocus>

			@error('code')
				<span class="invalid-feedback">{{ $message }}</span>
			@enderror
		</div>
		<button class="btn btn-primary shadow" type="submit">Cari</button>
	</div>
</form>