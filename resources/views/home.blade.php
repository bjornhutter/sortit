@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        You are logged in!
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">Notes</div>

                    <div class="panel-body">
                        @include('common.errors')
                        <form action="{{ url('note') }}" method="post" class="form-horizontal">
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <label for="title" class="control-label">Title</label>
                                    <input type="text" name="title" id="title" class="form-control" title="title">
                                    <label for="content" class="control-label">Content</label>
                                    <textarea name="content" id="content" class="form-control" rows="5"
                                              style="resize: vertical;" title="content"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    <button type="submit" class="btn btn-primary">Add note</button>
                                </div>
                            </div>

                            <input type="hidden" value="{{Auth::user()->id}}" id="user_id" name="user_id">

                            {{ csrf_field() }}

                        </form>
                    </div>
                </div>
                @if ($notes->count())
                    <div class="panel panel-default">
                        <div class="panel-heading">My Notes</div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <tbody>
                                @foreach($notes as $note)
                                    <tr>
                                        <td>
                                            <h3>{{ $note->title }}</h3>
                                            <p>{{ $note->content }}</p>
                                            <form action="{{ url('note/' . $note->id) }}" method="post">
                                                <button type="submit" class="btn btn-danger pull-right"
                                                        onclick="return confirm('Are you sure about that?')">Delete
                                                </button>

                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}

                                            </form>
                                            <form action="{{ url('note/edit/' . $note->id) }}" method="post">
                                                <div class="form-group">
                                                    <div class="col-sm-offset-3 col-sm-6">
                                                        <label for="title" class="control-label">Title</label>
                                                        <input type="text" name="title" id="title" class="form-control"
                                                               title="title" value="{{ $note->title }}">
                                                        <label for="content" class="control-label">Content</label>
                                    <textarea name="content" id="content" class="form-control" rows="5"
                                              style="resize: vertical;" title="content">{{ $note->content }}</textarea>
                                                    </div>
                                                </div>

                                                <input type="hidden" value="{{ $note->id }}" id="noteid">
                                                <button type="submit" class="btn btn-primary pull-right"
                                                        onclick="return confirm('Are you sure about that?')">Update
                                                </button>

                                                {{--{{ method_field('PATCH') }}--}}
                                                {{ csrf_field() }}

                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
