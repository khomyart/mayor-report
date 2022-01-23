<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Report;
use App\Models\Chart;
use App\Models\ChartDataset;
use App\Models\ReportBook;
use App\Models\Presentation;

class Reports extends Controller
{
    public function showReportDetail($year) {
        $report = Report::where('year', $year)->get()->first()->toArray();
        $report['articles'] = Article::where('report_id', $report["id"])->orderBy('number_in_list')->get()->toArray();
        
        foreach($report["articles"] as $articleKey => $article) {
            //changing name of "path_to_additional_content" field to "additional_content_url"
            $report["articles"][$articleKey]['additional_content_url'] = $report["articles"][$articleKey]['path_to_additional_content'];
            unset($report["articles"][$articleKey]['path_to_additional_content']);

            $report["articles"][$articleKey]["charts"] = Chart::where('article_id', $article["id"])->orderBy("number_in_list")->get()->toArray();

            foreach($report["articles"][$articleKey]["charts"] as $chartKey => $chart) {
                //changing chart array structure, according to existing chart reader
                $report["articles"][$articleKey]["charts"][$chartKey]["isVerbalRoundingEnabled"] =
                    $report["articles"][$articleKey]["charts"][$chartKey]["is_verbal_rounding_enabled"];

                $report["articles"][$articleKey]["charts"][$chartKey]["isVerbalRoundingEnabledForHoveredLabels"] =
                    $report["articles"][$articleKey]["charts"][$chartKey]["is_verbal_rounding_enabled_for_hovered_labels"];

                $report["articles"][$articleKey]["charts"][$chartKey]["axis"]["x"] = $report["articles"][$articleKey]["charts"][$chartKey]["axis_x"];
                $report["articles"][$articleKey]["charts"][$chartKey]["axis"]["y"] = $report["articles"][$articleKey]["charts"][$chartKey]["axis_y"];

                unset( $report["articles"][$articleKey]["charts"][$chartKey]["axis_x"]);
                unset( $report["articles"][$articleKey]["charts"][$chartKey]["axis_y"]);
                unset( $report["articles"][$articleKey]["charts"][$chartKey]["is_verbal_rounding_enabled"]);
                unset( $report["articles"][$articleKey]["charts"][$chartKey]["is_verbal_rounding_enabled_for_hovered_labels"]);

                $report["articles"][$articleKey]["charts"][$chartKey]["dataset"] = ChartDataset::where('chart_id', $chart["id"])->get()->toArray();
            }
        }

        return view('report_detail',[
            'year' => $report["year"],
            'articles' => $report["articles"],
        ]);
    }

