@extends('master')

@section('content')
    <div class="col-lg-8" style="margin-top: 80px">
        <h4>Control Panel</h4>
        <h5>List of the Users</h5>

        <div>
            <table class="table table-bordered table-responsive">
                <tr>
                    <td>#ID</td>
                    <td>Name</td>
                    <td>Email</td>
                    <td>User</td>
                    <td>Admin</td>
                </tr>
                @foreach($users as $user)

                <form method="post" action="/add_role">
                    {{ csrf_field() }}
                <input type="hidden" name="id" value="{{ $user->id }}"
                    <tr>
                        <td> {{ $user['id'] }}</td>
                        <td> {{ $user['name'] }}</td>
                        <td> {{ $user['email'] }}</td>
                        <td>
                            <input type="checkbox" onChange="this.form.submit()" name="role-user" {{ $user->hasRole('user') ? 'checked' : "" }}>
                        </td>
                        <td>
                            <input type="checkbox" onChange="this.form.submit()" name="role-admin" {{ $user->hasRole('admin') ? 'checked' : '' }}>
                        </td>
                    </tr>
                </form>
                @endforeach
            </table>
        </div>
    </div>







@stop