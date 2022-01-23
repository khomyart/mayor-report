<div class="col-12 d-flex justify-content-center breadcrumb-container">
    <nav style="--bs-breadcrumb-divider: '/';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            @foreach($breadcrumbs as $breadcrumb)
                @if(!$loop->last)
                    @if ($breadcrumb['url'] == 'list_of_reports') 
                        <li class="breadcrumb-item"><a href="{{ route($breadcrumb['url']) }}">{{ $breadcrumb['name'] }}</a></li>
                    @else 
                        <li class="breadcrumb-item"><a href="{{ route($breadcrumb['url'], isset($year) ? $year : '2020') }}">{{ $breadcrumb['name'] }}</a></li>
                    @endif
                @else
                    <li class="breadcrumb-item breadcrumb-active" aria-current="page">{{ $breadcrumb['name'] }}</li>
                @endif
            @endforeach
        </ol>
    </nav>
</div>
