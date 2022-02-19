@if (count($breadcrumbs))

    <ul class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i></a></li>
        @foreach ($breadcrumbs as $breadcrumb)

            @if ($breadcrumb->url && !$loop->last)
                <li ><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
            @else
                <li><a href="{{ $breadcrumb->url }}"> {{ $breadcrumb->title }}</a></li>
            @endif

        @endforeach
    </ul>

@endif
