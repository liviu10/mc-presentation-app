<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    'index' => [
        'info_0001_admin_message' => [
            'message_1' => 'Momentan, nu există nicio categorie de blog definită în tabelul [:tableName] din baza de date!',
            'message_2' => 'Momentan, nu există nicio categorie de blog definită!',
        ],
        'info_0002_admin_message' => [
            'message_1' => 'Lista categoriilor blog-ului a fost adusă cu succes din baza de date!',
            'message_2' => 'Lista categoriilor blog-ului a fost adusă cu succes!',
        ],
        'err_0001_admin_message'  => 'Categoriile blog-ului pe care dorești să le vizualizezi nu pot fi afișate, deoarece tabelul [:tableName] nu există în baza de date! Te rog contactează administratorul website-ului!',
    ],
    'store' => [
        'info_0003_admin_message' => 'O nouă categorie de blog a fost creată (:blogCategoryTitle) în baza de date!',
        'info_0009_admin_message' => 'O nouă categorie de blog a fost creată în baza de date! Cu toate acestea, statusul categoriei (:blogCategoryTitle) a fost setat ca inactiv! Poți activa această categorie în panoul de administrare!',
        'err_0001_admin_message'  => 'Categoria blog-ului (:blogCategoryTitle) pe care dorești să o inserezi în tabelul [:tableName] nu a putut fi salvată în baza de date, deoarece tabelul nu există! Te rog contactează administratorul website-ului!',
        'err_0002_admin_message'  => 'Categoria blog-ului (:blogCategoryTitle) pe care dorești să o inserezi în tabelul [:tableName] nu a putut fi salvată în baza de date, deoarece tabelul nu conține același număr de coloane cât a fost solicitat în API! Te rog contactează administratorul website-ului!',
        'err_0003_admin_message'  => 'Categoria blog-ului (:blogCategoryTitle) pe care dorești să o inserezi în tabelul [:tableName] nu a putut fi salvată în baza de date, deoarece această categorie exită deja! Te rog încearcă din nou, iar dacă problema persistă contactează administratorul website-ului!',
    ],
    'show' => [
        'info_0001_admin_message' => 'Momentan, nu există nicio categorie de blog definită în tabelul [:tableName] din baza de date!',
        'info_0004_admin_message' => 'Categoria blog-ului pe care dorești să o vizualizezi nu poate fi afișată, deoarece nu există în baza de date! Te rog încearcă din nou!',
        'info_0002_admin_message' => 'Categoria blog-ului selectată (:blogCategoryTitle) a fost adusă cu succes din baza de date!',
        'err_0001_admin_message'  => 'Categoria blog-ului pe care dorești să o vizualizezi nu poate fi afișată, deoarece tabelul [:tableName] nu există în baza de date! Te rog contactează administratorul website-ului!',
    ],
    'update' => [
        'info_0008_admin_message' => 'Categoria blog-ului selectată (:blogCategoryTitle) a fost schimbată cu succes!',
        'err_0001_admin_message'  => 'Categoria blog-ului (:blogCategoryTitle) pe care dorești să o modifici în tabelul [:tableName] nu a putut fi salvată în baza de date, deoarece tabelul nu există! Te rog contactează administratorul website-ului!',
        'err_0002_admin_message'  => 'Categoria blog-ului (:blogCategoryTitle) pe care dorești să o modifici în tabelul [:tableName] nu a putut fi salvată în baza de date, deoarece tabelul nu conține același număr de coloane cât a fost solicitat în API! Te rog contactează administratorul website-ului!',
    ],
    'delete' => [
        'info_0001_admin_message' => 'Momentan, nu există nicio categorie de blog definită în tabelul [:tableName] din baza de date!',
        'info_0005_admin_message' => 'Categoria blog-ului selectată nu poate fi ștearsă, deoarece nu există în baza de date! Te rog încearcă din nou!',
        'info_0006_admin_message' => 'Categoria de blog selectată (:blogCategoryTitle) a fost ștearsă cu succes din baza de date!',
        'err_0001_admin_message'  => 'Categoria blog-ului (:blogCategoryTitle) selectată nu a putut fi ștearsă din tabelul [:tableName] din baza de date, deoarece aceasta nu există! Te rog contactează administratorul website-ului!',
    ],
    'delete_all_records' => [
        'info_0001_admin_message' => 'Momentan, nu există nicio categorie de blog definită în tabelul [:tableName] din baza de date!',
        'info_0005_admin_message' => 'Categoriile blog-ului nu au putut fi șterse, deoarece tabelul [:tableName] din baza de date nu conține nicio înregistrare! Te rog încearcă din nou!' ,
        'info_0007_admin_message' => 'Categoriile blog-ului au fost șterse cu succes din tabelul [:tableName] din baza de date!',
        'err_0001_admin_message'  => 'Categoriile blog-ului nu au putut fi șterse din  tabelul [:tableName] din baza de date, deoarece acesta nu conține nicio înregistrare! Te rog contactează administratorul website-ului!',
    ],
];
