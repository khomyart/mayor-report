@extends('layouts.app')

@section('css_import')
    @parent
    <link href="{{ asset('css/report_view_selection.css') }}" rel="stylesheet">
@endsection

@section('javascript_import')
    @parent
    <script src="{{ asset('js/report_view_selection.js') }}"></script>
@endsection

@php
    $list_of_views =
    [
        [
            'name' => 'Презентація',
            'description' => 'Коротке представлення звіту Луцької міської ради у вигляді змістовної презентації',
            'thumbnail' => ['report_view_selection_presentation_1.png', 'report_view_selection_presentation_2.png'],
            'url' => 'report_2020_presentation' //url name for route()
        ],
        [
            'name' => 'Детальний звіт',
            'description' => 'Детальне представлення звіту Луцької міської ради у вигляді графіків, статей',
            'thumbnail' => ['report_view_selection_detail_1.png', 'report_view_selection_detail_2.png'],
            'url' => 'report_2020_detail' //url name for route()
        ],
        [
            'name' => 'Звіт — книжка',
            'description' => 'Представлення звіту Луцької міської ради у вигляді електронної книги (pdf)',
            'thumbnail' => ['report_view_selection_book_1.png', 'report_view_selection_book_2.png'],
            'url' => 'list_of_reports' //url name for route()
            //'url' => 'report_2020_pdf_book' //url name for route()
        ],

    ]
@endphp

@section('content')
    <div class="container h-100">
        <div class="row d-flex flex-column justify-content-center align-items-center h-100">
            @foreach($list_of_views as $view)
                <div class="col-7 view rounded shadow bg-white mb-4 d-flex p-2"
                     onmouseenter="changeImage(this.childNodes[1].childNodes[1], '{{ asset('img/report_view_selection/'.$view['thumbnail'][1]) }}', 'enter')"
                     onmouseleave="changeImage(this.childNodes[1].childNodes[1], '{{ asset('img/report_view_selection/'.$view['thumbnail'][0]) }}', 'leave')"
                     onclick="location.href='{{ route($view['url']) }}';"
                >
                    <div class="col-4 d-flex justify-content-center h-100 p-4">
                        <img id="{{ $view['url'] }}" src="{{ asset('img/report_view_selection/'.$view['thumbnail'][0]) }}" alt=""
                             class="view-image shadow">
                    </div>
                    <div class="col-8 h-100 p-2 view-text">
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
