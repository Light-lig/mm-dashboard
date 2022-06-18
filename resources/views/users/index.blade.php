@extends('layouts.app')


@section('content')
        <user :iduser="{{ Auth::user()->usr_id }}" />
@endsection
