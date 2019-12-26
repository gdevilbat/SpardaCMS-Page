<?php

namespace Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers;

use Gdevilbat\SpardaCMS\Modules\Post\Foundation\AbstractPost;

class PageController extends AbstractPost
{
	/**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct(\Gdevilbat\SpardaCMS\Modules\Post\Repositories\PostRepository $post_repository)
    {
        parent::__construct($post_repository);

        $this->setModule('page');
        $this->setPostType('page');
        $this->post_repository->setModule($this->getModule());
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
