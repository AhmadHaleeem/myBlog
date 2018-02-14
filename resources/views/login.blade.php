
@extends('master')

@section('content')

    <div class='col-md-8'>
        <h3>Create a new user!!</h3>

        <form method='post' action='/login'>
            {{ csrf_field() }}
            <div class='form-group'>
                <label for='name'>Email</label>
                <input type='email' name='email' value="{{ old('email') }}" class='form-control form-app' placeholder='Email Address'>
            </div>
            <div class='form-group'>
                <label for='name'>Password</label>
                <input type='password' name='password' class='form-control form-app' placeholder='Password'>
            </div>
            <div class='form-group'>
                <button type='submit' class='btn btn-primary'>Login</button>
            </div>
        </form>

            @foreach($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach()

    </div>
@stop