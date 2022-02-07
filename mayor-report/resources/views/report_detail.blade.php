@extends('layouts.app')

@section('title', 'Детальний звіт про роботу виконавчих органів')

@section('css_import')
    @parent
    <link rel="stylesheet" href="{{ asset('/css/report_detail.css') }}">
    {{-- change place for this lib after template setup--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js" integrity="sha512-d9xgZrVZpmmQlfonhQUvTR7lMPtO7NkZMkA0ABN3PHCbKA5nqylQ/yWlFAyY6hYgdF1Qh6nYiuADWwKB4C2WSw==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0"></script>
{{--    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>--}}
@endsection

@section('javascript_import')
    @parent
    <script defer src="{{ asset('/js/report_detail.js') }}"></script>
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
         'name' => 'Детальний звіт',
     ]
 ];

/*
 *
 * name — name of the article
 * content — content of the article
 * additional_content_url — archive with all related to current article content
 * charts — available for current article
 *  - title — title of a chart
 *  - legend — label of the chart, which located on top of a chart
 *  - type — type of a chart (pie, doughnut, bar, horizontalBar, line?)
 *  - axis — name for axis
 *  - suffix — suffix of an every data label
 *  - isVerbalRoundingEnabled — is verbal rounding enabled (true/false) (145000 to 145 тис.)
 *  - isVerbalRoundingEnabledForHoveredLabels - is verbal rounding enabled (true/false) (145000 to 145 тис.) when hover
 *  - isDataLabelsShown - is data labels shown (actual value of each parameter)
 *  - dataset — dataset for current chart
 *    - label — data label
 *    - value — data value
 *
[
    'name' => '',
    'content' => '',
    'additional_content_url' => '#',
    'charts' => [
        [
            'title' => '',
            'legend' => '',
            'type' => '',
            'axis' => [
                'x' => '',
                'y' => ''
            ],
            'suffix' => '',
            'isDataLabelsShown' => 'true',
            'isVerbalRoundingEnabled' => 'true',
            'isVerbalRoundingEnabledForHoveredLabels' => 'false',
            'dataset' => [
                ['label' => '', 'value' => ''],
            ]
        ],
    ]
],

 */

/*
 * fixing an article's content depends on needed corrections (__article_id__ transform to actual article id, etc)
 */
$replacementPatterns = [
    'idReplacementPattern' => '/__article_id__/mi',
    'imageSrcReplacementPattern' => '/(<\s*img.*?src\s*=\s*")(.*?)(\s*".*?>)/mi'
];

foreach($articles as $key => $article) {
    $articles[$key]['content'] = preg_replace($replacementPatterns,
    [

        "a_".transliteration($article['name'])."_{$key}", //idReplacementPattern
        '$1'.asset('$2').'$3', //imageSrcReplacementPattern

    ], $article['content']);
}
@endphp

