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
            'message_1' => 'Currently, there are no defined blog subcategories in the database table [:tableName]!',
            'message_2' => 'Currently, there are no defined blog subcategories!',
        ],
        'info_0002_admin_message' => [
            'message_1' => 'The list of blog subcategories was fetched successfully from the database!',
            'message_2' => 'The list of blog subcategories was fetched successfully!',
        ],
        'err_0001_admin_message'  => 'The blog subcategories you are trying to view could not be fetched from the database!, because the [:tableName] does not exist in the database! Please contact the website administrator!',
    ],
    'store' => [
        'info_0003_admin_message' => 'A new blog subcategory was created (:blogSubcategoryTitle) for the blog category (:blogCategoryTitle)!',
        'info_0009_admin_message' => 'A new blog subcategory was created in the database! However, the status of this newly created blog subcategory (:blogSubcategoryTitle) was set to inactive! You can active this blog subcategory in the administration panel!',
        'err_0001_admin_message'  => 'The blog subcategory (:blogSubcategoryTitle) you are trying to insert in the table [:tableName] could not be saved in the database, because the table does not exist! Please contact the website administrator!',
        'err_0002_admin_message'  => 'The blog subcategory (:blogSubcategoryTitle) you are trying to insert in the table [:tableName] could not be saved in the database, because the table does not contain the same number of column as what was requested in API! Please contact the website administrator!',
        'err_0003_admin_message'  => 'The blog subcategory (:blogSubcategoryTitle) you are trying to insert in the table [:tableName] could not be saved in the database, because this already exist! Please try again and if the problem persist contact the website administrator!',
    ],
    'show' => [
        'info_0001_admin_message' => 'Currently, there are no defined blog subcategories in the database table [:tableName]!',
        'info_0004_admin_message' => 'The blog subcategory you are trying to display does not exist, because it does not exist in the database! Please try again!',
        'info_0002_admin_message' => 'The selected blog subcategory (:blogSubcategoryTitle) was successfully fetched from the database!',
        'err_0001_admin_message'  => 'The blog subcategory you are trying to view could not be fetched from the database!, because the [:tableName] does not exist in the database! Please contact the website administrator!',
    ],
    'update' => [
        'info_0008_admin_message' => 'The selected blog subcategory (:blogSubcategoryTitle) was successfully modified!',
        'err_0001_admin_message'  => 'The blog subcategory (:blogSubcategoryTitle) you are trying to modify in the table [:tableName] could not be saved in the database, because the table does not exist! Please contact the website administrator!',
        'err_0002_admin_message'  => 'The blog subcategory (:blogSubcategoryTitle) you are trying to modify in the table [:tableName] could not be saved in the database, because the table does not contain the same number of column as what was requested in API! Please contact the website administrator!',
    ],
    'delete' => [
        'info_0001_admin_message' => 'Currently, there are no defined blog subcategories in the database table [:tableName]!',
        'info_0005_admin_message' => 'The selected blog subcategory could not be deleted, because it does not exist in the database! Please try again!',
        'info_0006_admin_message' => 'The selected blog subcategory (:blogSubcategoryTitle) was successfully deleted from the database!',
        'err_0001_admin_message'  => 'The selected blog subcategory (:blogSubcategoryTitle) could not be deleted from the database table: [:tableName], because it does not exist in the database! Please contact the website administrator!',
    ],
    'delete_all_records' => [
        'info_0001_admin_message' => 'Currently, there are no defined blog subcategories in the database table [:tableName]!',
        'info_0005_admin_message' => 'The blog subcategories could not be deleted, because the database table [:tableName] does not contain any record(s)! Please try again!',
        'info_0007_admin_message' => 'All the blog subcategories were successfully deleted from the database table: [:tableName]!',
        'err_0001_admin_message'  => 'The blog subcategories could not be deleted from the database table: [:tableName], because it does not contain any record(s)! Please contact the website administrator!',
    ],
];
