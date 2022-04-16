<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NewsletterKpi;

class NewsletterKpiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NewsletterKpi::truncate();
        $records = [
            [
                'id'              => '1',
                'kpi_name'        => 'Număr de email-uri trimise',
                'kpi_description' => 'Acest indicator contorizează câte email-uri au fost trimise într-o anumită perioadă.',
                'kpi_formula'     => '',
            ],
            [
                'id'              => '2',
                'kpi_name'        => 'Număr de email-uri deschise',
                'kpi_description' => 'Acest indicator contorizează câte email-uri au fost trimise și deschise într-o anumită perioadă.',
                'kpi_formula'     => '',
            ],
            [
                'id'              => '3',
                'kpi_name'        => 'Rata de citire a email-urilor',
                'kpi_description' => 'Acest indicator calculează rata de citire a email-urilor trimise.',
                'kpi_formula'     => '(număr email-uri deschise / număr email-uri trimise) x 100',
            ],
            [
                'id'              => '4',
                'kpi_name'        => 'Număr de email-uri netrimise',
                'kpi_description' => 'Acest indicator contorizează câte email-uri nu au fost trimise dintr-un număr total de email-uri trimise (ex: căsuță poștală plină, adresă de email greșită).',
                'kpi_formula'     => '',
            ],
            [
                'id'              => '5',
                'kpi_name'        => 'Rata email-urilor netrimise',
                'kpi_description' => 'Acest indicator calculează rata email-urilor netrimise.',
                'kpi_formula'     => '(număr de email-uri netrimise / număr de email-uri trimis) x 100',
            ],
            [
                'id'              => '6',
                'kpi_name'        => 'Numărul dezabonărilor',
                'kpi_description' => 'Acest indicator contorizează numărul dezabonărilor.',
                'kpi_formula'     => '',
            ],
            [
                'id'              => '7',
                'kpi_name'        => 'Rata dezabonărilor',
                'kpi_description' => 'Acest indicator calculează rata dezabonărilor.',
                'kpi_formula'     => '(numărul dezabonărilor / numărul email-urilor trimis) x 100',
            ],
            [
                'id'              => '8',
                'kpi_name'        => 'Număr total abonări noi',
                'kpi_description' => 'Acest indicator contorizează numărul total de abonări noi.',
                'kpi_formula'     => '',
            ],
            [
                'id'              => '9',
                'kpi_name'        => 'Număr total abonări',
                'kpi_description' => 'Acest indicator contorizează numărul total de abonări.',
                'kpi_formula'     => '',
            ],
            [
                'id'              => '10',
                'kpi_name'        => 'Rata de creștere a listei de abonați',
                'kpi_description' => 'Acest indicator calculează rata de creștere a listei de abonați.',
                'kpi_formula'     => '((numărul total abonări noi - numărul dezabonărilor) / numărul total abonări) x 100',
            ],
            [
                'id'              => '11',
                'kpi_name'        => 'Rata de email-urilor trimise',
                'kpi_description' => 'Acest indicator calculează rata de email-urilor trimise luând numărul de email-uri netrimise.',
                'kpi_formula'     => '((număr de email-uri trimise - număr de email-uri netrimise) / număr de email-uri netrimise) x 100',
            ],
            [
                'id'              => '12',
                'kpi_name'        => 'Rata de email-urilor trimise',
                'kpi_description' => 'Acest indicator calculează rata de email-urilor trimise luând numărul de email-uri netrimise.',
                'kpi_formula'     => '((număr de email-uri trimise - număr de email-uri netrimise) / număr de email-uri netrimise) x 100',
            ],
            [
                'id'              => '13',
                'kpi_name'        => 'Numărul total de campanii și numărul total de campanii active',
                'kpi_description' => 'Acest indicator contorizează numărul total de campanii de newsletter împreună cu numărul total de campanii active.',
                'kpi_formula'     => '',
            ],
            [
                'id'              => '14',
                'kpi_name'        => 'Numărul total de abonări pentru campania curentă',
                'kpi_description' => 'Acest indicator contorizează numărul total de abonări pentru campania curentă.',
                'kpi_formula'     => '',
            ],
            [
                'id'              => '15',
                'kpi_name'        => 'Numărul total de dezabonări pentru campania curentă',
                'kpi_description' => 'Acest indicator contorizează numărul total de dezabonări pentru campania curentă.',
                'kpi_formula'     => '',
            ],
            [
                'id'              => '16',
                'kpi_name'        => 'Numărul total de abonări pentru campania anterioară',
                'kpi_description' => 'Acest indicator contorizează numărul total de abonări pentru campania anterioară.',
                'kpi_formula'     => '',
            ],
            [
                'id'              => '17',
                'kpi_name'        => 'Numărul total de dezabonări pentru campania anterioară',
                'kpi_description' => 'Acest indicator contorizează numărul total de dezabonări pentru campania anterioară.',
                'kpi_formula'     => '',
            ],
        ];
        NewsletterKpi::insert($records);
    }
}
