@props(['trigger'])

<div x-data="{ show:false }" @click.away="show = false" class="relative">
        {{--trigger--}}
    <div @click="show =! show">
        {{$trigger}}
    </div>
    {{--link--}}
    <div x-show="show" class="py-2 absolute bg-gray-100 w-full mt-2 mb-4 rounded-xl text-left z-50 overflow-auto max-h-20" style="display:none">
        {{--can replace max-h-52--}}
        {{$slot}}
    </div>
</div>
