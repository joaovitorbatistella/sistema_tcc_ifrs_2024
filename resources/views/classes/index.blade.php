<x-app-layout>
    <x-slot:header>
        <div class="sm:flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-black">
                    {{ __('Turmas') }}
                </h2>
            </div>
        </div>
    </x-slot>

        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />

    <form class="max-w-md mx-auto" action="{{ route('class-controller.store') }}" enctype="multipart/form-data"  method="POST">
        @csrf
        <div style="margin-top: 15px;">
            <div style="margin-left: 20px; margin-right: 20px;" class="grid  md:gap-12">

                <div class="w-64 mt-4">
                    <label class="text-gray-600">Nome da turma:</label>
                    <input type="text" name="class_name" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                </div>
                
                <div class="w-64 mt-4">
                    <label for="students" class="block text-sm font-medium text-gray-700">Seleção Múltipla</label>
                    <select id="students" name="students[]" multiple class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                        @foreach ($students as $studet)
                            <option value="{{ $studet->id }}">{{ $studet->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-left: 20px; margin-right: 20px;">
                    <div class="w-64 mt-2" style=" mb-4">
                        <label class="text-gray-600">Atividade 1:</label>
                        <input type="text" name="name_1" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Descrição 1:</label>
                        <input type="text" name="description_1" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Prazo:</label>
                        <input type="datetime-local" name="due_at_1" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Arquivo:</label>
                        <input type="file" name="file_1" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                    </div>
                    <div class="w-64 mt-2 mb-4">
                        <label class="text-gray-600">Atividade 2:</label>
                        <input type="text" name="name_2" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Descrição 2:</label>
                        <input type="text" name="description_2" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Prazo:</label>
                        <input type="datetime-local" name="due_at_2" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Arquivo:</label>
                        <input type="file" name="file_2" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                    </div>
                    <div class="w-64 mt-2 mb-4">
                        <label class="text-gray-600">Atividade 3:</label>
                        <input type="text" name="name_3" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Descrição 3:</label>
                        <input type="text" name="description_3" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Prazo:</label>
                        <input type="datetime-local" name="due_at_3" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Arquivo:</label>
                        <input type="file" name="file_3" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                    </div>
                    <div class="w-64 mt-2 mb-4">
                        <label class="text-gray-600">Atividade 4:</label>
                        <input type="text" name="name_4" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Descrição 4:</label>
                        <input type="text" name="description_4" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Prazo:</label>
                        <input type="datetime-local" name="due_at_4" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Arquivo:</label>
                        <input type="file" name="file_4" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                    </div>
                    <div class="w-64 mt-2 mb-4">
                        <label class="text-gray-600">Atividade 5:</label>
                        <input type="text" name="name_5" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Descrição 5:</label>
                        <input type="text" name="description_5" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Prazo:</label>
                        <input type="datetime-local" name="due_at_5" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        <label class="text-gray-600">Arquivo:</label>
                        <input type="file" name="file_5" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                    </div>
                </div>
            </div>
        </div>

        <input type="text" name="user_id" value="{{ $user_id }}" hidden>

        <div class="sm:flex justify-center">
            <button style="margin-top:30px; margin-bottom:15px" type="submit" class="bg-c-green text-white text-lg font-bold py-1 px-2 border rounded">
                Salvar
            </button>
        </div>
    </form>
</x-app-layout>