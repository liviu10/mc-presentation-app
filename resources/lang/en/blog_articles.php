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
        'info_0001_admin_message' => 'Currently, there are no blog articles in the database table [:tableName]!',
        'info_0002_admin_message' => 'The list of all blog articles was fetched successfully from the database!',
        'err_0001_admin_message'  => 'The blog articles you are trying to view could not be fetched from the database!, because the [:tableName] does not exist in the database! Please contact the website administrator!',
    ],
    'store' => [
        'info_0010_admin_message' => 'A new audio article was posted (:blogArticleTitle) in the subcategory (:blogSubcategoryTitle)!',
        'info_0011_admin_message' => 'A new video article was posted (:blogArticleTitle) in the subcategory (:blogSubcategoryTitle)!',
        'info_0012_admin_message' => 'A new audio article was posted (:blogArticleTitle) in the subcategory (:blogSubcategoryTitle)! However, the status of this newly created audio article was set to inactive! You can change it\'s status in the administration panel!',
        'info_0013_admin_message' => 'A new video article was posted (:blogArticleTitle) in the subcategory (:blogSubcategoryTitle)! However, the status of this newly created video article was set to inactive! You can change it\'s status in the administration panel!',
        'info_0014_admin_message' => 'A new written article was posted (:blogArticleTitle) in the subcategory (:blogSubcategoryTitle)!',
        'info_0015_admin_message' => 'A new written article was posted (:blogArticleTitle) in the subcategory (:blogSubcategoryTitle)! However, the status of this newly created written article was set to inactive! You can change it\'s status in the administration panel!',
        'err_0001_admin_message'  => 'The blog article (:blogArticleTitle) you are trying to insert in the table [:tableName] could not be saved in the database, because the table does not exist! Please contact the website administrator!',
        'err_0002_admin_message'  => 'The blog article (:blogArticleTitle) you are trying to insert in the table [:tableName] could not be saved in the database, because the table does not contain the same number of column as what was requested in API! Please contact the website administrator!',
        'err_0003_admin_message'  => 'The blog article (:blogArticleTitle) you are trying to insert in the table [:tableName] could not be saved in the database, because this already exist! Please try again and if the problem persist contact the website administrator!',
    ],
    'show' => [
        'info_0001_admin_message' => 'Currently, there are no blog articles in the database table [:tableName]!',
        'info_0004_admin_message' => 'The blog article you are trying to display does not exist, because it does not exist in the database! Please try again!',
        'info_0002_admin_message' => 'The selected blog article (:blogArticleTitle) was successfully fetched from the database!',
        'err_0001_admin_message'  => 'The blog article you are trying to view could not be fetched from the database!, because the [:tableName] does not exist in the database! Please contact the website administrator!',
    ],
    'update' => [
        'info_0008_admin_message' => 'The selected blog article (:blogArticleTitle) was successfully modified!',
        'err_0001_admin_message'  => 'The blog article (:blogArticleTitle) you are trying to modify in the table [:tableName] could not be saved in the database, because the table does not exist! Please contact the website administrator!',
        'err_0002_admin_message'  => 'The blog article (:blogArticleTitle) you are trying to modify in the table [:tableName] could not be saved in the database, because the table does not contain the same number of column as what was requested in API! Please contact the website administrator!',
    ],
    'delete' => [
        'info_0001_admin_message' => 'Currently, there are no blog articles in the database table [:tableName]!',
        'info_0005_admin_message' => 'The selected blog article could not be deleted, because it does not exist in the database! Please try again!',
        'info_0006_admin_message' => 'The selected blog article (:blogArticleTitle) was successfully deleted from the database!',
        'err_0001_admin_message'  => 'The selected blog article (:blogArticleTitle) could not be deleted from the database table: [:tableName], because it does not exist in the database! Please contact the website administrator!',
    ],
    'delete_all_records' => [
        'info_0001_admin_message' => 'Currently, there are no blog articles in the database table [:tableName]!',
        'info_0005_admin_message' => 'The blog articles could not be deleted, because the database table [:tableName] does not contain any record(s)! Please try again!',
        'info_0007_admin_message' => 'All the blog articles were successfully deleted from the database table: [:tableName]!',
        'err_0001_admin_message'  => 'The blog article could not be deleted from the database table: [:tableName], because it does not contain any record(s)! Please contact the website administrator!',
    ],
];
