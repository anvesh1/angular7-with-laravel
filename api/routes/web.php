<?php

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



Route::get('/', function () {
    return view('welcome');
});
//
//Route::get('pdf-header','PdfController@pdfHeader');
//Route::get('pdf-footer/{id}','PdfController@pdfFooter');
//Route::get('/custom-pdf', 'PdfController@customPdf');


//Route::get('pdf-footer','PdfController@pdfFooter');
//Route::get('documents', 'DashboardController@getCustomerDocuments');
