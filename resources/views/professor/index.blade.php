<x-app-layout>
    <x-slot:header>
            <div class="sm:flex justify-between items-center">
                <div>
                    <h2 class="font-semibold text-xl text-black">
                        {{ __('Professores') }}
                    </h2>
                </div>
                <div>
                    <button type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 border border-red-600 rounded">
                        <a href="{{route('professores-controller.create')}}">Adicionar Professor</a>
                    </button>
                </div>
            </div>
        </x-slot>

        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />

        <section class="container mx-auto p-6 font-mono">
            <div class="w-full mb-8 overflow-hidden rounded-lg shadow-lg">
                <div class="w-full overflow-x-auto">

                    <table class="w-full table-auto">
                        <thead class="bg-gray-500 text-white">
                            <tr class="text-md font-semibold tracking-wide text-center text-white border-b border-gray-600">
                                <th class="p-3">Nome</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">RG</th>
                                <th class="p-3">CPF</th>
                                <th class="p-3">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach ($professores as $professor)
                            <tr>
                                <td class="p-2 border">
                                    <div class="text-center text-sm">
                                        <p class="font-semibold text-gray-700">{{$professor->name}}</p>
                                    </div>
                                </td>
                                <td class="p-2 border">
                                    <div class="text-center text-sm">
                                        <p class="font-semibold text-gray-700">{{$professor->email}}</p>
                                    </div>
                                </td>
                                <td class="p-2 border">
                                    <div class="text-center text-sm">
                                        <p class="font-semibold text-gray-700">{{$professor->rg}}</p>
                                    </div>
                                </td>
                                <td class="p-2 border">
                                    <div class="text-center text-sm">
                                        <p class="font-semibold text-gray-700">{{$professor->cpf}}</p>
                                    </div>
                                </td>
                                <td class="p-2 border">
                                    <form action="{{route('professores-controller.destroy',['professor' => $professor->id])}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <div class="text-center text-sm">
                                            <a style="color: black;" href="{{route('professores-controller.show',['professor' => $professor->id])}}" class="mr-2">
                                                <i class="material-icons-outlined text-base">visibility</i>
                                            </a>
                                            <a style="color:orange" href="{{route('professores-controller.edit',['professor' => $professor->id])}}" class="mx-2">
                                                <i class="material-icons-outlined text-base">edit</i>
                                            </a>
                                            <button type="submit">
                                                <svg class=" text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
</x-app-layout>