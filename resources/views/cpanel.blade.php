@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="success-msg">
            @if(session('success'))
                <div class="alert alert-danger" role="alert">
                    {{session('success')}}
                </div>
            @endif
        </div>

         <div class="cpanel-content">

            <div class="content">
                <ul>
                    <a href="{{route('new_comp')}}">
                        <li>Add Company</li>
                    </a>
                    <a href="{{route('employee.index')}}">
                        <li>Add Employee</li>
                    </a>
                </ul>
            </div>

             <div class="content">
                 <table class="table">
                     <thead class="thead-dark">
                     <tr>
                         <th scope="col">ID</th>
                         <th scope="col">Name</th>
                         <th scope="col">Email</th>
                         <th scope="col">Logo</th>
                         <th scope="col">Created At</th>
                         <th scope="col">Edite</th>
                         <th scope="col">Delete</th>

                     </tr>
                     </thead>
                     <tbody>
                     @foreach($Companies as $Company)

                         <tr>

                         <th>{{$Company->id}}</th>
                         <th>{{$Company->name}}</th>
                         <th>{{$Company->email}}</th>
                         <th>
                             <img class="company-logo" src="{{asset($Company->logo)}}" alt="Company Logo">
                         </th>
                         <th>{{date('d-m-Y', strtotime($Company->created_at))}}</th>


                         <th>
                             <a href="{{route('cpanel.edit',$Company->id)}}">
                                 <button type="button" class="btn btn-primary">
                                     <i class="fa-sharp fa-solid fa-pen-to-square"></i>
                                 </button>
                             </a>
                         </th>
                         <th>
                           <form action="{{route('cpanel.destroy',$Company->id)}}" method="POST">
                               @csrf
                               @method('DELETE')

                               <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>

                           </form>
                         </th>

                     </tr>
                     @endforeach

                     </tbody>
                 </table>
                 <br>
                 <br>
                 <table class="table">
                     <thead class="thead-dark">
                         <tr>
                             <th scope="col">ID</th>
                             <th scope="col">Full Name</th>
                             <th scope="col">Email</th>
                             <th scope="col">Phone</th>
                             <th scope="col">Company Name</th>
                             <th scope="col">Created At</th>
                             <th scope="col">Edite</th>
                             <th scope="col">Delete</th>

                         </tr>
                     </thead>
                     <tbody>
                     @foreach($Employees as $Employee)
                     <tr>

                             <th>{{$Employee->id}}</th>
                             <th>{{$Employee->first_name . ' ' . $Employee->last_name}}</th>
                             <th>{{$Employee->email}}</th>
                             <th>{{$Employee->phone}}</th>

                             <th>{{$Employee->company->name}}</th>

                             <th>{{date('d-m-Y', strtotime($Employee->created_at))}}</th>

                             <th>
                                 <a href="{{route('employee.edit',$Employee->id)}}">
                                     <button type="button" class="btn btn-primary">
                                         <i class="fa-sharp fa-solid fa-pen-to-square"></i>
                                     </button>
                                 </a>
                             </th>
                             <th>

                                 <form action="{{route('employee.destroy',$Employee->id)}}" method="POST">
                                     @csrf
                                     @method('DELETE')

                                     <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>

                                 </form>
                             </th>

                     </tr>
                     @endforeach
                     </tbody>
                 </table>
             </div>


         </div>

    </div>
@endsection
