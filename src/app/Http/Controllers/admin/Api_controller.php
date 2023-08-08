<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;

use App\Models\Users_model;
use App\Models\Machines_model;
use App\Models\Material_model;
use App\Models\Activity_model;
use App\Models\Sites_model;
use App\Scopes\GlobeScope;


class Api_controller extends Controller
{
    //
    public function index()
    {       
        // $pdf = PDF::loadView('admin/demo_mailer', $result);
        // $pdf->set_paper("a4", "portrait");
        // $output = $pdf->output();
        // file_put_contents('assets/invoice.pdf', $output);

        PDF::loadView('admin/demo_mailer')
        ->save('assets/invoice.pdf');

        // return $pdf->download('invoice.pdf');   //download in the desktop

    }

   
}
