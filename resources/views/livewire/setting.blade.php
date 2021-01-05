<div class="col-sm-6 mx-auto">
	@if (session()->has('success'))
		<div class="alert alert-success alert-dismissible">
		  <span>{{ session('success' )}}</span>
		  <button class="close" data-dismiss="alert">&times;</button>
		</div>
	@endif
	<div class="card shadow">
	<form wire:submit.prevent="save">
		@csrf
		<div class="card-header py-3">
			<h2 class="h6 m-0 font-weight-bold text-primary">Pengaturan</h2>
		</div>
		<div class="card-body">
			<div class="form-group">
				<label>Nama Aplikasi</label>
				<input type="text" class="form-control @error('setting.name') is-invalid @enderror" wire:model="setting.name" placeholder="Nama Aplikasi" autofocus>

				@error('setting.name')
					<span class="invalid-feedback">{{ $message }}</span>
				@enderror
			</div>
			<div class="form-group">
				<label>Nominal Denda (Per Hari)</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<span class="input-group-text">Rp</span>
					</div>
					<input type="text" class="form-control @error('setting.fine') is-invalid @enderror" wire:model="setting.fine" placeholder="Denda">

					@error('setting.fine')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>
		</div>
		<div class="card-footer">
			<button class="btn btn-primary shadow" type="submit">Simpan</button>
			<a href="{{ route('member.index') }}" class="btn btn-secondary shadow">Batal</a>
		</div>
	</form>
	</div>
</div>