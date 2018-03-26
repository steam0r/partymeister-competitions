<?php

namespace Partymeister\Competitions\Http\Controllers\Backend\AccessKeys;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Http\Requests\Backend\AccessKeyRequest;
use Partymeister\Competitions\Models\AccessKey;
use Partymeister\Competitions\Services\AccessKeyService;

class ExportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function csv()
    {
        $csv   = '';
        $count = 0;

        foreach (AccessKey::all() as $key => $row) {
            $count++;
            $csv .= "\"$row->access_key\"\n";
        }

        // Send the file content as the response
        return response()->streamDownload(function () use ($csv) {
            echo $csv;
        }, 'access-keys.csv');
    }


    public function pdf()
    {
        $pdf = new \Partymeister\Competitions\PDF\AccessKey();
        $pdf->generate();

         //Send the file content as the response
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output('accesskey.pdf', 'S');
        }, 'access-keys.pdf');
    }
}
