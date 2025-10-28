<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
{
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::setFromDb(); // columns

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        // CRUD::setFromDb(); // fields
         $this->crud->addField([    // Image
            'name' => 'name',
            'label' => 'Namea',
            'type' => 'text',
        ]);

         $this->crud->addField([    // Image
            'name' => 'email',
            'label' => 'Emails',
            'type' => 'email',
        ]);

         $this->crud->addField([    // Image
            'name' => 'password',
            'label' => 'pass',
            'type' => 'password',
        ]);

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
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
        $this->setupCreateOperation();
        //   CRUD::field('name')->validationRules('required|min:5');
        //   CRUD::field('email')->validationRules('required|email|unique:users,email,'.CRUD::getCurrentEntryId());
        //   CRUD::field('password')->hint('Type a password to change it.');

        //   \App\User::updating(function ($entry) {
        //       if (request('password') == null) {
        //           $entry->password = $entry->getOriginal('password');
        //       } else {
        //           $entry->password = Hash::make(request('password'));
        //       }
        //   });
    }
}
