<?php

namespace Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Gdevilbat\SpardaCMS\Modules\Post\Http\Controllers\PostController;

class PageController extends PostController
{
    protected $module = 'page';
    protected $post_type = 'page';
}
