@extends('layouts.app')

<!-- Favicon -->
<link rel="icon" href="img/core-img/favicon.ico">
<!-- Stylesheet -->

<link rel="stylesheet" href="css/style1.css">

<link rel="stylesheet" href="{{asset('css/style1.css')}}">

<script type="text/javascript" src="{{ URL::asset('js/jquery/jquery-2.2.4.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/plugins/plugins.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/active.js') }}"></script>



@section('content')

    <div class="text-center">
        <h1>{{$album->name}}</h1>
        <a href="{{ route('profile.show',Auth::user()) }}" class="button secondary">Nazad</a>

    </div>
    <hr>
    <h3 class="text-center">Glazba</h3>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Kupljeni album </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            @php($count=0)
                            @foreach($files as $file)
                                @if(($album->id == $file->album_id))

                                    <div class="col-12">
                                        <div class="single-song-area mb-30 d-flex flex-wrap align-items-end">
                                            <div class="song-thumbnail">

                                                <img src="{{url('storage/uploads/songs_and_cover_images/'.$file->coverImage)}}">

                                            </div>
                                            <div class="song-play-area">
                                                <div class="song-name">
                                                    <p>{{++$count}}. {{$file->artistName}} - {{$file->songName}}</p>
                                                </div>
                                                <audio preload="auto" controls>
                                                    <source src="{{url('storage/uploads/songs_and_cover_images/'.$file->songFile)}}">

                                                </audio>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>


    </div>


@endsection
