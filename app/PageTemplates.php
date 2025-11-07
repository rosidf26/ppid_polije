<?php

namespace App;

trait PageTemplates
{
    /*
    |--------------------------------------------------------------------------
    | Page Templates for Backpack\PageManager
    |--------------------------------------------------------------------------
    |
    | Each page template has its own method, that define what fields should show up using the Backpack\CRUD API.
    | Use snake_case for naming and PageManager will make sure it looks pretty in the create/update form
    | template dropdown.
    |
    | Any fields defined here will show up after the standard page fields:
    | - select template
    | - page name (only seen by admins)
    | - page title
    | - page slug
    */

     private function informasi_publik()
    {
        $this->crud->addField([
            'name' => 'featured_content',
            'label' => 'Featured Content',
            'type' => 'textarea',
            'fake' => true,
            'placeholder' => 'Featured Content',
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'name' => 'featured_icon',
            'label' => 'Featured Icon',
            'type' => 'text',
            'fake' => true,
            'placeholder' => 'Featured Icon',
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'name' => 'featured_image',
            'label' => 'Featured Image',
            'type' => 'browse',
            'fake' => true,
            'placeholder' => 'Featured Image',
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'name' => 'content',
            'label' => trans('backpack::pagemanager.content'),
            'type' => 'ckeditor',
            'placeholder' => trans('backpack::pagemanager.content_placeholder'),
            'extra_plugins' => ['autogrow'],
            'options' => [
                'height' => 500,
                'removePlugins' => 'maximize,about',
                'stylesSet' => 'my_styles:' . config('app.url') . '/frontpage/js/ckeditor_format_style.js',
                'allowedContent' => true
            ]
        ]);
    }

    private function statistik()
    {
        $this->crud->addField([
            'name' => 'lb_1',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Label 1',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'count_1',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Count 1',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'lb_2',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Label 2',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'count_2',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Count 2',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'lb_3',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Label 3',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'count_3',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Count 3',
            'type' => 'number',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

    }

    private function umum()
    {
         $this->crud->addField([
            'name' => 'content',
            'label' => trans('backpack::pagemanager.content'),
            'type' => 'ckeditor',
            'placeholder' => trans('backpack::pagemanager.content_placeholder'),
            'extra_plugins' => ['autogrow'],
            'options' => [
               'autoGrow_minHeight'   => 200,
               'removePlugins'        => 'resize,maximize',
               'format_tags' => 'p;h1;h2;h3;h4;h5;h6;pre;address;div',
               'allowedContent' => true
            ]
        ]);
    }

    private function sambutan_direktur()
    {
        $this->crud->addField([
            'name' => 'featured_image',
            'label' => 'Featured Image',
            'type' => 'browse',
            'fake' => true,
            'placeholder' => 'Featured Image',
            'store_in' => 'extras'
        ]);

        $this->crud->addField([
            'name' => 'content',
            'label' => trans('backpack::pagemanager.content'),
            'type' => 'ckeditor',
            'placeholder' => trans('backpack::pagemanager.content_placeholder'),
            'extra_plugins' => ['autogrow'],
            'options' => [
               'autoGrow_minHeight'   => 200,
               'removePlugins'        => 'resize,maximize',
               'allowedContent' => true
            ]
        ]);
    }
}