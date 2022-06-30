
    <div class="card">
        <div class="card-header">{{ __('New Node Entry') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ url('node') }}">
                @csrf

                <div class="row mb-3">
                    <label for="comment" class="col-md-4 col-form-label text-md-end">{{ __('Comment') }}</label>

                    <div class="col-md-6">
                        <textarea id="comment" type="textarea" class="form-control @error('comment') is-invalid @enderror" name="comment" value="{{ old('comment') }}" required autocomplete="comment" autofocus></textarea>
                        @error('comment')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="ram_used" class="col-md-4 col-form-label text-md-end">{{ __('Ram Used') }}</label>

                    <div class="col-md-6">
                        <input id="ram_used" type="number" class="form-control @error('ram_used') is-invalid @enderror" name="ram_used" value="{{ old('ram_used') }}" required autocomplete="ram_used" autofocus>

                        @error('ram_used')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="disk_used" class="col-md-4 col-form-label text-md-end">{{ __('Disk Used') }}</label>

                    <div class="col-md-6">
                        <input id="disk_used" type="number" class="form-control @error('disk_used') is-invalid @enderror" name="disk_used" value="{{ old('disk_used') }}" required autocomplete="disk_used" autofocus>

                        @error('disk_used')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
            
                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Log Stats') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br/>
    

