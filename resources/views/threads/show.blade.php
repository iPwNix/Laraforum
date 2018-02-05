@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <a href="#">{{ $thread->creator->name }}</a> posted:
                        {{ $thread->title }}
                    </div>

                    <div class="panel-body">
                        {{ $thread->body }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <h1 style="text-align: center">Replies</h1>
            <div class="col-md-8 col-md-offset-2">
                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                 @endforeach
            </div>
        </div>
        @if(auth()->check())
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <form method="POST" action="{{ $thread->path() .'/replies' }}">
                        {{ csrf_field() }}
                        <textarea name="body" id="body" class="form-control" placeholder="Have something to say?" rows="5" style="resize: none;"></textarea>
                        <button type="submit" class="btn btn-default" style="width: 100%;">Post</button>
                    </form>
                </div>
            </div>
            @else
            <p class="text-center"><a href="{{route('login')}}">Sign In</a> to add your reply to this thread!</p>
        @endif
    </div>
@endsection
