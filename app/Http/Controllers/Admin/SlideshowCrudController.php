<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SlideshowRequest;
use App\Models\Slideshow;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
     use Backpack\CRUD\app\Library\CrudPanel\CrudPanel;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SlideshowCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class SlideshowCrudController extends CrudController
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
        CRUD::setModel(Slideshow::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/slideshow');
        CRUD::setEntityNameStrings('slideshow', 'slideshows');
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
            'label' => 'Name',
            'type' => 'text',
        ]);

        $this->crud->addColumn([    // Image
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
        ]);

        $this->crud->addColumn([    // Image
            'name' => 'description',
            'label' => 'Description',
            'type' => 'text',
        ]);


        $this->crud->addColumn([    // Image
            'name' => 'image',
            'label' => 'Image',
            'type' => 'image',
        ]);

        $this->crud->addColumn([    // Image
            'name' => 'type',
            'label' => 'Type',
            'type' => 'text',
        ]);

        $this->crud->addColumn([    // Image
            'name' => 'advanced_mode',
            'label' => 'Advanced Mode',
            'type'  => 'boolean',
        ]);

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
        CRUD::setValidation(SlideshowRequest::class);

        $this->crud->addField([    // Image
            'name' => 'name',
            'label' => 'Name',
            'type' => 'text',
        ]);

        $this->crud->addField([    // Image
            'name' => 'image',
            'label' => 'Image',
            'type' => 'browse',
        ]);

        $this->crud->addField([    // Image
            'name' => 'title',
            'label' => 'Title',
            'type' => 'text',
        ]);

        $this->crud->addField([    // Image
            'name' => 'description',
            'label' => 'Description',
            'type' => 'textarea',
        ]);

        $this->crud->addField([
            'name' => ['type', 'link', 'page_id'],
            'label' => 'Type',
            'type' => 'page_or_link',
            'page_model' => '\Backpack\PageManager\app\Models\Page',
        ]);

        $this->crud->addField([    // Image
            'name' => 'advanced_mode',
            'label' => 'Advanced Mode<br />Note. Check this if you want to custom your slideshow (like adding animations, more delay, etc.) then add your custom code in description textarea. <br />',
            'type' => 'checkbox',

        ]);

        $this->crud->addField([    // Image
            'name' => 'order',
            'label' => 'Order',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-3'
            ]
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
}
