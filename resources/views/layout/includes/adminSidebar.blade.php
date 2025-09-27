
<div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside">
    
    <div class="aside-menu flex-column-fluid">
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                <div class="menu-item">
                    <a class="menu-link {{ Request::is(app()->getLocale() .'/admin/home*') ? 'active' : '' }}" href="{{ route('admin.admin.home') }}">
						<span class="menu-icon"> <i class="fas fa-home"></i> </span>
                        <span class="menu-title"> {{ __('translate.home') }} </span>
                    </a>
                </div>
                
                @isset($adminPermissions)
                @foreach($adminPermissions as $one)

                    <div class="menu-item">
                        <a class="menu-link {{ Request::is(app()->getLocale() .'/admin/users*') ? 'active' : '' }}" href="{{ route($one->route_name) }}">
                            <span class="menu-icon"> {!! $one->icon !!} </span>
                            <span class="menu-title"> {{ __('translate.'.$one->name) }} </span>
                            
                            @isset($newContactMsg)
                            @if($newContactMsg > 0 && $one->route_name == 'admin.Contact.index')
                                <span style="margin-top:0px;" class="badge badge-primary"> {{ @$newContactMsg }}  </span>
                            @endif
                            @endisset
                        </a>
                    </div>
                
                @endforeach
                @endisset

            </div>
        </div>
    </div>

</div>
