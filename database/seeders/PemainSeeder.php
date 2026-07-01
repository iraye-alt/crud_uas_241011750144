<?php

namespace Database\Seeders;

use App\Models\Pemain;
use Illuminate\Database\Seeder;

class PemainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serenaSource = database_path('seeders/images/serena.png');
        $simoneSource = database_path('seeders/images/simone.png');
        $alexSource = database_path('seeders/images/alex.png');
        $sabrinaSource = database_path('seeders/images/sabrina.png');
        $chloeSource = database_path('seeders/images/chloe.png');

        $targetDir = storage_path('app/public/pemain');
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $serenaGambar = null;
        $simoneGambar = null;
        $alexGambar = null;
        $sabrinaGambar = null;
        $chloeGambar = null;

        if (file_exists($serenaSource)) {
            copy($serenaSource, $targetDir . '/serena.png');
            $serenaGambar = 'pemain/serena.png';
        }

        if (file_exists($simoneSource)) {
            copy($simoneSource, $targetDir . '/simone.png');
            $simoneGambar = 'pemain/simone.png';
        }

        if (file_exists($alexSource)) {
            copy($alexSource, $targetDir . '/alex.png');
            $alexGambar = 'pemain/alex.png';
        }

        if (file_exists($sabrinaSource)) {
            copy($sabrinaSource, $targetDir . '/sabrina.png');
            $sabrinaGambar = 'pemain/sabrina.png';
        }

        if (file_exists($chloeSource)) {
            copy($chloeSource, $targetDir . '/chloe.png');
            $chloeGambar = 'pemain/chloe.png';
        }

        Pemain::create([
            'nama_pemain' => 'Serena Williams',
            'cabang_olahraga' => 'Tenis',
            'klub' => 'WTA Tour',
            'usia' => 42,
            'gambar' => $serenaGambar,
        ]);

        Pemain::create([
            'nama_pemain' => 'Simone Biles',
            'cabang_olahraga' => 'Senam Artistik',
            'klub' => 'Team USA',
            'usia' => 27,
            'gambar' => $simoneGambar,
        ]);

        Pemain::create([
            'nama_pemain' => 'Alex Morgan',
            'cabang_olahraga' => 'Sepak Bola',
            'klub' => 'San Diego Wave FC',
            'usia' => 35,
            'gambar' => $alexGambar,
        ]);

        Pemain::create([
            'nama_pemain' => 'Sabrina Ionescu',
            'cabang_olahraga' => 'Bola Basket',
            'klub' => 'New York Liberty',
            'usia' => 26,
            'gambar' => $sabrinaGambar,
        ]);

        Pemain::create([
            'nama_pemain' => 'Chloe Kim',
            'cabang_olahraga' => 'Snowboard',
            'klub' => 'US Snowboard Team',
            'usia' => 24,
            'gambar' => $chloeGambar,
        ]);
    }
}
