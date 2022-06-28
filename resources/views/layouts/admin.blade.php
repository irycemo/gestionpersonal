<x-app-layout>

    <div class="relative min-h-screen md:flex">

        {{-- Sidebar --}}
        <div id="sidebar" class="z-50 bg-white w-64 absolute inset-y-0 left-0 transform -translate-x-full transition duration-200 ease-in-out md:relative md:translate-x-0">

            {{-- Header --}}
            <div class="w-100 flex-none bg-white border-b-2 border-b-grey-200 flex flex-row p-5 pr-0 justify-between items-center h-20 ">

                {{-- Logo --}}
                <a href="/" class="mx-auto">

                    <img class="h-16" src="{{ asset('storage/img/logo2.png') }}" alt="Logo">

                </a>

                {{-- Side Menu hide button --}}
                <button  type="button" title="Cerrar Menú" id="sidebar-menu-button" class="md:hidden mr-2 inline-flex items-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>

                </button>

            </div>

            {{-- Nav --}}
            <nav class="p-4 text-rojo " x-data="{openRoles:true, openArticles:true}">

                <p class="uppercase text-md text-rojo mb-4 tracking-wider">Administración</p>

                @can('Lista de roles')

                    <div class="flex items-center mb-3 w-full justify-between hover:text-red-600 transition ease-in-out duration-500 hover:bg-gray-100 rounded-xl">

                        <a href="{{ route('roles') }}" class=" capitalize font-medium text-md  flex hover w-full  p-2 px-4 ">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>

                            Roles

                        </a>
                        <svg @click="openRoles = false" x-show="openRoles" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-300 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>

                        <svg @click="openRoles = true" x-show="!openRoles" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-300 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>

                    </div>

                @endcan

                <div
                    x-transition:enter="transition duration-2000 transform ease-out"
                    x-transition:leave="transition duration-200 transform ease-in"
                    x-transition:leave-end="opacity-0 scale-90"
                    x-transition:enter-start="scale-75"
                    class="flex items-center mb-3 w-full justify-between hover:text-red-600 transition ease-in-out duration-500 hover:bg-gray-100 rounded-xl text-sm"
                    x-show="!openRoles">

                    <a href="{{ route('permisos') }}" class=" capitalize font-medium text-md  flex hover w-full   p-2 px-4 ml-5">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                          </svg>

                        Permisos

                    </a>

                </div>

                @can('Lista de usuarios')

                    <a href="{{ route('usuarios') }}" class="mb-3 capitalize font-medium text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                            </svg>

                        Usuarios
                    </a>

                @endcan

                @can('Lista de horarios')

                    <a href="{{ route('horarios') }}" class="mb-3 capitalize font-medium text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>

                        Horarios
                    </a>

                @endcan

                @can('Lista de inasistencias')

                    <a href="{{ route('inasistencias') }}" class="mb-3 capitalize font-medium text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>

                        Inasistencias
                    </a>

                @endcan

                @can('Lista de artículos')

                    <div class="flex items-center mb-3 w-full justify-between hover:text-red-600 transition ease-in-out duration-500 hover:bg-gray-100 rounded-xl">

                        <a href="#" class="capitalize font-medium text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>

                            Artículos
                        </a>

                        <svg @click="openArticles = false" x-show="openArticles" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-300 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>

                        <svg @click="openArticles = true" x-show="!openArticles" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-300 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                        </svg>

                    </div>

                @endcan

                <div
                    x-transition:enter="transition duration-2000 transform ease-out"
                    x-transition:leave="transition duration-200 transform ease-in"
                    x-transition:leave-end="opacity-0 scale-90"
                    x-transition:enter-start="scale-75"
                    class="flex flex-col space-y-2 items-center mb-3 w-full justify-between hover:text-red-600 transition ease-in-out duration-500  rounded-xl text-sm"
                    x-show="!openArticles">

                    <a href="#" class=" capitalize font-medium text-md  flex hover w-full  hover:bg-gray-100 p-2 px-4 ml-5">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>

                        Catastro

                    </a>

                    <a href="#" class=" capitalize font-medium text-md  flex hover w-full  hover:bg-gray-100 p-2 px-4 ml-5">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                        </svg>

                        RPP

                    </a>

                </div>

                @can('Lista de permisos personal')

                    <a href="{{ route('permisos_personal') }}" class="mb-3 capitalize font-medium text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                        </svg>

                        Permisos
                    </a>

                @endcan

                @can('Lista de incapacidades')

                    <a href="{{ route('incapacidades') }}" class="mb-3 capitalize font-medium text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                        </svg>

                        Incapacidades
                    </a>

                @endcan

                @can('Lista de personal')

                    <a href="{{ route('personal') }}" class="mb-3 capitalize font-medium text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                        <svg xmlns="http://www.w3.org/2000/svg"  class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                          </svg>

                        Personal
                    </a>

                @endcan

                @can('Lista de justificaciones')

                    <a href="{{ route('justificaciones') }}" class="mb-3 capitalize font-medium text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>

                        Justificaciones
                    </a>

                @endcan

                @can('Lista de inhabiles')

                    <a href="{{ route('inhabiles') }}" class="mb-3 capitalize font-medium text-md hover:text-red-600 transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>

                        Días Inhábiles
                    </a>

                @endcan

                @can('Reportes')

                    <a href="{{ route('reportes') }}" class="mb-3 capitalize font-medium text-md  transition ease-in-out duration-500 flex hover  hover:bg-gray-100 p-2 px-4 rounded-xl">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>

                        Reportes
                    </a>

                @endcan


            </nav>

        </div>

        {{-- Content --}}
        <div class="flex-1 flex-col flex max-h-screen overflow-x-auto min-h-screen">

            {{-- Header --}}
            <div class="w-100  bg-white border-b-2 border-b-grey-200 flex-none flex flex-row p-5 justify-between items-center h-20">

                <!-- Mobile menu button-->
                <div class="flex items-center">

                    <button  type="button" title="Abrir Menú" id="mobile-menu-button" class="md:hidden inline-flex items-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

                        <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>

                    </button>

                </div>

                {{-- Logo --}}
                <p x-show.transition.in.duration.1000ms.out.duration.200msw="!open_side_menu"  class="font-semibold text-2xl text-rojo">Gestión de Personal</p>

                <!-- Profile dropdown -->
                <div class="ml-3 relative z-50" x-data="{ open_drop_down:false }">

                    <div>

                        <button x-on:click="open_drop_down=true" type="button" class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu" aria-expanded="false" aria-haspopup="true">

                            <span class="sr-only">Abrir menú de usuario</span>

                            <img class="h-10 w-10 rounded-full" src="{{Auth::user()->profile_photo_url}}" alt="{{ Auth::user()->name }}" id="nav-profile">

                        </button>

                    </div>

                    <div x-show="open_drop_down" x-on:click.away="open_drop_down=false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">

                        <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">Mi Perfil</a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 focus:outline-none" role="menuitem">Cerrar Sesión</button>

                        </form>

                    </div>

                </div>

            </div>

            <div class="bg-gray-100 p-3 flex-1 overflow-y-auto  md:border-l-2 border-l-grey-200">

                @yield('content')

            </div>

        </div>

    </div>

    <script>

        const btn_close = document.getElementById('sidebar-menu-button');
        const btn_open = document.getElementById('mobile-menu-button');
        const sidebar = document.getElementById('sidebar');

        btn_open.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        btn_close.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        /* Change nav profile image */
        window.addEventListener('nav-profile-img', event => {

            document.getElementById('nav-profile').setAttribute('src', event.detail.img);

        });

    </script>

</x-app-layout>
