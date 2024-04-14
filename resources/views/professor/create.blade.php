<x-app-layout>
    <x-slot:header>
        <div class="sm:flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-black">
                    {{ __('Adicionar Professor') }}
                </h2>
            </div>
            <div>
                <button type="button" class="bg-red-600 text-white text-lg font-bold py-1 px-2 border border-red-600 rounded">
                    <a href="{{route('professores-controller.index')}}">Cancelar</a>
                </button>
            </div>
        </div>
        </x-slot>

        <div>
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div>
                    <form class="max-w-md mx-auto" action="{{ route('professores-controller.store') }}" method="POST">
                        @csrf
                        <div style="margin-top: 15px;">
                            <div style="margin-left: 20px; margin-right: 20px;" class="grid md:grid-cols-2 md:gap-6">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label class="text-gray-600">Nome:</label>
                                    <input required type="text" name="name" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                </div>
                                <div style="margin-left: 10px;" class="relative z-0 w-full mb-5 group">
                                    <label class="text-gray-600">Email:</label>
                                    <input required type="text" name="email" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                </div>
                            </div>
                            <div style="margin-left: 20px; margin-right: 20px; margin-top:20px" class="grid md:grid-cols-2 md:gap-6">
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600" for="gender">Gênero:</label>
                                        <select required class="block py-2.5 peer w-full text-gray-600 bg-gray-300 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2" id="gender" name="gender">
                                            <option></option>
                                            <option value="Male">Masculino</option>
                                            <option value="Female">Feminino</option>
                                            <option value="Others">Outro</option>
                                        </select>
                                    </div>
                                    <div style="margin-left: 5px;" class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600">Nascimento:</label>
                                        <input required type="date" name="birthday" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                    </div>
                                </div>
                                <div style="margin-left: 15px;" class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600">RG:</label>
                                        <input required type="tel" name="rg" minlength="10" maxlength="10" pattern="[0-9]+$" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                    </div>
                                    <div style="margin-left:10px;" class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600">CPF:</label>
                                        <input required type="tel" name="cpf" minlength="11" maxlength="11" pattern="[0-9]+$" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                    </div>
                                </div>
                            </div>
                            <div style="margin-left: 20px; margin-right: 20px; margin-top:20px" class="grid md:grid-cols-2 md:gap-6">
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600" for="nationality">Nacionalidade:</label>
                                        <input required type="text" name="nationality" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                    </div>
                                    <div style="margin-left: 5px;" class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600">Estado Civil:</label>
                                        <select required class="block py-2.5 peer w-full text-gray-600 bg-gray-300 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2" id="martial_status" name="martial_status">
                                            <option></option>
                                            <option value="single">Solteiro</option>
                                            <option value="married">Casado</option>
                                            <option value="separated">Separado</option>
                                            <option value="divorced">Divorciado</option>
                                            <option value="widowed">Viúvo</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="margin-left: 15px;" class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600">Necessidade Especial:</label>
                                        <select required class="block py-2.5 peer w-full text-gray-600 bg-gray-300 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2" id="special_need" name="special_need">
                                            <option></option>
                                            <option value="Nao">Não</option>
                                            <option value="Sim">Sim</option>
                                        </select>
                                    </div>
                                    <div style="margin-left: 10px;" class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 w-full mb-5 group">
                                            <label class="text-gray-600">Renda Familiar:</label>
                                            <input required min="0" type="number" name="family_income" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                        </div>
                                        <div style="margin-left:10px;" class="relative z-0 w-full mb-5 group">
                                            <label class="text-gray-600">Grupo Familiar:</label>
                                            <input required step="1" min="1" type="number" name="family_number" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                        </div>
                                        <input hidden type="text" name="password" value="1234">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sm:flex justify-center">
                            <button style="margin-top:30px; margin-bottom:15px" type="submit" class="bg-c-green text-white text-lg font-bold py-1 px-2 border rounded">
                                Salvar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>