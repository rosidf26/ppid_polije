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