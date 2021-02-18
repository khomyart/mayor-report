@extends('layouts.app')

@section('title', 'Звіти голови Луцької міської ради')

@section('css_import')
    @parent
    <link href="{{ asset('css/list_of_reports.css') }}" rel="stylesheet">
@endsection

@section('javascript_import')
    @parent
@endsection

@php
    $reports =
    [
        [
            'year' => 2020,
            'published' => '19 лютого 2021 року',
            'url' => 'report_2020',
            'banner' => '2020.png'
        ],
        /*
        [
            'year' => 2021,
            'published' => '2 лютого 2022 року',
            'url' => 'report_2021',
            'banner' => '2021.png'
        ],
        [
            'year' => 2022,
            'published' => '1 лютого 2023 року',
            'url' => 'report_2020',
            'banner' => '2020.png'
        ],
        [
            'year' => 2023,
            'published' => '2 лютого 2024 року',
            'url' => 'report_2021',
            'banner' => '2021.png'
        ],
        [
            'year' => 2024,
            'published' => '1 лютого 2025 року',
            'url' => 'report_2020',
            'banner' => '2020.png'
        ],

        [
            'year' => 2025,
            'published' => '2 лютого 2026 року',
            'url' => 'report_2021',
            'banner' => '2021.png'
        ]*/
    ];
@endphp

@section('content')
    <div class="container pt-5 d-flex flex-column h-100">
        <div class="row d-flex justify-content-end align-items-center logo-holder mb-2">
            <div class="col-4 col-sm-5 ml-3 d-flex justify-content-end align-items-center">
                <img class="logo-image-holder p-1" src="{{ asset('img/Herb_Lutsk.svg') }}" alt="">
            </div>
            <div class="col-8 col-sm-7 d-flex justify-content-center flex-column align-items-start logo-text-holder">
                <p>
                    ЛУЦЬКА МІСЬКА РАДА
                </p>
                <p>
                    Звіт про роботу виконавчих органів
                </p>
            </div>
        </div>

        <div class="row mt-5 d-flex align-items-center flex-column justify-content-start">
                    <div class="mt-lg-5"></div>
            @foreach($reports as $report)
                <div class="col-11 col-sm-9 col-md-8 col-xl-7 report-card mb-5 bg-white shadow rounded"
                     onclick="location.href='{{ route($report['url']) }}';">
                    <p class="mb-4">{{ $report['year'] }}</p>
                    <p class="col-4 col-md-6" style="z-index: 30; position: absolute; font-weight: bolder">Опубліковано:<br> {{ $report['published'] }}</p>
                    <img class="report-card-banner" src="{{ asset('img/report_banners_main_page/'.$report['banner']) }}"
                         alt="banner">
                </div>
            @endforeach
        </div>
        <div class="row mt-2 d-flex align-items-center flex-column justify-content-center">
            <div class="col-12 col-sm-10 col-md-9 col-xl-7 mt-2 d-flex align-items-end justify-content-center footer">
                <img class="footer-image" src="{{ asset('img/report_list_footer.png') }}" alt="">
            </div>
        </div>
    </div>
@endsection
