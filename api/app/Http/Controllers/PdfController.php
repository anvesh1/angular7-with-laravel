<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\helpers\helper;
use App\User;
use App\LoginHistory;
use App\Construction;
use App\Client;
use DB;
use App\Product;
use App\Component;
use Knp\Snappy\Pdf;



class PdfController extends Controller
{
    public function __construct()
    {

    }

    public function customPdf(){

        ini_set("memory_limit", "2048M");
        set_time_limit(0);
        ini_set('max_execution_time', 0);

        $request= request();

        $requestData = $request->all();

        $data =  DB::table('users')
            ->get()->toArray();

        $imageLogo = '';

        $headerHtml = "<!DOCTYPE html>
			<div class=\"col-lg-12\" style=\"height: 20px;\">
			</div>";

        $footerHtml = "<!DOCTYPE html>
			<div class=\"col-lg-12\" style=\"padding-left: 0px;padding-right: 0px;margin-top: -20px; margin-left: -10px;margin-right: -10px;
			        padding: 8px;height: 70px;\">
			        <hr style='margin-left: -20px;margin-right: -20px;border-top: 2px solid lightgrey;'>
			    <div class=\"row\" style=\"\">
			        <div class=\"col-lg-6\">
			            <a>
			                <img src=\"{$imageLogo}\" style=\"width: 50px;\">
			            </a>
			            <div style=\"margin-top: -50px;margin-left: 58px;\">
			                <span style=\"color: #36454f;\">Name</span>
			            </div>
			            <div style=\"margin-top: 0px;margin-left: 58px;\">
			                <span style=\"color: #36454f;\">Website</span>
			            </div>
			        </div>
			        <div class=\"col-lg-6\" style=\"float: right;\">
			            <div style=\"margin-top: -44px;margin-left: 58px;\">
			                <span style=\"color: #36454f;\">Email</span>
			            </div>
			            <div style=\"margin-top: 0px;margin-left: 58px;\">
			                <span style=\"color: #36454f;\">Contact</span>
			            </div>
			        </div>
			    </div>
			</div>";
//		dd($footerHtml);
//		dd($url.'/pdf-header');



        return \PDF::loadView('custom-pdf',['data'=> $data])
//			->setOption('header-html', $url.'/pdf-header')
            ->setOption('header-html', $headerHtml)
            ->setOption('footer-html', $footerHtml)
            ->setOption('margin-left', '0')
            ->setOption('margin-right', '0')
            ->setOrientation('portrait')
            ->setOption('margin-top', '10')
            ->setOption('margin-bottom', '18')
            ->download('candidate_custom_pdf.pdf');
//                ->stream('candidate_custom_pdf.pdf');

//// ->setOption('header-html', $header)
//// ->setPaper('a4')

    }

    public function pdfHeader(){
        return view('pdf-header');
    }

    public function pdfFooter($id){
        $data  = DB::table('companies')
            ->where('companies.id', '=', $id)
            ->select( array('companies.name',  'companies.email','companies.contact_number',
                'companies.contact_person','companies.logo_image','companies.website'));

        $response = $data->get();

        $CompData =  json_encode($response);
        return view('pdf-footer', ["compData"=>$response]);
    }

}
