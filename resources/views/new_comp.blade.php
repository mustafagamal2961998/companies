@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Company</h1>
        <form class="company-edit-data-form"  method="POST" action="{{route('cpanel.store')}}" enctype="multipart/form-data" >
            @csrf

            <div class="success-msg">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif
            </div>
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Company Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"  autofocus>

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>



            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Company Email') }}</label>
                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="logo" class="col-md-4 col-form-label text-md-end">{{ __('Company Logo') }}</label>
                <div class="col-md-6">

                    <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo">

                    @error('logo')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Add New Company
                    </button>

                </div>
            </div>

        </form>
    </div>
@endsection
