@extends('_layouts.app')

@section('title', 'Peminjaman Baru')

@section('content')
	
	<div class="col-md-9 col-lg-6 mx-auto">
		<div class="card shadow">
		<form action="{{ route('loan.store') }}" method="post" enctype="multipart/form-data">
			@csrf
			<div class="card-header py-3">
				<h2 class="h6 m-0 font-weight-bold text-primary">Peminjaman Baru</h2>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>Kode Buku</label>
					<select class="form-control custom-select @error('book_id') is-invalid @enderror" name="book_id"></select>

					@error('book_id')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label>Judul Buku</label>
					<input type="text" class="form-control" placeholder="Judul Buku" name="title" disabled>
				</div>
				<div class="form-group">
					<label>Tanggal Pinjam</label>
					<input type="date" class="form-control @error('create_date') is-invalid @enderror" name="create_date" value="{{ date('Y-m-d') }}" placeholder="Tanggal Pinjam">

					@error('create_date')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label>Tanggal Kembali</label>
					<input type="date" class="form-control @error('return_date') is-invalid @enderror" name="return_date" value="{{ old('return_date') }}" placeholder="Tanggal Kembali">

					@error('return_date')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label>Anggota</label>
					<select class="form-control custom-select @error('member_id') is-invalid @enderror" name="member_id"></select>

					@error('member_id')
						<span class="invalid-feedback">{{ $message }}</span>
					@enderror
				</div>
			</div>
			<div class="card-footer">
				<button class="btn btn-primary shadow" type="submit">Tambah</button>
				<a href="{{ route('loan.index') }}" class="btn btn-secondary shadow">Batal</a>
			</div>
		</form>
		</div>
	</div>

@endsection

@push('css')
	<link rel="stylesheet" href="{{ asset('sbadmin/vendor/select2/css/select2.min.css') }}">
@endpush

@push('js')
	<script src="{{ asset('sbadmin/vendor/select2/js/select2.min.js') }}"></script>
	<script>
		$(function () {
			$('[name=book_id]').select2({
				placeholder: 'Kode Buku',
				ajax: {
					url: '{{ route('book.search') }}',
					type: 'post',
					data: params => ({
						code: params.term,
						_token: '{{ csrf_token() }}'
					}),
					processResults: res => ({
						results: res
					}),
					cache: true
				}
			})
			$('[name=member_id]').select2({
				placeholder: 'Anggota',
				ajax: {
					url: '{{ route('member.search') }}',
					type: 'post',
					data: params => ({
						name: params.term,
						_token: '{{ csrf_token() }}'
					}),
					processResults: res => ({
						results: res
					}),
					cache: true
				}
			})
			$('[name=book_id]').on('select2:select', function (e) {
				const title = e.params.data.title

				$('[name=title]').val(title)
			})
		})
	</script>
@endpush