@extends('layout')

@section('title', 'create member')

@section('body')
<div>
    <form action="{{ route('members.store') }}" method="POST">
        {{ csrf_field() }}
        <input name="name" type="text" placeholder="Name">
        <input name="email" type="email" placeholder="email">
        <input type="submit">
    </form>
</div>
@endsection 