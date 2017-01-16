@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                @if (session('status'))
                            <div class="alert alert-success">
                               <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {!! session('status') !!}
                            </div>
                        @endif

                <div class="panel-body">
                  <table class="table">
                    <tr>
                    <th>Name</th>
                    <th>Telephone</th>
                    <th>Email</th>
                    <th>Enquiry Detail</th>
                    <th>Action</th>
                  </tr>
                  @foreach($contacts as $contact)
                  <tr>
                    <td>{{$contact->name}}</td>
                    <td>{{$contact->telephone}}</td>
                    <td>{{$contact->email}}</td>
                    <td>{{$contact->enquiry_details}}</td>
                    <td class="center"><div class="btn-group">
                                      <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                      Action
                                          <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu pull-right" role="menu">
                                          <li>
                                            <form action="{{url('contact/'.$contact->id)}}" method="POST">
                                               {{ method_field('DELETE') }}
                                                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                               <input type="submit" value="Delete">
                                            </form>
                                        </li>
                                      </ul>
                                  </div></td>
                  </tr>
                  @endforeach

                  </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
