{{--php style--}}
{{--<h1><?php echo $heading; ?></h1>--}}
{{--<?php foreach ($listings as $item): ?>--}}
{{--<h3><?php echo $item['title']; ?></h3>--}}
{{--<p><?php echo $item['description']; ?></p>--}}
{{--<?php endforeach; ?>--}}


{{--laravel style--}}


{{--@section('title', 'Listings')--}}
{{--    @section('main_content')--}}
<x-layout>
        @include('partials._hero')
        @include('partials._search')


        <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
            @foreach ($listings as $item)
                <x-listing-card :listing="$item"/>
            @endforeach
        </div>
    <div class="mt-6 p-4">
        {{ $listings->links() }}
    </div>
</x-layout>

{{--<h1>{{ $heading }}</h1>--}}

{{--@if(count($listings)==0)--}}
{{--    <p>No listing found</p>--}}
{{--@endif--}}
{{--@unless(count($listings)==0)--}}
    {{--@php--}}
    {{--    $name = '-John Doe-';--}}
    {{--    echo $name;--}}
    {{--@endphp--}}
    {{--{{$name}}--}}

    {{--@else--}}
    {{--    <p>No listing found</p>--}}
    {{--@endunless--}}

{{--@endsection--}}
