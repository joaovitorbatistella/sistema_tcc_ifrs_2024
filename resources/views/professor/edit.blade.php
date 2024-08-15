<x-app-layout>
    <x-slot:header>
        <div class="sm:flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-black">
                    {{ __('Editar Professor') }}
                </h2>
            </div>
            <div>
                <button type="button" class="bg-red-600 text-white text-lg font-bold py-1 px-2 border border-red-600 rounded">
                    <a href="{{route('professores-controller.index')}}">Cancelar</a>
                </button>
            </div>
        </div>
        </x-slot>

        <style>
            .disabled-btn {
                background-color: gray !important;
                cursor: not-allowed;
            }
        </style>

        @if(session()->has('message'))
        {{ session()->get('message') }}
        @endif
        <div>
            <div class="overflow-hidden rounded-lg border border-gray-200 shadow-md m-5">
                <div>
                    <form action="{{route('professores-controller.update',['professor' => $professor->id])}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <div style="margin-top: 15px;">
                            <div style="margin-left: 20px; margin-right: 20px;" class="grid md:grid-cols-2 md:gap-6">
                                <input type="hidden" name="id" value="{{$professor->id}}">
                                <div class="relative z-0 w-full mb-5 group">
                                    <label class="text-gray-600">Nome:</label>
                                    <input required type="text" name="name" value="{{$professor->name}}" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                </div>
                                <div style="margin-left: 10px;" class="relative z-0 w-full mb-5 group">
                                    <label class="text-gray-600">Email:</label>
                                    <input required type="text" name="email" value="{{$professor->email}}" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                    <span id="emailError" style="color:red; display:none;">Email já existe!</span>
                                </div>
                            </div>
                            <div style="margin-left: 20px; margin-right: 20px; margin-top:20px" class="grid md:grid-cols-2 md:gap-6">
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600" for="gender">Gênero:</label>
                                        <select required class="block py-2.5 peer w-full text-gray-600 bg-gray-300 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2" id="gender" name="gender">
                                            <option>{{$professor->gender}}</option>
                                            <option value="Male">Masculino</option>
                                            <option value="Female">Feminino</option>
                                            <option value="Others">Outro</option>
                                        </select>
                                    </div>
                                    <div style="margin-left: 5px;" class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600">Nascimento:</label>
                                        <input required value="{{$professor->birthday}}" type="datetime" name="birthday" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                    </div>
                                </div>
                                <div style="margin-left: 15px;" class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600">RG:</label>
                                        <input required type="tel" name="rg" value="{{$professor->rg}}" minlength="10" maxlength="10" pattern="[0-9]+$" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                        <span id="rgError" style="color:red; display:none;">RG já existe!</span>
                                    </div>
                                    <div style="margin-left:10px;" class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600">CPF:</label>
                                        <input required type="tel" name="cpf" value="{{$professor->cpf}}" minlength="11" maxlength="11" pattern="[0-9]+$" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                        <span id="cpfError" style="color:red; display:none;">CPF já existe!</span>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-left: 20px; margin-right: 20px; margin-top:20px" class="grid md:grid-cols-2 md:gap-6">
                                <div class="grid md:grid-cols-2 md:gap-6">
                                    <div class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600" for="nationality">Nacionalidade:</label>
                                        <input value="{{$professor->nationality}}" type="text" name="nationality" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                    </div>
                                    <div style="margin-left: 5px;" class="relative z-0 w-full mb-5 group">
                                        <label class="text-gray-600">Estado Civil:</label>
                                        <select required class="block py-2.5 peer w-full text-gray-600 bg-gray-300 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2" id="martial_status" name="martial_status">
                                            <option>{{$professor->martial_status}}</option>
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
                                            <option>{{$professor->special_need}}</option>
                                            <option value="Nao">Não</option>
                                            <option value="Sim">Sim</option>
                                        </select>
                                    </div>
                                    <div style="margin-left: 10px;" class="grid md:grid-cols-2 md:gap-6">
                                        <div class="relative z-0 w-full mb-5 group">
                                            <label class="text-gray-600">Renda Familiar:</label>
                                            <input required value="{{$professor->family_income}}" min="0" type="number" name="family_income" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                        </div>
                                        <div style="margin-left:10px;" class="relative z-0 w-full mb-5 group">
                                            <label class="text-gray-600">Grupo Familiar:</label>
                                            <input required value="{{$professor->family_number}}" step="1" min="1" type="number" name="family_number" class="block py-2.5 peer w-full text-gray-600 bg-gray-300 p-2 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2">
                                        </div>
                                        <input hidden type="text" name="password" value="{{$professor->password}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sm:flex justify-center">
                            <button id="submitBtn" style="margin-top:30px; margin-bottom:15px" type="submit" class="bg-c-green text-white text-lg font-bold py-1 px-2 border rounded">
                                Atualizar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                const routes = {
                    email: @json(route('verificar.email')),
                    rg: @json(route('verificar.rg')),
                    cpf: @json(route('verificar.cpf'))
                };

                function checkField(fieldName, errorSpan, routeName) {
                    $('input[name="' + fieldName + '"]').on('keyup', function() {
                        var fieldValue = $(this).val();
                        var data = {
                            '_token': '{{ csrf_token() }}',
                            [fieldName]: fieldValue,
                            'id': $('input[name="id"]').val() // Adiciona o ID do usuário em todas as verificações
                        };

                        $.ajax({
                            url: routes[routeName],
                            method: 'POST',
                            data: data,
                            success: function(response) {
                                if (response.existe) {
                                    $('#' + errorSpan).show();
                                    $('#submitBtn').prop('disabled', true).addClass('disabled-btn');
                                } else {
                                    $('#' + errorSpan).hide();
                                    checkAllFields();
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });
                }

                checkField('email', 'emailError', 'email');
                checkField('rg', 'rgError', 'rg');
                checkField('cpf', 'cpfError', 'cpf');

                function checkAllFields() {
                    var emailValue = $('input[name="email"]').val();
                    var rgValue = $('input[name="rg"]').val();
                    var cpfValue = $('input[name="cpf"]').val();

                    $.when(
                        $.ajax({
                            url: routes.email,
                            method: 'POST',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'email': emailValue,
                                'id': $('input[name="id"]').val() // Adiciona o ID do usuário para a verificação de email
                            }
                        }),
                        $.ajax({
                            url: routes.rg,
                            method: 'POST',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'rg': rgValue,
                                'id': $('input[name="id"]').val() // Adiciona o ID do usuário para a verificação de RG
                            }
                        }),
                        $.ajax({
                            url: routes.cpf,
                            method: 'POST',
                            data: {
                                '_token': '{{ csrf_token() }}',
                                'cpf': cpfValue,
                                'id': $('input[name="id"]').val() // Adiciona o ID do usuário para a verificação de CPF
                            }
                        })
                    ).done(function(responseEmail, responseRG, responseCPF) {
                        if (!responseEmail[0].existe && !responseRG[0].existe && !responseCPF[0].existe) {
                            $('#submitBtn').prop('disabled', false).removeClass('disabled-btn');
                        }
                    });
                }
            });
        </script>
</x-app-layout>