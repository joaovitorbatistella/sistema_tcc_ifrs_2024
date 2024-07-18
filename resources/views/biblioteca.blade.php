<x-app-layout>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <div class="flex-shrink-0">
                <h2 class="font-semibold text-xl text-black">
                    {{ __('Biblioteca') }}
                </h2>
            </div>
            <div class="flex items-center space-x-4">
                <div>
                    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
                    <div class="relative">
                        <input type="text" name="search" size="20" class="peer w-full text-gray-600 bg-gray-300 p-2 pl-10 pr-10 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2 mb-2" placeholder="Buscar">
                        <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" style="top: 20px; right: 5px;">
                            search
                        </i>
                    </div>
                </div>
                <div style="margin-left: 10px; margin-top:10px">
                    <label>Ordenar por:</label>
                </div>
                <div style="margin-left: 10px;">
                    <select class="w-48 text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2" name="order_by" id="order_by">
                        <option value="name">Nome</option>
                        <option value="date">Data</option>
                    </select>
                </div>
            </div>
        </div>
        </x-slot>

        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />

        <div class="flex justify-between items-center space-x-4" style="margin-left: 30px; margin-top: 15px; margin-right: 30px">
            <h2 class="font-semibold text-lg text-black">
                Recentes
            </h2>
            <button type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 border border-red-600 rounded">
                <a href="">Adicionar Documento</a>
            </button>
        </div>
        <div class="flex items-center">

            <style>
                .recentes {
                    margin-top: 30px;
                    margin-left: 30px;
                    margin-right: 30px;
                    width: 200px;
                    height: 200px;
                    background-color: rgb(233, 233, 233);
                    border: rgb(233, 233, 233);
                    border-radius: 10px;
                    transition: background-color 0.3s ease;
                }

                .recentes:hover {
                    background-color: lightgray;
                }
            </style>

            <div style="margin-left:30px" class="recentes">
                <div class="relative">
                    <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" style="right: 5px; top: 8px;">
                        <span class="material-symbols-outlined">
                            more_vert
                        </span>
                    </i>
                </div>
                <div class="relative">
                    <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" style="right: 70px; top: 70px; font-size: 64px;">
                        <span class="material-symbols-outlined">
                            file_present
                        </span>
                    </i>
                </div>
            </div>
            <div style="margin-left:30px" class="recentes">
                <div class="relative">
                    <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" style="right: 5px; top: 8px;">
                        <span class="material-symbols-outlined">
                            more_vert
                        </span>
                    </i>
                </div>
                <div class="relative">
                    <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" style="right: 70px; top: 70px; font-size: 64px;">
                        <span class="material-symbols-outlined">
                            file_present
                        </span>
                    </i>
                </div>
            </div>
            <div style="margin-left:30px" class="recentes">
                <div class="relative">
                    <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" style="right: 5px; top: 8px;">
                        <span class="material-symbols-outlined">
                            more_vert
                        </span>
                    </i>
                </div>
                <div class="relative">
                    <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" style="right: 70px; top: 70px; font-size: 64px;">
                        <span class="material-symbols-outlined">
                            file_present
                        </span>
                    </i>
                </div>
            </div>
            <div style="margin-left:30px" class="recentes">
                <div class="relative">
                    <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" style="right: 5px; top: 8px;">
                        <span class="material-symbols-outlined">
                            more_vert
                        </span>
                    </i>
                </div>
                <div class="relative">
                    <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" style="right: 70px; top: 70px; font-size: 64px;">
                        <span class="material-symbols-outlined">
                            file_present
                        </span>
                    </i>
                </div>
            </div>
            <div class="relative" style="margin-left:50px">
                <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-700" style="right: 5px; top: 10px; font-size: 36px;">
                    <span class="material-symbols-outlined">
                        add
                    </span>
                </i>
            </div>
        </div>

        <style>
                .docs {
                    margin-top: 30px;
                    margin-left: 30px;
                    margin-right: 30px;
                    width: 80px;
                    height: max-content;
                    background-color: rgb(233, 233, 233);
                    border: rgb(233, 233, 233);
                    border-radius: 10px;
                    transition: background-color 0.3s ease;
                }
            </style>

        <div>
            <table>
                
            </table>
        </div>

        
</x-app-layout>