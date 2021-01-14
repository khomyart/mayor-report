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
            'published' => '1 лютого 2021 року',
            'url' => 'report_2020',
            'banner' => '2020.png'
        ],
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
/*
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
    <div class="container pt-5 d-flex flex-column" style="height: 100%">
        <div class="row d-flex justify-content-end align-items-center logo-holder mb-2">
            <div class="col-5 d-flex justify-content-end align-items-center">
                <img class="logo-image-holder p-1" src="{{ asset('img/Herb_Lutsk.svg') }}" alt="">
            </div>
            <div class="col-7 d-flex justify-content-center flex-column align-items-start logo-text-holder">
                <p>
                    ЛУЦЬКА МІСЬКА РАДА
                </p>
                <p>
                    Звіти міського голови
                </p>
            </div>
        </div>
        <div class="row mt-5 d-flex align-items-center flex-column justify-content-start">
            @foreach($reports as $report)
                <div class="col-7 report-card mb-4 bg-white shadow rounded"
                     onclick="location.href='{{ route($report['url']) }}';">
                    <p class="mb-4">{{ $report['year'] }}</p>
                    <p>Опубліковано: {{ $report['published'] }}</p>
                    <img class="report-card-banner" src="{{ asset('img/report_banners_main_page/'.$report['banner']) }}"
                         alt="banner">
                </div>
            @endforeach
        </div>
        <div class="row mt-2 d-flex align-items-center flex-column justify-content-center">
            <div class="col-7 mt-2 d-flex align-items-center justify-content-center footer">
                <img class="footer-image" src="{{ asset('img/report_list_footer.png') }}" alt="">
            </div>
        </div>
    </div>
@endsection
