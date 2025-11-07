<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\FaqRequest;
use App\Models\Faq;
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

class FaqCrudController extends CrudController
{
    
    use ListOperation;
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;
    use ShowOperation;

    public function setup()
    {
        CRUD::setModel(Faq::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/faq');
        CRUD::setEntityNameStrings('FAQ', 'FAQs');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'question', 'label' => 'Question']);
        CRUD::addColumn(['name' => 'answer', 'label' => 'Answer']);
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(FaqRequest::class); // Create a FaqRequest for validation

        CRUD::addField([
            'name' => 'question',
            'label' => 'Question',
            'type' => 'text',
        ]);

        CRUD::addField([
            'name' => 'answer',
            'label' => 'Answer',
            'type' => 'textarea',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation(); // Reuse the same fields for update
    }
}