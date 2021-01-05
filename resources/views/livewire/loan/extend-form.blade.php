<form wire:submit.prevent="extendBook">
	@csrf
	<div class="card-header py-3">
		<h2 class="h6 m-0 font-weight-bold text-primary">Data Peminjaman</h2>
	</div>
	<div class="card-body">
		<div class="form-group">
			<label>Judul Buku</label>
			<input type="text" class="form-control" placeholder="Judul Buku" value="{{ $loan ? $loan->book->title : '' }}" disabled>
		</div>
		<div class="form-group">
			<label>Peminjam</label>
			<input type="text" class="form-control" placeholder="Peminjam" value="{{ $loan ? $loan->member->name : '' }}" disabled>
		</div>
		<div class="form-row">
			<div class="col-sm-6">
				<div class="form-group">
					<label>Tanggal Kembali</label>
					<input type="text" class="form-control" placeholder="Tanggal Kembali" value="{{ $loan ? $loan->return_local : '' }}" disabled>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					<label>Terlambat</label>
					<input type="text" class="form-control" placeholder="Terlambat" value="@isset ($late){{ $late }} Hari @endisset" disabled>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label>Perpanjang Hingga</label>
			<input type="date" class="form-control @error('extend') is-invalid @enderror" placeholder="Perpanjang Hingga" wire:model="extend">

			@error('extend')
				<span class="invalid-feedback">{{ $message }}</span>
			@enderror
		</div>
	</div>
	<div class="card-footer">
		<button class="btn btn-primary shadow submit" type="submit">Perpanjang</button>
		<a href="{{ route('loan.index') }}" class="btn btn-secondary shadow">Batal</a>
	</div>
</form>

@push('js')
	<script>
		document.querySelector('.submit').disabled = true;
	</script>
@endpush