<div class="col">
    <div class="btn-group">
        <a href="javascript:void(0)" class="btn btn-outline-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Actions
        </a>
        <div class="dropdown-menu dropdown-menu-left">
            @if(Module::has('Blog'))
                <button class="dropdown-item" type="button">
                    <a class="m-link m-link--state m-link--warning" href="{{action('\Gdevilbat\SpardaCMS\Modules\Blog\Http\Controllers\BlogController@page', ['slug' => $post->post_slug])}}" target="_blank"><i class="fa fa-eye"> Preview</i></a>
                </button>
            @endif
            @can('update-page', $post)
                <button class="dropdown-item" type="button">
                    <a class="m-link m-link--state m-link--info" href="{{action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@create').'?code='.encrypt($post->getKey())}}"><i class="fa fa-edit"> Edit</i></a>
                </button>
            @endcan
            @can('delete-page', $post)
                <form action="{{action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@destroy')}}" method="post" accept-charset="utf-8">
                    {{method_field('DELETE')}}
                    {{csrf_field()}}
                    <input type="hidden" name="{{\Gdevilbat\SpardaCMS\Modules\Post\Entities\Post::getPrimaryKey()}}" value="{{encrypt($post->getKey())}}">
                </form>
                <button class="dropdown-item confirm-delete" type="button"><a class="m-link m-link--state m-link--accent" data-toggle="modal" href="#small"><i class="fa fa-trash"> Delete</i></a></button>
            @endcan
        </div>
    </div>
</div>