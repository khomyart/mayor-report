@extends('layouts.app')

@section('title', 'Звіт - презентація про роботу виконавчих органів')

@section('css_import')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/report_presentation.css') }}">
@endsection

@section('javascript_import')
    @parent
    <script src="{{ asset('/js/report_presentation.js') }}"></script>
@endsection

@php
    function transliteration($s) {
        $s = (string) $s;
        $s = trim($s);
        $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
        $s = strtr($s,[
          'а'=>'a','б'=>'b','в'=>'v','г'=>'g',
          'ґ'=>'g','д'=>'d','е'=>'e','є'=>'ye','ж'=>'j',
          'з'=>'z','и'=>'y','і'=>'i','ї'=>'yi','й'=>'y',
          'к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o',
          'п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u',
          'ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh',
          'щ'=>'shch','ю'=>'yu','я'=>'ya','ь'=>'', '`'=>'', '’'=>'',
          ' '=>'_', '-'=>'_', '\''=>'', ',' => '', '.' => '',
        ]);

        return $s;
    }

    $breadcrumbs = [
     [
         'name' => 'Перелік звітів',
         'url' => 'list_of_reports',
     ],
     [
         'name' => $year,
         'url' => 'report',
     ],
     [
         'name' => 'Презентація',
     ]
    ];

