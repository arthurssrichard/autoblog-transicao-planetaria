@extends('layouts.main')
@section('title','Home')
@section('content')
<main class="container mx-auto px-5 flex flex-grow">
        <div class="mb-10">
            <h2 class="mt-16 mb-5 text-3xl text-yellow-500 font-bold">Latest Posts</h2>
            <div class="w-full mb-5">
                <div class="grid grid-cols-3 gap-10 gap-y-32 w-full">
                    <div class="md:col-span-1 col-span-3">
                        <a href="http://127.0.0.1:8000/blog/laravel-34">
                            <div>
                                <img class="w-full rounded-xl"
                                    src="http://127.0.0.1:8000/storage/3i5uKG05UnvhbORZ3ieDkvtAOL8ss5-metaZXAxNSAoMjIpLnBuZw==-.png">
                            </div>
                        </a>
                        <div class="mt-3"><a href="http://127.0.0.1:8000/blog/laravel-34">
                            </a>
                            <div class="flex items-center mb-2"><a href="http://127.0.0.1:8000/blog/laravel-34">
                                </a><a href="http://127.0.0.1:8000/categories/laravel" class="bg-red-600 
                                        text-white 
                                        rounded-xl px-3 py-1 text-sm mr-3">
                                    Laravel</a>
                                <p class="text-gray-500 text-sm">2023-09-05</p>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Laravel 10 tutorial feed page #34</h3>
                        </div>

                    </div>
                    <div class="md:col-span-1 col-span-3">
                        <a href="http://127.0.0.1:8000/blog/fil3tutorial">
                            <div>
                                <img class="w-full rounded-xl"
                                    src="http://127.0.0.1:8000/storage/4sEsCDleYEXT4GC7AdU8BP7TBab3cx-metaZmlsYW1lbnQgY291cnNlICg0KS5wbmc=-.png">
                            </div>
                        </a>
                        <div class="mt-3"><a href="http://127.0.0.1:8000/blog/fil3tutorial">
                            </a>
                            <div class="flex items-center mb-2"><a href="http://127.0.0.1:8000/blog/fil3tutorial">
                                </a><a href="http://127.0.0.1:8000/categories/PHP" class="bg-blue-400 
                                        text-white 
                                        rounded-xl px-3 py-1 text-sm mr-3">
                                    PHP</a>
                                <p class="text-gray-500 text-sm">2023-09-04</p>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Filament 3 relationship manager tutorial</h3>
                        </div>

                    </div>
                    <div class="md:col-span-1 col-span-3">
                        <a
                            href="http://127.0.0.1:8000/blog/in-exercitationem-quis-dolor-consequatur-eligendi-esse-rerum">
                            <div>
                                <img class="w-full rounded-xl"
                                    src="https://via.placeholder.com/640x480.png/0000ee?text=corrupti">
                            </div>
                            <div class="mt-3">
                                <div class="flex items-center mb-2">
                                    <p class="text-gray-500 text-sm">2023-08-29</p>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Mary Berge</h3>
                            </div>
                        </a>
                    </div>
                    <div class="md:col-span-1 col-span-3">
                        <a href="http://127.0.0.1:8000/blog/autem-nesciunt-architecto-doloribus-ut-id">
                            <div>
                                <img class="w-full rounded-xl"
                                    src="https://via.placeholder.com/640x480.png/00ee33?text=nihil">
                            </div>
                            <div class="mt-3">
                                <div class="flex items-center mb-2">
                                    <p class="text-gray-500 text-sm">2023-08-29</p>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Dr. Reina Yost</h3>
                            </div>
                        </a>
                    </div>
                    <div class="md:col-span-1 col-span-3">
                        <a href="http://127.0.0.1:8000/blog/voluptas-ipsam-ea-officia-nostrum">
                            <div>
                                <img class="w-full rounded-xl"
                                    src="https://via.placeholder.com/640x480.png/00cc33?text=in">
                            </div>
                            <div class="mt-3">
                                <div class="flex items-center mb-2">
                                    <p class="text-gray-500 text-sm">2023-08-29</p>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Carlie Hermann</h3>
                            </div>
                        </a>
                    </div>
                    <div class="md:col-span-1 col-span-3">
                        <a href="http://127.0.0.1:8000/blog/ea-officiis-tenetur-aut-voluptatem">
                            <div>
                                <img class="w-full rounded-xl"
                                    src="https://via.placeholder.com/640x480.png/00eeaa?text=repudiandae">
                            </div>
                            <div class="mt-3">
                                <div class="flex items-center mb-2">
                                    <p class="text-gray-500 text-sm">2023-08-29</p>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Tess Kub</h3>
                            </div>
                        </a>
                    </div>
                    <div class="md:col-span-1 col-span-3">
                        <a
                            href="http://127.0.0.1:8000/blog/non-et-molestiae-repellat-omnis-amet-mollitia-necessitatibus">
                            <div>
                                <img class="w-full rounded-xl"
                                    src="https://via.placeholder.com/640x480.png/00bb77?text=et">
                            </div>
                            <div class="mt-3">
                                <div class="flex items-center mb-2">
                                    <p class="text-gray-500 text-sm">2023-08-29</p>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Lysanne Schmeler</h3>
                            </div>
                        </a>
                    </div>
                    <div class="md:col-span-1 col-span-3">
                        <a href="http://127.0.0.1:8000/blog/itaque-officiis-accusantium-quis-distinctio">
                            <div>
                                <img class="w-full rounded-xl"
                                    src="https://via.placeholder.com/640x480.png/00dd88?text=et">
                            </div>
                            <div class="mt-3">
                                <div class="flex items-center mb-2">
                                    <p class="text-gray-500 text-sm">2023-08-29</p>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Dr. Kiara Mohr</h3>
                            </div>
                        </a>
                    </div>
                    <div class="md:col-span-1 col-span-3">
                        <a href="http://127.0.0.1:8000/blog/sed-dolor-id-qui-distinctio-autem-repellat-voluptas">
                            <div>
                                <img class="w-full rounded-xl"
                                    src="https://via.placeholder.com/640x480.png/002288?text=aut">
                            </div>
                            <div class="mt-3">
                                <div class="flex items-center mb-2">
                                    <p class="text-gray-500 text-sm">2023-08-29</p>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900">Alfreda Hills</h3>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection