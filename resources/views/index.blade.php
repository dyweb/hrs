@extends('layout')

@section('title', 'member index')

@section('body')
<div>
    <table>
        <thead>
            <tr>
                <td>Name</td>
                <td>E-mail</td>
                <td>phone</td>
                <td>qq</td>
                <td>GitTq</td>
                <td>GitHub</td>
                <td>stdId</td>
                <td>department</td>
                <td>grade</td>
                <td>birthday</td>
                <td>gender</td>
                <td>QA</td>
                <td>nickname</td>
                <td>remark</td>
                <td>created_at</td>
                <td>updated_at</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $member)
            <tr>
                <td> {{ $member->name }} </td>
                <td> {{ $member->email }} </td>
                <td> {{ $member->phone }} </td>
                <td> {{ $member->qq }} </td>
                <td> {{ $member->GitTq }} </td>
                <td> {{ $member->GitHub }} </td>
                <td> {{ $member->stdId }} </td>
                <td> {{ $member->department }} </td>
                <td> {{ $member->grade }} </td>
                <td> {{ $member->birthday }} </td>
                <td> {{ $member->gender }} </td>
                <td> {{ $member->QA }} </td>
                <td> {{ $member->nickname }} </td>
                <td> {{ $member->remark }} </td>
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