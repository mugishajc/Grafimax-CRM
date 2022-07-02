@php
    $users=\Auth::user();
@endphp
<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{route('dashboard')}}">
                <!-- <img class="img-fluid" src="{{ asset(Storage::url('logo/logo.png')) }}" alt="image" width="">
             -->
             JDD Hotels CRM
            </a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <!-- <a href="{{route('dashboard')}}">
                <img class="img-fluid" src="{{ asset(Storage::url('logo/small-logo.png')) }}" alt="image" width="">
            </a> -->
        </div>
        <ul class="sidebar-menu">
            <li class="dropdown {{ (Request::route()->getName() == 'dashboard') ? ' active' : '' }} ">
                <a class="nav-link" href="{{route('dashboard')}}"> <i class="fas fa-fire"></i> <span>{{__('Dashboard')}}</span></a>
            </li>

            @if(\Auth::user()->type=='super admin')
                @can('manage user')
                    <li class="dropdown {{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : '' }}">
                        <a class="nav-link" href="{{ route('users.index') }}"> <i class="fas fa-columns"></i> <span>{{__('User') }}</span></a>
                    </li>
                @endcan
            @else

                @if(Gate::check('manage client') || Gate::check('manage user') || Gate::check('manage role'))
                    <li class="dropdown {{ (Request::segment(1) == 'users' || Request::segment(1) == 'clients' || Request::segment(1) == 'roles')?' active':''}}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>{{__('Staff')}}</span></a>
                        <ul class="dropdown-menu {{ (Request::segment(1) == 'users' || Request::segment(1) == 'clients' || Request::segment(1) == 'roles')?'display:block':''}}">
                            @can('manage user')
                                <li class="{{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('users.index') }}">{{  __('User') }}</a>
                                </li>
                            @endcan
                            @can('manage client')
                                <li class="{{ (Request::route()->getName() == 'clients.index' || Request::route()->getName() == 'clients.create' || Request::route()->getName() == 'clients.edit') ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('clients.index') }}">{{  __('Client') }}</a>
                                </li>
                            @endcan
                            @can('manage role')
                                <li class="{{ (Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : '' }}">
                                    <a class="nav-link" href="{{route('roles.index')}}">{{__('Role')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
            @endif
<!--
            @if(Gate::check('manage lead') || \Auth::user()->type=='client')
                <li class="{{ (Request::segment(1) == 'leads')?'active':''}}">
                    <a class="nav-link" href="{{ route('leads.index') }}"><i class="fab fa-dribbble"></i> <span>{{__('Leads')}}</span></a>
                </li>

            @endif -->

            {{--  @if(Gate::check('manage project'))
                <li class="{{ (Request::segment(1) == 'projects')?'active open':''}}">
                    <a class="nav-link" href="{{ route('projects.index') }}"><i class="fas fa-tasks"></i> <span>Job</span></a>
                </li>
            @endif
<!--
                <li class="{{ (Request::segment(1) == 'jobs')?'active open':''}}">
                    <a class="nav-link" href="{{ route('jobs.index') }}"><i class="fab fa-dribbble"></i> <span>Job</span></a>
                </li> -->  --}}

            @if(\Auth::user()->type!='super admin')
                <li class="{{ (Request::segment(1) == 'calender')?'active open':''}}">
                    <a class="nav-link" href="{{ route('calender.index') }}"><i class="fas fa-calendar"></i> <span>{{__('Calender')}}</span></a>
                </li>
            @endif

            <li class="dropdown {{ (Request::segment(1) == 'users' || Request::segment(1) == 'clients' || Request::segment(1) == 'roles')?' active':''}}">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-school"></i> <span>Inventory</span></a>
                        <ul class="dropdown-menu {{ (Request::segment(1) == 'users' || Request::segment(1) == 'clients' || Request::segment(1) == 'roles')?'display:block':''}}">
                            @can('manage user')
                                <li class="{{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : '' }}">
                                    <a class="nav-link" href="{{ route('Inventory.index') }}">Stock in</a>
                                </li>
                            @endcan
                            @can('manage client')
                                <li class="{{ (Request::route()->getName() == 'clients.index' || Request::route()->getName() == 'clients.create' || Request::route()->getName() == 'clients.edit') ? ' active' : '' }}">
                                    <a class="nav-link" href="#">Stock out</a>
                                </li>
                            @endcan
                        </ul>
                    </li>

<!--
            @if(Gate::check('manage plan'))
                <li class="{{ (Request::segment(1) == 'plans')?'active':''}}">
                    <a class="nav-link" href="{{ route('plans.index') }}"><i class="fas fa-trophy"></i><span>{{__('Plan')}}</span></a>
                </li>
            @endif -->

            @if(Gate::check('manage order'))
                <li class="{{ (Request::segment(1) == 'orders')?'active':''}}">
                    <a class="nav-link" href="{{ route('order.index') }}"><i class="fas fa-cart-plus"></i><span>{{__('Order')}}</span></a>
                </li>
            @endif

            @if(Gate::check('manage note'))
                <li class="{{ (Request::segment(1) == 'notes')?'active':''}}">
                    <a class="nav-link" href="{{ route('notes.index') }}"><i class="fas fa-sticky-note"></i><span>{{__('Notes')}}</span></a>
                </li>
            @endif


            @if((Gate::check('manage product') || Gate::check('manage invoice') || Gate::check('manage expense') || Gate::check('manage payment') || Gate::check('manage tax')) || \Auth::user()->type=='client')
                <li class="dropdown {{ (Request::segment(1) == 'products' || Request::segment(1) == 'expenses' || Request::segment(1) == 'invoices' || Request::segment(1) == 'invoices-payments' || Request::segment(1) == 'taxes')?'active':''}}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-shopping-cart"></i> <span>{{__('Sales')}}</span></a>
                    <ul class="dropdown-menu {{ (Request::segment(1) == 'products' || Request::segment(1) == 'expenses' || Request::segment(1) == 'invoices' || Request::segment(1) == 'invoices-payments' || Request::segment(1) == 'taxes')?'display:block':''}}">

                        @if(Gate::check('manage invoice') || \Auth::user()->type=='client')
                            <li class="{{ (Request::segment(1) == 'invoices')?'active':''}}">
                                <a class="nav-link" href="{{ route('invoices.index') }}">{{__('Invoice')}}</a>
                            </li>
                        @endcan
                        @if(Gate::check('manage payment') || \Auth::user()->type=='client')
                            <li class="{{ (Request::segment(1) == 'invoices-payments')?'active':''}}">
                                <a class="nav-link" href="{{ route('invoices.payments') }}">{{__('Payment')}}</a>
                            </li>

                        @endif

                        @if(Gate::check('manage expense') || \Auth::user()->type=='client')
                            <li class="{{ (Request::segment(1) == 'expenses')?'active open':''}}">
                                <a class="nav-link" href="{{ route('expenses.index') }}">{{__('Expense')}}</a>
                            </li>
                        @endif
                        @can('manage tax')
                            <li class="{{ (Request::segment(1) == 'taxes')?'active':''}}">
                                <a class="nav-link" href="{{ route('taxes.index') }}">{{__('Tax Rates')}}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif


            @if(Gate::check('manage lead stage') || Gate::check('manage project stage') || Gate::check('manage lead source') || Gate::check('manage label') || Gate::check('manage expense category') || Gate::check('manage payment'))
                <li class="dropdown {{ (Request::segment(1) == 'leadstages' || Request::segment(1) == 'projectstages' ||  Request::segment(1) == 'leadsources' ||  Request::segment(1) == 'labels' ||  Request::segment(1) == 'productunits' ||  Request::segment(1) == 'expensescategory' ||  Request::segment(1) == 'payments' ||  Request::segment(1) == 'bugstatus')? 'active':''}}">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-cog"></i> <span>Constant</span></a>
                    <ul class="dropdown-menu {{ (Request::segment(1) == 'leadstages' || Request::segment(1) == 'projectstages' ||  Request::segment(1) == 'leadsources' ||  Request::segment(1) == 'labels' ||  Request::segment(1) == 'productunits' ||  Request::segment(1) == 'expensescategory' ||  Request::segment(1) == 'payments' ||  Request::segment(1) == 'bugstatus')? 'display:block':''}}">
                        {{--  @can('manage lead stage')
                            <li class="{{ (Request::route()->getName() == 'leadstages.index' ) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('leadstages.index')}}"> {{__('Lead Stage')}}</a>
                            </li>
                        @endcan  --}}

                        {{--  @can('manage project stage')
                            <li class="{{ (Request::route()->getName() == 'projectstages.index' ) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('projectstages.index')}}"> {{__('Project Stage')}}</a>
                            </li>

                        @endcan  --}}

                        {{--  @can('manage lead source')
                            <li class="{{ (Request::route()->getName() == 'leadsources.index' ) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('leadsources.index')}}">{{__('Lead Source')}}</a>
                            </li>
                        @endcan  --}}
                        {{--  @can('manage label')

                            <li class="{{ (Request::route()->getName() == 'labels.index' ) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('labels.index')}}"> {{__('Lable')}}</a>
                            </li>
                        @endcan  --}}

                        @can('manage product unit')
                            <li class="{{ (Request::route()->getName() == 'productunits.index' ) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('productunits.index')}}">{{__('Product Unit')}}</a>
                            </li>
                        @endcan

                        @can('manage expense category')
                            <li class="{{ (Request::route()->getName() == 'expensescategory.index' ) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('expensescategory.index')}}">{{__('Expense Category')}}</a>
                            </li>
                        @endcan

                        @can('manage payment')
                            <li class="{{ (Request::route()->getName() == 'payments.index' ) ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('payments.index')}}">{{__('Payment Method')}}</a>
                            </li>
                        @endcan
                        {{--  <li class="{{ (Request::segment(1) == 'bugstatus')?'active open':''}}">
                            <a class="nav-link" href="{{ route('bugstatus.index') }}">{{__('Bug Status')}}</a>
                        </li>  --}}
                    </ul>
                </li>
            @endif
<!--
            @if(Gate::check('manage system settings'))
                <li class="{{ (Request::route()->getName() == 'systems.index') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('systems.index') }}"><i class="fas fa-sliders-h"></i> <span>{{  __('System Setting') }} </span></a>
                </li>
            @endif
            @if(Gate::check('manage company settings'))
                <li class="{{ (Request::route()->getName() == 'systems.index') ? ' active' : '' }}">
                    <a class="nav-link" href="{{ route('company.setting') }}"><i class="fas fa-sliders-h"></i> <span>{{  __('Company Setting') }} </span></a>
                </li>
            @endif -->

        </ul>
    </aside>
</div>
