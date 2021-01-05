@extends('_layouts.app')

@section('title', 'Pengembalian Buku')

@section('content')
	
	<div class="row">
		<div class="col-sm-5 mb-4">
			<div class="card shadow">
				<livewire:loan.return-search />
			</div>
		</div>
		<div class="col-sm-7">
			<div class="card shadow">
				<livewire:loan.return-form />
			</div>
		</div>
	</div>


@endsection