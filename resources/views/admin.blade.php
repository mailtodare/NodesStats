@extends('layouts.app')

@section('content')
<div class="container mt-5">
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">Log Time</th>
                    <th scope="col">Node Name</th>
                    <th scope="col">Used Ram</th>
                    <th scope="col">Allocated Ram</th>
                    <th scope="col">Total Ram</th>
                    <th scope="col">Used Disk</th>
                    <th scope="col">Allocated Disk</th>
                    <th scope="col">Total Disk</th>                
                </tr>
            </thead>
            <tbody>
                @foreach($node_stats as $data)
                <tr>
                    <th scope="row">{{$data->created_at->format('H:i:s')  }}</th>
                    <td>{{ $data->node->node_name }}</td>
                    <td>{{ $data->ram_used }}</td>
                    <td>{{ $data->node->allocated_ram }}</td>
                    <td>{{ $data->node->total_ram }}</td>
                    <td>{{ $data->disk_used }}</td>
                    <td>{{ $data->node->allocated_disk }}</td>
                    <td>{{ $data->node->total_disk }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {!! $node_stats->appends(['sort' => 'created_at'])->links() !!}
        </div>
    </div>
    </div>
@endsection    