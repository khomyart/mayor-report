@extends('layouts.app')

@section('title', 'Звіти голови Луцької міської ради')

@section('css_import')
    @parent
    <link href="{{ asset('css/report_view_selection.css') }}" rel="stylesheet">
@endsection

@section('javascript_import')
    @parent
    <script src="{{ asset('js/report_view_selection.js') }}"></script>
@endsection

@php
    $breadcrumbs = [
        [
            'name' => 'Перелік звітів',
            'url' => 'list_of_reports',
        ],
        [
            'name' => '2020'
        ]
    ];

    $list_of_views =
    [
        [
            'id' => 'presentation',
            'name' => 'Презентація',
            'description' => 'Коротке представлення звіту Луцької міської ради у вигляді змістовної презентації',
            'thumbnail' => ['report_view_selection_presentation_1.png', 'report_view_selection_presentation_2.png'],
            'url' => 'report_2020_presentation', //url name for route()
            'thumbnail_prefix' => asset('img/report_view_selection/')
        ],
        [
            'id' => 'detail',
            'name' => 'Детальний звіт',
            'description' => 'Детальне представлення звіту Луцької міської ради у вигляді графіків, статей',
            'thumbnail' => ['report_view_selection_detail_1.png', 'report_view_selection_detail_2.png'],
            'url' => 'report_2020_detail', //url name for route()
            'thumbnail_prefix' => asset('img/report_view_selection/')
        ],
        [
            'id' => 'book',
            'name' => 'Звіт — книжка',
            'description' => 'Представлення звіту Луцької міської ради у вигляді електронної книги (pdf)',
            'thumbnail' => ['report_view_selection_book_1.png', 'report_view_selection_book_2.png'],
            'url' => 'list_of_reports', //url name for route()
            'thumbnail_prefix' => asset('img/report_view_selection/')
            //'url' => 'report_2020_pdf_book' //url name for route()
        ],

    ]
@endphp

<script>
    let listOfViews = @json($list_of_views);
</script>

@section('content')
    <div class="container h-100">
        <div class="row d-flex view-container">
            @include('includes.breadcrumb', ['breadcrumbs' => $breadcrumbs])
            @foreach($list_of_views as $view)
                <div id="{{ $view['id'] }}" class="col-9 col-md-10 col-lg-8 col-xl-7 view rounded shadow bg-white mb-2 p-2"
                     onclick="location.href='@if ($view['id'] == 'book') {{ asset('/reports_pdf/2020.pdf') }} @else {{ route($view['url']) }} @endif';"
                >
                    <div class="col-12 col-md-4 d-flex justify-content-center p-4">
                        <img id="{{ $view['url'] }}" src="{{ asset('img/report_view_selection/'.$view['thumbnail'][0]) }}" alt=""
                             class="view-image shadow">
                    </div>
                    <div class="col-12 col-md-8 p-2 view-text">
                        <p>{{ $view['name'] }}</p>
                        <p>{{ $view['description'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{--    <a href="{{ route('report_2020_presentation') }}">Презентація</a>--}}
    {{--    <a href="{{ route('report_2020_detail') }}">Детальний звіт</a>--}}
@endsection
