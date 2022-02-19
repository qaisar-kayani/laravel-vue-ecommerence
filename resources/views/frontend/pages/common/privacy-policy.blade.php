@extends('frontend.layouts.landing-page')
@section('content')
@push('header-top')
@include('frontend.layouts.headers.header-top')
@endpush
@push('header-center')
@include('frontend.layouts.headers.header-center')
@endpush
@push('header-bottom')
@include('frontend.layouts.headers.header-bottom')
@endpush

@push('extracss')
<link id="color_scheme" href="{{ asset('public/frontend/css/home2.css') }}" rel="stylesheet">
@endpush
<!-- Main Container  -->
<div class="main-container container">
    <ul class="breadcrumb">
        <li><a href="{{route('home')}}"><i class="fa fa-home"></i></a></li>
        <li><a href="{{route('privacyPolicy')}}">Privacy & Policy</a></li>
    </ul>
    

    <div class="col-sm-12" style="padding-bottom: 5%;">

        <h2 class="text-uppercase">Privacy Policy</h2>
        <ul>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tristique risus orci, nec ultricies justo ultrices ac. Aliquam aliquet ullamcorper malesuada. Mauris dictum porta nulla vel tristique. Integer in condimentum massa. Etiam justo nibh, suscipit ultricies sollicitudin a, finibus at ipsum. Morbi et tortor quis arcu faucibus vulputate eget non nisi. Nam consequat eros justo, nec porttitor enim iaculis sed. Sed at massa et odio pharetra bibendum in in urna. Mauris at lobortis neque. Donec nulla quam, feugiat vitae ex non, varius vestibulum metus. Fusce rutrum tempus odio, sit amet sagittis justo tristique rhoncus. Suspendisse potenti. Ut nec suscipit risus. Vestibulum eu odio bibendum, mattis justo pellentesque, commodo libero. Vestibulum sagittis nunc nec vestibulum ultrices.

            </p>
        </ul>

        <ul>
            <p>

                In volutpat lacus eget urna commodo lobortis. Curabitur nec mauris in massa porttitor iaculis. Nam in sodales lectus. Aenean ut mauris lacinia, molestie velit id, sollicitudin arcu. Fusce lectus nisi, tincidunt sit amet erat vitae, hendrerit sollicitudin felis. Proin scelerisque nisl metus, sed elementum nisi rhoncus eget. Sed bibendum placerat mauris eget imperdiet. Vivamus non nisl auctor, luctus metus ac, hendrerit est. Mauris auctor, leo id facilisis fermentum, nisi ex convallis urna, non tristique libero justo vel turpis. In pretium arcu nunc, sit amet placerat mauris interdum sit amet. Vestibulum vel vestibulum justo. Sed turpis sapien, tempor non sollicitudin quis, volutpat eu arcu. Nulla vitae elementum urna, at dictum quam. Vestibulum vulputate erat non facilisis consectetur. Vestibulum tincidunt in nisi sit amet placerat.
            </p>
        </ul>

        <ul>
            <p>
                Mauris sit amet commodo mi. Pellentesque lacinia nulla id tortor imperdiet, ut bibendum leo pretium. In auctor rhoncus magna sed interdum. Donec sit amet facilisis augue, quis convallis ante. Vivamus vestibulum dictum arcu, in aliquam velit. Fusce vel efficitur ante. Vivamus vulputate lorem eu tellus imperdiet sagittis. Donec gravida congue condimentum. Vestibulum et ligula tortor. Aliquam ac odio nec lectus iaculis mollis. Ut metus odio, posuere sit amet mauris in, volutpat eleifend magna. Donec hendrerit, ante quis porta rhoncus, nunc enim egestas risus, condimentum ultricies ante felis blandit mauris. Mauris egestas convallis congue. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
            </p>
        </ul>

        <ul>
            <p>
                Integer in luctus urna. Integer quis sapien mauris. Integer scelerisque posuere magna quis volutpat. Morbi rhoncus velit nec mattis vestibulum. Suspendisse pulvinar malesuada quam. Duis libero ante, ultricies ut mattis nec, dapibus eu metus. Nam ac arcu quis quam rhoncus scelerisque feugiat a arcu. Nam ornare tempor diam eget fermentum. Maecenas bibendum tellus ipsum, sit amet gravida mi sagittis id.
            </p>
        </ul>

        <ul>
            <p>
                Morbi elementum sed urna ultricies dapibus. Ut sed lorem fermentum, varius orci a, mattis leo. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Pellentesque consequat augue non scelerisque interdum. Aenean condimentum vestibulum egestas. Donec neque tellus, condimentum ut scelerisque vitae, aliquam at dui. Sed et ante a erat gravida elementum quis vitae sapien. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aenean ullamcorper neque eget nunc lobortis, ut tristique velit ultrices. Sed elementum eros in nunc ornare, vitae ullamcorper velit gravida. Nulla non lobortis ex. Vestibulum non sem eros. Nunc vehicula tellus turpis, et vulputate mauris porta et. Duis risus augue, rutrum ac ipsum vitae, lobortis laoreet erat. Pellentesque venenatis massa eu libero volutpat, vel blandit eros consectetur.
            </p>
        </ul>



    </div>





</div>
<!-- //Main Container -->
@push('vuejs')
@include('frontend.plugins.vuejs')
@endpush
@endsection
