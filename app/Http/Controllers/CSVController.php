<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Competencia;
use Illuminate\Http\Request;

class CSVController extends Controller
{
    public function upload(Request $request)
{
    $request->validate([
        'csv_file' => 'required|file|mimes:csv,txt',
    ]);

    $file = $request->file('csv_file');
    $filePath = $file->getRealPath();

    // Read CSV file and parse its content without headers
    $csvData = array_map('str_getcsv', file($filePath));

    foreach ($csvData as $row) {
        // Map each row manually to the correct database fields
        $gametag = trim($row[1]);  // First column in CSV is 'gametag'
        $kills = (int)$row[3];     // Second column is 'kills'
        $deaths = (int)$row[4];    // Third column is 'deaths'
        $assists = (int)$row[5];   // Fourth column is 'assists'
        $dd = (int)$row[6];
        $acs = (int)$row[2];       // Fifth column is 'acs'
        $adr = (int)$row[7];       // Sixth column is 'adr'
        $hs = (float)$row[8];      // Seventh column is 'hs'
        $kast = (float)$row[9];    // Eighth column is 'kast'
        $fk = (int)$row[10];        // Ninth column is 'fk'
        $fd = (int)$row[11];        // Tenth column is 'fd'
        $competencias_id = (int)$row[12]; // Eleventh column is 'competencia_id'
        $winloss_input = strtoupper(trim($row[0]));  // Twelfth column is 'winloss' as 'W' or 'L'

        // Find the competencia related to the score
        $competencia = Competencia::find($competencias_id);

        if ($competencia) {
            // Determine win/loss value based on 'W' or 'L' in CSV and competencia's winners
            $winlossValue = $winloss_input === 'W'
                ? ($competencia->winners == 1 ? 1 : 0)
                : ($competencia->winners == 1 ? 0 : 1);

            // Insert data into the scores table
            Score::create([
                'gametag' => $gametag,
                'kills' => $kills,
                'deaths' => $deaths,
                'assists' => $assists,
                'acs' => $acs,
                'adr' => $adr,
                'hs' => $hs,
                'kast' => $kast,
                'fk' => $fk,
                'fd' => $fd,
                'competencias_id' => $competencias_id,
                'winloss' => $winlossValue,
                'dd' => $dd,
            ]);
        }
    }

    return redirect()->back()->with('success', 'CSV data uploaded successfully!');
}
}