    public function showReportPresentation($year) {
        // [
        //     'name' => 'Звіт про роботу виконавчих органів',
        //     'img' => '/img/slides/2020/0.jpg',
        //     'img_stretch' => 'vertical',
        //     'content' => ' <span cy="40%" cx="5%" widthmultiplier="100" height="auto" canchor="0%,-50%" style="text-align: left; width: 1080px; position: absolute; top: 40%; left: 5%; transform: translate(0%, -50%);"> <p fontsizemultiplier="5" marginbottommultiplier="2" style="font-size: 54px; margin-bottom: 15px;"> Звіт про роботу </p> <p fontsizemultiplier="3" marginbottommultiplier="0" style="font-size: 32.4px; margin-bottom: 0px;"> виконавчих органів </p> </span> <div cy="100%" cx="100%" canchor="-100%,-100%" widthmultiplier="75" style="height: fit-content; width: 810px; position: absolute; top: 100%; left: 100%; transform: translate(-100%, -100%);"> <img src="img/slides/2020/2020.png" alt="" style="width: 100%; height: auto;"> </div> <img cy="65%" cx="9%" canchor="-50%, -50%" heightmultiplier="10" src="img/Herb_Lutsk.svg" alt="" style="height: 77px; position: absolute; top: 65%; left: 9%; transform: translate(-50%, -50%);"> <span fontsizemultiplier="1.8" cy="64.8%" cx="17.5%" canchor="-50%, -50%" style="font-weight: bold; font-size: 19.44px; position: absolute; top: 64.8%; left: 17.5%; transform: translate(-50%, -50%);"> ЛУЦЬКА <br> МІСЬКА <br> РАДА </span> <img heightmultiplier="11" cy="65.5%" cx="35%" canchor="-50%, -50%" src="img/logo_lutsk.png" alt="" style="height: 85px; position: absolute; top: 65.5%; left: 35%; transform: translate(-50%, -50%);"> <div widthmultiplier="100" heightmultiplier="5.5" cy="3.8%" cx="0%" style="background: linear-gradient(to right, rgb(255, 0, 0), 50%, rgb(27, 100, 235)); width: 1080px; height: 42px; position: absolute; top: 3.8%; left: 0%;" class="shadow"> <a cx="10%" cy="46%" canchor="-50%,-50%" style="color: white; text-decoration: none; font-weight: 700; width: fit-content; font-size: 20.52px; position: absolute; top: 46%; left: 10%; transform: translate(-50%, -50%);" fontsizemultiplier="1.9" href="https://www.lutskrada.gov.ua"> #lutskrada.gov.ua </a> <a cx="92%" cy="46%" canchor="-50%,-50%" style="color: rgb(255, 255, 255); text-decoration: none; font-weight: 700; width: fit-content; font-size: 20.52px; position: absolute; top: 46%; left: 92%; transform: translate(-50%, -50%);" fontsizemultiplier="1.9" href="https://www.facebook.com/lutskrada"> fb:@lutskrada </a> </div> <section> <style> </style> <script> </script> </section> ',
        //     'subparagraphs' => [],
        // ],
        $compiledPresentation = [];

        $report = Report::where('year', $year)->get()->first();
        $presentations = Presentation::where('report_id', $report["id"])->orderBy('number_in_list')->get();
        
        $slideHeadersCounter = 0;
        foreach ($presentations as $presentationIndex => $presentation) {
            $slides = $presentation->slides;

            $slideSubparagraphsCounter = 0;
            foreach ($slides as $slideIndex => $slide) {

                if ($slideIndex == 0) {
                    $compiledPresentation[$slideHeadersCounter]["id"] = $slide["id"];
                    $compiledPresentation[$slideHeadersCounter]["name"] = $slide["name"];
                    $compiledPresentation[$slideHeadersCounter]["content"] = $slide["content"];
                    $compiledPresentation[$slideHeadersCounter]["img"] = "/img/slides/2020/0.jpg";
                    $compiledPresentation[$slideHeadersCounter]["img_stretch"] = "vertical";
                    $compiledPresentation[$slideHeadersCounter]["subparagraphs"] = [];
                } else {
                    $compiledPresentation[$slideHeadersCounter]["subparagraphs"][$slideSubparagraphsCounter]['id'] = $slide["id"];
                    $compiledPresentation[$slideHeadersCounter]["subparagraphs"][$slideSubparagraphsCounter]['name'] = $slide["name"];
                    $compiledPresentation[$slideHeadersCounter]["subparagraphs"][$slideSubparagraphsCounter]['content'] = $slide["content"];
                    $compiledPresentation[$slideHeadersCounter]["subparagraphs"][$slideSubparagraphsCounter]["img"] = "/img/slides/2020/0.jpg";
                    $compiledPresentation[$slideHeadersCounter]["subparagraphs"][$slideSubparagraphsCounter]["img_stretch"] = "vertical";
                    $compiledPresentation[$slideHeadersCounter]["subparagraphs"][$slideSubparagraphsCounter]['subparagraphs'] = [];
    
                    $slideSubparagraphsCounter++;
                }
            }

            $slideHeadersCounter++;
        }
        
        // return $compiledPresentation;

        return view('report_presentation',[
            'year' => $report["year"],
            'presentation' => $compiledPresentation,
        ]);
    }
}
