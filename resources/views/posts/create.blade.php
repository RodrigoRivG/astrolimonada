<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear nuevo Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                <!-- Mensaje de éxito de la sesión -->
                 @if (session('success'))
                    <div class="mb-4 text-green-600 font-semibold">
                        {{ session('success') }}
                    </div>
                 @endif

                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Campo: Título -->
                    <div class="mb-4">
                        <x-input-label for="title" value="Título del Post" />
                        <x-text-input 
                            id="title"
                            name="title"
                            type="text"
                            class="mt-1 block w-full"
                            placeholder="Agrega un título"
                            value="{{ old('title') }}"
                        />
                        <x-input-error :messages="$errors->get('title')" class="mt-2"/>
                    </div>

                    <!-- Campo: Descripción -->
                    <div class="mb-4">
                        <x-input-label for="description" value="Descripción del Post" />
                        <textarea 
                            id="description"
                            name="description"
                            rows="4"
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                            placeholder="Agrega la descripción del post"
                        >{{ old('description') }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-2"/>
                    </div>

                    <!-- Campo: Fotos (con feedback dinámico en Alpine.js) -->
                    <div x-data="{ filesCount: 0, fileNames: [] }" class="mb-4">
                        <x-input-label for="photos" value="Fotos del Post" />
                        
                        <label for="photos" class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 p-4 text-center">
                            
                            <!-- Si NO se ha seleccionado ninguna foto -->
                            <template x-if="filesCount === 0">
                                <span class="text-gray-600 font-medium">+ Subir Fotos</span>
                            </template>

                            <!-- Si YA se seleccionaron fotos -->
                            <template x-if="filesCount > 0">
                                <div>
                                    <p class="text-sm font-semibold text-indigo-600" x-text="filesCount + ' foto(s) seleccionada(s)'"></p>
                                    <p class="text-xs text-gray-500 mt-1 truncate max-w-xs" x-text="fileNames.join(', ')"></p>
                                </div>
                            </template>

                            <!-- Input que escucha el evento de selección (@change) -->
                            <input 
                                id="photos"
                                name="photos[]"
                                type="file"
                                multiple
                                accept="image/*"
                                class="hidden"
                                @change="
                                    filesCount = $event.target.files.length;
                                    fileNames = Array.from($event.target.files).map(f => f.name);
                                "
                            />
                        </label>
                        <x-input-error :messages="$errors->get('photos')" class="mt-2"/>
                        <x-input-error :messages="$errors->get('photos.*')" class="mt-2"/>
                    </div>


                    <!-- boton de guardar  -->
                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button>
                            {{ __('Publicar') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
