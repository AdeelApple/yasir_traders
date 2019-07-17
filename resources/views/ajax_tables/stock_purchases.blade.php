				@php ($cols = 8)
				<thead>
					<tr>
						<th>Sr.</th>
						<th>Product</th>
						<th>QTY</th>
						<th>Company</th>
						<th>Purchase</th>
						<th>Sale</th>
						<th>Total</th>
						<th>Date</th>
					</tr>
				</thead>
				<tbody>
					
					@forelse($data as $it)
					<tr>
						<td>{{ $it->inventory_id }}</td>
						<td>{{ $it->product }}</td>
						<td>{{ $it->qty }}</td>
						<td>{{ $it->company }}</td>
						<td>{{ $it->unit_purchase }}</td>
						<td>{{ $it->unit_sale }}</td>
						<td>{{ $it->total_purchase }}</td>
						<td>{{ date('d-M-Y',strtotime($it->created_at)) }}</td>
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
				