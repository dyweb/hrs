@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <member-form :teams="teams"></member-form>
    {{-- <address-book></address-book> --}}
  </div>
</div>
@endsection
