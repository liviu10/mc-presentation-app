<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Questionnaire;

class QuestionnaireSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Questionnaire::truncate();
        $records = [
            [
                'id'                => '1',
                'title'             => 'Relația dintre emoții și muzică',
                'scope'             => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Beatae provident corrupti dolor nostrum similique, pariatur soluta labore deserunt sapiente iste ratione quaerat eius natus possimus rerum atque consectetur, vero at? Quis ex minus labore deserunt, fugiat quas et quasi. Pariatur ipsa architecto accusamus unde laborum obcaecati impedit culpa, sunt, eius illum animi, ex quidem? Eligendi dolores amet repellat. Dignissimos odit repudiandae corrupti necessitatibus voluptatum fuga mollitia recusandae neque praesentium. Earum quidem vel expedita itaque sint sit dicta hic laborum nostrum optio odit sed, velit facilis atque repudiandae nisi quod laudantium assumenda amet dolores delectus autem magni recusandae. Assumenda, optio quaerat.', // 100 words
                'description'       => 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequuntur quod quia, obcaecati veniam est repellat quisquam illum. Perspiciatis corrupti aut autem necessitatibus itaque veritatis, incidunt blanditiis aspernatur? Optio earum deleniti rerum aliquid molestias nobis voluptatum tempore similique. Non, officia unde doloremque fuga nostrum ullam quibusdam ipsa voluptatem, iste sit, et maiores quam? Nisi necessitatibus qui sapiente possimus, dignissimos harum placeat praesentium laboriosam ullam iste voluptate illum incidunt aliquid modi vitae maiores doloremque provident exercitationem reiciendis ea commodi dolores? Possimus sit nulla quasi ad dolor error veniam eaque, odit quibusdam optio tempore quas consequatur, recusandae sed fugit asperiores doloribus, fugiat molestiae itaque? Perspiciatis nam velit ipsa cumque, excepturi expedita praesentium quam molestiae modi quasi eaque. Ipsam eveniet id facere libero quos, consequuntur necessitatibus quidem dolor sunt incidunt minima beatae animi enim. Provident, nemo eveniet tempora laudantium repellat temporibus culpa aliquid ut ipsa dolor ullam perspiciatis illum officiis accusantium cupiditate consequatur incidunt? Ad optio eius dolorum eos saepe. Nemo dolore veritatis, labore distinctio eos, ad tenetur est eum laboriosam deleniti quo repellat at facere amet sed voluptatem animi ex quam quidem. Repellendus dicta culpa optio consequuntur. Voluptatum ex quia, odio corrupti sit error facilis veritatis eius odit ad ipsa nobis, voluptas, voluptate ratione sapiente explicabo aliquam numquam impedit culpa similique sint facere. Perspiciatis, dolor voluptas velit eos omnis voluptatibus delectus ratione! Debitis consectetur cumque alias repellat dicta cupiditate consequuntur quidem quia aspernatur accusantium maxime culpa nostrum voluptate reiciendis nisi optio delectus soluta officia, omnis aperiam eaque commodi quibusdam deleniti. Accusamus, ullam amet.', // 250 word
                'is_active'         => '1',
            ],
        ];
        Questionnaire::insert($records);
    }
}
