@extends('layouts.app') <!--usando una directiva de blade para decir que archivo va a cargar
 y en vez de usar / se usan . -->

@section('titulo')
    Bienvenido a Pet Ville
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">

            <article>
                <p class="text-lg font-semibold text-center">
                    Nos alegra darte la bienvenida a <span class="text-blue-500 font-bold">Pet Ville</span>,
                    la primera red social diseñada especialmente para amantes de las mascotas.
                </p>

                <p class="mt-4 text-center">
                    Aquí, tu mejor amigo <span class="font-bold">peludo, emplumado o escamoso</span> es el protagonista.
                    🐶🐱🐰🐦🐠
                </p>

                <div class="mt-6 space-y-3">
                    <p class="font-semibold text-xl text-center text-blue-600">🌟 En Pet Ville, podrás:</p>
                    <ul class="list-none space-y-2">
                        <li class="flex items-center"><span class="text-green-500">✅</span> Compartir fotos, videos y
                            anécdotas inolvidables de tu mascota.</li>
                        <li class="flex items-center"><span class="text-green-500">✅</span> Conectar con otros amantes de
                            los animales y hacer nuevos amigos.</li>
                        <li class="flex items-center"><span class="text-green-500">✅</span> Comentar, dar "me gusta" y
                            compartir publicaciones dentro de nuestra comunidad.</li>
                        <li class="flex items-center"><span class="text-green-500">✅</span> Explorar servicios y productos
                            diseñados para el bienestar de tu mascota.</li>
                        <li class="flex items-center"><span class="text-green-500">✅</span> Descubrir eventos, consejos y
                            noticias sobre el mundo animal.</li>
                    </ul>
                </div>
    
                <p class="mt-6 text-center text-gray-700">
                    🐾 <span class="font-semibold">Nuestra misión</span> es crear un espacio donde los dueños de mascotas
                    puedan encontrar apoyo, información y entretenimiento,
                    mientras fortalecen el vínculo con sus compañeros de vida.
                </p>

                <p class="mt-6 text-center text-blue-600 font-bold text-xl">💙 Gracias por ser parte de esta increíble
                    comunidad.</p>

                <p class="mt-4 text-center text-xl text-gray-900 font-semibold">🐾 ¡Juntos, hagamos de Pet Ville el mejor
                    lugar para nuestras mascotas! 🐾</p>
            </article>

        </div>
        <div class='md:w-7/12 p-5'>
            <img src="{{asset('img/principal.jpg')}}" alt="Imagen login de usuarios">
        </div>
    </div>


@endsection
