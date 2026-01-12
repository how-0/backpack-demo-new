<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\TicketRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * 
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TicketCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Ticket::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/ticket');
        CRUD::setEntityNameStrings('ticket', 'ticket');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column([
            'label' => 'Name',
            'name' => 'name',
            'type' => 'string',
        ]);

        CRUD::column([
            'label' => 'Gender',
            'name' => 'gender',
            'type' => 'string',
        ]);

        CRUD::column([
            'label' => 'Inquiry',
            'name' => 'inquiry',
            'type' => 'textarea',
        ]);

        CRUD::column([
            'label' => 'Status',
            'name' => 'status',
            'type' => 'custom_html'
        ]);

        CRUD::column([
            'label' => 'Creator',
            'name' => 'creator.name',
            'type' => 'text',
        ]);

        CRUD::filter('Name')
        ->type('text')
        ->whenActive(function($value) {
        CRUD::addClause('where', 'name', 'LIKE', "%$value%");
        });

        CRUD::filter('gender')
        ->type('dropdown')
        ->values([
        'Male' => 'Male',
        'Female' => 'Female',
        ])
        ->whenActive(function($value) {
        CRUD::addClause('where', 'gender', $value);
        });

        CRUD::filter('Inquiry')
        ->type('text')
        ->whenActive(function($value) {
        CRUD::addClause('where', 'inquiry', 'LIKE', "%$value%");
        });

        CRUD::filter('status')
        ->type('dropdown')
        ->values([
        'New' => 'New',
        'Processing' => 'Processing',
        'Completed' => 'Completed',
        'Cancel' => 'Cancel',
        ])
        ->whenActive(function($value) {
        CRUD::addClause('where', 'status', $value);
        });

        CRUD::filter('Creator')
        ->type('text')
        ->whenActive(function($value) {
        CRUD::addClause('where', 'created_by', 'LIKE', "%$value%");
        });
                    
    }

    
    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(TicketRequest::class);

        CRUD::field([
            'label' => 'Creator',
            'name' => 'created_by',
            'type' => 'hidden',
            'value' => backpack_user()->id,
        ]);

        CRUD::field([
            'label' => "Name",
            'name' => 'name',
            'type' => 'text',
        ]);
        CRUD::field([
            'label'       => 'Gender',
            'name'        => 'gender', 
            'type'        => 'radio',
            'options'     => [
                "Male" => "Male",
                "Female" => "Female"
            ],
            'inline' => false,
        ]);

        CRUD::field([
            'label' => 'Inquiry', 
            'name'  => 'inquiry',
            'type'  => 'textarea',
        ]);

        CRUD::field([
            'label'       => "Status",    
            'name'        => 'status',
            'type'        => 'select_from_array',
            'options'     => ['New' => 'New', 'Processing' => 'Processing', 'Cancel' => 'Cancel', 'Completed' => 'Completed'],
            'allows_null' => false,
            'default'     => 'New',
            
            // 'allows_multiple' => true
        ]);
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        CRUD::setValidation(TicketRequest::class);
    }
    
}
