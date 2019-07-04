<?php

namespace Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers;

use Gdevilbat\SpardaCMS\Modules\Post\Foundation\AbstractPost;

class PageController extends AbstractPost
{
	/**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        parent::__construct();

        $this->module = 'page';
        $this->post_type = 'page';
    }

    public function getCategory()
    {
        return 'category';
    }

    public function getTag()
    {
        return 'tag';
    }
}
