<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Criação de Turma') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="onboarding-container">
                        <div class="modal" id="cadastroModal" tabindex="-1" role="dialog" aria-labelledby="cadastroModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="cadastroModalLabel">Cadastro de Turmas</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div id="step1">
                                            <h3 class="text-lg font-semibold mb-4">Etapa 1</h3>
                                            <form id="formStep1" class="space-y-4">
                                                <div>
                                                    <label for="semestre" class="block text-sm font-medium text-gray-700">Escolha o Semestre:</label>
                                                    <select id="semestre" name="semestre" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                                        <option value="1">Primeiro</option>
                                                        <option value="2">Segundo</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="ano" class="block text-sm font-medium text-gray-700">Ano:</label>
                                                    <select id="ano" name="ano" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                                        @for ($i = 2000; $i <= 2100; $i++)
                                                            <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                                <div class="flex justify-end space-x-4 mt-4">
                                                    <button type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 border border-c-green rounded mt-4" onclick="nextStep(1)">Próximo</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="step2" style="display:none;">
                                            <h3 class="text-lg font-semibold mb-4">Etapa 2</h3>
                                            <form id="formStep2" class="space-y-4">
                                                <div>
                                                    <label for="alunos" class="block text-sm font-medium text-gray-700">Selecione os Alunos:</label>
                                                    <select id="alunos" name="alunos[]" multiple class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                                        <!-- Alunos serão carregados aqui via AJAX -->
                                                    </select>
                                                </div>
                                                <div class="flex justify-end space-x-4 mt-4">
                                                    <button type="button" class="bg-red-500 text-white text-lg font-bold py-1 px-2 border border-red-500 rounded mt-4" onclick="prevStep(2)">Voltar</button>
                                                    <button type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 border border-c-green rounded mt-4" onclick="nextStep(2)">Próximo</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="step3" style="display:none;">
                                            <h3 class="text-lg font-semibold mb-4">Etapa 3</h3>
                                            <div class="space-y-4">
                                                <form id="formStep3" class="space-y-4">
                                                    <div class="atividade space-y-4">
                                                        <div>
                                                            <label for="atividade_nome" class="block text-sm font-medium text-gray-700">Nome da Atividade:</label>
                                                            <input type="text" id="atividade_nome" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                                        </div>
                                                        <div>
                                                            <label for="atividade_descricao" class="block text-sm font-medium text-gray-700">Descrição:</label>
                                                            <textarea id="atividade_descricao" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                                                        </div>
                                                        <div>
                                                            <label for="atividade_prazo" class="block text-sm font-medium text-gray-700">Prazo:</label>
                                                            <input type="datetime-local" id="atividade_prazo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                                                        </div>
                                                        <div>
                                                            <label for="atividade_arquivo" class="block text-sm font-medium text-gray-700">Arquivo:</label>
                                                            <input type="file" id="atividade_arquivo" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                        </div>
                                                    </div>
                                                </form>
                                                <button type="button" id="addActivity" class="bg-gray-500 text-white text-lg font-bold py-1 px-2 border border-gray-500 rounded mt-4" onclick="adicionarAtividade()">Adicionar Atividade</button>
                                                <button type="button" id="addImport" class="bg-gray-500 text-white text-lg font-bold py-1 px-2 border border-gray-500 rounded mt-4" onclick="importTemplate()">Importar template</button>
                                                <div class="flex justify-end space-x-4 mt-4">
                                                    <button type="button" class="bg-red-500 text-white text-lg font-bold py-1 px-2 border border-red-500 rounded" onclick="prevStep(3)">Voltar</button>
                                                    <button type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 border border-c-green rounded" onclick="submitForm()">Finalizar</button>
                                                </div>

                                                <div id="myModal" class="custom-modal">

                                                    <!-- Modal content -->
                                                    <div class="custom-modal-content">
                                                        <span onclick="closeTemplateSelector()" class="custom-close">&times;</span>
                                                        <div id="templates" class="modal-body template-box">
                                                        
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div id="listaAtividades" class="mt-4 space-y-4">
                                                <!-- Lista de atividades será renderizada aqui -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <meta name="csrf-token" content="{{ csrf_token() }}">

                        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
                        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js"></script>
                        <script>
                            $(document).ready(function(){
                                $('#cadastroModal').modal('show');

                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                            });

                            var formData = {
                                semestre: '',
                                ano: '',
                                alunos: [],
                                atividades: [],
                                template: null
                            };

                            function nextStep(step) {
                                // Capturar os dados do formulário da etapa atual e adicionar ao formData
                                if (step === 1) {
                                    formData.semestre = $('#semestre').val();
                                    formData.ano = $('#ano').val();
                                } else if (step === 2) {
                                    formData.alunos = $('#alunos').val();
                                }

                                $.post('/turmas/cadastro/step' + step, formData, function(response) {
                                    if (response.status === 'success') {
                                        $('#step' + step).hide();
                                        if (response.next !== 'finished') {
                                            $('#step' + (step + 1)).show();
                                            if (step === 1) {
                                                loadAlunos();
                                            }
                                        } else {
                                            $('#cadastroModal').modal('hide');
                                            alert('Cadastro concluído!');
                                        }
                                    } else {
                                        alert('Erro ao processar a etapa ' + step);
                                    }
                                }).fail(function() {
                                    alert('Erro ao processar a etapa ' + step);
                                });
                            }

                            function prevStep(step) {
                                if(step === 3) {
                                    var listaAtividadesDiv = document.getElementById('listaAtividades');
                                    listaAtividadesDiv.innerHTML = '';

                                    document.getElementById("formStep3").hidden = false;
                                    document.getElementById("addActivity").hidden = false;
                                    document.getElementById("addImport").hidden = false;

                                    formData.template = null
                                }
                                
                                $('#step' + step).hide();
                                $('#step' + (step - 1)).show();
                            }

                            function loadAlunos() {
                                $.get('/api/alunos/list', function(data) {
                                    console.log('data', data)
                                    if (data.success) {
                                        var alunosSelect = $('#alunos');
                                        alunosSelect.empty();
                                        data.data.forEach(function(aluno) {
                                            alunosSelect.append(new Option(aluno.name, aluno.id));
                                        });
                                    } else {
                                        alert('Erro ao carregar alunos');
                                    }
                                }).fail(function() {
                                    alert('Erro ao carregar alunos');
                                });
                            }

                            function closeTemplateSelector() {
                                var modal = document.getElementById("myModal");

                                var btn = document.getElementById("myBtn");

                                var span = document.getElementsByClassName("custom-close")[0];

                                modal.style.display = "none";
                            }

                            function getTemplates() {
                                return new Promise((resolve, reject) => {
                                    $.get('/api/templates/list', function(data) {
                                        if (data.success) {
                                            resolve(data)
                                        } else {
                                            alert('Erro ao carregar templates');
                                            reject();
                                        }
                                    }).fail(function() {
                                        alert('Erro ao carregar templates');
                                        reject();
                                    });
                                })
                            }

                            function selectTemplate(template_uid, name) {
                                formData.template = template_uid

                                var listaAtividadesDiv = document.getElementById('listaAtividades');
                                listaAtividadesDiv.innerHTML = '';

                                document.getElementById("formStep3").hidden = true;
                                document.getElementById("addActivity").hidden = true;
                                document.getElementById("addImport").hidden = true;

                                var atividadeDiv = document.createElement('div');
                                    atividadeDiv.classList.add('atividade', 'border', 'p-4', 'rounded', 'shadow-sm');
                                    atividadeDiv.innerHTML = `
                                        <div class="flex justify-between">
                                            <div>
                                                <p><strong>Template:</strong> ${name}</p>
                                            </div>
                                        </div>
                                    `;

                                listaAtividadesDiv.appendChild(atividadeDiv);

                                closeTemplateSelector()
                            }
                            
                            async function importTemplate() {
                                
                                const { data } = await getTemplates();

                                var templatesModal = document.getElementById("templates");
                                console.log('data', data)

                                templatesModal.innerHTML ='';

                                data.forEach((template) => {
                                    var templateDiv = document.createElement('div');
                                    templateDiv.classList.add('template-item');
                                    templateDiv.innerHTML = `
                                        <a onclick="selectTemplate('${template.class_template_uid}', '${template.name}')">
                                            <img 
                                                src="{{ asset('storage/assets/images/file-icon.png')  }}"
                                            >
                                        </a>
                                        <div class="desc"">${template.name}</div>
                                    `;
                                    templatesModal.appendChild(templateDiv);
                                });

                                // Get the modal
                                var modal = document.getElementById("myModal");

                                // Get the button that opens the modal
                                var btn = document.getElementById("myBtn");

                                // Get the <span> element that closes the modal
                                var span = document.getElementsByClassName("custom-close")[0];

                                // When the user clicks on the button, open the modal
                                modal.style.display = "block";

                                // When the user clicks on <span> (x), close the modal
                                // modal.style.display = "none";

                                // When the user clicks anywhere outside of the modal, close it
                                // window.onclick = function(event) {
                                //     if (event.target == modal) {
                                //         modal.style.display = "none";
                                //     }
                                // }
                            }

                            var atividadeCount = 1;
                            var atividades = [];

                            function adicionarAtividade() {
                                var nome = document.getElementById('atividade_nome').value;
                                var descricao = document.getElementById('atividade_descricao').value;
                                var prazo = document.getElementById('atividade_prazo').value;
                                var arquivo = document.getElementById('atividade_arquivo').files[0];

                                if (nome && descricao && prazo && arquivo) {
                                    var atividade = {
                                        id: atividadeCount,
                                        name: nome,
                                        description: descricao,
                                        due_at: prazo,
                                        files: [arquivo]
                                    };
                                    atividades.push(atividade);
                                    renderListaAtividades();
                                    atividadeCount++;

                                    // Limpar os campos do formulário, exceto o arquivo
                                    document.getElementById('atividade_nome').value = '';
                                    document.getElementById('atividade_descricao').value = '';
                                    document.getElementById('atividade_prazo').value = '';
                                    document.getElementById('atividade_arquivo').value = null;
                                } else {
                                    alert('Preencha todos os campos da atividade, incluindo o arquivo');
                                }
                            }

                            function renderListaAtividades() {
                                var listaAtividadesDiv = document.getElementById('listaAtividades');
                                listaAtividadesDiv.innerHTML = '';

                                atividades.forEach(function(atividade) {
                                    var prazoDate = new Date(atividade.due_at.replace('T', ' '));
                                    var prazoFormatado = prazoDate.toLocaleDateString('pt-BR', { 
                                        year: 'numeric', 
                                        month: '2-digit', 
                                        day: '2-digit', 
                                        hour: '2-digit', 
                                        minute: '2-digit' 
                                    });

                                    prazoFormatado =prazoFormatado.replace(',', ' às');

                                    var atividadeDiv = document.createElement('div');
                                    atividadeDiv.classList.add('atividade', 'border', 'p-4', 'rounded', 'shadow-sm');
                                    atividadeDiv.innerHTML = `
                                        <div class="flex justify-between">
                                            <div>
                                                <p><strong>Nome:</strong> ${atividade.name}</p>
                                                <p><strong>Prazo:</strong> ${prazoFormatado}</p>
                                                <p><strong>Arquivo:</strong> ${atividade.files[0].name}</p>
                                            </div>
                                            <div class="space-x-2">
                                                <button style="color:orange" type="button" class="text-gray-500 hover:text-gray-900" onclick="editarAtividade(${atividade.id})">
                                                    <i class="material-icons-outlined text-orange-500 text-base">edit</i>
                                                </button>
                                                <button type="button" class="text-gray-500 hover:text-gray-900" onclick="excluirAtividade(${atividade.id})">
                                                    <svg class="text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                        <path stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.4" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    `;
                                    listaAtividadesDiv.appendChild(atividadeDiv);
                                });
                            }

                            function editarAtividade(id) {
                                var atividade = atividades.find(function(atividade) {
                                    return atividade.id === id;
                                });

                                if (atividade) {
                                    document.getElementById('atividade_nome').value = atividade.name;
                                    document.getElementById('atividade_descricao').value = atividade.description;
                                    document.getElementById('atividade_prazo').value = atividade.due_at;
                                    document.getElementById('atividade_arquivo').value = null; // Limpar o arquivo selecionado
                                    excluirAtividade(id); // Remove a atividade da lista para ser adicionada novamente após edição
                                }
                            }

                            function excluirAtividade(id) {
                                atividades = atividades.filter(function(atividade) {
                                    return atividade.id !== id;
                                });
                                renderListaAtividades();
                            }

                            function submitForm() {
                                formData.activities = atividades;

                                console.log(formData);

                                // Criar um objeto FormData para enviar os arquivos
                                var formToSubmit = new FormData();
                                formToSubmit.append('semester', formData.semestre);
                                formToSubmit.append('year', formData.ano);
                                if(formData.template) {
                                    formToSubmit.append('template', formData.template);
                                }
                                formData.alunos.forEach(function(aluno, index) {
                                    formToSubmit.append('students[]', aluno);
                                });
                                formData.activities.forEach(function(atividade, index) {
                                    formToSubmit.append('activities[' + index + '][name]', atividade.name);
                                    formToSubmit.append('activities[' + index + '][description]', atividade.description);
                                    formToSubmit.append('activities[' + index + '][due_at]', atividade.due_at);
                                    atividade.files.forEach((file, fileIndex) => {
                                        formToSubmit.append('activities[' + index + '][files]['+ fileIndex +']', file);                                        
                                    });
                                });

                                $.ajax({
                                    url: '/classes/create',
                                    type: 'POST',
                                    data: formToSubmit,
                                    contentType: false,
                                    processData: false,
                                    success: function(response) {
                                        if (response.success) {
                                            alert('Turma criada com sucesso');
                                            location.reload();
                                        } else {
                                            alert('Erro ao criar turma');
                                        }
                                    },
                                    error: function() {
                                        alert('Erro ao criar turma');
                                    }
                                });
                            }
                        </script>
                        <style>
                            .custom-modal {
                                display: none; /* Hidden by default */
                                position: fixed; /* Stay in place */
                                z-index: 9999; /* Sit on top */
                                left: 0;
                                top: 0;
                                width: 100%; /* Full width */
                                height: 100%; /* Full height */
                                overflow: auto; /* Enable scroll if needed */
                                background-color: rgb(0,0,0); /* Fallback color */
                                background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
                            }

                            /* Modal Content/Box */
                            .custom-modal-content {
                                background-color: #fefefe;
                                margin: 15% auto; /* 15% from the top and centered */
                                padding: 20px;
                                border: 1px solid #888;
                                width: 80%; /* Could be more or less, depending on screen size */
                            }

                            /* The Close Button */
                            .custom-close {
                                color: #aaa;
                                float: right;
                                font-size: 28px;
                                font-weight: bold;
                            }

                            .custom-close:hover,
                            .custom-close:focus {
                                color: black;
                                text-decoration: none;
                                cursor: pointer;
                            }

                            div.gallery {
                                margin: 5px;
                                border: 1px solid #ccc;
                                float: left;
                                width: 180px;
                            }

                            div.gallery:hover {
                                border: 1px solid #777;
                            }

                            div.gallery img {
                                width: 100%;
                                height: auto;
                            }

                            div.desc {
                                padding: 15px;
                                text-align: center;
                            }

                            .template-box {
                                display: flex;

                            }

                            .template-item {
                                display: flex;
                                flex-direction: column;
                                justify-content: center !important;
                                align-items: center !important;
                                cursor: pointer;
                            }
                        </style>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>