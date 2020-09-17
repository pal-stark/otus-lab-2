#!/usr/bin/php
<?php
require __DIR__ . '/vendor/autoload.php';

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\Redis;

class PvsExporter extends HTTPServer {

    protected $requests = 0;

    function __construct() {
        parent::__construct(array(
            'port' => 9099,
        ));
    }

    function route_request($request) {
        $uri = $request->uri;

        if (preg_match('#/metrics$#', $uri)) {
            //Считаем только обращения к метрикам.
            $this->requests ++;
            //Вычисляем метрики.
            $adapter  = new Prometheus\Storage\InMemory();
            $registry = new CollectorRegistry($adapter);
            $renderer = new RenderTextFormat();

            //Счётчик - увеличивается при каждом обращении.
            $c1 = $registry->registerCounter('pvs', 'metric_one', 'it increases', ['type']);
            $c1->incBy($this->requests, ['blue']);

            //Меняется случайно в интервале от 0 до 100
            $g1 = $registry->registerGauge('pvs', 'metric_two', 'it increases', ['type']);
            $g1->set(rand(0, 100), ['red']);

            $result = $renderer->render($registry->getMetricFamilySamples());
        }
        else {
            //Индексная страничка.
            $result = "<h1>Pvs Exporter!</h1>";
            $result .= "<a href='/metrics'>Metrics</a>";
        }
        return $this->response('200', $result, array('Content-Type' => 'text/plain; version=0.0.4; charset=utf-8'));
    }

}

$server = new PvsExporter();
$server->run_forever();
