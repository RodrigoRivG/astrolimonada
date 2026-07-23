<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comunidad AstroLimonada') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Buscador -->
             <div class="bg-white shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('posts.index') }}" method="GET" class="flex gap-2">
                    <x-text-input 
                        name="search"
                        type="text"
                        placeholder="Buscar por título, descripción o #etiqueta"
                        value="{{ $searchTerm }}"
                        class="w-full"
                    />
                    <x-primary-button type="submit">
                        {{ __('Buscar') }}
                    </x-primary-button>

                    @if ($searchTerm)
                        <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300">
                            {{ __('Limpiar') }}
                        </a>
                    @endif
                </form>
             </div>
             <!-- Próximamente: Listado de Posts -->
        </div>
    </div>
</x-app-layout>
