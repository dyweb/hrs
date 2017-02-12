{{-- The form for enrollment --}}
{{-- This html is similar with assets/js/components/MemberForm.vue to a large extent --}}
{{-- If you are to modify this file, chances are that you need to modify that one as well  --}}
@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Sign up</div>
        <div class="panel-body">
          <form class="form-horizontal" role="form" method="POST" action="{{ action('EnrollController@store') }}">
            {{ csrf_field() }}

            {{-- Get the property from backend unless --}}
            {{-- we don't need to control the order to display or other frontend stuff --}}
            @foreach ([  
              ['name','text'], 
              ['email','email'],
              ['nickname','text'],
              ['gender',''],
              ['birthday','date'],
              ['qq','text'],
              ['phone','text'],
              ['stdId','text'],
              ['grade','text'],
              ['department','text'],
              ['GitTq','text'],
              ['GitHub','text'],
              ['QA','text'],
              ['remark','text'],
           ] as $entry)
            <div class="form-group{{ $errors->has($entry[0]) ? ' has-error' : '' }}">
              <label for="{{ $entry[0] }}" class="col-md-4 control-label">{{ ucfirst($entry[0]) }}</label>

              <div class="col-md-6">
                @if ($entry[0] === 'gender')
                  <select id="{{ $entry[0] }}" class="form-control" name="{{ $entry[0] }}" value="0">
                    @foreach (App\Models\Member::GENDER_CONSTS as $gender => $value)
                      <option value="{{ $value }}"> {{ $gender }} </option>
                    @endforeach
                  </select>
                @else
                  <input id="{{ $entry[0] }}" name="{{ $entry[0] }}" value="{{ old($entry[0]) }}" 
                  type="{{ $entry[1] }}" class="form-control">
                @endif

                @if ($errors->has($entry[0]))
                  <span class="help-block">
                    <strong>{{ $errors->first($entry[0]) }}</strong>
                  </span>
                @endif
              </div>
            </div>
            @endforeach

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  Submit
                </button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
