<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Vendor
    Route::apiResource('vendors', 'VendorApiController');

    // Properties
    Route::apiResource('properties', 'PropertiesApiController');

    // Unit
    Route::apiResource('units', 'UnitApiController');

    // Applications
    Route::apiResource('applications', 'ApplicationsApiController');

    // Invoice
    Route::apiResource('invoices', 'InvoiceApiController');

    // Lease
    Route::apiResource('leases', 'LeaseApiController');

    // Maintenance
    Route::apiResource('maintenances', 'MaintenanceApiController');

    // Workorder
    Route::apiResource('workorders', 'WorkorderApiController');
});
