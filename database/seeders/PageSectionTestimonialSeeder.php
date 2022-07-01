<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PageSectionTestimonial;

class PageSectionTestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        PageSectionTestimonial::truncate();
        $records = [
            [
                'id'              => '1',
                'page_section_id' => '3',
                'name'            => 'Liviu V.',
                'occupation'      => 'Developer',
                'description'     => 'Am apelat la Mădălina în perioada 2020 - 2021 pentru a mă ajuta să slăbesc, deoarece ajunsesem la o greutate destul de mare și la un stil de viață destul de haotic care începuseră să-mi creeze probleme. Ce mi-a plăcut foarte mult la Mădălina a fost că am avut împreună o discuție legată de stilul meu de viață și ce îmi place să mănânc; împreună am stabilit un anumit număr de calori și un program de exerciții fizice. Chiar și la un an după terminarea acestui program am reușit să-mi păstrez rutina de a avea mai puțină mâncare în farfurie, de a face combinații de alimente corecte și de a face gimnastică aproape în fiecare zi.',
            ]
        ];
        PageSectionTestimonial::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
