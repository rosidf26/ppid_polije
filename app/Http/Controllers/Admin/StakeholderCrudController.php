<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StakeholderRequest;
use App\Models\Stakeholder;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class StakeholderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class StakeholderCrudController extends CrudController
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
        CRUD::setModel(Stakeholder::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/stakeholder');
        CRUD::setEntityNameStrings('stakeholder', 'stakeholders');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([    // Image
            'name' => 'name',
            'label' => 'Nama Instansi',
            'type' => 'text',
        ]);

        $this->crud->addColumn([    // Image
            'name' => 'title',
            'label' => 'Bidang',
            'type' => 'text',
        ]);

        $this->crud->addColumn([    // Image
            'name' => 'description',
            'label' => 'Keterangan',
            'type' => 'text',
        ]);

        $this->crud->addColumn([    // Image
            'name' => 'link',
            'label' => 'Link',
            'type' => 'text',
        ]);

        $this->crud->addColumn([    // Image
            'name' => 'image',
            'label' => 'Logo',
            'type' => 'image',
            'prefix' => url('/') . '/'
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
        $this->crud->addButtonFromView('top', 'refresh_datatable', 'refresh_datatable', 'end');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(StakeholderRequest::class);

        $this->crud->addField([    // Image
            'name' => 'name',
            'label' => 'Nama Instansi',
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([    // Image
            'name' => 'image',
            'label' => 'Logo',
            'type' => 'browse',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        $this->crud->addField([    // Image
            'name' => 'title',
            'label' => 'Bidang',
            'type' => 'text',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        $this->crud->addField([    // Image
            'name' => 'link',
            'label' => 'Link',
            'type' => 'url',
            'wrapper' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        $this->crud->addField([    // Image
            'name' => 'description',
            'label' => 'Keterangan',
            'type' => 'textarea',
            'wrapper' => [
                'class' => 'form-group col-md-12'
            ],
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
    }

    protected function setupShowOperation()
    {
        // Tombol kembali sejajar tombol Delete
        $this->crud->addButtonFromView(
            'line',        // posisi tombol di baris action
            'back_button', // nama tombol
            'back_button', // view blade
            'end'          // di kanan (sejajar delete)
        );

    }
}
