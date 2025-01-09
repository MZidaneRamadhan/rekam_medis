<nav class="flex mb-4 text-sm" aria-label="Breadcrumb">
    <ol class="inline-flex items-center gap-2">
        <li>
            <a href="/dashboard" class="text-gray-500 hover:text-gray-700"><i class="fas fa-home"></i></a>
        </li>
        @foreach ($breadcrumbs as $breadcrumb)
            <li class="">
                <span class="text-gray-400">/</span>
                @if ($loop->last)
                    <span class="text-gray-700">{{ $breadcrumb['label'] }}</span>
                @else
                    <a href="{{ $breadcrumb['url'] }}" class="text-gray-500 hover:text-gray-700">
                        {{ $breadcrumb['label'] }}
                    </a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
