<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\PageSectionCarousel;

class PageSectionCarouselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        PageSectionCarousel::truncate();
        $records = [
            [
                'id'                   => '1',
                'page_section_id'      => '1',
                'image_path'           => '/images/pages/home/carousel-v1/Carousel-img0_495.webp',
                'title'                => 'Iubire de oameni',
                'caption_text_1'       => 'Întotdeauna mi-a plăcut să fiu înconjurată de oameni și am ascultat cu încântare poveștile lor de viață.',
                'caption_text_2'       => 'Am realizat că cel mai important dar pe care îl poți oferi lumii este timpul tău și energia ta.',
                'caption_text_3'       => 'Și din toată inima îmi doresc să pot ajuta cât mai mulți oameni cu ceea ce au nevoie.',
                'caption_text_4'       => '',
                'button_label'         => 'Alfă mai multe!',
                'link_to_blog_article' => config('app.url') . '/blog/article/view/1',
            ],
            [
                'id'                   => '2',
                'page_section_id'      => '1',
                'image_path'           => config('app.url') . '/images/pages/home/carousel-v1/Carousel-img1_495.webp',
                'title'                => 'Inspirație pentru creștere',
                'caption_text_1'       => '"Cei pe care îi servești, îți arată cum să crești" - Andy Szekely',
                'caption_text_2'       => 'Din anul 2016 m-am lăsat ghidată de Andy Szekely în dezvoltarea mea si am crescut armonios. Participarea la evenimentele lui si comunitatea lui de oameni faini m-au inspirat și am devenit omul energic de acum.',
                'caption_text_3'       => 'Am fost fascinată de stilul lui Andy de a povesti și de a amuza oamenii și așa îmi doresc să transmit și eu informațiile.',
                'caption_text_4'       => '',
                'button_label'         => 'Alfă mai multe!',
                'link_to_blog_article' => config('app.url') . '/blog/article/view/2',
            ],
            [
                'id'                   => '3',
                'page_section_id'      => '1',
                'image_path'           => config('app.url') . '/images/pages/home/carousel-v1/Carousel-img2_495.webp',
                'title'                => 'Liniște interioară',
                'caption_text_1'       => 'În secolul vitezei și în lumea agitată în care trăim, a rămâne calm și liniștit este un lucru măreț.',
                'caption_text_2'       => 'Relaxarea prin meditație și dans te ajută să înfrunți provocările în viață. Vrei să încerci?',
                'caption_text_3'       => '',
                'caption_text_4'       => '',
                'button_label'         => 'Alfă mai multe!',
                'link_to_blog_article' => config('app.url') . '/blog/article/view/3',
            ],
            [
                'id'                   => '4',
                'page_section_id'      => '1',
                'image_path'           => config('app.url') . '/images/pages/home/carousel-v1/Carousel-img3_495.webp',
                'title'                => 'Împlinire prin dans',
                'caption_text_1'       => 'Când ești pasionat de ceva încă de mic și vezi că nu îți trece cu nimic în timp, înseamnă că este ceea ce ți se potrivește.',
                'caption_text_2'       => 'Dansez de când mă știu și îmi doresc să ghidez cât mai mulți oameni să-și găseasca propriul ritm în viață.',
                'caption_text_3'       => 'Totul începe cu primul pas.',
                'caption_text_4'       => '',
                'button_label'         => 'Alfă mai multe!',
                'link_to_blog_article' => config('app.url') . '/blog/article/view/4',
            ],
            [
                'id'                   => '5',
                'page_section_id'      => '1',
                'image_path'           => config('app.url') . '/images/pages/home/carousel-v1/Carousel-img4_495.webp',
                'title'                => 'Îndrumător în nutriție',
                'caption_text_1'       => '”Corpul este singurul loc unde locuiești toată viața”- Jim Rohn',
                'caption_text_2'       => 'De obicei oamenii au grijă de trupul lor doar atunci când se confruntă cu o problemă de sănătate și atunci pentru o perioadă adoptă un stil nutrițional echilibrat. Dar când scapă de problemă, atunci revin la vechile obiceiuri și uită de corpul lor. Totuși mai sunt și oameni care se preocupă de sănătatea lor toată viața și care se simt foarte bine și au multă energie.',
                'caption_text_3'       => 'Eu mă încadrez în a doua categorie. Tu?',
                'caption_text_4'       => 'La cursul de tehnician nutriționist am învățat cum să am un stil de viață sănătos și mi-ar plăcea să îți împărtășesc și ție din cunoștințele mele. Accepți?',
                'button_label'         => 'Alfă mai multe!',
                'link_to_blog_article' => config('app.url') . '/blog/article/view/5',
            ],
            [
                'id'                   => '6',
                'page_section_id'      => '1',
                'image_path'           => config('app.url') . '/images/pages/home/carousel-v1/Carousel-img5_495.webp',
                'title'                => 'Alergător de fapte bune',
                'caption_text_1'       => 'Am fost o persoană sedentară mulți ani și sportul nu-mi plăcea deloc. Dar când am descoperit că pot ajuta pe alții făcând mișcare, m-am apucat de alergat.',
                'caption_text_2'       => 'Mișcarea în natură are multe beneficii atât fizice, cât și mentale și le-am simțit din plin la cursele de 10 km de până acum.',
                'caption_text_3'       => 'Așa am reușit să fiu mai sănătoasă și să mă implic în activități caritabile.',
                'caption_text_4'       => 'Run for a good life.',
                'button_label'         => 'Alfă mai multe!',
                'link_to_blog_article' => config('app.url') . '/blog/article/view/6',
            ],
        ];
        PageSectionCarousel::insert($records);
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
