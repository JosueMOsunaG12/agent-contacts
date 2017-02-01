@extends('master')

@section('header')
  <nav>
    <ul class="nav nav-pills pull-right">
      <li role="presentation" class="active"><a href="/">Home</a></li>
    </ul>
    <h1 class="text-muted">Agent Contacts</h1>
  </nav>
@stop

@section('sidebar-up')
  <h2>Split contacts depending on the agents zip codes</h2>
  <p class="lead">Please enter the zip codes of the agents in the following text box. Also, when you want to display the separation of the contacts please press calculate</p>
  {!! Form::open(['url' => '/', 'class' => 'form-inline']) !!}
    @foreach ($agents as $agent)
      <div class="form-group">
        {!! Form::text('agent'.$agent->id.'_zipcode', null, ['class' => 'form-control', 'placeholder' => $agent->name]) !!}  
      </div>          
    @endforeach
    {!! Form::submit('MATCH!', ['class' => 'btn btn-success']); !!}
    @if ($errors->any())
      
        {!! implode('', $errors->all('<div class="alert alert-danger form-group">:message</div>')) !!}
    @endif
  {!! Form::close() !!}
@stop

@section('sidebar-left')
@if(isset($contactsAgent1))
<table class="table table-hover">
  <thead>
    <tr> 
      <th>Agent Id</th>
      <th>Contact Name</th>
      <th>Contact Zip Code</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($contactsAgent1 as $contact)
      <tr>
        <th scope="row">{{$contact->agent}}</th>
        <td>{{$contact->name}}</td>
        <td>{{$contact->zipcode_id}}</td>
      </tr>
    @endforeach  
  </tbody>
</table>
@endif
@stop

@section('sidebar-right')
@if(isset($contactsAgent2))
<table class="table table-hover">
  <thead>
    <tr> 
      <th>Agent Id</th>
      <th>Contact Name</th>
      <th>Contact Zip Code</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($contactsAgent2 as $contact)
      <tr>
        <th scope="row">{{$contact->agent}}</th>
        <td>{{$contact->name}}</td>
        <td>{{$contact->zipcode_id}}</td>
      </tr>
    @endforeach  
  </tbody>
</table>
@endif
@stop

@section('footer')
  <p>&copy; Josué Miguel Osuna</p>
@stop