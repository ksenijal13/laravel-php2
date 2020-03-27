@extends('layouts.admin-template')
@section('title')
    miXenial Admin -    Users
@endsection
@section('main')
    <div id="main-admin" class="background-admin">
        <h3 class="admin-insert-h3" id="h3-contact-admin">
            Users Activities
        </h3>
        <select id="sort-activity" name="sort-activity">
            <option value="0">Sort by...</option>
            <option value="desc">Newest to Oldest</option>
            <option value="asc">Oldest to Newest</option>
        </select>
        @include('partials.users-activity-form')
        <div id="pagination-block" class="pagination-style">
            <?php $activitiesNumber = $activitiesNumber / 10 ?>
            <ul class="flex-element">
                @for($i = 0; $i < $activitiesNumber; $i++)
                    <li>
                        <a href="#"  id = "link{{$i}}" data-limit="{{$i}}" class="activity-pagination">{{$i+1}}</a>
                    </li>
                @endfor </ul>
        </div>
    </div>
@endsection

