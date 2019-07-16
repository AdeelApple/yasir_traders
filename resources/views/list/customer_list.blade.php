@extends('layouts.main')

	@section('title','Customers List')
	@section('content')

		
	<div class="row">
		<div class="col">
			<h5>Customers List</h5>	
		</div>
	</div>
	<div class="row">
		<div class="col">
			<input type="text" class="form-control form-control-sm">	
		</div>
	</div>
	<div class="row">
		<div class="col">
			<table class="table table-sm table-hover">
				<thead>
					<tr>
						<th>Sr.</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Balance</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $it)
					<tr>
						<td>{{ $it->id }}</td>
						<td>{{ $it->name }}</td>
						<td>{{ $it->phone }}</td>
						<td>{{ $it->balance }}</td>
						<td>{{ $it->created_at }}</td>
					</tr>
					@endforeach
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3">{{ $data->links() }}</td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>



	@endsection