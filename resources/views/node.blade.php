@extends('layouts.app')

@section('content')
    <div class="container">               
        <div class="row">
            <div class="col-md-6">
                @include('common.node_entry')
            </div>
            <div class="col-md-6">
                @include('common.update_node')
            </div>            
        </div>
        <br/>
        <br/>
        @include('common.previous_entries')
    </div>
@endsection
