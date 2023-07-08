@if(session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false , 3000)" x-show="true" class="fixed top-0">
        <p>
            {{session('message')}}
        </p>
    </div>
@endif

