@extends('layouts.app')

@section('app')
<div id="app">
  <app-navbar @roll="roll">
    <span slot="username">{{ Auth::user()->name }}</span>
    <span slot="csrf-field">{{ csrf_field() }}</span>
  </app-navbar>
  {{-- 
    Here slot is used to pass blade-stuff into Vue.
    However this is far from a cure-all when combining Vue and blde for
    1. Passing things with too complex a structure will cause the separation of logic
    2. Can't handle template logic (condition, loop, ...)
    3. Tags grow with component hierarchy
  --}}

  <transition name="transition-view">
    <component 
      :is="view"
      :teams="teams"
      :members="members"
      @roll="roll">      
    </component>
    {{-- <member-form :teams="teams"></member-form> --}}
    {{-- <address-book :members="members"></address-book> --}}
  </transition>
</div>

@endsection
