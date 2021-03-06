				@php ($cols = 7)
				<thead>
					<tr>
						<th>Sr.</th>
						<th>Name</th>
						<th>Phone</th>
						<th>Target</th>
						<th>Date</th>
						<th class="d-print-none">Edit</th>
						<th class="d-print-none">Del</th>
					</tr>
				</thead>
				<tbody>
					@forelse($data as $it)
					<tr>
						<td>{{ $it->id }}</td>
						<td><a href="/orderbooker/{{ $it->id }}">{{ $it->name }}</a></td>
						<td>{{ $it->phone }}</td>
						<td>{{ $it->target }}</td>
						<td>{{ $it->showdate() }}</td>
						<td class="d-print-none"><a href="/orderbooker/{{ $it->id }}/edit" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a></td>
						<td class="d-print-none"><button class="btn btn-danger btn-sm" onclick="deleteOrderbooker(this,{{ $it->id }})"><i class="fa fa-trash"></i></button></td>
					</tr>
					@empty
					<tr>
						<td colspan="{{$cols}}" class="text-danger text-center">No Record Found</td>
					</tr>
					@endforelse
				</tbody>
				<tfoot>
					<tr>
						<td colspan="{{$cols}}">{{ $data->links() }}</td>
					</tr>
				</tfoot>