@extends('_layouts.app')

@section('title', 'Perpanjangan Buku')

@section('content')
	
	<div class="row">
		<div class="col-sm-5 mb-4">
			<div class="card shadow">
				<livewire:loan.extend-search />
			</div>
		</div>
		<div class="col-sm-7">
			<div class="card shadow">
				<livewire:loan.extend-form />
			</div>
		</div>
	</div>


@endsection