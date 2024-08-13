<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detalhes da Atividade') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <!-- Nome da Atividade e Botões -->
                    <div class="flex justify-between items-center mb-6">
                        <div class="text-2xl font-bold">
                            {{ $activity->name }}
                        </div>
                        <div>
                            <button id="advanceButton" onclick="openModal('advanceModal')">
                                Avançar
                            </button>
                            <button id="returnButton" onclick="openModal('returnModal')" class="ml-2">
                                Devolver
                            </button>
                        </div>
                    </div>
                    
                    <!-- Linha do Tempo -->
                    <div class="relative timeline-wrapper">
                        <div class="flex items-center justify-between">
                            @foreach($activity->steps as $index => $step)
                                <div class="timeline-step {{ $step->completed ? 'completed-step' : 'incomplete-step' }}">
                                    {{ $index + 1 }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Detalhes da Atividade -->
                    <div class="mt-6 text-gray-500">
                        <p><strong>Data de Entrega:</strong> {{ $activity->due_at}}</p>
                        <p class="mt-4">{{ $activity->description }}</p>
                    </div>

                    <!-- Tabela de Arquivos Anexados -->
                    <div class="mt-8 overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 table-attachments">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descrição</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Comentários</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($activity->attachments as $attachment)
                                    <tr class="cursor-pointer" onclick="openAttachmentModal('{{ $attachment->id }}')">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $attachment->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $attachment->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Modal de Avançar -->
<div id="advanceModal" class="fixed z-10 inset-0 overflow-y-auto hidden modal">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
            <div class="modal-header">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Avançar Atividade</h3>
                <button type="button" onclick="closeModal('advanceModal')" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="advanceForm" action="{{ route('activities.advance', ['id' => $actualStep]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="file" class="block text-sm font-medium text-gray-700">Adicionar Arquivo</label>
                        <input type="file" name="file" id="file" class="mt-1 block w-full">
                    </div>
                    <div class="mt-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700">Parecer</label>
                        <textarea name="comment" id="comment" rows="3" class="mt-1 block w-full"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('advanceModal')" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:text-sm">
                    Cancelar
                </button>
                <button type="submit" form="advanceForm" class="ml-3 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-700 sm:text-sm">
                    Concluir
                </button>
            </div>
        </div>
    </div>
</div>

    <!-- Modal de Devolver -->
    <div id="returnModal" class="fixed z-10 inset-0 overflow-y-auto hidden modal">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
                <div class="modal-header">
                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Devolver Atividade</h3>
                    <button type="button" onclick="closeModal('returnModal')" class="text-gray-400 hover:text-gray-500">
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('activities.return', ['id' => $activity->user_class_activity_id]) }}" method="POST">
                        @csrf
                        <div class="mt-4">
                            <label for="comment" class="block text-sm font-medium text-gray-700">Parecer</label>
                            <textarea name="comment" id="comment" rows="3" class="mt-1 block w-full"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeModal('returnModal')" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:text-sm">
                        Cancelar
                    </button>
                    <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-700 sm:text-sm">
                        Concluir
                    </button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal de Anexo -->
<div id="attachmentModal" class="fixed z-10 inset-0 overflow-y-auto hidden modal">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity" aria-hidden="true">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full modal-content">
            <div class="modal-header">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="attachmentName"></h3>
                <button type="button" onclick="closeModal('attachmentModal')" class="text-gray-400 hover:text-gray-500">
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <h4 class="text-sm font-medium text-gray-900 mb-2">Histórico de Versões</h4>
                <div class="overflow-x-auto">
                    <table id="attachmentVersionsTable" class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome do Arquivo</th>
                                <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <!-- Linhas das versões serão inseridas aqui via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal('attachmentModal')" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 sm:text-sm">
                    Fechar
                </button>
            </div>
        </div>
    </div>
</div>