/*
 *
 *
'img' => '/img/slides/2020/#/#_#.PNG',
'img_stretch' => 'horizontal',

'subparagraphs' => [
    [
        'name' => 'Інформація 1',
        'img' => '/img/slides/2020/0.jpg',
        'img_stretch' => 'vertical',
        'content' => '',
        'subparagraphs' => [],
    ],
],


[
    'name' => '',
    'img' => '/img/slides/2020/0.jpg',
    'img_stretch' => 'vertical',
    'content' => '',
    'subparagraphs' => [],
],



 */
    // $presentation = [
    //     [
    //         'name' => 'Звіт про роботу виконавчих органів',
    //         'img' => '/img/slides/2020/0.jpg',
    //         'img_stretch' => 'vertical',
    //         'content' => ' <span cy="40%" cx="5%" widthmultiplier="100" height="auto" canchor="0%,-50%" style="text-align: left; width: 1080px; position: absolute; top: 40%; left: 5%; transform: translate(0%, -50%);"> <p fontsizemultiplier="5" marginbottommultiplier="2" style="font-size: 54px; margin-bottom: 15px;"> Звіт про роботу </p> <p fontsizemultiplier="3" marginbottommultiplier="0" style="font-size: 32.4px; margin-bottom: 0px;"> виконавчих органів </p> </span> <div cy="100%" cx="100%" canchor="-100%,-100%" widthmultiplier="75" style="height: fit-content; width: 810px; position: absolute; top: 100%; left: 100%; transform: translate(-100%, -100%);"> <img src="img/slides/2020/2020.png" alt="" style="width: 100%; height: auto;"> </div> <img cy="65%" cx="9%" canchor="-50%, -50%" heightmultiplier="10" src="img/Herb_Lutsk.svg" alt="" style="height: 77px; position: absolute; top: 65%; left: 9%; transform: translate(-50%, -50%);"> <span fontsizemultiplier="1.8" cy="64.8%" cx="17.5%" canchor="-50%, -50%" style="font-weight: bold; font-size: 19.44px; position: absolute; top: 64.8%; left: 17.5%; transform: translate(-50%, -50%);"> ЛУЦЬКА <br> МІСЬКА <br> РАДА </span> <img heightmultiplier="11" cy="65.5%" cx="35%" canchor="-50%, -50%" src="img/logo_lutsk.png" alt="" style="height: 85px; position: absolute; top: 65.5%; left: 35%; transform: translate(-50%, -50%);"> <div widthmultiplier="100" heightmultiplier="5.5" cy="3.8%" cx="0%" style="background: linear-gradient(to right, rgb(255, 0, 0), 50%, rgb(27, 100, 235)); width: 1080px; height: 42px; position: absolute; top: 3.8%; left: 0%;" class="shadow"> <a cx="10%" cy="46%" canchor="-50%,-50%" style="color: white; text-decoration: none; font-weight: 700; width: fit-content; font-size: 20.52px; position: absolute; top: 46%; left: 10%; transform: translate(-50%, -50%);" fontsizemultiplier="1.9" href="https://www.lutskrada.gov.ua"> #lutskrada.gov.ua </a> <a cx="92%" cy="46%" canchor="-50%,-50%" style="color: rgb(255, 255, 255); text-decoration: none; font-weight: 700; width: fit-content; font-size: 20.52px; position: absolute; top: 46%; left: 92%; transform: translate(-50%, -50%);" fontsizemultiplier="1.9" href="https://www.facebook.com/lutskrada"> fb:@lutskrada </a> </div> <section> <style> </style> <script> </script> </section> ',
    //         'subparagraphs' => [],
    //     ],

    //     [
    //         'name' => 'Вступне слово міського голови Поліщука І.І.',
    //         'img' => '/img/slides/2020/0.jpg',
    //         'img_stretch' => 'vertical',
    //         'content' => ' <span cy="45%" cx="50%" widthmultiplier="70" height="auto" canchor="-50%,-50%" style="text-align: justify; width: 756px; position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%);"> <p fontsizemultiplier="2" marginbottommultiplier="2" style="font-size: 21.6px; margin-bottom: 15px;"> Шановні мешканці Луцької міської територіальної громади! </p> <p fontsizemultiplier="1.2" marginbottommultiplier="2" style="font-size: 12.96px; margin-bottom: 15px;"> Пропоную вам звіт про роботу виконавчих органів міської ради за 2020 рік. </p> <p fontsizemultiplier="1.2" marginbottommultiplier="2" style="font-size: 12.96px; margin-bottom: 15px;"> Вважаю, що як орган місцевого самоврядування, ми повинні використовувати усі наявні засоби і способи комунікації, аби довести до вас інформацію про життєдіяльність громади, про те, що зроблено міською владою і які плани нам з вами належить реалізувати у цьому році. Це аналіз ефективності роботи Луцької міської ради, її виконавчого комітету та усіх працівників виконавчих органів міської ради. </p> <p fontsizemultiplier="1.2" marginbottommultiplier="2" style="font-size: 12.96px; margin-bottom: 15px;"> 2020 рік був непростим і напруженим. І проблема не тільки у світовій пандемії коронавірусу. Політичні перипетії, спад національної економіки в усіх сферах, адміністративно - територіальна реформа, відкриття ринку землі, підвищення тарифів і цін на товари та ліки, війна на Сході України і, зрештою, місцеві вибори – в таких умовах здійснювалось управління і господарювання містом. Усі зусилля міської влади були спрямовані на підтримку економіки громади, суб’єктів господарювання, інвестиційної привабливості, наповнення бюджету, соціальної стабільності і забезпечення безпеки громадян в умовах карантину і локдауну. Протягом 2020 року у нашій громаді тривали роботи із термомодернізації бюджетних установ та закладів, ремонту об`єктів вулично&nbsp;-&nbsp;дорожньої мережі та прибудинкових територій, впроваджувались заходи інвестиційних міжнародних проєктів із модернізації системи централізованого теплопостачання, оновлення громадського електротранспорту, освітлення та встановлення камер зовнішнього відеоспостереження у різних мікрорайонах міст, проводились фестивалі, змагання та ін. </p> <p fontsizemultiplier="1.2" marginbottommultiplier="2" style="font-size: 12.96px; margin-bottom: 15px;"> Саме завдяки злагодженій, ефективній співпраці, влади, бізнесу і громади ми завершили 2020 рік з хорошими показниками. Не зважаючи на те, що виклики економічної кризи зумовили суттєве зростання видатків на медичне та соціальне забезпечення, нам вдалось реалізувати чимало інфраструктурних проєктів та завдань, передбачених Програмою економічного та соціального розвитку міста на 2020 рік та Бюджетом міста Луцька. Дякую кожному жителю громади, хто щоденною сумлінною працею сприяв її розвитку, кожному представнику великого, малого та середнього бізнесу, завдяки прозорій ефективній діяльності яких наповнювався міський бюджет. </p> </span> <div widthmultiplier="100" heightmultiplier="5.5" cy="3.8%" cx="0%" style="background: linear-gradient(to right, rgb(255, 0, 0), 50%, rgb(27, 100, 235)); width: 1080px; height: 42px; position: absolute; top: 3.8%; left: 0%;" class="shadow"> <a cx="10%" cy="46%" canchor="-50%,-50%" style="color: white; text-decoration: none; font-weight: 700; width: fit-content; font-size: 20.52px; position: absolute; top: 46%; left: 10%; transform: translate(-50%, -50%);" fontsizemultiplier="1.9" href="https://www.lutskrada.gov.ua"> #lutskrada.gov.ua </a> <a cx="92%" cy="46%" canchor="-50%,-50%" style="color: rgb(255, 255, 255); text-decoration: none; font-weight: 700; width: fit-content; font-size: 20.52px; position: absolute; top: 46%; left: 92%; transform: translate(-50%, -50%);" fontsizemultiplier="1.9" href="https://www.facebook.com/lutskrada"> fb:@lutskrada </a> </div> <img cy="87%" cx="39%" canchor="-50%, -50%" heightmultiplier="8" src="img/Herb_Lutsk.svg" alt="" style="height: 62px; position: absolute; top: 87%; left: 39%; transform: translate(-50%, -50%);"> <span fontsizemultiplier="1.4" cy="86.8%" cx="45.5%" canchor="-50%, -50%" style="font-weight: bold; font-size: 15.12px; position: absolute; top: 86.8%; left: 45.5%; transform: translate(-50%, -50%);"> ЛУЦЬКА <br> МІСЬКА <br> РАДА </span> <img heightmultiplier="8.7" cx="59%" cy="87%" canchor="-50%, -50%" src="img/logo_lutsk.png" alt="" style="height: 67px; position: absolute; top: 87%; left: 59%; transform: translate(-50%, -50%);"> <div widthmultiplier="31" heightmultiplier="9" cy="87%" cx="100%" canchor="-100%,-50%" style="background: linear-gradient(to left, rgb(255, 0, 0), 50%, rgba(0, 255, 255, 0)); width: 335px; height: 69px; position: absolute; top: 87%; left: 100%; transform: translate(-100%, -50%);"> </div> <div widthmultiplier="31" heightmultiplier="9" cy="87%" cx="0%" canchor="0%,-50%" style="background: linear-gradient(to right, rgb(255, 0, 0), 50%, rgba(0, 255, 255, 0)); width: 335px; height: 69px; position: absolute; top: 87%; left: 0%; transform: translate(0%, -50%);"> </div> <section> <style> </style> <script> </script> </section> ',
    //         'subparagraphs' => [],
    //     ],

    //     [
    //         'name' => 'Аналіз економічного та соціального розвитку Луцької міської територіальної громади у 2020 році та діяльність департаменту економічної політики',
    //         'img' => '/img/slides/2020/0.jpg',
    //         'img_stretch' => 'vertical',
    //         'content' => ' <span cy="45%" cx="50%" widthmultiplier="70" fontsizemultiplier="3" height="auto" canchor="-50%,-50%" style="text-align: center; font-size: 32.4px; width: 756px; position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%);"> Аналіз економічного та соціального розвитку Луцької міської територіальної громади у 2020 році та діяльність департаменту економічної політики </span> <div widthmultiplier="100" heightmultiplier="5.5" cy="3.8%" cx="0%" style="background: linear-gradient(to right, rgb(255, 0, 0), 50%, rgb(27, 100, 235)); width: 1080px; height: 42px; position: absolute; top: 3.8%; left: 0%;" class="shadow"> <a cx="10%" cy="46%" canchor="-50%,-50%" style="color: white; text-decoration: none; font-weight: 700; width: fit-content; font-size: 20.52px; position: absolute; top: 46%; left: 10%; transform: translate(-50%, -50%);" fontsizemultiplier="1.9" href="https://www.lutskrada.gov.ua"> #lutskrada.gov.ua </a> <a cx="92%" cy="46%" canchor="-50%,-50%" style="color: rgb(255, 255, 255); text-decoration: none; font-weight: 700; width: fit-content; font-size: 20.52px; position: absolute; top: 46%; left: 92%; transform: translate(-50%, -50%);" fontsizemultiplier="1.9" href="https://www.facebook.com/lutskrada"> fb:@lutskrada </a> </div> <img cy="87%" cx="39%" canchor="-50%, -50%" heightmultiplier="8" src="img/Herb_Lutsk.svg" alt="" style="height: 62px; position: absolute; top: 87%; left: 39%; transform: translate(-50%, -50%);"> <span fontsizemultiplier="1.4" cy="86.8%" cx="45.5%" canchor="-50%, -50%" style="font-weight: bold; font-size: 15.12px; position: absolute; top: 86.8%; left: 45.5%; transform: translate(-50%, -50%);"> ЛУЦЬКА <br> МІСЬКА <br> РАДА </span> <img heightmultiplier="8.7" cx="59%" cy="87%" canchor="-50%, -50%" src="img/logo_lutsk.png" alt="" style="height: 67px; position: absolute; top: 87%; left: 59%; transform: translate(-50%, -50%);"> <div widthmultiplier="31" heightmultiplier="9" cy="87%" cx="100%" canchor="-100%,-50%" style="background: linear-gradient(to left, rgb(255, 0, 0), 50%, rgba(0, 255, 255, 0)); width: 335px; height: 69px; position: absolute; top: 87%; left: 100%; transform: translate(-100%, -50%);"> </div> <div widthmultiplier="31" heightmultiplier="9" cy="87%" cx="0%" canchor="0%,-50%" style="background: linear-gradient(to right, rgb(255, 0, 0), 50%, rgba(0, 255, 255, 0)); width: 335px; height: 69px; position: absolute; top: 87%; left: 0%; transform: translate(0%, -50%);"> </div> <section> <style> </style> <script> </script> </section> ',
    //         'subparagraphs' => [
    //             [
    //                 'name' => 'Інформація 1',
    //                 'img' => '/img/slides/2020/2/2_1.png',
    //                 'img_stretch' => 'horizontal',
    //                 'content' => ' <span cy="25%" cx="0%" widthmultiplier="70" heightmultiplier="10" canchor="0%,-50%" style="text-align: left; background: linear-gradient(to right, rgb(255, 0, 0), 80%, rgba(27, 100, 235, 0)); width: 756px; height: 77px; position: absolute; top: 25%; left: 0%; transform: translate(0%, -50%);" class="d-flex justify-content-start align-items-center"> <div widthmultiplier="50" cy="50%" cx="3%" canchor="0%,-50%" fontsizemultiplier="1.5" style="color: white; font-size: 16.2px; width: 540px; position: absolute; top: 50%; left: 3%; transform: translate(0%, -50%);"> Чисельність наявного населення міста Луцька на 1 грудня 2020&nbsp;&nbsp;року становила 217,3 тис. осіб. У місті народилося 1&nbsp;459 дітей. </div> </span> <div widthmultiplier="50" heightmultiplier="4" cy="3.8%" cx="0%" style="background: linear-gradient(to right, rgb(255, 0, 0), 80%, rgba(27, 100, 235, 0)); width: 540px; height: 31px; position: absolute; top: 3.8%; left: 0%;" class=""> <a cx="18%" cy="47%" canchor="-50%,-50%" style="color: white; text-decoration: none; font-weight: 700; width: fit-content; font-size: 18.36px; position: absolute; top: 47%; left: 18%; transform: translate(-50%, -50%);" fontsizemultiplier="1.7" href="https://www.lutskrada.gov.ua"> #lutskrada.gov.ua </a> <a cx="50%" cy="47%" canchor="-50%,-50%" style="color: rgb(255, 255, 255); text-decoration: none; font-weight: 700; width: fit-content; font-size: 18.36px; position: absolute; top: 47%; left: 50%; transform: translate(-50%, -50%);" fontsizemultiplier="1.7" href="https://www.facebook.com/lutskrada"> fb:@lutskrada </a> </div> <div cy="87%" cx="50%" widthmultiplier="100" heightmultiplier="13" canchor="-50%,-50%" style="text-align: center; background-color: rgba(255, 255, 255, 0.965); width: 1080px; height: 100px; position: absolute; top: 87%; left: 50%; transform: translate(-50%, -50%);"> </div> <img cy="87%" cx="39%" canchor="-50%, -50%" heightmultiplier="8" src="img/Herb_Lutsk.svg" alt="" style="height: 62px; position: absolute; top: 87%; left: 39%; transform: translate(-50%, -50%);"> <span fontsizemultiplier="1.4" cy="86.8%" cx="45.5%" canchor="-50%, -50%" style="font-weight: bold; font-size: 15.12px; position: absolute; top: 86.8%; left: 45.5%; transform: translate(-50%, -50%);"> ЛУЦЬКА <br> МІСЬКА <br> РАДА </span> <img heightmultiplier="8.7" cx="59%" cy="87%" canchor="-50%, -50%" src="img/logo_lutsk.png" alt="" style="height: 67px; position: absolute; top: 87%; left: 59%; transform: translate(-50%, -50%);"> <div widthmultiplier="31" heightmultiplier="9" cy="87%" cx="100%" canchor="-100%,-50%" style="background: linear-gradient(to left, rgb(255, 0, 0), 50%, rgba(0, 255, 255, 0)); width: 335px; height: 69px; position: absolute; top: 87%; left: 100%; transform: translate(-100%, -50%);"> </div> <div widthmultiplier="31" heightmultiplier="9" cy="87%" cx="0%" canchor="0%,-50%" style="background: linear-gradient(to right, rgb(255, 0, 0), 50%, rgba(0, 255, 255, 0)); width: 335px; height: 69px; position: absolute; top: 87%; left: 0%; transform: translate(0%, -50%);"> </div> <section> <style> </style> <script> </script> </section> ',
    //                 'subparagraphs' => [],
    //             ],
    //             [
    //                 'name' => 'Інформація 2',
    //                 'img' => '/img/slides/2020/0.jpg',
    //                 'img_stretch' => 'vertical',
    //                 'content' => ' <span cy="45%" cx="50%" widthmultiplier="70" fontsizemultiplier="2" height="auto" canchor="-50%,-50%" style="text-align: center; font-size: 21.6px; width: 756px; position: absolute; top: 45%; left: 50%; transform: translate(-50%, -50%);"> Розмір середньомісячної номінальної заробітної плати штатного працівника склав 9&nbsp;670&nbsp;грн, що в 1,9 рази вище рівня законодавчо встановленої мінімальної заробітної плати (5&nbsp;000&nbsp;грн). </span> <div widthmultiplier="50" heightmultiplier="4" cy="3.8%" cx="0%" style="background: linear-gradient(to right, rgb(255, 0, 0), 80%, rgba(27, 100, 235, 0)); width: 540px; height: 31px; position: absolute; top: 3.8%; left: 0%;" class=""> <a cx="18%" cy="46%" canchor="-50%,-50%" style="color: white; text-decoration: none; font-weight: 700; width: fit-content; font-size: 18.36px; position: absolute; top: 46%; left: 18%; transform: translate(-50%, -50%);" fontsizemultiplier="1.7" href="https://www.lutskrada.gov.ua"> #lutskrada.gov.ua </a> <a cx="50%" cy="46%" canchor="-50%,-50%" style="color: rgb(255, 255, 255); text-decoration: none; font-weight: 700; width: fit-content; font-size: 18.36px; position: absolute; top: 46%; left: 50%; transform: translate(-50%, -50%);" fontsizemultiplier="1.7" href="https://www.facebook.com/lutskrada"> fb:@lutskrada </a> </div> <img cy="87%" cx="39%" canchor="-50%, -50%" heightmultiplier="8" src="img/Herb_Lutsk.svg" alt="" style="height: 62px; position: absolute; top: 87%; left: 39%; transform: translate(-50%, -50%);"> <span fontsizemultiplier="1.4" cy="86.8%" cx="45.5%" canchor="-50%, -50%" style="font-weight: bold; font-size: 15.12px; position: absolute; top: 86.8%; left: 45.5%; transform: translate(-50%, -50%);"> ЛУЦЬКА <br> МІСЬКА <br> РАДА </span> <img heightmultiplier="8.7" cx="59%" cy="87%" canchor="-50%, -50%" src="img/logo_lutsk.png" alt="" style="height: 67px; position: absolute; top: 87%; left: 59%; transform: translate(-50%, -50%);"> <div widthmultiplier="31" heightmultiplier="9" cy="87%" cx="100%" canchor="-100%,-50%" style="background: linear-gradient(to left, rgb(255, 0, 0), 50%, rgba(0, 255, 255, 0)); width: 335px; height: 69px; position: absolute; top: 87%; left: 100%; transform: translate(-100%, -50%);"> </div> <div widthmultiplier="31" heightmultiplier="9" cy="87%" cx="0%" canchor="0%,-50%" style="background: linear-gradient(to right, rgb(255, 0, 0), 50%, rgba(0, 255, 255, 0)); width: 335px; height: 69px; position: absolute; top: 87%; left: 0%; transform: translate(0%, -50%);"> </div> <section> <style> </style> <script> </script> </section> ',
    //                 'subparagraphs' => [],
    //             ],

    //         ],
    //     ],
    // ];
    /*
     * fixing an article's content depends on needed corrections (__slide_id__ transform to actual slide id, etc)
     */
    $replacementPatterns = [
        'idReplacementPattern' => '/__slide_id__/mi',
        'imageSrcReplacementPattern' => '/(<\s*img.*?src\s*=\s*")(.*?)(\s*".*?>)/mi'
    ];

    foreach($presentation as $key => $slide) {

        if (!empty($slide['subparagraphs'])) {
            foreach($slide['subparagraphs'] as $subKey => $subparagraph) {
                $presentation[$key]['subparagraphs'][$subKey]['content'] = preg_replace($replacementPatterns,
                [

                    transliteration($slide['name']).'_'.transliteration($subparagraph['name'])."_{$subparagraph["id"]}", //idReplacementPattern
                    '$1'.env('ADMIN_PANEL_URL').'$2'.'$3', //imageSrcReplacementPattern

                ], $subparagraph['content']);
                 $presentation[$key]['subparagraphs'][$subKey]['img'] = asset($subparagraph['img']);
            }
        }

        $presentation[$key]['content'] = preg_replace($replacementPatterns,
        [

            transliteration($slide['name'])."_{$slide["id"]}", //idReplacementPattern
            '$1'.env('ADMIN_PANEL_URL').'$2'.'$3', //imageSrcReplacementPattern

        ], $slide['content']);
        $presentation[$key]['img'] = asset($slide['img']);
    }
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
                        <a class="nav-link main-paragraph {{ $loop->first ? 'active' : '' }}"
                            href="#{{ transliteration($slide['name'])."_{$slide["id"]}" }}">{{ $slide['name'] }}</a>

                        @if(isset($slide['subparagraphs']) && !empty($slide['subparagraphs']))
                            @foreach($slide['subparagraphs'] as $subparagraph)
                                @if(count($slide['subparagraphs']) == 1)
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link ms-4"
                                           href="#{{ transliteration($slide['name']).'_'.transliteration($subparagraph['name'])."_{$subparagraph["id"]}" }}">
                                            {{ $subparagraph['name'] }}
                                        </a>
                                    </nav>
                                    @break
                                @endif

                                @if($loop->first)
                                    <nav class="nav nav-pills flex-column">
                                        <a class="nav-link ms-4"
                                           href="#{{ transliteration($slide['name']).'_'.transliteration($subparagraph['name'])."_{$subparagraph["id"]}" }}">
                                            {{ $subparagraph['name'] }}
                                        </a>
                                @continue
                                @endif
                                @if($loop->last)
                                    <a class="nav-link ms-4"
                                       href="#{{ transliteration($slide['name']).'_'.transliteration($subparagraph['name'])."_{$subparagraph["id"]}" }}">{{ $subparagraph['name'] }}</a>
                                    </nav>
                                    @break
                                @endif
                                <a class="nav-link ms-4"
                                   href="#{{ transliteration($slide['name']).'_'.transliteration($subparagraph['name'])."_{$subparagraph["id"]}" }}">{{ $subparagraph['name'] }}</a>
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
                                        'id' => transliteration($slide['name'])."_{$slide["id"]}",
                                        'img' => $slide['img'],
                                        'content' => $slide['content'],
                                        'img_stretch' => $slide['img_stretch'],
                                    ])

                    @if(isset($slide['subparagraphs']) && !empty($slide['subparagraphs']))
                        @foreach($slide['subparagraphs'] as $subparagraph)
                            @include('includes.slide',
                                [
                                    'id' => transliteration($slide['name']).'_'.transliteration($subparagraph['name'])."_{$subparagraph["id"]}",
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
