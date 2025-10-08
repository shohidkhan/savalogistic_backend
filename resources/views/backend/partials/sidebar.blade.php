<div id="kt_aside" class="aside aside-default aside-hoverable " data-kt-drawer="true" data-kt-drawer-name="aside"
    data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
    data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
    data-kt-drawer-toggle="#kt_aside_toggle">

    <!--begin::Brand-->
    <div class="px-10 pb-5 aside-logo flex-column-auto pt-9" id="kt_aside_logo">
        <!--begin::Logo-->
       <a href="{{ route('admin.dashboard') }}" style="display: block; width: 200px; height: auto;">
            <img alt="Logo" src="{{ asset($systemSetting->logo ?? 'backend/media/logos/logo-default.svg') }}"
                class="max-h-50px logo-default theme-light-show" style="width: 100%; height: auto;" />
            <img alt="Logo" src="{{ asset($systemSetting->logo ?? 'backend/media/logos/logo-default.svg') }}"
                class="max-h-50px logo-minimize" style="width: 100%; height: auto;" />
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid ps-3 pe-1">
        <!--begin::Aside Menu-->

        <!--begin::Menu-->
        <div class="my-5 menu menu-sub-indention menu-column menu-rounded menu-title-gray-600 menu-icon-gray-400 menu-active-bg menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 mt-lg-2 mb-lg-0"
            id="kt_aside_menu" data-kt-menu="true">

            <div class="mx-4 hover-scroll-y" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="20px"
                data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer">

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-element-11 fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title">Dashboard</span>
                    </a>
                </div>

                <div class="menu-item">
                    <div class="menu-content">
                        <div class="mx-1 my-2 separator"></div>
                    </div>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"
                        href="{{ route('admin.services.index') }}">
                        <span class="menu-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="24"
                                height="24" stroke-width="2">
                                <path
                                    d="M19.875 6.27c.7 .398 1.13 1.143 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z">
                                </path>
                                <path d="M12 16v.01"></path>
                                <path d="M12 13a2 2 0 0 0 .914 -3.782a1.98 1.98 0 0 0 -2.414 .483"></path>
                            </svg>
                        </span>
                        <span class="menu-title">Our Services</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.teams.*') ? 'active' : '' }}"
                        href="{{ route('admin.teams.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-people-group" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Team</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.our_history.*') ? 'active' : '' }}"
                        href="{{ route('admin.our_history.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-clock-rotate-left" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Our History</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.certificates.*') ? 'active' : '' }}"
                        href="{{ route('admin.certificates.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-certificate" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Certificates</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.awards.*') ? 'active' : '' }}"
                        href="{{ route('admin.awards.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-award" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Awards</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}"
                        href="{{ route('admin.category.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-layer-group" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Category</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.blog.*') ? 'active' : '' }}"
                        href="{{ route('admin.blog.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-blog" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Blog</span>
                    </a>
                </div>
                {{-- <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.annex_rate.*') ? 'active' : '' }}"
                        href="{{ route('admin.annex_rate.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Annex Rate</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.deviation.index') ? 'active' : '' }}"
                        href="{{ route('admin.deviation.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Deviation</span>
                    </a> --}}
                {{-- </div> --}}
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.ldm.*') ? 'active' : '' }}"
                        href="{{ route('admin.ldm.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-scale-unbalanced-flip" style="font-size:20px;"></i>
                        </span>
                        <span class="menu-title">LDM</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.loading_zone.*') ? 'active' : '' }}"
                        href="{{ route('admin.loading_zone.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Loading Zones</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.loading_area.*') ? 'active' : '' }}"
                        href="{{ route('admin.loading_area.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Loading Area</span>
                    </a>
                </div>
                 <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.pickup_cost.*') ? 'active' : '' }}"
                        href="{{ route('admin.pickup_cost.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Pickup Cost</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.ro_pickup_cost.*') ? 'active' : '' }}"
                        href="{{ route('admin.ro_pickup_cost.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Romania Pickup Cost</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.unloading_zone.*') ? 'active' : '' }}"
                        href="{{ route('admin.unloading_zone.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Unloading Zones</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.unloading_area.*') ? 'active' : '' }}"
                        href="{{ route('admin.unloading_area.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Unloading Area</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.unloading_price.*') ? 'active' : '' }}"
                        href="{{ route('admin.unloading_price.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-truck-fast" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Unloading delivery cost</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.job.*') ? 'active' : '' }}"
                        href="{{ route('admin.job.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-calendar-days"  style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Jobs</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.apply_job.*') ? 'active' : '' }}"
                        href="{{ route('admin.apply_job.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-blender-phone" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Applicants</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.contact*') ? 'active' : '' }}"
                        href="{{ route('admin.contact.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-address-card" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Contact</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.transport-restriction*') ? 'active' : '' }}"
                        href="{{ route('admin.transport-restriction.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-circle-xmark" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Transport Restrictions</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.transport-regulation*') ? 'active' : '' }}"
                        href="{{ route('admin.transport-regulation.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-gamepad" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Transport Regulation</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.compliance*') ? 'active' : '' }}"
                        href="{{ route('admin.compliance.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-shield-halved" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Compliance</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.cmr*') ? 'active' : '' }}"
                        href="{{ route('admin.cmr.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-binoculars" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">CMR Convention</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.transport_notice*') ? 'active' : '' }}"
                        href="{{ route('admin.transport_notice.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-check-double" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Transport Notice</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.sector*') ? 'active' : '' }}"
                        href="{{ route('admin.sector.index') }}">
                        <span class="menu-icon">
                            <i class="fa-solid fa-clipboard" style="font-size: 20px;"></i>
                        </span>
                        <span class="menu-title">Sector</span>
                    </a>
                </div>

                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs(['admin.cms.about.*','admin.cms.sava.*']) ? 'active show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-arrows-to-circle" style="font-size:20px;"></i>
                        </span>
                        <span class="menu-title">CMS</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a href="{{ route('admin.cms.about.index') }}"
                                class="menu-link {{ request()->routeIs('admin.cms.about.index') ? 'active' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">About</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('admin.cms.sava.index') }}"
                                class="menu-link {{ request()->routeIs('admin.cms.sava.index') ? 'active' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Sava Operations</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div data-kt-menu-trigger="click"
                    class="menu-item {{ request()->routeIs(['profile.setting', 'stripe.setting', 'paypal.setting', 'dynamic_page.*', 'system.index', 'mail.setting', 'social.index']) ? 'active show' : '' }} menu-accordion">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="fa-solid fa-gear fs-2"></i>
                        </span>
                        <span class="menu-title">Setting</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a href="{{ route('profile.setting') }}"
                                class="menu-link {{ request()->routeIs('profile.setting') ? 'active' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Profile Setting</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('system.index') }}"
                                class="menu-link {{ request()->routeIs('system.index') ? 'active' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">System Setting</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('dynamic_page.index') }}"
                                class="menu-link {{ request()->routeIs(['dynamic_page.index', 'dynamic_page.create', 'dynamic_page.update']) ? 'active show' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Dynamic Page</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('mail.setting') }}"
                                class="menu-link {{ request()->routeIs('mail.setting') ? 'active' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Mail Setting</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a href="{{ route('social.index') }}"
                                class="menu-link {{ request()->routeIs('social.index') ? 'active' : '' }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Social Media</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
