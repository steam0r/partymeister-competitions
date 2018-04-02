<?php

namespace Partymeister\Competitions\Http\Controllers\Backend\CompetitionPrizes;

use Motor\Backend\Http\Controllers\Controller;

use Partymeister\Competitions\Http\Requests\Backend\CompetitionPrizeRequest;
use Partymeister\Competitions\Models\Competition;
use Partymeister\Competitions\Models\Entry;
use Partymeister\Competitions\PDF\Prize;
use Partymeister\Competitions\Services\VoteService;

class ExportController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function receipt()
    {
        $pdf = new Prize();
        $pdf->SetCompression(true);
        $pdf->SetDisplayMode('fullpage');
        $pdf->SetMargins(20, 20, 20);

        $pdf->addPage();
        $pdf->SetTemplate('receipt', __DIR__ . '/../../../../../resources/assets/pdf/receipt');
        $pdf->UseTemplate('receipt');

        $pdf->renderReceipt();

        // Send the file content as the response
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->Output('empty-receipt.pdf', 'S');
            $pdf->Close();
        }, 'empty-receipt.pdf');
    }


    public function prizesheet(CompetitionPrizeRequest $request)
    {
        $pdf = new Prize();
        $pdf->SetCompression(true);
        $pdf->SetDisplayMode('fullpage');
        $pdf->SetMargins(20, 20, 20);
        $pdf->SetTemplate('receipt', __DIR__ . '/../../../../../resources/assets/pdf/receipt');

        $competitions = Competition::where('has_prizegiving', true)
                                   ->orderBy('prizegiving_sort_position', 'DESC')
                                   ->get();

        if ($competitions->count() == 0) {
            // FIXME
            die("no competitions");
        }

        $results = VoteService::getAllVotesByRank('DESC');
        foreach ($results as $competition) {
            $c = Competition::find($competition['id']);

            if ($request->get('prizesheet') !== null) {
                $pdf->AddPage();
                $pdf->renderCompetitionName($competition['name']);

                // Prizes
                $num = 1;
                foreach ($competition['entries'] as $entry) {
                    $e = Entry::find($entry['id']);
                    //foreach ($competition->entries->find_all_by_rank() as $entry) {
                    if ($num >= 4) {
                        continue;
                    }
                    $pdf->renderCompetitionRankings($e, $c->prizes()->where('rank', $num)->first());
                    $num++;
                }
            }

            // Receipts
            if ($request->get('receipt') !== null) {
                $num = 1;
                //foreach ($competition->entries()->get() as $entry) {
                foreach ($competition['entries'] as $entry) {
                    $e = Entry::find($entry['id']);
                    if ($num >= 4) {
                        continue;
                    }

                    $prize = $c->prizes()->where('rank', $num)->first();
                    if ((int) $prize->amount > 0) {
                        $pdf->addPage();
                        $pdf->UseTemplate('receipt');
                        $pdf->renderReceipt($e, $prize);
                    }
                    $num++;
                }
            }
        }

        $filename = 'prizegiving.pdf';
        if ($request->get('receipt') && $request->get('prizesheet')) {
            $filename = 'prizesheet-and-receipts.pdf';
        } elseif ($request->get('receipt')) {
            $filename = 'receipts.pdf';
        } elseif ($request->get('prizesheet')) {
            $filename = 'prizesheet.pdf';
        }

        //Send the file content as the response
        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->Output('prizegiving.pdf', 'S');
            $pdf->Close();
        }, $filename);
    }
}
