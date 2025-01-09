<div class="flex w-60">
    <div
        class="flex flex-col w-full max-w-full text-gray-600 break-words bg-white border border-gray-100 rounded-lg shadow-lg">
        <div class="flex p-3">
            <div class=" -mt-5 h-12 w-14 -ml-5 rounded-xl {{ $color }} text-center text-white shadow-lg">
                <i class="{{ $icon }}"></i>
            </div>
            <div class="w-full">
                <div class="pt-1 text-right">
                    <p class="text-sm font-light capitalize">{{ $title }}</p>
                    <h4 class="text-2xl font-medium tracking-tighter xl:text-2xl">{{ $slot }}</h4>
                </div>
                <div class="pt-1 border-t">
                    <p class="font-light">
                        <a href="{{ $more }}" class="no-underline text-slate-700">See More</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
