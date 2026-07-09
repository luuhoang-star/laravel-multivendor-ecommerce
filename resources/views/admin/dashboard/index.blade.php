<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bảng điều khiển Admin') }}
        </h2>
    </x-slot>




    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf

                <x-dropdown-link :href="route('admin.logout')"
                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Đăng xuất') }}
                </x-dropdown-link>
            </form>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __('Bạn đã đăng nhập!') }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
