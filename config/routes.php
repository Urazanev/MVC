<?php

return array(
    
    'article/([0-9A-Za-z_/\-]+)' => 'article/view/$1',		// actionView в ArticleController
    'category/([0-9A-Za-z_/\-]+)/page-([0-9]+)' => 'category/category/$1/$2',
    'category/([0-9A-Za-z_/\-]+)' => 'category/category/$1', // actionCategory	в CategoryController
    'category' => 'category/index', // actionIndex в CategoryController
    'contact' => 'site/contact', // actionContact в SiteController
    'index.php' => 'site/index', // actionIndex в SiteController
    '' => 'site/index', // actionIndex в SiteController
);
