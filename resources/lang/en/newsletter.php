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
        'info_0001_admin_message' => 'Currently, there is no subscribed user to the newsletter in the database table: :tableName!',
        'info_0002_admin_message' => 'The list of people subscribed to the newsletter was fetched successfully!',
        'err_0001_admin_message'  => 'The records you are trying to view could not be fetched from the database! Please try again and if the problem persist contact the website administrator!',
    ],
    'store' => [
        'info_0003_admin_message' => 'You have successfully subscribed to the newsletter! Welcome to my website, :fullName!',
        'err_0001_admin_message'  => 'The records you are trying to insert in the fields [Full Name] and [Email] could not be saved in the database! Please try again and if the problem persist contact the website administrator!',
        'err_0002_admin_message'  => 'The records you are trying to insert in the fields [Full Name] and [Email] could not be saved in the database! Please try again and if the problem persist contact the website administrator!',
    ],
    'show' => [
        'info_0001_admin_message' => 'Currently, there is no subscribed user to the newsletter in the database table: :tableName!',
        'info_0004_admin_message' => 'The subscriber you are trying to display does not exist! Please try again!',
        'info_0002_admin_message' => 'Subscriber details to the newsletter were successfully fetched from the database!',
        'err_0001_admin_message'  => 'The record you are trying to view could not be fetched from the database! Please try again and if the problem persist contact the website administrator!',
    ],
    'update' => [
        'info_0006_admin_message' => 'The email address was successfully changed!',
        'err_0001_admin_message'  => 'The record you are trying to change could not be saved in the database! Please try again and if the problem persist contact the website administrator!',
        'err_0002_admin_message'  => 'The record you are trying to change could not be saved in the database! Please try again and if the problem persist contact the website administrator!',
    ],
    'delete' => [
        'info_0001_admin_message' => 'Currently, there is no subscribed user to the newsletter in the database table: :tableName!',
        'info_0007_admin_message' => 'It appears that you are trying to delete an email address that does not exist in the database table: :tableName! Please try again and if the problem persist contact the website administrator!',
        'info_0006_admin_message' => 'The email address was successfully deleted from the database!',
        'err_0001_admin_message'  => 'The selected email address could not be deleted from the database! Please try again and if the problem persist contact the website administrator!',
    ],
    'delete_all_records' => [
        'info_0001_admin_message' => 'Currently, there is no subscribed user to the newsletter in the database table: :tableName!',
        'info_0005_admin_message' => 'It appears that the database table: :tableName does not contain any records that can be deleted! Please try again and if the problem persist contact the website administrator!',
        'info_0007_admin_message' => 'All the records were successfully deleted from the database table: :tableName!',
        'err_0001_admin_message'  => 'The selected email address could not be deleted from the database! Please try again and if the problem persist contact the website administrator!',
    ],
];
