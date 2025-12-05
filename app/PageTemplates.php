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

        // $this->crud->addField([
        //     'name' => 'featured_image',
        //     'label' => 'Featured Image',
        //     'type' => 'browse',
        //     'fake' => true,
        //     'placeholder' => 'Featured Image',
        //     'store_in' => 'extras'
        // ]);

        $this->crud->addField([
            // Table
        'name'            => 'options',
        'label'           => 'Buat Tabel',
        'type'            => 'table',
        'entity_singular' => 'option', // used on the "Add X" button
        'columns'         => [
                'no'  => 'No',
                'desc'  => 'Keterangan',
                'link' => 'Link'
        ],
        'max' => 10, // maximum rows allowed in the table
        'min' => 0, // minimum rows allowed in the table

        // 🔥 penting agar tersimpan di kolom JSON "extras"
        'fake' => true,
        'store_in' => 'extras',
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

    private function tentang_polije()
    {
       
       $this->crud->addField([
            'name' => 'fi_1',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Featured Image Slideshow 1',
            'type' => 'browse',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        $this->crud->addField([
            'name' => 'fi_2',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Featured Image Slideshow 2',
            'type' => 'browse',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        $this->crud->addField([
            'name' => 'fi_3',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Featured Image Slideshow 3',
            'type' => 'browse',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-4'
            ],
        ]);

        $this->crud->addField([
            'name' => 'id_youtube',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'ID Youtube',
            'type' => 'text'
        ]);

        $this->crud->addField([
            'name' => 'content',
            'label' => 'Konten',
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

     private function profil_ppid()
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
            // Table
        'name'            => 'options',
        'label'           => 'Buat Tabel',
        'type'            => 'table',
        'entity_singular' => 'option', // used on the "Add X" button
        'columns'         => [
                'no'  => 'No',
                'name'  => 'Nama',
                'pangkat' => 'Pangkat/Jabatan',
                'status' => 'Diangkat Dalam Jabatan'
        ],
        'max' => 10, // maximum rows allowed in the table
        'min' => 0, // minimum rows allowed in the table

        // 🔥 penting agar tersimpan di kolom JSON "extras"
        'fake' => true,
        'store_in' => 'extras',
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

      private function berkas()
    {
       $this->crud->addField([
            'name' => 'label_1',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Label 1',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'berkas_1',
             'fake' => true,
            'store_in' => 'extras',
            'label' => 'Berkas 1',
            'type' => 'browse',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        $this->crud->addField([
            'name' => 'label_2',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Label 2',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'berkas_2',
             'fake' => true,
            'store_in' => 'extras',
            'label' => 'Berkas 2',
            'type' => 'browse',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        $this->crud->addField([
            'name' => 'label_3',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Label 3',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'berkas_3',
             'fake' => true,
            'store_in' => 'extras',
            'label' => 'Berkas 3',
            'type' => 'browse',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        $this->crud->addField([
            'name' => 'label_4',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Label 4',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'berkas_4',
             'fake' => true,
            'store_in' => 'extras',
            'label' => 'Berkas 4',
            'type' => 'browse',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        $this->crud->addField([
            'name' => 'label_5',
            'fake' => true,
            'store_in' => 'extras',
            'label' => 'Label 5',
            'type' => 'text',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ]
        ]);

        $this->crud->addField([
            'name' => 'berkas_5',
             'fake' => true,
            'store_in' => 'extras',
            'label' => 'Berkas 5',
            'type' => 'browse',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
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
               'format_tags' => 'p;h1;h2;h3;h4;h5;h6;pre;address;div',
               'allowedContent' => true
            ]
        ]);

       
    }

      private function layanan_informasi()
    {

         $this->crud->addField([
            'name' => 'featured_image',
            'label' => 'Featured Image',
            'type' => 'browse',
            'fake' => true,
            'placeholder' => 'Featured Image',
            'store_in' => 'extras',
             'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
        ]);

        $this->crud->addField([
            'name' => 'berkas',
             'fake' => true,
            'store_in' => 'extras',
            'label' => 'Berkas',
            'type' => 'browse',
            'wrapperAttributes' => [
                'class' => 'form-group col-md-6'
            ],
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

    private function e_blangko_permohonan_informasi()
    {
       
    }

    private function e_blangko_pernyataan_keberatan()
    {
       
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
   
}