<?php

namespace Gdevilbat\SpardaCMS\Modules\Page\Repositories;

use Gdevilbat\SpardaCMS\Modules\Post\Repositories\AbstractRepository;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class EloquentCoreRepository
 *
 * @package Gdevilbat\SpardaCMS\Modules\Core\Repositories\Eloquent
 */
class PageRepository extends AbstractRepository
{
	public function __construct(\Gdevilbat\SpardaCMS\Modules\Post\Entities\Post $model, \Gdevilbat\SpardaCMS\Modules\Role\Repositories\Contract\AuthenticationRepository $acl)
    {
        parent::__construct($model, $acl);
        $this->setModule('page');
        $this->setPostType('page');
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
