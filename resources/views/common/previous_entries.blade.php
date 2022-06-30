 @if (count($node_stats) > 0)
            <table class="table table-striped task-table">
                <thead>
                    <th>{{__('Log Time')}}</th>
                    <th>{{__('Comment')}}</th>
                    <th>{{__('Used Ram')}}</th>
                    <th>{{__('Used Disk')}}</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($node_stats as $stat)
                        <tr>
                            <td class="table-text"><div>{{ $stat->created_at->format('H:i:s')  }}</div></td>
                            <td class="table-text"><div>{{ $stat->comment }}</div></td>
                            <td class="table-text"><div>{{ $stat->ram_used }}</div></td>                                            
                            <td class="table-text"><div>{{ $stat->disk_used }}</div></td>
                            <td>
                                <form action="{{ url('node/entry/'.$stat->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-btn fa-trash"></i>Delete
                                    </button>
                                </form>
                            </td>                                           
                                                                        
                        </tr>
                    @endforeach
                </tbody>
            </table>        
        </div>
@endif