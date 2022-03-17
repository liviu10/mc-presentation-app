<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Error and Notification System Translations
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the error and notification system
    | to provide various messages translation that are generated by the web applications.
    | You are free to change them to anything you want to customize your views to better match your application.
    |
    */

    'index' => [
        'info_00001_notify' => [
            'user_has_rights' => [
                'message_title'           => 'Success!',
                'message_super_admin'     => 'The list of record(s) was successfully fetched from the database table \':databaseName.:tableName\'. This contains :numberOfRecords record(s)!',
                'message_admin'           => 'The list of record(s) was successfully fetched from the database!',
            ],
            'user_do_not_have_rights' => [
                'message_title'           => 'Insufficient rights!',
                'message_generic_user'    => 'You do not have sufficient rights to view this resources!',
                'message_unauthenticated' => 'You must be authenticated in order to view this resources!',
            ],
        ],
        'war_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Resource(s) not found!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have sent via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName did not received any record(s) from the database: :databaseName because the following table: :tableName is empty!',
                'message_admin'        => 'It appears that the resource you are trying to view exists in the database but currently it does not have any records to display!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to view this resources!',
            ],
        ],
        'err_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Internal Server Error!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have sent via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName did not received any record(s) from the database: :databaseName because the following table: :tableName does not exist!',
                'message_admin'        => 'It appears that the resource you are trying to view does not exist in the database! Please contact the webmaster if the problem persists!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to view this resources!',
            ],
        ],
    ],
    'store' => [
        'info_00002_notify' => [
            'user_has_rights' => [
                'message_title'           => 'Success!',
                'message_super_admin'     => 'The notification code: :record was successfully inserted in the database table \':databaseName.:tableName\'!',
            ],
            'user_do_not_have_rights' => [
                'message_title'           => 'Insufficient rights!',
                'message_generic_user'    => 'You do not have sufficient rights to view this resource!',
                'message_unauthenticated' => 'You must be authenticated in order to view this resource!',
            ],
        ],
        'err_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Internal Server Error!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have sent via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName could not save the records in the database: :databaseName because the following table: :tableName does not exist!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to create this resource!',
            ],
        ],
        'err_00003_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Internal Server Error!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have sent via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName could not save the records in the database: :databaseName because the following notification code: :record already exists!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to create this resource!',
            ],
        ],
    ],
    'show' => [
        'info_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Success!',
                'message_super_admin'  => 'The list of record(s) was successfully fetched from the database table \':databaseName.:tableName\'.',
                'message_admin'        => 'The list of record(s) was successfully fetched from the database!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to view this resources!',
            ],
        ],
        'war_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Resource(s) not found!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have send via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName did not received any record(s) from the database: :databaseName because the following table: :tableName is empty!',
                'message_admin'        => 'It appears that the resource you are trying to view exists in the database but currently it does not have any records to display!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to view this resources!',
            ],
        ],
        'info_00006_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Record(s) not found!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have send via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName did not received any record(s) from the database: :databaseName because the following record id: :lookupRecord does not exist!',
                'message_admin'        => 'It appears that the record(s) you are trying to view does not exist in the database!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to view this resources!',
            ],
        ],
        'err_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Internal Server Error!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have send via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName did not received any record(s) from the database: :databaseName because the following table: :tableName does not exist!',
                'message_admin'        => 'It appears that the resource you are trying to view does not exist in the database! Please contact the webmaster if the problem persists!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to view this resources!',
            ],
        ],
    ],
    'update' => [
        'info_00002_notify' => [
            'user_has_rights' => [
                'message_title'           => 'Success!',
                'message_super_admin'     => 'The notification code :record was successfully updated to :newNotifyCode and saved in the database table \':databaseName.:tableName\'!',
            ],
            'user_do_not_have_rights' => [
                'message_title'           => 'Insufficient rights!',
                'message_generic_user'    => 'You do not have sufficient rights to view this resource!',
                'message_unauthenticated' => 'You must be authenticated in order to view this resource!',
            ],
        ],
        'err_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Internal Server Error!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have sent via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName could not update the records in the database: :databaseName because the following table: :tableName does not exist!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to update this resource!',
            ],
        ],
    ],
    'delete' => [
        'info_00002_notify' => [
            'user_has_rights' => [
                'message_title'           => 'Success!',
                'message_super_admin'     => 'The notification code: :record was successfully deleted from the database table \':databaseName.:tableName\'!',
            ],
            'user_do_not_have_rights' => [
                'message_title'           => 'Insufficient rights!',
                'message_generic_user'    => 'You do not have sufficient rights to view this resource!',
                'message_unauthenticated' => 'You must be authenticated in order to view this resource!',
            ],
        ],
        'war_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Resource(s) not found!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have sent via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName could not delete the record from the database: :databaseName because the following table: :tableName is empty!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to view this resources!',
            ],
        ],
        'info_00006_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Record(s) not found!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have send via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName did not received any record(s) from the database: :databaseName because the following record id: :lookupRecord does not exist!',
                'message_admin'        => 'It appears that the record(s) you are trying to delete does not exist in the database!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to view this resources!',
            ],
        ],
        'err_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Internal Server Error!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have sent via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName could not delete the records from the database: :databaseName because the following table: :tableName does not exist!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to create this resource!',
            ],
        ],
    ],
    'delete_all' => [
        'info_00004_notify' => [
            'user_has_rights' => [
                'message_title'           => 'Success!',
                'message_super_admin'     => 'All the records were successfully deleted from the database table \':databaseName.:tableName\'!',
            ],
            'user_do_not_have_rights' => [
                'message_title'           => 'Insufficient rights!',
                'message_generic_user'    => 'You do not have sufficient rights to view this resource!',
                'message_unauthenticated' => 'You must be authenticated in order to view this resource!',
            ],
        ],
        'war_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Resource(s) not found!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have sent via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName could not delete the records from the database: :databaseName because the following table: :tableName is empty!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to view this resources!',
            ],
        ],
        'err_00001_notify' => [
            'user_has_rights' => [
                'message_title'        => 'Internal Server Error!',
                'message_super_admin'  => 'It appears that the HTTP request with the :methodName method you have sent via the api endpoint: :apiEndpoint was successfully understood by the server, but the controller file located at :serviceName could not delete the records from the database: :databaseName because the following table: :tableName does not exist!',
            ],
            'user_do_not_have_rights' => [
                'message_title'        => 'Insufficient rights!',
                'message_generic_user' => 'You do not have sufficient rights to create this resource!',
            ],
        ],
    ],
];
