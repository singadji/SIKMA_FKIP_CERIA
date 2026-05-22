@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Request;
    use App\Models\Modul;

    $user = Auth::user();

    $mods = Modul::where('aktif', 1)
            ->when($user?->role_id, function ($q) use ($user) {
                $q->where(function ($q2) use ($user) {
                    $q2->whereNull('role_id')
                       ->orWhere('role_id', $user->role_id);
                });
            })
            ->orderBy('par')
            ->get();

    $modulesByParent = $mods->groupBy('par');

@endphp
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
            <hr>
                {{-- Dashboard --}}
                <li class="{{ Request::is('dashboard') ? 'mm-active' : '' }}">
                    <a href="{{ url('dashboard') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>

                @foreach($modulesByParent[null] ?? [] as $mod)

                    @php
                        $children = $modulesByParent[$mod->id] ?? collect();

                        $isOpen = $children->contains(function ($c) {
                            return request()->is(trim($c->url, '/') . '*');
                        }) || request()->is(trim($mod->url, '/') . '*');
                    @endphp

                    <li class="{{ $isOpen ? 'mm-active' : '' }}">

                        @if($children->isNotEmpty())
                            <a href="javascript:void(0);" class="has-arrow">
                                <i data-feather="{{ $mod->icon ?? 'grid' }}"></i>
                                <span>{{ $mod->nama_modul }}</span>
                            </a>

                            <ul class="sub-menu" style="{{ $isOpen ? 'display:block;' : '' }}">
                                @foreach($children as $child)
                                    <li class="{{ request()->is(trim($child->url, '/') . '*') ? 'mm-active' : '' }}">
                                        <a href="{{ url($child->url) }}">
                                            {{ $child->nama_modul }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                        @else
                            <a href="{{ url($mod->url) }}">
                                <i data-feather="{{ $mod->icon ?? 'grid' }}"></i>
                                <span>{{ $mod->nama_modul }}</span>
                            </a>
                        @endif

                    </li>

                @endforeach
            </ul>
        </div>
    </div>
</div>
