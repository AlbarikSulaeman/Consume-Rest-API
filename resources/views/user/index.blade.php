@extends('user.layout')
     
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-success">
            <p>{{ Session::get('message') }}</p>
        </div>
    @endif   

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>:)</h2>
            </div>   
            <div class="pull-right"> 
                <a class="btn btn-success" href="{{ 'user/create' }}"> Create</a>
            </div>
        </div>
    </div>
    
    
     
    <table class="table table-bordered">
    <tbody>
    <tr style="text-align: center;">
        <td>Nomor</td>
        <td>First Name</td>
        <td>Last Name</td>
        <td>Action</td>
    </tr>
    @php
        $number = 1;
    @endphp
    @forelse($users['data'] as $user)
    <tr>
        <td>{{ $number++ }}</td>
        <td>{{ $user['firstName'] }}</td>
        <td>{{ $user['lastName'] }}</td>
        <td align="center">
            <form method="POST" action="{{ 'user/'.$user['id'] }}">
                @method('DELETE')
                @csrf

                <a href="{{ 'user/'.$user['id'] }}" class="btn btn-success"> Edit</a> |
                <button type="submit" class="btn btn-dabger" style="background: red; color: white;" onClick="return confirm('Are you sure to delete this user?');"> Delete</button>
        </form>
        </td>

    </tr>
    @empty
        <tr><td colspan="6" align="center">No Record(s) Found!</td></tr>
    @endforelse
    </tbody>
    </table>  
@endsection