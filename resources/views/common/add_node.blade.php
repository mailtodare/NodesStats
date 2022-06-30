<div class="card">
        <div class="card-header "><div class="">{{ __('Add New Node') }}</div></div>
        <div class="card-body">
        <form method="POST" action="{{ url('node/new-node') }}">    
            @csrf

            <div class="row mb-3">
                <label for="node_name" class="col-md-4 col-form-label text-md-end">{{ __('Node Name') }}</label>

                <div class="col-md-6">
                    <input id="node_name" type="text" class="form-control @error('node_name') is-invalid @enderror" name="node_name" value="{{ old('node_name') }}" required autocomplete="node_name" autofocus>

                    @error('node_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                <div class="col-md-6">
                    <textarea id="description" type="textarea" class="form-control @error('description') is-invalid @enderror" name="description" value="" required autocomplete="description" autofocus>{{ old('description') }}</textarea>

                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            <!-- disk -->
            <div class="row mb-3">
                <label for="total_disk" class="col-md-4 col-form-label text-md-end">{{ __('Disk') }}</label>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col">
                            <input id="allocated_disk" type="number" placeholder="Allocated" class="form-control @error('allocated_disk') is-invalid @enderror" name="allocated_disk" value="{{ old('allocated_disk') }}" required autocomplete="allocated_disk" autofocus>            
                            @error('allocated_disk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                            <span style="width: 1em!important; font-size: larger; margin:auto;">{{__( "  /  " )}}</span>
                        <div class="col">
                            <input id="total_disk" type="number" placeholder="Total" class="form-control @error('total_disk') is-invalid @enderror" name="total_disk" value="{{ old('total_disk') }}" required autocomplete="total_disk" autofocus>
                            @error('total_disk')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
            </div>

            <!-- ram -->
            <div class="row mb-3">
                <label for="ram" class="col-md-4 col-form-label text-md-end">{{ __('Ram') }}</label>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col">
                            <input id="allocated_ram" type="number" placeholder="Allocated" class="form-control @error('allocated_ram') is-invalid @enderror" name="allocated_ram" value="{{ old('allocated_ram') }}" required autocomplete="allocated_ram" autofocus>            
                            @error('allocated_ram')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                            <span style="width: 1em!important; font-size: larger; margin:auto;">{{__( "  /  " )}}</span>
                        <div class="col">
                            <input id="total_ram" type="number" placeholder="Total" class="form-control @error('total_ram') is-invalid @enderror" name="total_ram" value="{{ old('total_ram') }}" required autocomplete="total_ram" autofocus>
                            @error('total_ram')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                   
                </div>
            </div>                                       

            <div class="row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button  type="submit" class="btn btn-primary">
                        {{ __('Add Node') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>