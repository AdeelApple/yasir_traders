				@php ($cols = 5)
				<thead>
					<tr>
						<th>Sr.</th>
						<th>Saleman</th>
						<th>Spend Amount</th>
						<th>Description</th>
						<th>Spend At</th>
					</tr>
				</thead>
				<tbody>
					@forelse($data as $it)
					<tr>
						<td>{{ $it->id }}</td>
						<td>{{ $it->saleMan->name }}</td>
						<td>{{ $it->amount }}</td>
						<td>{{ $it->description }}</td>
						<td>{{ $it->showdate() }}</td>
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