<script>
    articlesVariables.push({
        id: "{{ transliteration($article['name']) }}",
        additionalContentUrl: "{{ $article['additional_content_url'] }}",
        charts: {
            incomingData: @json($article['charts']),
            articleChartsInstances: []
        }
    });
</script>

<section id="{{transliteration($article['name'])."_{$key}"}}">
    <h4 class="section-header mb-4">
        <a class="section-header-link" href="#{{transliteration($article['name'])."_{$key}"}}">{{$article['name']}}</a>
        <div class="btn-group question-mark-container">
            <button class="question-mark-button" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                /?
            </button>
            <ul class="dropdown-menu shadow-sm question-mark-context-menu mt-2">
                @if ($article["additional_content_url"] != null)
                    <li class="question-mark-context-menu-list-item">
                        <a class="question-mark-context-menu-links" href="{{ env('ADMIN_PANEL_URL').preg_replace('/public/', '/storage', $article['additional_content_url']) }}">
                            Додаткові матеріали
                        </a>
                    </li>
                @endif
                <li class="question-mark-context-menu-list-item">
                    <a class="question-mark-context-menu-links" href="https://www.lutskrada.gov.ua/electronic-appeal/request">Задати запитання</a>
                </li>
            </ul>
        </div>
    </h4>
    <div class="col-12 d-flex flex-column" id="{{transliteration($article['name']).'_content'}}">
        {!! $article['content'] !!}
    </div>
</section>

<script>
    (() => {
        let
            currentArticle = articlesVariables[articlesVariables.length - 1],
            chartCanvases = document.querySelectorAll('.{{ "a_".transliteration($article['name'])."_{$key}"}}_chart');

        if (chartCanvases.length <= currentArticle.charts.incomingData.length) {
            /*
                Building a chart according to amount of canvases (chart holders)
             */
            chartCanvases.forEach((canvas, index) => {
                let
                    currentChartData = currentArticle.charts.incomingData[index],
                    chart = new ChartPrototype;

                chart.type = currentChartData.type;
                chart.data.datasets[0].label = currentChartData.label;

                /*
                    optimizing canvas size depends on incoming data and other information,
                     before assigning it as a chart holder
                */
                optimizeCanvasSize(canvas, currentChartData);

                /*
                    fills chart prototype with data according to it's structure
                 */
                currentChartData.dataset.forEach((data) => {
                    chart.data.datasets[0].data.push(data.value); //[0,1,2,3,4,N,...,Nx]
                    chart.data.labels.push(data.label); //[label1,label2,label3,...,labelN]
                })

                proceedAdditionalOptionsToChart(chart, currentChartData);
                currentArticle.charts.articleChartsInstances.push(new Chart(canvas, chart));
            })
        } else {
            /*
                Building a chart according to amount of datasets
            */
            currentArticle.charts.incomingData.forEach((currentChartData, index) => {
                let
                    canvas = chartCanvases[index],
                    chart = new ChartPrototype;

                chart.type = currentChartData.type;
                chart.data.datasets[0].label = currentChartData.label;

                /*
                    optimizing canvas size depends on incoming data and other information,
                     before assigning it as a chart holder
                */
                optimizeCanvasSize(canvas, currentChartData);

                /*
                    fills chart prototype with data according to it's structure
                 */
                currentChartData.dataset.forEach((data) => {
                    chart.data.datasets[0].data.push(data.value); //[data1,data2,data3,...,dataN]
                    chart.data.labels.push(data.label); //[label1,label2,label3,...,labelN]
                })

                proceedAdditionalOptionsToChart(chart, currentChartData);
                currentArticle.charts.articleChartsInstances.push(new Chart(canvas, chart));
            })
        }
    })();
</script>
