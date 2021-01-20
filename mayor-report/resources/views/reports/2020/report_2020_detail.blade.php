@extends('layouts.app')

@section('title', 'Детальний звіт міського голови')

@section('css_import')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/report_detail.css') }}">
    {{-- change place for this lib after template setup--}}
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript"></script>
@endsection

@section('javascript_import')
    @parent
    <script src="{{ asset('/js/report_detail.js') }}"></script>
@endsection

@php
    $breadcrumbs = [
         [
             'name' => 'Перелік звітів',
             'url' => 'list_of_reports',
         ],
         [
             'name' => '2020',
             'url' => 'report_2020',
         ],
         [
             'name' => 'Детальний звіт',
         ]
     ];
@endphp

@section('content')
    <div class="container-fluid bg-light">
        <div class="row d-flex justify-content-center pt-0 pt-md-4">
            <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-7 col-xxl-6 chapters-container shadow">
                <a href="#" class="to-top-button shadow">
                    <img src="{{ asset('img/icons/up-arrow-angle.svg') }}" alt="">
                </a>
                <div class="row pb-4">
                    @include('includes.breadcrumb', ['breadcrumbs' => $breadcrumbs])
                </div>
                <h3 class="mb-4">
                    Зміст
                </h3>
                <ul class="col-12 p-0">
                    <li class="chapter-map-element">
                        <a href="#1">Енергозбереження та енергоефективна діяльність.</a>
                    </li>
                    <li class="chapter-map-element">
                        <a href="#2">Розбудова міської інфраструктури, капітальне будівництво
                            об'єктів соціальної сфери та житлового фонду.</a>
                    </li>
                    <li class="chapter-map-element">
                        <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            A, dolorem.</a>
                    </li>
                    <li class="chapter-map-element">
                        <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            A aliquam ea exercitationem illum in, nesciunt nihil. Lorem ipsum dolor sit amet,
                            consectetur adipisicing elit. Aliquid, quam?</a>
                    </li>
                    <li class="chapter-map-element">
                        <a href="">Lorem ipsum dolor sit amet.</a>
                    </li>
                    <li class="chapter-map-element">
                        <a href="">Lorem ipsum dolor sit amet, consectetur.</a>
                    </li>
                    <li class="chapter-map-element">
                        <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing.</a>
                    </li>
                    <li class="chapter-map-element">
                        <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Libero.</a>
                    </li>
                    <li class="chapter-map-element">
                        <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                            Doloremque error facere iusto veniam?</a>
                    </li>
                    <li class="chapter-map-element">
                        <a href="">Lorem ipsum dolor sit amet, consectetur adipisicing.</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row d-flex justify-content-center pt-4 mb-4">
            <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-7 col-xxl-6 content-container shadow">
                <section class="section-container" id="1">
                    <script>
                        (() => {
                            google.charts.load("current", {packages:['corechart']});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ["Рік", "грн ", { role: "style" } ],
                                    ["2016", 568621.4, "#eb0909"],
                                    ["2017", 689443.9, "#eb0909"],
                                    ["2018", 936059.9, "#eb0909"],
                                    ["2019", 863570.6, "#eb0909"],
                                    ["2020", 1094982.5, "#eb0909"]
                                ]);

                                var view = new google.visualization.DataView(data);
                                view.setColumns([0, 1,
                                    { calc: "stringify",
                                        sourceColumn: 1,
                                        type: "string",
                                        role: "annotation" },
                                    2]);

                                var options = {
                                    title: "Надходження до бюджету міста за 2016-2020 роки",
                                    width: 650,
                                    height: 400,
                                    bar: {groupWidth: "40%"},
                                    legend: { position: "none" },
                                    vAxis: {
                                        viewWindow: {
                                            max: 1300000,
                                            min: 0
                                        }
                                    }
                                };
                                var chart = new google.visualization.ColumnChart(document.getElementById("chart_div"));
                                chart.draw(view, options);
                            }
                        })();
                    </script>
                    <h4 class="section-header mb-4">
                        <a class="section-header-link" href="#">Енергозбереження та енергоефективна діяльність
                        </a>
                        <div class="btn-group question-mark-container">
                            <button class="question-mark-button" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                /?
                            </button>
                            <ul class="dropdown-menu shadow-sm question-mark-context-menu mt-2">
                                <li class="question-mark-context-menu-list-item">
                                    <a class="question-mark-context-menu-links" href="#345">Додаткові матеріали</a>
                                </li>
                                <li class="question-mark-context-menu-list-item">
                                    <a class="question-mark-context-menu-links" href="#346">Задати питання</a>
                                </li>
                            </ul>
                        </div>
                    </h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquid consequatur dolore
                        eius est eum fuga illum iusto maiores maxime molestias nesciunt, nihil, nulla perspiciatis
                        quasi, quidem velit! Aliquid autem commodi, consectetur consequuntur eaque magnam
                        necessitatibus, non nulla porro quam ratione voluptate! Accusantium ad aliquam atque deleniti
                        dolore esse ex exercitationem facilis harum in ipsum laudantium minima, molestias mollitia
                        perspiciatis placeat reiciendis repellendus repudiandae similique temporibus tenetur ut voluptas
                        voluptates? Cum dicta dignissimos laborum nihil porro, tenetur! Accusamus aliquam ducimus id
                        esse facilis, fugit modi nam nihil officia quia sed similique suscipit? Aliquid animi
                        consequatur cum deserunt error, est exercitationem fuga ipsa itaque iure labore laboriosam magni
                        minima modi, molestias nemo nostrum nulla pariatur perferendis, possimus praesentium quo sit
                        tempora veritatis voluptas. Accusamus cum fugiat id necessitatibus placeat quod, reiciendis
                        repellendus?
                    </p>
                    <div class="row col-12 d-flex justify-content-center">
                        <div class="chart" id="chart_div"></div>
                    </div>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusamus aliquid consequatur dolore
                        eius est eum fuga illum iusto maiores maxime molestias nesciunt, nihil, nulla perspiciatis
                        quasi, quidem velit! Aliquid autem commodi, consectetur consequuntur eaque magnam
                        necessitatibus, non nulla porro quam ratione voluptate! Accusantium ad aliquam atque deleniti
                        dolore esse ex exercitationem facilis harum in ipsum laudantium minima, molestias mollitia
                        perspiciatis placeat reiciendis repellendus repudiandae similique temporibus tenetur ut voluptas
                        voluptates? Cum dicta dignissimos laborum nihil porro, tenetur! Accusamus aliquam ducimus id
                        esse facilis, fugit modi nam nihil officia quia sed similique suscipit? Aliquid animi
                        consequatur cum deserunt error, est exercitationem fuga ipsa itaque iure labore laboriosam magni
                        minima modi, molestias nemo nostrum nulla pariatur perferendis, possimus praesentium quo sit
                        tempora veritatis voluptas. Accusamus cum fugiat id necessitatibus placeat quod, reiciendis
                        repellendus?
                    </p>
                </section>
                <section id="2">
                    <h4 class="section-header mb-4">
                        <a class="section-header-link" href="#">Розбудова міської інфраструктури, капітальне будівництво
                            об'єктів соціальної сфери
                            та житлового фонду</a>
                        <div class="btn-group question-mark-container">
                            <button class="question-mark-button" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                /?
                            </button>
                            <ul class="dropdown-menu shadow-sm question-mark-context-menu mt-2">
                                <li class="question-mark-context-menu-list-item">
                                    <a class="question-mark-context-menu-links" href="#345">Додаткові матеріали</a>
                                </li>
                                <li class="question-mark-context-menu-list-item">
                                    <a class="question-mark-context-menu-links" href="#346">Задати питання</a>
                                </li>
                            </ul>
                        </div>
                    </h4>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis deserunt officia perspiciatis
                        praesentium totam unde voluptas voluptatum? Ab fuga hic ut? A assumenda atque beatae cumque
                        dolor excepturi id, nam quae quam, quis, ratione sapiente ut velit voluptates voluptatibus.
                        Alias aperiam architecto, atque culpa dignissimos ipsum nam nihil numquam odio, porro provident
                        quaerat quas quisquam recusandae veniam. Aspernatur at, consequuntur dolorem ex id laudantium
                        libero, magni neque nesciunt quidem quod ratione, rem sequi sint veniam! Beatae consequatur
                        dolor eos ipsam modi non numquam, similique. Aliquid atque consectetur cumque dicta expedita
                        facilis, fugiat mollitia rem tempore voluptatum! Autem dignissimos laborum non pariatur qui
                        veniam! Delectus id omnis quam qui veritatis! Aut consectetur dolores ipsa nisi officiis quas
                        sapiente sequi? Alias, asperiores aut dolore eligendi eos eveniet fugiat in nulla suscipit. Ab
                        accusamus animi aut beatae dolores ea error eveniet ex expedita explicabo, hic laborum non
                    </p>
                    <p>
                        <img class="section-image shadow-sm" src="{{ asset('img/slides/2020/2.jpg') }}" alt="">
                    </p>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Debitis deserunt officia perspiciatis
                        praesentium totam unde voluptas voluptatum? Ab fuga hic ut? A assumenda atque beatae cumque
                        dolor excepturi id, nam quae quam, quis, ratione sapiente ut velit voluptates voluptatibus.
                        Alias aperiam architecto, atque culpa dignissimos ipsum nam nihil numquam odio, porro provident
                        quaerat quas quisquam recusandae veniam. Aspernatur at, consequuntur dolorem ex id laudantium
                        libero, magni neque nesciunt quidem quod ratione, rem sequi sint veniam! Beatae consequatur
                        dolor eos ipsam modi non numquam, similique. Aliquid atque consectetur cumque dicta expedita
                        facilis, fugiat mollitia rem tempore voluptatum! Autem dignissimos laborum non pariatur qui
                        veniam! Delectus id omnis quam qui veritatis! Aut consectetur dolores ipsa nisi officiis quas
                        sapiente sequi? Alias, asperiores aut dolore eligendi eos eveniet fugiat in nulla suscipit. Ab
                        accusamus animi aut beatae dolores ea error eveniet ex expedita explicabo, hic laborum non
                    </p>
                </section>
            </div>
        </div>
    </div>
@endsection
