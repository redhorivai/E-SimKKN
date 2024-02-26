<?php

namespace App\Controllers;

use App\Models\Backend\ArtikelModel;
use App\Models\Backend\InstansiModel;
use App\Models\Backend\ChartModel;

class Profil extends BaseController
{
    protected $m_artikel;
    protected $m_instansi;
    protected $m_chart;
    protected $session;
    public function __construct()
    {
        $this->m_artikel  = new ArtikelModel();
        $this->m_instansi = new InstansiModel();
        $this->m_chart    = new ChartModel();
        $this->session    = \Config\Services::session();
        $this->session->start();
    }
    public function index()
    {
        $data = [
            'title'         => 'Tentang Kami',
            'menu'          => 'profil',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/profil/tentang-kami', $data);
    }
    public function tentangkami()
    {
        $data = [
            'title'         => 'Tentang Kami',
            'menu'          => 'profil',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/profil/tentang-kami', $data);
    }
    public function visimisi()
    {
        $data = [
            'title'         => 'Visi dan Misi',
            'menu'          => 'profil',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/profil/visi-misi', $data);
    }
    public function tatanilai()
    {
        $data = [
            'title'         => 'Tata Nilai dan Motto',
            'menu'          => 'profil',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/profil/tata-nilai', $data);
    }
    public function direksi()
    {
        $data = [
            'title'         => 'Direksi',
            'menu'          => 'profil',
            'artikelFooter' => $this->m_artikel->getLimit('3'),
            'dataInstansi'  => $this->m_instansi->getInstansi(),
        ];
        return view('front/pages/profil/direksi', $data);
    }
    // INDIKATOR MUTU
    public function grafik_hais()
    {
        $chart = $this->m_chart->getChartByCategory("HAIS");
        $grafik    = "";
        $indicator = "";
        $value     = "";
        $script    = "";
        if (count($chart) > 0) {
            foreach ($chart as $key) {
                $grafik .= "<div class='col-sm-6 col-md-6'>
                            <div class='heading-line-bottom' style='display: block;'>
                            <h4 class='text-center'>
                                " . $key->chart_nm . "<br>
                                " . $key->chart_periode . "
                            </h4>
                            </div>
                            <div id='chart_$key->chart_id' style='height: 370px; max-width: 920px; margin: 0 auto 50px auto;'></div></div>";
                $chartIndicator  = $this->m_chart->getIndicatorByID($key->chart_id);
                foreach ($chartIndicator as $res) {
                    $dataPoints[] = array(
                        'y'     => $res->indicator_value,
                        'label' => $res->indicator_nm
                    );
                }
                $script .= "var chart$key->chart_id = new CanvasJS.Chart('chart_$key->chart_id', {
                                animationEnabled: true,
                                theme: 'light2',
                                title:{
                                    text: ''
                                },
                                axisY: {
                                    title: 'Value(Nilai)',
                                    includeZero: true,
                                },
                                data: [{        
                                    type: '$key->chart_type',  
                                    showInLegend: true, 
                                    legendMarkerColor: 'red',
                                    legendText: 'RSUD Palembang BARI',
                                    dataPoints: " . json_encode($dataPoints, JSON_NUMERIC_CHECK) . "
                                }]
                                });
                                chart$key->chart_id.render();";
                unset($dataPoints);
            }
        } else {
            $grafik .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'          => 'Insiden Rate HAIs',
            'menu'           => 'profil',
            'artikelFooter'  => $this->m_artikel->getLimit('3'),
            'dataInstansi'   => $this->m_instansi->getInstansi(),
            'grafik'         => $grafik,
            'script'         => $script,
        ];
        return view('front/pages/profil/imut/hais', $data);
    }
    public function grafik_ikm()
    {
    
        $chart = $this->m_chart->getChartByCategory("IKM");
        
        $grafik    = "";
        $indicator = "";
        $value     = "";
        $script    = "";
        if (count($chart) > 0) {
            foreach ($chart as $key) {
                $grafik .= "<div class='col-sm-6 col-md-6'>
                            <div class='heading-line-bottom' style='display: block;'>
                            <h4 class='text-center'>
                                " . $key->chart_nm . "<br>
                                " . $key->chart_periode . "
                            </h4>
                            </div>
                            <div id='chart_$key->chart_id' style='height: 370px; max-width: 920px; margin: 0 auto 50px auto;'></div></div>";
                $chartIndicator  = $this->m_chart->getIndicatorByID($key->chart_id);
                foreach ($chartIndicator as $res) {
                    $dataPoints[] = array(
                        'y'     => $res->indicator_value,
                        'label' => $res->indicator_nm
                    );
                }

                $script .= "var chart$key->chart_id = new CanvasJS.Chart('chart_$key->chart_id', {
                                animationEnabled: true,
                                theme: 'light2',
                                title:{
                                    text: ''
                                },
                                axisY: {
                                    title: 'Value(Nilai)',
                                    includeZero: true,
                                },
                                data: [{        
                                    type: '$key->chart_type',  
                                    showInLegend: true, 
                                    legendMarkerColor: 'red',
                                    legendText: 'RSUD Palembang BARI',
                                    dataPoints: " . json_encode($dataPoints, JSON_NUMERIC_CHECK) . "
                                }]
                                });
                                chart$key->chart_id.render();";
                unset($dataPoints);
            }
        } else {
            $grafik .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'          => 'Indeks Kepuasan Masyarakat (IKM)',
            'menu'           => 'profil',
            'artikelFooter'  => $this->m_artikel->getLimit('3'),
            'dataInstansi'   => $this->m_instansi->getInstansi(),
            'grafik'         => $grafik,
            'script'         => $script,
        ];
        return view('front/pages/profil/imut/ikm', $data);    
    }
    public function grafik_skm()
    {
    
        $chart = $this->m_chart->getChartByCategory("SKM");
        
        $grafik    = "";
        $indicator = "";
        $value     = "";
        $script    = "";
        if (count($chart) > 0) {
            foreach ($chart as $key) {
                $grafik .= "<div class='col-sm-6 col-md-6'>
                            <div class='heading-line-bottom' style='display: block;'>
                            <h4 class='text-center'>
                                " . $key->chart_nm . "<br>
                                " . $key->chart_periode . "
                            </h4>
                            </div>
                            <div id='chart_$key->chart_id' style='height: 370px; max-width: 920px; margin: 0 auto 50px auto;'></div></div>";
                $chartIndicator  = $this->m_chart->getIndicatorByID($key->chart_id);
                foreach ($chartIndicator as $res) {
                    $dataPoints[] = array(
                        'y'     => $res->indicator_value,
                        'label' => $res->indicator_nm
                    );
                }

                $script .= "var chart$key->chart_id = new CanvasJS.Chart('chart_$key->chart_id', {
                                animationEnabled: true,
                                theme: 'light2',
                                title:{
                                    text: ''
                                },
                                axisY: {
                                    title: 'Value(Nilai)',
                                    includeZero: true,
                                },
                                data: [{        
                                    type: '$key->chart_type',  
                                    showInLegend: true, 
                                    legendMarkerColor: 'red',
                                    legendText: 'RSUD Palembang BARI',
                                    dataPoints: " . json_encode($dataPoints, JSON_NUMERIC_CHECK) . "
                                }]
                                });
                                chart$key->chart_id.render();";
                unset($dataPoints);
            }
        } else {
            $grafik .= "<h5 class='text-center'><em>Belum ada data yang diposting.</em></h5>";
        }
        $data = [
            'title'          => 'Survei Kepuasan Masyarakat (SKM)',
            'menu'           => 'profil',
            'artikelFooter'  => $this->m_artikel->getLimit('3'),
            'dataInstansi'   => $this->m_instansi->getInstansi(),
            'grafik'         => $grafik,
            'script'         => $script,
        ];
        return view('front/pages/profil/imut/skm', $data);    
    }
}
