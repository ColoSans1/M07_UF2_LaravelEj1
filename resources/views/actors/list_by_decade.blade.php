@extends('layout')

@section('title', 'List Actors by Decade')

@section('content')
<div class="container">
    <h1>List of Actors by Decade</h1>

    <!-- Form to select decade -->
    <form action="{{ route('actors.byDecade') }}" method="GET">
        <label for="decade">Select Decade:</label>
        <select name="decade" id="decade">
            <option value="1980">1980</option>
            <option value="1990">1990</option>
            <option value="2000">2000</option>
            <option value="2010">2010</option>
            <option value="2020">2020</option>
        </select>
        <button type="submit">Filter</button>
    </form>

    @if(isset($actors) && $actors->count() > 0)
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Birthdate</th>
                    <th>Country</th>
                </tr>
            </thead>
            <tbody>
                @foreach($actors as $actor)
                    <tr>
                        <td>{{ $actor->name }}</td>
                        <td>{{ $actor->surname }}</td>
                        <td>{{ $actor->birthdate }}</td>
                        <td>{{ $actor->country }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No actors found for this decade.</p>
    @endif
</div>
@endsection
