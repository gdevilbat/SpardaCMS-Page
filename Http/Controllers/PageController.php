<?php

namespace Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers;

use Gdevilbat\SpardaCMS\Modules\Post\Foundation\AbstractPost;
use Gdevilbat\SpardaCMS\Modules\Post\Entities\Post;

class PageController extends AbstractPost
{
	/**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct(\Gdevilbat\SpardaCMS\Modules\Page\Repositories\PageRepository $post_repository)
    {
        parent::__construct($post_repository);
        $this->post_m = new Post;
    }
}
