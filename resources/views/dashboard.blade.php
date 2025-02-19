<!-- utlizando el template principal-->
@extends('layouts.app')

@push('scripts')
    @vite(['resources/js/changephoto.js'])
@endpush

@section('titulo')
    Perfil: {{$user->username}}
@endsection

@section('contenido')
    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center">
                <div class="relative group">
                    <label for="profileImageInput" class="block relative">

                        <img id="profileImage"
                            src="{{ auth()->user()->Photo_url ? asset(auth()->user()->Photo_url) : asset('img/pred.png') }}"
                            alt="Imagen usuario"
                            class="w-32 h-32 md:w-48 md:h-48 lg:w-72 lg:h-72 rounded-full object-cover border-4 border-gray-300 shadow-xl">

                        <div
                            class="absolute inset-0 bg-black bg-opacity-50 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-white text-lg font-medium">Cambiar imagen</span>
                        </div>
                    </label>


                    <input type="file" id="profileImageInput" class="hidden" accept="image/*"
                        onchange="previewImage(event)">
                </div>

                <button id="saveImageButton" onclick="uploadImage()"
                    class="mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 hidden">
                    Guardar Imagen
                </button>
                <form action="{{ route('photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <label for="photo">Selecciona una imagen:</label>
                    <input type="file" name="photo" required>
                    <button type="submit">Actualizar Foto</button>
                </form>
            </div>

            <div
                class="md:w-8/12 lg:w-6/12 px-5 flex flex-col items-center md:items-start md:justify-center py-10 md:py-10">
                <p class="text-gray-700 text-2xl">
                    {{$user->username}}
                    <!--/{/{auth()->user()->username}}-->
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    0
                    <span class="font-normal">Seguidores</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Siguiendo</span>
                </p>
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    0
                    <span class="font-normal">Posts</span>
                </p>
            </div>
        </div>
    </div>
    <section class="container mx-auto mt-10">
        <h2 class="text-4xl text-center font-black my-10">Publicaciones</h2>
        <!--esta es otra forma sin tener que usar el controlador solo con la relacion de las tablas
                                        se remplaza en todas las sen tencias $user->posts solo que con esta no se puede paginar/{/{$user->posts}/}/-->


        @if ($posts->count())

            <!--iternado los arreglos que se obtienende post-->
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($posts as $post)
                    <div>
                        <a href="{{route('posts.show', ['post' => $post, 'user' => $user])}}">
                            <!--con esto le dicimos donde se encuentran y le decimos el nombre que extraemos de la bd-->
                            <img src="{{asset('uploads') . '/' . $post->imagen}}" alt="imagen del post {{$post->titulo}}">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="my-10">
                {{$posts->links('pagination::tailwind')}}
            </div>

        @else
            <p class="text-gray-600 uppercase text-sm text-center font-bold">No hay posts</p>
        @endif

    </section>
@endsection
