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
        'info_0001_admin_message' => 'Momentan, nu există niciun eventiment în tabelul [:tableName] din baza de date!',
        'info_0002_admin_message' => 'Lista evenimentelor a fost adusă cu succes din baza de date!',
        'err_0001_admin_message'  => 'Evenimentele pe care dorești să le vizualizezi nu pot fi afișate, deoarece tabelul [:tableName] nu există în baza de date! Te rog contactează administratorul website-ului!',
    ],
    'store' => [
        'info_0003_admin_message' => 'Evenimentul a fost creat cu success!',
        'err_0001_admin_message'  => 'Evenimentul pe care dorești să-l programezi nu a putut fi salvat! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
        'err_0002_admin_message'  => 'Evenimentul pe care dorești să-l programezi nu a putut fi salvat! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
    ],
    'show' => [
        'info_0001_admin_message' => 'Momentan, nu există niciun eveniment în tabelul [:tableName] din baza de date!',
        'info_0004_admin_message' => 'Evenimentul pe care dorești să o vizualizezi nu poate fi afișat, deoarece nu există în baza de date! Te rog încearcă din nou!',
        'info_0002_admin_message' => 'Evenimentul selectat a fost adus cu succes din baza de date!',
        'err_0001_admin_message'  => 'Evenimentul pe care dorești să-l vizualizezi nu poate fi afișat, deoarece tabelul [:tableName] nu există în baza de date! Te rog contactează administratorul website-ului!',
    ],
    'update' => [
        'info_0008_admin_message' => 'Evenimentul selectat a fost schimbat cu succes!',
        'err_0001_admin_message'  => 'Evenimentul pe care dorești să-l modifici în tabelul [:tableName] nu a putut fi salvat în baza de date, deoarece tabelul nu există! Te rog contactează administratorul website-ului!',
        'err_0002_admin_message'  => 'Evenimentul pe care dorești să-l modifici în tabelul [:tableName] nu a putut fi salvat în baza de date, deoarece tabelul nu conține același număr de coloane cât a fost solicitat în API! Te rog contactează administratorul website-ului!',
    ],
    'delete' => [
        'info_0001_admin_message' => 'Momentan, nu există niciun eventiment în tabelul [:tableName] din baza de date!',
        'info_0005_admin_message' => 'Evenimentul selectat nu poate fi șters, deoarece nu există în baza de date! Te rog încearcă din nou!',
        'info_0006_admin_message' => 'Evenimentul selectat a fost șters cu succes din baza de date!',
        'err_0001_admin_message'  => 'Evenimentul selectat nu a putut fi șters din tabelul [:tableName] din baza de date, deoarece acesta nu există! Te rog contactează administratorul website-ului!',
    ],
    'delete_all_records' => [
        'info_0001_admin_message' => 'Momentan, nu există niciun eventiment în tabelul [:tableName] din baza de date!',
        'info_0005_admin_message' => 'Evenimentele selectate nu au putut fi șterse, deoarece tabelul [:tableName] din baza de date nu conține nicio înregistrare! Te rog încearcă din nou!' ,
        'info_0007_admin_message' => 'Evenimentele selectate au fost șterse cu succes din tabelul [:tableName] din baza de date!',
        'err_0001_admin_message'  => 'Evenimentele selectate nu au putut fi șterse din  tabelul [:tableName] din baza de date, deoarece acesta nu conține nicio înregistrare! Te rog contactează administratorul website-ului!',
    ],
];
