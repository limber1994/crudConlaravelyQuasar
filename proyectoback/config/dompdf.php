<?php

return [
    'default_font' => 'Arial',
    'default_paper_size' => 'letter',
    'default_font_size' => 12,
    'set_options' => [
        'isHtml5ParserEnabled' => true,
        'isPhpEnabled' => true,
        'isPhpEnabled' => true,
        'isPhpEnabled' => true,
        'isHtml5ParserEnabled' => true,
    ],
    'font_path' => base_path('resources/fonts/'),
    'font_cache_path' => storage_path('app/dompdf'),
    'auto_script_to_lang' => true,
    'auto_lang_to_font' => true,
    'pdf_a' => false,
    'pdf_a_auto' => false,
    'pdf_x' => false,
    'pdf_font_name_main' => 'sans-serif',
    'pdf_font_size_main' => 10,
    'pdf_font_name_data' => 'sans-serif',
    'pdf_font_size_data' => 8,
    'pdf_font_monospaced' => 'Courier New',
    'pdf_encrypt' => false,
    'pdf_encrypt_string' => '',
];