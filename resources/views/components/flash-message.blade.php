@if( session()->has('message') )
    <div x-data="{show: true}" x-init="setTimeout(()=>show = false, 3000)" x-show="show" class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px48 py-4">
        <p>
            {{ session()->get('message') }}
        </p>
    </div>
@endif
