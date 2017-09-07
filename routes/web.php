<?php

use App\Pharmacy;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('pharmacies/', function(){
//   $pharmacies = App\Pharmacy::all();
//   $response = Response::json($pharmacies);
//   $response->header('Access-Control-Allow-Origin', '*');
//   return $response;
// });

// Route::get('/pharmacies/distance/{latitude}/{longitude}', function ($latitude, $longitude) {
//   $pharmacies = App\Pharmacy::all();
//
//   foreach ($pharmacies as &$pharmacy) {
//     $pharmacy['distance'] = $pharmacy->getDistanceFrom($latitude, $longitude);
//   }
//
//   $response = Response::json($pharmacies);
//   $response->header('Access-Control-Allow-Origin', '*');
//   return $response;
// });

Route::get('/pharmacies/nearest/{latitude}/{longitude}', function ($latitude, $longitude) {
  $pharmacies = App\Pharmacy::all();

  $nearestPharmacy = false;
  foreach ($pharmacies as &$pharmacy) {
    $pharmacy['distance'] = $pharmacy->getDistanceFrom($latitude, $longitude);
    if ($nearestPharmacy === false || $pharmacy['distance'] < $nearestPharmacy['distance']){
      $nearestPharmacy = $pharmacy;
    }
  }

  $response = Response::json($nearestPharmacy);
  $response->header('Access-Control-Allow-Origin', '*');
  return $response;
});
