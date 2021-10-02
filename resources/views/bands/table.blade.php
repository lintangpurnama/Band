@extends('layouts.backend')
@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Genres</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bands as $band)
                <tr>
                    <td>1</td>
                    <td>{{ $band->name }}</td>
                    @foreach ($genres as $g)
                    <td>{{ $g->get('name')}}</td>
                        
                    @endforeach
                    {{-- <td>{{ $band->genres()->get()->implode('name', ',') }}</td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $bands->links() }}

@endsection
