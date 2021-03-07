@extends('layout.layout')

@section('content')
<div class="container">
    <h2>Crud Form</h2>
    @if ($msg)
        <p>{!! $msg !!}</p> <!-- !! : it symbol means escaps the html tags  -->
    @endif        
    <form class="form-horizontal" method="post" action="{{ isset($editId) ? url('/update') : url('/add') }}">
        @csrf
        <input type="hidden" name="editId" value="{{$editId ?? ''}}" />
        <div class="form-group">
            <label class="control-label col-sm-2" for="name">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="{{$editData['name'] ?? ''}}">
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="{{$editData['email'] ?? ''}}">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-2" for="phone">Phone Number:</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="phone" placeholder="Enter Phone" name="phone" value="{{$editData['phone'] ?? ''}}">
            </div>
        </div>    

        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Password:</label>
            <div class="col-sm-10">          
                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd" value="{{$editData['pwd'] ?? ''}}">
            </div>
        </div>      

        <div class="form-group">        
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success">Submit</button>
                <a href="/crud" class="btn btn-primary">Go Back</a>                
            </div>
        </div>
    </form>

    <table class="table table-hover">
        <thead>
        <tr>
            <th>name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $val)
            <tr>
                <td>{{$val['name']}}</td>
                <td>{{$val['phone']}}</td>
                <td>{{$val['email']}}</td>
                <td><a href="/edit/{{$val['id']}}" class="btn btn-primary">Edit</a></td>
                <td><a href="/delete/{{$val['id']}}" class="btn btn-danger" onclick="return confirm('Are you sure want to delete it.')">Delete</a></td>
            </tr>        
        @endforeach            
        </tbody>
    </table>
</div>
@stop