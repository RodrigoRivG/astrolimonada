@props([
    'post',
    'showOptions' => false
])

<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
    <!-- 1. Cabecera: Autor y Fecha (+ Botón de 3 puntos) -->
    <div class="flex items-center justify-between p-4 border-b border-gray-50">
        <div class="flex items-center space-x-3">
            <!-- Icono/Avatar genérico del usuario -->
            <div style="width: 36px; height: 36px; border-radius: 9999px; background-color: #e0e7ff; color: #4338ca; display: inline-flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; flex-shrink: 0; margin-right: 10px;">
                {{ strtoupper(substr($post->user->name ?? 'A', 0, 1)) }}
            </div>
            <div>
                <p class="text-sm font-semibold text-gray-800">
                    {{ $post->user->name ?? 'Usuario Anónimo' }}
                </p>
                <p class="text-xs text-gray-400">
                    {{ $post->created_at->diffForHumans() }}
                </p>
            </div>
        </div>
        <!-- Menú de 3 puntos (Sólo si $showOptions es true) -->
        @if ($showOptions)
            <div class="relative">
                <button class="text-gray-400 hover:text-gray-600 p-1.5 rounded-full hover:bg-gray-100 transition">
                    <!-- Icono SVG de 3 puntos verticales -->
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 8c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm0 2c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm0 6c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2z"/>
                    </svg>
                </button>
            </div>
        @endif
    </div>

    <!-- 2. Vista Previa de la Imagen (Carrusel Preview) -->
    <a href="{{ route('posts.show', $post) }}" class="block relative group">
        @if ($post->photos->isNotEmpty())
            <div class="overflow-hidden">
                <img 
                    src="{{ asset('storage/' . $post->photos->first()->path) }}"
                    alt="{{ $post->title }}"
                    class="group-hover:opacity-95 transition"
                    style="height: 280px; width: 100%; object-fit: cover;"
                />
            </div>
            <!-- Badge flotante si hay más de 1 foto 📷-->
            @if ($post->photos->count() > 1)
                <span class="absolute top-3 right-3 bg-black/65 text-white text-xs font-semibold px-2.5 py-1 rounded-full backdrop-blur-sm">
                    1/{{ $post->photos->count() }}
                </span>
            @endif
        @else 
            <!-- Si el post no tiene fotos -->
            <div class="w-full h-32 bg-gray-50 flex items-center justify-center text-gray-400 text-sm">
                Sin fotos adjuntas
            </div>
        @endif
    </a>

    <!-- 3. Título y Contenido -->
    <div class="p-4">
        <a href="{{ route('posts.show', $post) }}" class="block">
            <h3 class="text-lg font-bold text-gray-900 hover:text-indigo-600 transition">
                {{ $post->title }}
            </h3>
        </a>
    </div>
    <!-- 4. Footer: Botones de Interacción (Favorito y Comentario) -->
    <div class="px-4 py-3 bg-gray-50/50 border-t border-gray-100 flex items-center space-x-6">
        {{-- Placeholder para favorite-button --}}
        <div class="flex items-center text-gray-500 text-sm font-medium">
            <span>❤️ Favorito</span>
        </div>
        {{-- Placeholder para comment-button --}}
        <div class="flex items-center text-gray-500 text-sm font-medium">
            <span>💬 Comentarios</span>
        </div>
    </div>
</div>