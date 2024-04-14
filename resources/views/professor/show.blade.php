<x-app-layout>
    <x-slot:header>
        <div class="sm:flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-black">
                    Detalhes do Professor {{$professor->name}}
                </h2>
            </div>
            <div>
                <button type="button" class="bg-red-600 text-white text-lg font-bold py-1 px-2 border border-red-600 rounded">
                    <a href="{{route('professores-controller.index')}}">Voltar</a>
                </button>
            </div>
        </div>
        </x-slot>

        <div>
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div>
                    <input type="hidden" name="_method" value="PUT">
                    <div style="margin-top: 15px;"></div>
                    <div style="margin-left: 50px; margin-right: 50px">
                        <div>
                            <label class="text-gray-600">Nome:</label>
                            <input disabled type="text" name="name" value="{{$professor->name}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-top: 15px;">
                            <label class="text-gray-600">Email:</label>
                            <input disabled type="text" name="email" value="{{$professor->email}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-top: 15px;">
                            <label class="text-gray-600">Gênero:</label>
                            <input disabled type="text" name="gender" value="{{$professor->gender}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-top: 15px;">
                            <label class="text-gray-600">Nascimento:</label>
                            <input disabled type="text" name="birthday" value="{{$professor->birthday}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-top: 15px;">
                            <label class="text-gray-600">RG:</label>
                            <input disabled type="text" name="rg" value="{{$professor->rg}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-top: 15px;">
                            <label class="text-gray-600">CPF:</label>
                            <input disabled type="text" name="cpf" value="{{$professor->cpf}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-top: 15px;">
                            <label class="text-gray-600">Nacionalidade:</label>
                            <input disabled type="text" name="nationality" value="{{$professor->nationality}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-top: 15px;">
                            <label class="text-gray-600">Estado Civil:</label>
                            <input disabled type="text" name="martial_status" value="{{$professor->martial_status}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-top: 15px;">
                            <label class="text-gray-600">Necessidade Especial:</label>
                            <input disabled type="text" name="special_need" value="{{$professor->special_need}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-top: 15px;">
                            <label class="text-gray-600">Renda Familiar:</label>
                            <input disabled type="text" name="family_income" value="R$ {{$professor->family_income}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-top: 15px;">
                            <label class="text-gray-600">Grupo Familiar:</label>
                            <input disabled type="text" name="family_number" value="{{$professor->family_number}}" class="w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white">
                        </div>
                        <div style="margin-bottom: 15px;"></div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>