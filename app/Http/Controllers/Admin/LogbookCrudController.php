<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LogbookRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class LogbookCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class LogbookCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Logbook::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/logbook');
        CRUD::setEntityNameStrings('Case', 'logbook entry');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('ID')->type('hidden');
        CRUD::column('datefiled')->label('Date Filed');
        CRUD::column('caseno')->type('text')->label('Case #');
        CRUD::column('complainant')->label('Complainant');
        CRUD::column('respondent')->label('Respondent');
        CRUD::column('casetitle')->label('Case Title');
        CRUD::column('casenum')->type('number')->label('Number');
        CRUD::column('disposition')->type('enum')->label('Disposition');
        CRUD::column('caselevel')->type('enum')->label('Level');
        CRUD::column('link')->label('Link');
        CRUD::column('updated_at')->type('datetime');
        CRUD::column('created_at')->type('datetime');


        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * $this->crud->setValidation(TagCrudRequest::class);

      $this->crud->addField([
        'name' => 'name',
        'type' => 'text',
        'label' => "Tag name"
      ]);
      $this->crud->addField([
        'name' => 'slug',
        'type' => 'text',
        'label' => "URL Segment (slug)"
      ]);

     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(LogbookRequest::class);

        $this->crud->addField([
        'name' => 'id',
        'type' => 'hidden',
        'label' => "ID"
        ]);
        $this->crud->addField([
            'name' => 'datefiled',
            'type'  => 'date',
            'label' => 'Date Filed'
        ]);
        /** */
        CRUD::column('complainant')->label('Complainant')->type('text');
        CRUD::column('respondent')->label('Respondent')->type('text');
        CRUD::column('casetitle')->label('Case Title')->type('textarea');
        CRUD::column('casenum')->type('number')->label('Number');
        CRUD::column('disposition')->type('enum')->label('Disposition');
        CRUD::column('caselevel')->type('enum')->label('Level');
        CRUD::column('link')->label('Link');
        CRUD::field('created_at')->type('datetime','hidden')->getTimestamp('now');

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
