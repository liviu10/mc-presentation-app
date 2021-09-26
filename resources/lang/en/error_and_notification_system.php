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
        'info_0001_admin_message' => 'It appears that the following database table: :tableName is empty!',
        'info_0002_admin_message' => 'The list of errors and notifications was successfully fetched from the database! This list contains :tableRecordCount record(s)!',
        'err_0001_admin_message'  => 'The records you are trying to view could not be fetched from the database! Please try again later and if the problem persists contact the website administrator!',
    ],
    'store' => [
        'info_0003_admin_message' => 'The notify code: :notifyCode (Description: :notifyDescription) was successfully inserted into the database!',
        'err_0001_admin_message'  => 'The records you are trying to insert in the fields [Notify Code], [Notify Short Description] and [Notify Reference] could not be saved in the database! Please try again later and if the problem persists contact the website administrator!',
        'err_0002_admin_message'  => 'The records you are trying to view could not be fetched from the database! Please try again later and if the problem persists contact the website administrator!',
        'err_0003_admin_message'  => 'The following notify code: :notifyCode could not be saved because it already exists in the database! Please try again with a different notify code!',
    ],
    'show' => [
        'info_0001_admin_message' => 'It appears that the following database table: :tableName is empty!',
        'info_0004_admin_message' => 'It appears that the notify code you are trying to view does not exist in the database! Please try again!',
        'info_0002_admin_message' => 'The error and notification type you have selected was successfully fetched from the database!',
        'err_0001_admin_message'  => 'The record you are trying to view could not be fetched from the database! Please try again later and if the problem persists contact the website administrator!',
    ],
    'update' => [
        'info_0006_admin_message' => 'The notify code: :notifyCode was successfully updated and saved into the database!',
        'err_0001_admin_message'  => 'The notify code you are trying to update could not be saved in the database! Please try again later and if the problem persists contact the website administrator!',
        'err_0002_admin_message'  => 'The notify code you are trying to update could not be saved in the database! Please try again later and if the problem persists contact the website administrator!',
    ],
    'delete' => [
        'info_0001_admin_message' => 'It appears that the following database table: :tableName is empty!',
        'info_0005_admin_message' => 'It appears that the notify code you are trying to delete does not exist in the database table: :tableName! Please try again later and if the problem persists contact the website administrator!',
        'info_0006_admin_message' => 'The notify code: :notifyCode was successfully updated and saved into the database!',
        'err_0001_admin_message'  => 'The records you are trying to view could not be fetched from the database! Please try again later and if the problem persists contact the website administrator!',
    ],
    'delete_all_records' => [
        'info_0001_admin_message' => 'It appears that the following database table: :tableName is empty!',
        'info_0005_admin_message' => 'It appears that the database table: :tableName does not have any records to be deleted! Please try again later and if the problem persists contact the website administrator!',
        'info_0007_admin_message' => 'All the records from the database table: :tableName were successfully deleted!',
        'err_0001_admin_message'  => 'The records you have selected could not be deleted from the database! Please try again later and if the problem persists contact the website administrator!',
    ],
];
