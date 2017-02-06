@extends('layout')

@section('title', 'member index')

@section('body')
<div>
    <table>
        <thead>
            <tr><td>Name</td><td>E-mail</td><td>created_at</td><td>updated_at</td></tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
            <tr>
                <td> {{ $member->name }} </td>
                <td> {{ $member->email }} </td>
                <td> {{ $member->created_at }} </td>
                <td> {{ $member->updated_at }} </td>
                <td>     
                    <form action="{{ route('members.destroy', $member->id) }}" method="POST">
                        {{ method_field('DELETE') }}
                        {{ csrf_field() }}
                        <input type="submit" value="x">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection 