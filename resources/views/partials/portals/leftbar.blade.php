<!-- Layout sidenav -->
<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-dark">
	<!-- Brand demo (see assets/css/demo/demo.css) -->
	<div class="app-brand demo">
		<a href="{{ route('portal.home') }}">
			<img src="{{ asset('assets/img/logo_white.png') }}" alt="Logo" height="50px">
		</a>
		{{-- <a href="{{ route('portal.home') }}" class="app-brand-text demo sidenav-text font-weight-normal ml-2">Magazine</a> --}}
		<a href="javascript:void(0)" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
			<i class="ion ion-md-menu align-middle"></i>
		</a>
	</div>
	<!-- Links -->
	<ul class="sidenav-inner py-1">
		<!-- Pages -->
		@canany(['viewpermission', 'viewrole', 'viewuser'])
		<li class="sidenav-item {{ request()->is('portal/usermanage/*') ? 'active open' : '' }}">
			<a href="javascript:void(0)" class="sidenav-link sidenav-toggle">
				<i class="sidenav-icon ion ion-md-people"></i>
				<div>{{ __('global.userManagement') }}</div>
			</a>
			<ul class="sidenav-menu">
				@can('viewpermission')
				<li class="sidenav-item {{ request()->is('portal/usermanage/permissions') ? 'active' : '' }}">
					<a href="{{ route('portal.usermanage.permissions.index') }}" class="sidenav-link">
						<div>{{ __('global.permissions.title') }}</div>
					</a>
				</li>
				@endcan

				@can('viewrole')
				<li class="sidenav-item {{ request()->is('portal/usermanage/roles') ? 'active' : '' }}">
					<a href="{{ route('portal.usermanage.roles.index') }}" class="sidenav-link">
						<div>{{ __('global.roles.title') }}</div>
					</a>
				</li>
				@endcan

				@can('viewuser')
				<li class="sidenav-item {{ request()->is('portal/usermanage/users') ? 'active' : '' }}">
					<a href="{{ route('portal.usermanage.users.index') }}" class="sidenav-link">
						<div>{{ __('global.users.title') }}</div>
					</a>
				</li>
				@endcan
			</ul>
		</li>
		@endcanany

		@can('viewgenre')
		<li class="sidenav-item {{ request()->is('portal/genres') ? 'active' : '' }}">
			<a href="{{ route('portal.genres.index') }}" class="sidenav-link">
				<i class="sidenav-icon ion ion-md-cube"></i>
				<div>{{ __('global.genres.title') }}</div>
			</a>
		</li>
		@endcan

		<li class="sidenav-item {{ request()->is('portal/magazines') ? 'active' : '' }}">
			<a href="{{ route('portal.magazines.index') }}" class="sidenav-link">
				<i class="sidenav-icon ion ion-md-paper"></i>
				<div>{{ __('global.magazines.title') }}</div>
			</a>
		</li>

		<li class="sidenav-item {{ request()->is('portal/emails') ? 'active' : '' }}">
			<a href="{{ route('portal.emails.compose') }}" class="sidenav-link">
				<i class="sidenav-icon ion ion-md-mail"></i>
				<div>{{ __('global.emails.emailUs') }}</div>
			</a>
		</li>
	</ul>
</div>
<!-- / Layout sidenav -->