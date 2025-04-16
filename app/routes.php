<?php

use Flight;
use WordStat\Controllers\Index;

Flight::route('GET /', [Index::class, 'index']);
Flight::route('POST /calculate', [Index::class, 'calculate']);

Flight::map("notFound", fn() => Flight::render("404", []));