@section('content')
    <script>
        /* Array with php values, which has been transferred through article.blade.php file.
        * This array exists because we need to have access to every article's chart and generate
        * new instance of chart's class each time when needed according to .__article_id___chart
        * query selection (querySelectorAll('__article_id___chart')). That means, we need to produce
        * query selection by class selector presented earlier and assign it to newly created instance of
        * Chart class then place this instance in articleVariables['article_id']['charts'][0...n]['instance']*/

        let articlesVariables = []

        const
        ChartPrototype = function() {
            this.type = '';
            this.data = {
                labels: [],
                datasets: [{
                    label: '',
                    data: [],
                    backgroundColor: [],
                    borderColor: [],
                }]
            };
        }

        /**
        * Cuts incoming string into pieces with length wich are close to "symbolsPerLine" number and places them into array 
        * 
        * @param {number} symbolsPerLine 
        * @param {string} string 
        * @returns 
        */
        function stringCut(symbolsPerLine, string) {
            function findClosestSpaceToSymbolsPerLineNumberInString(lengthPerLine, string) {
                let spaceIndexes = [];
                let closestSpaces = [];
                let previousDifference;
                let currentClosestSpaceIndex;
            
                for (let i = 0; i < string.length; i++) {
                    if (string[i] === ' ') {
                        spaceIndexes.push(i);
                    }
                }
            
                for (let i = 1; spaceIndexes[spaceIndexes.length-1] > lengthPerLine; i++) {
                    lengthPerLine = lengthPerLine * i;
                    spaceIndexes.forEach((spaceIndex, index)=>{
                        if (index == 0) { previousDifference = Math.abs(lengthPerLine - spaceIndex) }
                        else if (previousDifference > Math.abs(lengthPerLine - spaceIndex)) { 
                            currentClosestSpaceIndex = spaceIndex;
                            previousDifference = Math.abs(lengthPerLine - spaceIndex);
                            closestSpaces[i-1] = spaceIndex;
                        }
                    })
                }
                //deletes last space
                closestSpaces.pop();
            
                return closestSpaces;
            }
            
            function devideStringBySpaceIndexes(closestSpaceIndexes, string) {
                let devidedString = [];
                let tempString;
                closestSpaceIndexes.unshift(0)
                closestSpaceIndexes.push(string.length)
            
                for (let i = 0; i < closestSpaceIndexes.length - 1; i++) {
                    tempString = '';
            
                    for (let j = i == 0 ? closestSpaceIndexes[i] : closestSpaceIndexes[i] + 1; j < closestSpaceIndexes[i+1]; j++) {
                        tempString += string[j]
                    }
            
                    devidedString[i] = tempString
                }
            
                return devidedString;
            }

            if (string.length < symbolsPerLine * 1.5) 
            {
                return string
            } else {
                return devideStringBySpaceIndexes(findClosestSpaceToSymbolsPerLineNumberInString(symbolsPerLine, string), string)
            }
        }

        function optimizeCanvasSize(canvas, chartData) {
            function optimizeCanvasHeight(chartHeight, multiplier) {
                chartHeight = multiplier == 4 ? chartHeight : chartHeight * 0.8;

                if (chartData.type === 'pie' ||
                    chartData.type === 'doughnut') {
                    canvas.width = '100';
                    //multiplier 4 is for portrait orientation
                    if (multiplier == 4) {
                        canvas.height = ((chartHeight + (chartData.dataset.length * 2) * multiplier + chartData.title.length * 0.1) * 0.9).toString();
                    } else {
                        canvas.height = ((chartHeight + (chartData.dataset.length * 0.8) * multiplier  + chartData.title.length * 0.1) * 0.9).toString();
                    }
                } else {
                    //if chart has additional strings to their title, height of canvas will be increased
                    if (typeof chartData.title === 'object') {
                        canvas.height = (chartHeight + chartData.title.length * multiplier).toString();
                        canvas.width = '80';
                    } else {
                        //if we have a lot elements inside dataset in "bar" chart, we should calculate height of it
                        //depends on largest dataset label in list
                        if (chartData.dataset.length > 4) {
                            let longestLabelInDatasetLength;

                            chartData.dataset.forEach((elem, index)=>{
                                if (index == 0) {
                                    longestLabelInDatasetLength = elem.label.length;
                                } else {
                                    longestLabelInDatasetLength = longestLabelInDatasetLength < elem.label.length ?
                                        elem.label.length : longestLabelInDatasetLength;                                     
                                }
                            })

                            console.log(longestLabelInDatasetLength);

                            canvas.height = (chartHeight + longestLabelInDatasetLength * (multiplier / 4) ).toString();
                            canvas.width = '80';
                        } else {
                            canvas.height = chartHeight.toString();
                            canvas.width = '80';
                        }
                    }
                }
            }

            let chartsDefaultHeight = {
                more0less300: 120,
                more300less370: 93,
                more370less450: 80,
                more450less580: 65,
                more580less768: 65,
                more768less1365: 55,
                more1365: 55,
            }

            if (window.innerWidth > 0 && window.innerWidth <= 300) {
                optimizeCanvasHeight(chartsDefaultHeight.more0less300, 4);
            }

            if (window.innerWidth > 300 && window.innerWidth <= 370) {
                optimizeCanvasHeight(chartsDefaultHeight.more300less370, 4);
            }

            if (window.innerWidth > 370 && window.innerWidth <= 450) {
                optimizeCanvasHeight(chartsDefaultHeight.more370less450, 4);
            }

            if (window.innerWidth > 450 && window.innerWidth <= 580) {
                optimizeCanvasHeight(chartsDefaultHeight.more450less580, 3);
            }

            if (window.innerWidth > 580 && window.innerWidth <= 768) {
                optimizeCanvasHeight(chartsDefaultHeight.more580less768, 3);
            }

            if (window.innerWidth > 768 && window.innerWidth <= 1365) {
                optimizeCanvasHeight(chartsDefaultHeight.more768less1365, 3);
            }

            if (window.innerWidth > 1365) {
                optimizeCanvasHeight(chartsDefaultHeight.more1365, 3);
            }
        }

        function getRandomColor() {
                let r = Math.floor(Math.random() * (256));
                let g = Math.floor(Math.random() * (256));
                let b = Math.floor(Math.random() * (256));

                return {
                    r: r,
                    g: g,
                    b: b,
                }
        }

        function proceedAdditionalOptionsToChart(chartInstance, chartData) {
            let
                type = chartInstance.type,
                legend = chartData.legend,
                name = stringCut(35, chartData.title),
                axisNames = chartData.axis,
                dataLabelSuffix = chartData.suffix,
                arrayWithData = chartInstance.data.datasets[0].data.map(element => parseInt(element)),
                showVerbalRounding = chartData.isVerbalRoundingEnabled === 'true',
                showVerbalRoundingForHoveredLabels = chartData.isVerbalRoundingEnabledForHoveredLabels === 'true',
                showDataLabels = chartData.isDataLabelsShown === 'true',
                barsBackgroundsColors = [];
                console.log(showVerbalRounding, showVerbalRoundingForHoveredLabels)

            chartInstance.data.datasets[0].barPercentage = 0.7;
            chartInstance.type = type;
            chartInstance.data.datasets[0].label = legend;
            chartInstance.options = {
                //here chart's title can be enabled
                title: {
                    display: true,
                    text: name,
                    fontSize: 16,
                    fontColor: 'black',
                    fontFamily: '\'Open Sans\', sans-serif',
                    padding: (chartInstance.type === 'pie' || chartInstance.type === 'doughnut') ? 0 : 10,
                },
                tooltips: {
                    titleFontSize: 14,
                    bodyFontSize: 12,
                    footerFontSize: 12,
                    callbacks: {
                        label: function(tooltipItem, data) {
                            let
                                currentItemIndex = tooltipItem.index,
                                currentItemData = data.datasets[0].data[currentItemIndex],
                                label = `${data.labels[currentItemIndex]}: `;

                            if (showVerbalRoundingForHoveredLabels == 'true' ||
                                showVerbalRoundingForHoveredLabels == true) {
                                if (currentItemData >= 1000 && currentItemData < 1000000) {
                                    return `${label}${(currentItemData/1000).toFixed(1)} тис.${dataLabelSuffix}`;
                                } else if (currentItemData >= 1000000 && currentItemData < 1000000000) {
                                    return `${label}${(currentItemData/1000000).toFixed(1)} млн.${dataLabelSuffix}`;
                                } else if (currentItemData >= 1000000000) {
                                    return `${label}${(currentItemData/1000000000).toFixed(3)} млрд.${dataLabelSuffix}`;
                                } else {
                                    return `${label}${currentItemData}${dataLabelSuffix}`;
                                }
                            } else {
                                return `${label}${currentItemData}${dataLabelSuffix}`;
                            }
                        }
                    }
                },
                legend: {
                    display: (chartInstance.type === 'pie' || chartInstance.type === 'doughnut' || legend !== ''),
                    labels: {
                        display: true,
                        fontFamily: '\'Open Sans\', sans-serif',
                        fontColor: 'black',
                        fontSize: 14,
                    }
                },
                plugins: {
                    datalabels: {
                        padding: 0,
                        display: !(chartInstance.type === 'pie' || chartInstance.type === 'doughnut'),
                        anchor: (chartInstance.type === 'pie' || chartInstance.type === 'doughnut') ? 'center' : 'end',
                        align: (chartInstance.type === 'pie' || chartInstance.type === 'doughnut') ? 'end' :
                                chartInstance.type === 'horizontalBar' ? 'end' : 'top',
                        formatter: function(value, context) {
                            if (showVerbalRounding == 'true' ||
                                showVerbalRounding == true) {
                                if (value >= 1000 && value < 1000000) {
                                    return `${(value/1000).toFixed(1)} тис.${dataLabelSuffix}`;
                                } else if (value >= 1000000 && value < 1000000000) {
                                    return `${(value/1000000).toFixed(1)} млн.${dataLabelSuffix}`;
                                } else if (value >= 1000000000) {
                                    return `${(value/1000000000).toFixed(3)} млрд.${dataLabelSuffix}`;
                                } else {
                                    return `${value}${dataLabelSuffix}`;
                                }
                            } else {
                                return `${value}${dataLabelSuffix}`;
                            }
                        },
                        font: {
                            family: '\'Open Sans\', sans-serif',
                            size: 14,
                        },
                        color: 'black',
                    }
                }
            }
            
            if (chartInstance.type === 'line') {
                chartInstance.data.datasets[0].fill = false;
                /*
                fill chart elements with color according to amount of incoming data
                 */
                for (let i = 0; i < arrayWithData.length; i++) {
                    chartInstance.data.datasets[0].pointBorderColor.push('rgba(0, 0, 0, 1)');
                    chartInstance.data.datasets[0].pointBackgroundColor.push('rgba(255, 99, 132, 1)');
                    chartInstance.data.datasets[0].borderColor.push('rgba(255, 99, 132, 1)');
                }
                chartInstance.data.datasets[0].pointBorderWidth = 2;
            }

            if (chartInstance.type === 'bar' ||
                chartInstance.type === 'horizontalBar') {
                for (let i = 0; i < arrayWithData.length; i++) {
                    chartInstance.data.datasets[0].backgroundColor.push('rgba(255, 0, 0, 1)');
                }
                chartInstance.data.datasets[0].borderWidth = 0;
            }

            if (chartInstance.type === 'doughnut' ||
                chartInstance.type === 'pie') {
                chartInstance.options.legend.position = window.innerWidth < 768 ? 'top' : 'top'
                for (let i = 0; i < arrayWithData.length; i++) {
                    let randomColor = getRandomColor();
                    chartInstance.data.datasets[0].backgroundColor.push(`rgba(${randomColor.r},${randomColor.g},${randomColor.b}, 0.4)`);
                    chartInstance.data.datasets[0].borderColor.push(`rgba(${randomColor.r},${randomColor.g},${randomColor.b}, 0.8)`);
                }
                chartInstance.data.datasets[0].borderWidth = 1;
            }

            if (chartInstance.type === 'bar' ||
                chartInstance.type === 'horizontalBar' ||
                chartInstance.type === 'line') {
                chartInstance.options.scales = {
                    xAxes: [{
                        scaleLabel : {
                            labelString: axisNames.x,
                            display: axisNames.x !== '',
                            fontFamily: '\'Open Sans\', sans-serif',
                            fontSize: 14,
                            fontColor: 'black',
                            padding: 0,
                        },
                        offset: chartInstance.type !== 'horizontalBar',
                        ticks: {
                            callback: function(value, index, values) {
                                if (chartInstance.type != 'horizontalBar') {
                                    return value;
                                }

                                if (showVerbalRounding == 'true' || 
                                    showVerbalRounding == true) {
                                    if (value >= 1000 && value < 1000000) {
                                        return `${(value/1000).toFixed(1)} тис.${dataLabelSuffix}`;
                                    } else if (value >= 1000000 && value < 1000000000) {
                                        return `${(value/1000000).toFixed(1)} млн.${dataLabelSuffix}`;
                                    } else if (value >= 1000000000) {
                                        return `${(value/1000000000).toFixed(3)} млрд.${dataLabelSuffix}`;
                                    } else {
                                        return `${value}${dataLabelSuffix}`;
                                    }
                                } else {
                                    return `${value}${dataLabelSuffix}`;
                                }
                            },
                            beginAtZero: true,
                            fontSize: 14,
                            suggestedMax: Math.max(...arrayWithData)*1.25,
                        }
                    }],
                    yAxes: [{
                        scaleLabel : {
                            labelString: axisNames.y,
                            display: axisNames.y !== '',
                            fontFamily: '\'Open Sans\', sans-serif',
                            fontSize: 14,
                            fontColor: 'black',
                            padding: 0,
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                if (chartInstance.type == 'horizontalBar') {
                                    return value;
                                }

                                if (showVerbalRounding == 'true' ||
                                    showVerbalRounding == true) {
                                    if (value >= 1000 && value < 1000000) {
                                        return `${(value/1000).toFixed(1)} тис.${dataLabelSuffix}`;
                                    } else if (value >= 1000000 && value < 1000000000) {
                                        return `${(value/1000000).toFixed(1)} млн.${dataLabelSuffix}`;
                                    } else if (value >= 1000000000) {
                                        return `${(value/1000000000).toFixed(3)} млрд.${dataLabelSuffix}`;
                                    } else {
                                        return `${value}${dataLabelSuffix}`;
                                    }
                                } else {
                                    return `${value}${dataLabelSuffix}`;
                                }
                            },
                            beginAtZero: true,
                            fontSize: 14,
                            suggestedMax: Math.max(...arrayWithData)*1.25,
                        }
                    }]
                }
            }
        }
    </script>
    <div class="container-fluid bg-light">
        <div class="row d-flex justify-content-center pt-0 pt-md-4">
            <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-7 col-xxl-6 chapters-container shadow">
                <a href="#" class="to-top-button content-table-href shadow">
                    <img src="{{ asset('img/icons/up-arrow-angle.svg') }}" alt="">
                </a>
                <div class="row pb-4">
                    @include('includes.breadcrumb', ['breadcrumbs' => $breadcrumbs])
                </div>
                <h3 class="mb-4">
                    Зміст
                </h3>
                <ul class="col-12 p-0">
                    @foreach($articles as $key => $article)
                        <li class="chapter-map-element">
                            <a class="content-table-href" href="#{{transliteration($article['name'])."_{$key}"}}">{{$article['name']}}</a>

                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row d-flex justify-content-center pt-4 mb-4">
            <div class="col-12 col-sm-10 col-md-9 col-lg-8 col-xl-7 col-xxl-6 content-container shadow">
                @foreach($articles as $key => $article)
                    @include('includes.article', ['article' => $article, 'key' => $key])
                @endforeach
            </div>
        </div>
    </div>
@endsection