<script>
    function openAttachmentModal(attachmentId) {
    console.log('Tentando abrir o modal de anexo com ID:', attachmentId);
    let attachment = @json($activity->attachments).find(att => att.id == attachmentId);

    if (attachment) {
        console.log('Anexo encontrado:', attachment);

        document.getElementById('attachmentName').innerText = attachment.name;

        let versionsTableBody = document.querySelector('#attachmentVersionsTable tbody');
        versionsTableBody.innerHTML = ''; // Limpa a tabela

        attachment.versions.forEach(version => {
            let row = document.createElement('tr');
            row.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">${version.name}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right">${version.date}</td>
            `;
            versionsTableBody.appendChild(row);
        });

        let commentsSection = document.getElementById('attachmentComments');
        commentsSection.innerHTML = ''; // Limpa os comentários existentes

        if (Array.isArray(attachment.comments)) {
            attachment.comments.forEach(comment => {
                let commentDiv = document.createElement('div');
                commentDiv.classList.add('mt-2', 'p-2', 'bg-gray-100', 'rounded');
                commentDiv.innerText = comment;
                commentsSection.appendChild(commentDiv);
            });
        } else {
            console.log('Comentários não são um array:', attachment.comments);
        }

        openModal('attachmentModal');
    } else {
        console.log('Anexo não encontrado.');
    }
}


    function openModal(modalId) {
        console.log('Abrindo modal:', modalId);
        document.getElementById(modalId).classList.remove('hidden');
    }

    function closeModal(modalId) {
        console.log('Fechando modal:', modalId);
        document.getElementById(modalId).classList.add('hidden');
    }

    function addComment() {
        let newComment = document.getElementById('newComment').value;
        if (newComment) {
            let commentsSection = document.getElementById('attachmentComments');
            let commentDiv = document.createElement('div');
            commentDiv.classList.add('mt-2', 'p-2', 'bg-gray-100', 'rounded');
            commentDiv.innerText = newComment;
            commentsSection.appendChild(commentDiv);

            document.getElementById('newComment').value = ''; // Limpa o campo de comentário
        }
    }
</script>


    <!-- Estilos -->
    <style>
        #advanceButton, #returnButton {
            background-color: #f3f3f3;
            border: 1px solid #ccc;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }

        #advanceButton {
            background-color: #000000; /* Preto para avançar */
            color: white;
        }

        #returnButton {
            background-color: #ffffff; /* Branco para devolver */
            color: black;
            border: 1px solid #000000; /* Borda preta para o botão branco */
        }

        #advanceButton:hover {
            background-color: #333333;
        }

        #returnButton:hover {
            background-color: #f0f0f0;
        }

        .timeline-wrapper {
            position: relative;
            width: 100%;
        }

        .timeline-step {
            width: 30px; /* Diminuindo o tamanho dos quadrados */
            height: 30px; /* Diminuindo o tamanho dos quadrados */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 6px; /* Ajustando o arredondamento */
            font-size: 14px; /* Ajustando o tamanho da fonte */
            font-weight: bold;
            position: relative;
            z-index: 10; /* Garantindo que fique acima da linha */
        }

        .completed-step {
            background-color: #000000; /* Preto para concluído */
            color: white;
        }

        .incomplete-step {
            background-color: #ffffff; /* Branco para incompleto */
            color: black;
            border: 1px solid #000000; /* Borda preta para o quadrado branco */
        }

        /* Linha entre os quadrados */
        .timeline-wrapper::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #000; /* Cor preta */
            z-index: 5; /* Garantindo que fique atrás dos quadrados */
            transform: translateY(-50%);
        }

        .table-attachments {
            background-color: #f9f9f9; /* Cor de fundo mais destacada */
            border: 2px solid #ccc; /* Borda ao redor da tabela */
        }

        .table-attachments thead {
            background-color: #e0e0e0; /* Cor de fundo do cabeçalho */
        }

        .table-attachments tbody tr {
            background-color: #ffffff; /* Cor de fundo das linhas */
        }

        .table-attachments tbody tr:hover {
            background-color: #f1f1f1; /* Cor de fundo ao passar o mouse sobre as linhas */
        }

        .table-attachments th, .table-attachments td {
            padding: 12px;
            text-align: left;
        }

        .mt-8 {
            margin-top: 2rem; /* Aumentando a margem superior da tabela */
        }

        /* Modal de Avançar, Devolver e Anexo */
        .modal {
        }

        .modal-content {
            padding: 1rem; /* Ajustar o espaçamento interno */
            border-radius: 0.5rem; /* Ajustar o arredondamento dos cantos */
            background-color: #fff; /* Cor de fundo */
            box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1), 0 4px 6px rgba(0, 0, 0, 0.1); /* Sombras para um efeito de profundidade */
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0; /* Linha de separação */
            padding-bottom: 0.5rem;
        }

        .modal-body .overflow-x-auto {
            width: 100%; /* Garante que a tabela ocupe todo o espaço disponível */
        }

        #attachmentVersionsTable {
            width: 100%; /* Garante que a tabela ocupe todo o espaço disponível */
            table-layout: auto; /* Permite que as colunas se ajustem automaticamente */
        }

        #attachmentVersionsTable th, #attachmentVersionsTable td {
            padding: 12px; /* Espaçamento interno para células */
            text-align: left; /* Alinha todo o conteúdo à esquerda */
        }

        #attachmentVersionsTable th {
            background-color: #e0e0e0; /* Cor de fundo do cabeçalho */
        }


        #attachmentVersionsTable td.text-left {
            text-align: left; /* Alinha a coluna de data à direita */
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            padding-top: 0.5rem;
            border-top: 1px solid #e2e8f0; /* Linha de separação */
        }

    </style>
</x-app-layout>
