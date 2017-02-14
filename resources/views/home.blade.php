@extends('layouts.app')

@section('app')
<div id="app">
  <app-navbar @roll="rollView">  {{-- Do not use camelcase like @rollView, beacause this is not .vue file--}}
    <span slot="username">{{ Auth::user()->name }}</span>
    <span slot="csrf-field">{{ csrf_field() }}</span>
  </app-navbar>

  {{-- <transition name="transition-view"> --}}
    <poster v-if="view == 'poster'"> </poster>
    
    <prompt v-if="view == 'prompt'"
      :type="viewkwargs.type"
      :title="viewkwargs.title"
      :message="viewkwargs.message"
    >
    </prompt>

    <address-book v-if="view == 'addressBook'"
      :members="members"
      :teams="teams"
      :all-columns="memberProps"
      :format="format"
      :allow-create="isAdmin"
      @roll="rollView"
    > 
    </address-book>

    <profile v-if="view == 'profile'"
      :member="viewkwargs.member"
      :member-props="memberProps"
      :format="format"
      :allow-edit="isAdmin || viewkwargs.member.id === user.member.id"
      :allow-delete="isAdmin"
      @roll="rollView"
      @delete="refreshMembers"
    >
    </profile>

    <member-form v-if="view == 'create'"
      :teams="teams"
      :form-props="memberCreateProps"
      :format="format"
      :mode="'create'"
      @roll="rollView"
      @store="refreshMembers"
      @update="refreshMembers"
    >
    </member-form>
    <member-form v-if="view == 'edit'"
      :member="viewkwargs.member"
      :teams="teams"
      :form-props="memberCreateProps"
      :format="format"
      :mode="'edit'"
      @roll="rollView"
      @store="refreshMembers"
      @update="refreshMembers"
    >
    </member-form>
  {{-- </transition> --}}
</div>

<script>
  window.bladeVar = {
    isGuest: Boolean({{ Auth::check() }}),
    isAdmin: Boolean({{ Auth::user()->is_admin }}),
    user: {!! Auth::user()->toJson() !!},
    members: {!! App\Models\Member::has('user')->with('teams')->get()->toJson() !!},
    teams: {!! App\Models\Team::all()->toJson() !!}
    // TODO: too big the json, many are duplicated
  }

</script>
@endsection
