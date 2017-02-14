@extends('layouts.app')

@section('app')
<div id="app">
  <app-navbar @roll="rollView">  {{-- Do not use camelcase like @rollView, beacause this is not .vue file--}}
    <span slot="username">{{ Auth::user()->name }}</span>
    <span slot="csrf-field">{{ csrf_field() }}</span>
  </app-navbar>
  {{-- 
    Here slot is used to pass blade-stuff into Vue.
    However this is far from a cure-all when combining Vue and blde for
    1. Passing things with too complex a structure will cause the separation of logic
    2. Can't handle template logic (condition, loop, ...) ( solved by js )
    3. Tags grow with component hierarchy
  --}}

  {{-- <transition name="transition-view"> --}}
    <poster v-if="view == 'poster'"> </poster>
    
    <address-book v-if="view == 'addressBook'"
      :members="members" :teams="teams"
    > 
    </address-book>

    <profile v-if="view == 'profile'"
      :member="viewkwarg.member" 
      :allowEdit="isAdmin"  
      {{-- TODO: if it's user's profile, he should also be authorized --}}
      :allowDelete="isAdmin"
    >
  {{-- </transition> --}}
</div>

<script>
  window.isGuest = Boolean({{ Auth::check() }})
  window.isAdmin = Boolean({{ Auth::user()->is_admin }})

  {{--
    Use js to pass blade-stuff into Vue, 
    these values will be assigned to Vue instance
    and solves the problems of using slot,
    but if `Window` contains property with same name someday,
    we will have to rewrite it.
  --}}
</script>
@endsection
