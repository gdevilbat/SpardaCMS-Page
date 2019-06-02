<li class="m-menu__item  {{Route::current()->getName() == 'page' ? 'm-menu__item--active' : ''}}" aria-haspopup="true">
    <a href="{{action('\Gdevilbat\SpardaCMS\Modules\Page\Http\Controllers\PageController@index')}}" class="m-menu__link ">
        <i class="m-menu__link-icon flaticon-web"></i>
        <span class="m-menu__link-title"> 
            <span class="m-menu__link-wrap"> 
                <span class="m-menu__link-text">
                    Page
                </span>
             </span>
         </span>
     </a>
</li>