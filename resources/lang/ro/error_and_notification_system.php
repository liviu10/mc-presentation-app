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
        'info_0001_admin_message' => 'Se pare că tabelul următor din baza de date: :tableName este gol!',
        'info_0002_admin_message' => 
        [
            'message_1' => 'Lista erorilor și a notificărilor a fost adusă din baza de date! Această listă conține :tableRecordCount înregistrări!',
            'message_2' => 'Lista erorilor și a notificărilor a fost adusă din baza de date! Această listă conține :tableRecordCount înregistrare!',
        ],
        'err_0001_admin_message'  => 'Înregistrările pe care dorești să le vizualizezi nu au putut fi afișate din baza de date! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
    ],
    'store' => [
        'info_0003_admin_message' => 'Codul de notificare: :notifyCode (Descriere: :notifyDescription) a fost inserat cu success în baza de date!',
        'err_0001_admin_message'  => 'Înregistrările pe care încerci să le inserezi in câmpurile [Notify Code], [Notify Short Description] și [Notify Reference] nu au putut fi salvate în baza de date! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
        'err_0002_admin_message'  => 'Înregistrările pe care dorești să le vizualizezi nu au putut fi afișate din baza de date! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
        'err_0003_admin_message'  => 'Codul de notificare: :notifyCode nu a putut fi salvat în baza de date, deoarece acesta există deja! Te rog să încerci din nou cu un cod de notificare diferit!',
    ],
    'show' => [
        'info_0001_admin_message' => 'Se pare că tabelul următor din baza de date: :tableName este gol!',
        'info_0004_admin_message' => 'Se pare că încerci să vizualizei un cod de notificare care nu există în baza de date! Te rog încearcă din nou!',
        'info_0002_admin_message' => 'Eroarea și tipul de notificare pe care ai selectat-o a fost adusă cu succes din baza de date!',
        'err_0001_admin_message'  => 'Înregistrarea pe care încerci să o vizualizei nu a putut fi adusă din baza de date! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
    ],
    'update' => [
        'info_0006_admin_message' => 'Codul de notificare: :notifyCode a fost actualizat și salvat în baza de date!',
        'err_0001_admin_message'  => 'Codul de notificare pe care încerci să-l vizualizezi nu a putut fi adus din baza de date! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
        'err_0002_admin_message'  => 'Codul de notificare pe care încerci să-l vizualizezi nu a putut fi adus din baza de date! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
    ],
    'delete' => [
        'info_0001_admin_message' => 'Se pare că tabelul următor din baza de date: :tableName este gol!',
        'info_0005_admin_message' => 'Se pare că încerci să ștergi un cod de notificare care nu exită în tabelul: :tableName din baza de date! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
        'info_0006_admin_message' => 'Codul de notificare: :notifyCode a fost șters cu succes din baza de date!',
        'err_0001_admin_message'  => 'înregistrarea pe care ai selectat-o nu poate fi ștearsă din baza de date! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
    ],
    'delete_all_records' => [
        'info_0001_admin_message' => 'Se pare că tabelul următor din baza de date: :tableName este gol!',
        'info_0005_admin_message' => 'Se pare că tabelul: :tableName din baza de date nu are nicio înregistrare care poate fi ștearsă! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
        'info_0007_admin_message' => 'Toate înregistrările din tabelul: :tableName din baza de date au fost șterse cu succes!',
        'err_0001_admin_message'  => 'Înregistrările pe care le-ai selectat nu au putut fi șterse din baza de date! Te rog să încerci mai târziu, iar dacă problema persistă contactează administratorul website-ului!',
    ],
];
