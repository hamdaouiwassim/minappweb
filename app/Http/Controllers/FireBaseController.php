<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class FireBaseController extends Controller
{
    //
    public function index(){
        $factory = (new Factory)->withServiceAccount(__DIR__.'/firebasekey.json');
        $datebase = $factory->getFirestore();


        $reference = $database->getReference('path/to/child/location');
    }
}
