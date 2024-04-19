<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Facades\Auth;
use App\Models\HealthyRecord;

class HealthyRecordChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $record = HealthyRecord::where('patient_id', Auth::user()->id)->get()->sortByDesc('created_at')->take(5);
        $record = $record->sortBy('created_at');

        $heart_rate = array();
        $sistole = array();
        $diastole = array();
        $time = array();

        foreach($record as $r){
            array_push($heart_rate, $r->heart_rate);
            array_push($sistole, $r->sistole_blood_pressure);
            array_push($diastole, $r->diastole_blood_pressure);
            array_push($time, Date('d/m', strtotime($r->created_at)));
        }

        return $this->chart->lineChart()
            ->setTitle('Your Healthy Record')
            ->addData('Heart Rate', $heart_rate)
            ->addData('Sistole', $sistole)
            ->addData('Diastole', $diastole)
            ->setXAxis($time)
            ->setHeight(250);
    }
}
