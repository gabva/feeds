<?php namespace Modules\Feeds\Sidebar;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Contracts\Authentication;

class SidebarExtender implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @param Menu $menu
     *
     * @return Menu
     */

    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('feeds::feeds.title.feeds'), function (Item $item) {
                $item->icon('fa fa-rss');
                $item->weight(10);
                $item->route('admin.feeds.feed.index');
                $item->authorize(
                    $this->auth->hasAccess('feeds.feeds.index')
                );
            });
        });

        return $menu;
    }

}
