@extends('layouts.app')

@section('title', 'Звіт про роботу виконавчих органів Луцької міської ради')

@section('css_import')
    @parent
    <link href="{{ asset('css/list_of_reports.css') }}" rel="stylesheet">
@endsection

@section('javascript_import')
    @parent
@endsection

@php
    /**
     * dateInput string - date with format yyyy-mm-dd
     * 
     */
    function getConvertedDate($dateInput) {
        $months = [
            "January" => "січня",
            "February" => "лютого",
            "March" => "березня",
            "April" => "квітня",
            "May" => "травня",
            "June" => "червня",
            "July" => "липня",
            "August" => "серпня",
            "September" => "вересня",
            "October" => "жовтня",
            "November" => "листопада",
            "December" => "грудня"
        ];

        $preConvertedDateInput = getDate(strtotime($dateInput));

        $convertedDate = "{$preConvertedDateInput["mday"]} {$months[$preConvertedDateInput["month"]]} {$preConvertedDateInput["year"]} року"; 

        return $convertedDate;
    }

    /* Template
    [
        'year' => 2021,
        'published' => '2 лютого 2022 року',
        'url' => 'report_2021',
        'banner' => '2021.png'
    ],
    ]*/
@endphp

@section('content')
    <div class="container pt-5 d-flex flex-column h-100">
        <div class="row d-flex justify-content-end align-items-center logo-holder mb-2">
            <div class="col-3 col-sm-4 ml-3 d-flex justify-content-end align-items-center">
                <img class="logo-image-holder p-1" src="{{ asset('img/Herb_Lutsk.svg') }}" alt="">
            </div>
            <div class="col-9 col-sm-8 d-flex justify-content-center flex-column align-items-start logo-text-holder">
                <p>
                    ЛУЦЬКА МІСЬКА РАДА
                </p>
                <p>
                    Щорічний звіт міського голови
                </p>
            </div>
        </div>

        <div class="row mt-5 d-flex align-items-center flex-column justify-content-start">
                    <div class="mt-lg-5"></div>
            @foreach($reports as $report)
                @if($report["is_active"] == 'true')
                    <div class="col-11 col-sm-9 col-md-8 col-xl-7 report-card mb-5 bg-white shadow rounded"
                        onclick="location.href='{{ route('report', $report['year']) }}';">
                        <p class="mb-4">{{ $report['year'] }}</p>
                        <p class="col-4 col-md-6" style="z-index: 30; position: absolute; font-weight: bolder">Опубліковано:<br> {{ getConvertedDate($report['published_at']) }}</p>
                        <img class="report-card-banner" src="{{ env('ADMIN_PANEL_URL').preg_replace('/public/', '/storage', $report['img_src']) }}"
                            alt="banner">
                    </div>
                @endif
            @endforeach

            {{-- <div class="col-11 col-sm-9 col-md-8 col-xl-7 report-card mb-5 bg-white shadow rounded"
                    onclick="location.href='{{ route('report_2020') }}';">
                <p class="mb-4">{{ 2020 }}</p>
                <p class="col-4 col-md-6" style="z-index: 30; position: absolute; font-weight: bolder">Опубліковано:<br> {{ '20 лютого 2021 року' }}</p>
                <img class="report-card-banner" src="{{ asset('img/report_banners_main_page/2020.png') }}"
                        alt="banner">
            </div> --}}
        </div>
        <div class="row mt-2 d-flex align-items-center flex-column justify-content-center">
            <div class="col-12 col-sm-10 col-md-9 col-xl-7 mt-2 d-flex align-items-end justify-content-center footer">
                <img class="footer-image" src="{{ asset('img/report_list_footer.png') }}" alt="">
            </div>
        </div>
    </div>
@endsection
