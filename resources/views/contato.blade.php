@extends('layouts.main')
@section('title','Contato')
@section('content')
<main class="flex-grow flex flex-col items-center">
    <section class="px-4 py-10 w-full max-w-7xl">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">
            <!-- Coluna do Contato -->
            <div class="space-y-6">
                <h1 class="text-4xl font-bold text-neutral-700 dark:text-neutral-200">Contato</h1>
                <ul class="text-neutral-700 dark:text-neutral-300 text-lg space-y-4">
                    <li class="flex items-center space-x-4">
                        <ion-icon name="logo-instagram" class="text-2xl text-pink-500"></ion-icon>
                        <a href="https://www.instagram.com/transicao_planetaria_com/" class="hover:underline">
                            @transicao_planetaria_com
                        </a>
                    </li>
                    <li class="flex items-center space-x-4">
                        <ion-icon name="logo-whatsapp" class="text-2xl text-green-500"></ion-icon>
                        <a href="https://wa.link/dqdevv" class="hover:underline">
                            (27) 99925-4242
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Coluna do Mapa -->
            <div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3741.6927377796296!2d-40.31768792439313!3d-20.312981481163227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xb83d793fa3154f%3A0x1a4f48a13e28778b!2sGrupo%20Espirita%20Servos%20De%20Jesus!5e0!3m2!1spt-BR!2sus!4v1736402296133!5m2!1spt-BR!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                class="w-full h-80 rounded-lg shadow-md"></iframe>      
            </div>
        </div>
    </section>
</main>
@endsection
