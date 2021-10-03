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
        'info_0001_admin_message' => 'Momentan, nu există niciun articol în tabelul [:tableName] din baza de date!',
        'info_0002_admin_message' => 'Lista tuturor articolelor blog-ului a fost adusă cu success din baza de date!',
        'err_0001_admin_message'  => 'Articolele blog-ului pe care dorești să le vizualizezi nu pot fi afișate, deoarece tabelul [:tableName] nu există în baza de date! Te rog contactează administratorul website-ului!',
    ],
    'store' => [
        'info_0010_admin_message' => 'Un nou articol audio a fost postat (:blogArticleTitle) în subcategoria (:blogSubcategoryTitle)!',
        'info_0011_admin_message' => 'Un nou articol video a fost postat (:blogArticleTitle) în subcategoria (:blogSubcategoryTitle)!',
        'info_0012_admin_message' => 'Un nou articol audio a fost postat (:blogArticleTitle) în subcategoria (:blogSubcategoryTitle)! Cu toate acestea, statusul articolului audio a fost setat ca inactiv! Îi poți schimba statusul în panoul de administrare!',
        'info_0013_admin_message' => 'Un nou articol video a fost postat (:blogArticleTitle) în subcategoria (:blogSubcategoryTitle)! Cu toate acestea, statusul articolului video a fost setat ca inactiv! Îi poți schimba statusul în panoul de administrare!',
        'info_0014_admin_message' => 'Un nou articol scris a fost postat (:blogArticleTitle) în subcategoria (:blogSubcategoryTitle)!',
        'info_0015_admin_message' => 'Un nou articol scris a fost postat (:blogArticleTitle) în subcategoria (:blogSubcategoryTitle)! Cu toate acestea, statusul articolului scris a fost setat ca inactiv! Îi poți schimba statusul în panoul de administrare!',
        'err_0001_admin_message'  => 'Articolul (:blogArticleTitle) pe care dorești să-l inserezi în tabelul [:tableName] nu a putut fi salvat în baza de date, deoarece tabelul nu există! Te rog contactează administratorul website-ului!',
        'err_0002_admin_message'  => 'Articolul (:blogArticleTitle) pe care dorești să-l inserezi în tabelul [:tableName] nu a putut fi salvat în baza de date, deoarece tabelul nu conține același număr de coloane cât a fost solicitat în API! Te rog contactează administratorul website-ului!',
        'err_0003_admin_message'  => 'Articolul (:blogArticleTitle) pe care dorești să-l inserezi în tabelul [:tableName] nu a putut fi salvat în baza de date, deoarece această categorie exită deja! Te rog încearcă din nou, iar dacă problema persistă contactează administratorul website-ului!',
    ],
    'show' => [
        'info_0001_admin_message' => 'Momentan, nu există niciun articol în tabelul [:tableName] din baza de date!',
        'info_0004_admin_message' => 'Articolul pe care dorești să-l vizualizezi nu poate fi afișat, deoarece nu există în baza de date! Te rog încearcă din nou!',
        'info_0002_admin_message' => 'Articolul selectat (:blogArticleTitle) a fost adus cu succes din baza de date!',
        'err_0001_admin_message'  => 'Articolul pe care dorești să-l vizualizezi nu poate fi afișat, deoarece tabelul [:tableName] nu există în baza de date! Te rog contactează administratorul website-ului!',
    ],
    'update' => [
        'info_0008_admin_message' => 'Articolul selectat (:blogArticleTitle) a fost schimbat cu succes!',
        'err_0001_admin_message'  => 'Articolul (:blogArticleTitle) pe care dorești să-l modifici în tabelul [:tableName] nu a putut fi salvat în baza de date, deoarece tabelul nu există! Te rog contactează administratorul website-ului!',
        'err_0002_admin_message'  => 'Articolul (:blogArticleTitle) pe care dorești să-l modifici în tabelul [:tableName] nu a putut fi salvat în baza de date, deoarece tabelul nu conține același număr de coloane cât a fost solicitat în API! Te rog contactează administratorul website-ului!',
    ],
    'delete' => [
        'info_0001_admin_message' => 'Momentan, nu există niciun articol în tabelul [:tableName] din baza de date!',
        'info_0005_admin_message' => 'Articolul selectat nu poate fi șters, deoarece nu există în baza de date! Te rog încearcă din nou!',
        'info_0006_admin_message' => 'Articolul selectat (:blogArticleTitle) a fost șters cu succes din baza de date!',
        'err_0001_admin_message'  => 'Articolul (:blogArticleTitle) selectat nu a putut fi șters din tabelul [:tableName] din baza de date, deoarece acesta nu există! Te rog contactează administratorul website-ului!',
    ],
    'delete_all_records' => [
        'info_0001_admin_message' => 'Momentan, nu există niciun articol în tabelul [:tableName] din baza de date!',
        'info_0005_admin_message' => 'Articolele nu au putut fi șterse, deoarece tabelul [:tableName] din baza de date nu conține nicio înregistrare! Te rog încearcă din nou!' ,
        'info_0007_admin_message' => 'Articolele au fost șterse cu succes din tabelul [:tableName] din baza de date!',
        'err_0001_admin_message'  => 'Articolele nu au putut fi șterse din  tabelul [:tableName] din baza de date, deoarece acesta nu conține nicio înregistrare! Te rog contactează administratorul website-ului!',
    ],
];
