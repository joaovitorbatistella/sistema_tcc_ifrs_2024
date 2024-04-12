<x-app-layout>
    <x-slot:header>
        <div>
            <div class="sm:flex items-center justify-center">
                <div>
                    <h2 class="font-semibold text-xl text-black">
                        {{ __('Editar Aluno') }}
                    </h2>
                </div>
                <div style="margin-left: 800px;"></div>
                <button type="button" class="bg-red-600 text-white text-lg font-bold py-1 px-2 border border-red-600 rounded">
                    <a href="{{route('alunos-controller.index')}}">Cancelar</a>
                </button>
            </div>
        </div>
        </x-slot>


        @if(session()->has('message'))
        {{ session()->get('message') }}
        @endif
        <div>
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div>
                    <form action="{{route('alunos-controller.update',['aluno' => $aluno->id])}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div style="margin-top: 15px;">
                            <div style="margin-left: 35px; margin-right: 30px" class="sm:flex items-center">
                                <label class="text-gray-600">Nome:</label>
                                <div style="margin-left: 490px;"></div>
                                <label class="text-gray-600">Email:</label>
                            </div>
                            <div style="margin-left: 35px; margin-right: 30px" class="sm:flex items-center">
                                <input required type="text" size="60" name="name" value="{{$aluno->name}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                <div style="margin-left: 30px;"></div>
                                <input required type="text" size="60" name="email" value="{{$aluno->email}}" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                            </div>
                            <div style="margin-left: 35px; margin-right: 30px; margin-top:20px" class="sm:flex items-center">
                                <label class="text-gray-600" for="gender">Gênero:</label>
                                <div style="margin-left: 205px;"></div>
                                <label class="text-gray-600">Nascimento:</label>
                                <div style="margin-left: 185px;"></div>
                                <label class="text-gray-600">RG:</label>
                                <div style="margin-left: 240px;"></div>
                                <label class="text-gray-600">CPF:</label>
                            </div>
                            <div style="margin-left: 35px; margin-right: 30px;" class="sm:flex items-center">
                                <select style="width:230px; height:40px;" class="text-gray-600 bg-gray-300 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2" id="gender" name="gender">
                                    <option>{{$aluno->gender}}</option>
                                    <option value="Male">Masculino</option>
                                    <option value="Female">Feminino</option>
                                    <option value="Others">Outro</option>
                                </select>
                                <div style="margin-left: 30px;"></div>
                                <input value="{{$aluno->birthday}}" style="width:250px; height:40px" type="datetime-local" name="birthday" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                <div style="margin-left: 30px;"></div>
                                <input size="26" type="tel" name="rg" value="{{$aluno->rg}}" maxlength="10" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                <div style="margin-left: 30px;"></div>
                                <input size="26" type="tel" name="cpf" value="{{$aluno->cpf}}" maxlength="11" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                            </div>
                            <div style="margin-left: 35px; margin-right: 30px; margin-top:20px" class="sm:flex items-center">
                                <label class="text-gray-600" for="nationality">Nacionalidade:</label>
                                <div style="margin-left: 155px;"></div>
                                <label class="text-gray-600">Estado Civil:</label>
                                <div style="margin-left: 190px;"></div>
                                <label class="text-gray-600">Necessidade Especial:</label>
                            </div>
                            <div style="margin-left: 35px; margin-right: 30px;" class="sm:flex items-center">
                                <input value="{{$aluno->nationality}}" type="text" size="25" name="nationality" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                <div style="margin-left: 30px;"></div>
                                <select style="width:250px; height:40px;" class="text-gray-600 bg-gray-300 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2" id="martial_status" name="martial_status">
                                    <option>{{$aluno->martial_status}}</option>
                                    <option value="single">Solteiro</option>
                                    <option value="married">Casado</option>
                                    <option value="separated">Separado</option>
                                    <option value="divorced">Divorciado</option>
                                    <option value="widowed">Viúvo</option>
                                </select>
                                <div style="margin-left: 30px;"></div>
                                <select required style="width:505px; height:40px;" class="text-gray-600 bg-gray-300 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2" id="special_need" name="special_need">
                                    <option>{{$aluno->special_need}}</option>
                                    <option value="Nao">Não</option>
                                    <option value="Sim">Sim</option>
                                </select>
                            </div>
                            <div style="margin-left: 35px; margin-right: 30px; margin-top:20px" class="sm:flex items-center">
                                <label class="text-gray-600">Renda Familiar: (R$)</label>
                                <div style="margin-left: 115px;"></div>
                                <label class="text-gray-600">Número de Membros na Família:</label>
                            </div>
                            <div style="margin-left: 35px; margin-right: 30px;" class="sm:flex items-center">
                                <input value="{{$aluno->family_income}}" style="width:230px; height:40px;" min="0" type="number" name="family_income" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                <div style="margin-left: 30px;"></div>
                                <input value="{{$aluno->family_number}}" step="1" style="width:250px; height:40px;" min="0" type="number" name="family_number" class="text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                            </div>
                        </div>
                        <button style="background-color:darkcyan; margin-left:980px; margin-right:50px; margin-top:30px; margin-bottom:15px" type="submit" class="text-white text-lg font-bold py-1 px-2 border rounded">
                            Atualizar
                        </button>
                    </form>
                </div>
            </div>
        </div>
</x-app-layout>