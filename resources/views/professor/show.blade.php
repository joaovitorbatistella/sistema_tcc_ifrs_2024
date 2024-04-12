<x-app-layout>
    <x-slot:header>
        <div>
            <div class="sm:flex items-center justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-black">
                        {{ __('Detalhes do Professor') }}
                    </h2>
                </div>
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
                    <div style="margin-top: 15px;">
                        <div style="margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">Nome:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="100" name="name" value="{{$professor->name}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                        <div style="margin-top: 10px; margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">Email:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="101" name="email" value="{{$professor->email}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                        <div style="margin-top: 10px; margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">Gênero:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="99" name="gender" value="{{$professor->gender}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                        <div style="margin-top: 10px; margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">Nascimento:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="95" name="birthday" value="{{$professor->birthday}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                        <div style="margin-top: 10px; margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">RG:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="103" name="rg" value="{{$professor->rg}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                        <div style="margin-top: 10px; margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">CPF:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="102" name="cpf" value="{{$professor->cpf}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                        <div style="margin-top: 10px; margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">Nacionalidade:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="93" name="nationality" value="{{$professor->nationality}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                        <div style="margin-top: 10px; margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">Estado Civil:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="95" name="martial_status" value="{{$professor->martial_status}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                        <div style="margin-top: 10px; margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">Necessidade Especial:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="86" name="special_need" value="{{$professor->special_need}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                        <div style="margin-top: 10px; margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">Renda Familiar:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="92" name="family_income" value="R$ {{$professor->family_income}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                        <div style="margin-bottom: 15px;margin-top: 10px; margin-left: 50px; margin-right: 50px" class="sm:flex items-center">
                            <label class="text-gray-600">Número de Membros na Família:</label>
                            <div style="margin-left: 15px;"></div>
                            <input disabled type="text" size="77" name="family_number" value="{{$professor->family_number}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>