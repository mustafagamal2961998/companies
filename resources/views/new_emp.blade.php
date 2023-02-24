@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Employee</h1>

        <form class="company-edit-data-form"  method="POST" action="{{route('employee.store')}}" enctype="multipart/form-data" >
            @csrf

            <div class="success-msg">
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{session('success')}}
                    </div>
                @endif
            </div>
            <div class="row mb-3">

                <label for="first_name" class="col-md-4 col-form-label text-md-end">{{ __('Employee First Name') }}</label>
                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" autofocus>

                    @error('first_name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="last_name" class="col-md-4 col-form-label text-md-end">{{ __('Employee Last Name') }}</label>
                <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name">

                    @error('last_name')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>



            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Employee Email') }}</label>
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
                <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Employee Phone') }}</label>
                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone">

                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="company_name" class="col-md-4 col-form-label text-md-end">{{ __('Employee Company Name') }}</label>
                <div class="col-md-6">

                    <select name="company_name" class="form-select" >
                        @foreach($Companies as $Company)
                            <option value="{{$Company->id}}"> {{$Company->name}}</option>
                        @endforeach
                    </select>

                    @error('company_name')
                    <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>



            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Add New Employee
                    </button>

                </div>
            </div>

        </form>
    </div>
@endsection
