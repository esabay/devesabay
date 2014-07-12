<!-- sidebar menu start-->
<ul class="sidebar-menu" id="nav-accordion">
    <li>
        <a class="@if(!\Request::segment(2)) active @endif" href="{{URL::to('/backend')}}">
            <i class="icon-dashboard"></i>
            <span>Dashboard</span>
        </a>
    </li>
    @foreach(\DB::table('menu')
    ->select('menu.id', 'menu.name', 'menu.url', 'menu.icon', 'menu.module', 'menu_role.role_id')
    ->join('menu_role', 'menu_role.menu_id', '=', 'menu.id')
    ->join('role_user', 'role_user.role_id', '=', 'menu_role.role_id')
    ->where('role_user.user_id', \Auth::user()->id)
    ->where('menu.sub_id', 0)
    ->orderBy('menu.rank', 'asc')
    ->groupBy('menu.id')
    ->get() as $item)

    <li class="sub-menu">
        <a href="javascript:;" class="{{($item->module == \Request::segment(2) ? 'active' : '')}}">
            <i class="{{$item->icon}}"></i>
            <span>{{$item->name}}</span>
        </a>
        @if (\Menurole::where('menu_id', $item->id)->count() > 0)
        <ul class="sub">
            @foreach(\DB::table('menu')
            ->join('menu_role', 'menu_role.menu_id', '=', 'menu.id')
            ->where('menu_role.role_id', '=', $item->role_id)
            ->where('menu.sub_id', '!=', 0)
            ->where('menu.sub_id', '=', $item->id)
            ->select('menu.id', 'menu.name', 'menu.url', 'menu.icon', 'menu.module')
            ->orderBy('menu.rank', 'asc')
            ->get() as $item2)
            <li class="{{($item2->url == \Request::path() ? 'active' : '')}}"><a href="{{URL::to($item2->url)}}">{{$item2->name}}</a></li>
            @endforeach
        </ul>
        @endif
    </li>
    @endforeach
</ul>
<!-- sidebar menu end-->