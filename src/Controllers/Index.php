<?php

namespace WordStat\Controllers;

use Flight;
use WordStat\Models\WorldCalculator;

class Index {
    public function calculate()
    {
        $text = Flight::request()->data['text'];
        try {

            $calculator = new WorldCalculator($text);
            $result = $calculator->getResult();
            Flight::render('calculate', $result);
        } catch (\Throwable $e) {
            Flight::redirect('/');
        }
    }

    public function index()
    {
        Flight::render("index");
    }
}
