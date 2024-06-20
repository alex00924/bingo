<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CSVBingoCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i < 21; $i++) {
            $path = storage_path() . "/csv/$i.CSV";
            $delimiter = ";";
            if (($handle = fopen($path, "r")) === false)
            {
                print("can't open file $i");
                break;
            }

            $csv_headers = fgetcsv($handle, 4000, $delimiter);
            $bingoCardData = [];
            $nCnt = 0;

            while ($row = fgetcsv($handle, 4000, $delimiter))
            {
                    $bingoCard = array_combine($csv_headers, $row);
                    if ($nCnt == 1000) {
                        DB::table('bingo_cards')->insert($bingoCardData);
                        $nCnt = 0;
                        $bingoCardData = [];
                    }
                    $nCnt++;
                    $data = [];
                    for($i = 1; $i < 26; $i++) {
                        $data["d$i"] = $bingoCard["D$i"];
                    }
                    $data['card_number'] = str_pad($bingoCard['CartelaD'], 6, '0', STR_PAD_LEFT);
                    $data['card_digit'] = $bingoCard['DigitoD'];
                    $bingoCardData[] = $data;
            }
            DB::table('bingo_cards')->insert($bingoCardData);

            fclose($handle);
        }
    }
}
