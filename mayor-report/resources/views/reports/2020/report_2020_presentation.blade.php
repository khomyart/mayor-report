@extends('layouts.app')

@section('title', 'Звіт - презентація міського голови')

@section('css_import')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/report_presentation.css') }}">
@endsection

@section('javascript_import')
    @parent
    <script src="{{ asset('/js/report_presentation.js') }}"></script>
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
             'name' => 'Презентація',
         ]
     ];

 $presentation = [
     [
         'id' => 'beg',
         'name' => 'Початок',
         'img' => asset('/img/slides/2020/0.jpg'),
         'img_stretch' => 'vertical',
         'content' => ' <div style=" width: 100%; height: 5.5%; background-color: red; position: absolute; top: 2%; " class="shadow"> <a style="color: white; position: absolute; text-decoration: none; font-weight: 700; top: 50%; left: 85%; transform: translate(-50%, -50%); width: fit-content; font-size: 12.76px;" fontsizemultiplier="2.2" href="https:lutskrada.gov.ua">Луцька міська рада</a> </div> <img style=" position: inherit; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 25%; height: auto; " src="'.asset("/img/logo_lutsk.png").'" alt=""> <div style=" position: inherit; top: 75%; left: 5%; display: flex; align-items: center; width: 60%; "> <img widthmultiplier="4.6" src="'.asset("img/Herb_Lutsk.svg").'" alt="" style="width: 27px;"> <div style="padding-left: 1%; margin-left: 1%; border-width: 2px; border-left-style: solid; border-left-color: red;" borderwidthmultiplier="0.3"> <p fontsizemultiplier="2" class="mb-0" style="font-size: 11.6px;"> Міський голова </p> <p fontsizemultiplier="2" class="mb-0" style="font-size: 11.6px;"> Пустовіт Григорій Олександрович </p> </div> </div> <script> let content = document.getElementById(slidesVariables[slidesVariables.length-1].id); let container = content.childNodes[5]; let imageDiv = container.childNodes[3]; imageDiv.onclick = function() { container.childNodes[1].childNodes[1].setAttribute("href", "https://google.com.ua"); let top = imageDiv.offsetTop; setInterval(() => { console.log(top); top = top - 10; imageDiv.style.top = top + "px"; }, 40); } </script> '
     ],
     [
         'id' => 'cont1',
         'name' => 'Продовження 1',
         'img' => asset('/img/slides/2020/0.jpg'),
         'img_stretch' => 'vertical',
         'content' => "",
         'subparagraphs' => [
             [
                 'id' => 'cont1-1',
                 'name' => 'Продовження 1-1',
                 'img' => asset('/img/slides/2020/0.jpg'),
                 'img_stretch' => 'horizontal',
                 'content' => '',
             ],
             [
                 'id' => 'cont1-2',
                 'name' => 'Продовження 1-2',
                 'img' => asset('/img/slides/2020/0.jpg'),
                 'img_stretch' => 'horizontal',
                 'content' => ''
             ],
             [
                 'id' => 'cont1-3',
                 'name' => 'Продовження 1-3',
                 'img' => asset('/img/slides/2020/2.jpg'),
                 'img_stretch' => 'horizontal',
                 'content' => ''
             ],
         ]
     ],
     [
         'id' => 'cont2',
         'name' => 'Розбудова міської інфраструктури, капітальне будівництво об\'єктів соціальної сфери та житлового фонду',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'vertical',
         'content' => '',
         'subparagraphs' => [
             [
                 'id' => 'cont2-1',
                 'name' => 'Продовження 2-1',
                 'img' => asset('/img/slides/2020/3.jpg'),
                 'img_stretch' => 'horizontal',
                 'content' => '',
             ],
             [
                 'id' => 'cont2-2',
                 'name' => 'Продовження 2-2',
                 'img' => asset('/img/slides/2020/1.jpg'),
                 'img_stretch' => 'horizontal',
                 'content' => '',
             ],
             [
                 'id' => 'cont2-3',
                 'name' => 'Продовження 2-3',
                 'img' => asset('/img/slides/2020/2.jpg'),
                 'img_stretch' => 'horizontal',
                 'content' => '',
             ],
         ]
     ],
     [
         'id' => 'end',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/4.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
     [
         'id' => 'end1',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/1.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
     [
         'id' => 'end2',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
     [
         'id' => 'end2',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
     [
         'id' => 'end2',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
     [
         'id' => 'end2',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
     [
         'id' => 'end2',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
     [
         'id' => 'end2',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
     [
         'id' => 'end2',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
          [
         'id' => 'end2',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
          [
         'id' => 'end2',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
          [
         'id' => 'end2',
         'name' => 'Кінець',
         'img' => asset('/img/slides/2020/2.jpg'),
         'img_stretch' => 'horizontal',
         'content' => '',
     ],
 ]
@endphp

@section('content')
    <script>
        /* Array with php values, which has been transferred through side.blade.php file.
        * This array exists because sometimes we need to get access to them from imported
        * internal content into slides through $content variable*/

        let slidesVariables = []
    </script>

    <div class="presentation-and-menu-container">
        <button class="menu-button col-12 shadow">
            Зміст
        </button>
        <div class="col-12 col-md-5 col-lg-4 col-xl-3 shadow menu-container">
            <div class="row mb-3 d-flex justify-content-center">
                @include('includes.breadcrumb', ['breadcrumbs' => $breadcrumbs])
                <button class="menu-button menu-button-inline mt-2 col-11">
                    Сховати
                </button>
            </div>
            <nav id="presentation">
                <nav class="nav nav-pills flex-column">
                    @foreach($presentation as $slide)

                        @if($loop->first)
                            <a class="nav-link main-paragraph active" href="#{{ $slide['id'] }}">{{ $slide['name'] }}</a>
                            @continue
                        @endif

                        <a class="nav-link main-paragraph" href="#{{ $slide['id'] }}">{{ $slide['name'] }}</a>

                        @if(isset($slide['subparagraphs']) && !empty($slide['subparagraphs']))
                            @foreach($slide['subparagraphs'] as $subparagraph)

                                @if($loop->first)
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link ms-4"
                                           href="#{{ $subparagraph['id'] }}">{{ $subparagraph['name'] }}</a>
                                        @continue
                                        @endif
                                        @if($loop->last)
                                            <a class="nav-link ms-4"
                                               href="#{{ $subparagraph['id'] }}">{{ $subparagraph['name'] }}</a>
                                    </nav>
                                    @break
                                @endif
                                <a class="nav-link ms-4"
                                   href="#{{ $subparagraph['id'] }}">{{ $subparagraph['name'] }}</a>
                            @endforeach
                        @endif
                    @endforeach
                </nav>
            </nav>
        </div>
        <div class="col-12 col-md-7 col-lg-8 col-xl-9">
            <div data-bs-spy="scroll" data-bs-target="#presentation"
                 data-bs-offset="100"
                 class="presentation-container" tabindex="0">
                @foreach($presentation as $slide)
                    @include('includes.slide',
                                    [
                                        'id' => $slide['id'],
                                        'img' => $slide['img'],
                                        'content' => $slide['content'],
                                        'img_stretch' => $slide['img_stretch'],
                                    ])

                    @if(isset($slide['subparagraphs']) && !empty($slide['subparagraphs']))
                        @foreach($slide['subparagraphs'] as $subparagraph)
                            @include('includes.slide',
                                [
                                    'id' => $subparagraph['id'],
                                    'img' => $subparagraph['img'],
                                    'content' => $subparagraph['content'],
                                    'img_stretch' => $subparagraph['img_stretch'],
                                ])
                        @endforeach
                    @endif

                @endforeach
            </div>
        </div>
    </div>
@endsection
