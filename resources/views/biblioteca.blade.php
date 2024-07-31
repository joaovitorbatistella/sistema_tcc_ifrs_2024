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
                    <label>Filtrar por:</label>
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

        <div>
            <style>
                .table-container {
                    margin-top: 20px;
                    margin-left: 30px;
                    margin-right: 30px;
                    margin-bottom: 20px;
                    background-color: rgb(233, 233, 233);
                    border-radius: 15px;
                    overflow: hidden;
                }

                .thead {
                    font-size: 18px;
                }

                .table-cell {
                    padding: 12px;
                    border-bottom: 1px solid lightgray;
                }

                .table-row {
                    background-color: rgb(233, 233, 233);
                }

                .table-row:hover {
                    background-color: lightgray;
                }

                .titulo {
                    font-weight: bold;
                    color: rgb(50, 50, 50);
                    border-bottom: 1px solid lightgray;
                }

                .tbody {
                    display: table-row-group;
                    text-align: center;
                }


                .delete-icon {
                    color: red;
                    cursor: pointer;
                    vertical-align: middle;
                    text-align: center;
                }

                .download-icon {
                    color: blue;
                    cursor: pointer;
                    vertical-align: middle;
                    text-align: center;
                }
            </style>

            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div class="flex justify-between items-center space-x-4" style="margin-left: 30px; margin-top: 15px; margin-right: 30px">
                <h2 class="titulo">
                    Documentos Importantes
                </h2>
                <button id="openModalDocButton" type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 border border-red-600 rounded">
                    Adicionar Documento
                </button>
            </div>

            <!-- Modal Documento-->
            <div id="fileDocModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
                <div class="bg-white p-4 rounded shadow-lg">
                    <h3 class="text-lg font-bold mb-4">Adicionar Documento</h3>
                    <input type="file" id="fileDocInput" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-c-green file:text-white hover:file:bg-green-600">
                    <div class="flex justify-end mt-4 space-x-2">
                        <button id="closeModalDocButton" type="button" class="bg-red-600 text-white text-lg font-bold py-1 px-2 rounded" style="margin-right: 10px;">Fechar</button>
                        <button id="confirmDocButton" type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 rounded" style="margin-right: 10px;">Confirmar</button>
                    </div>
                </div>
            </div>

            <div class="table-container mt-6 px-6">
                <table class="w-full table-auto">
                    <thead class="thead">
                        <tr>
                            <th class="table-cell">Nome do Arquivo</th>
                            <th class="table-cell">Data de Modificação</th>
                            <th class="table-cell">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="tbody" id="filesTableBody">
                        <!-- Conteúdo será gerado pelo JavaScript -->
                    </tbody>
                </table>
            </div>

            <hr style="border: 2px solid rgb(215, 215, 215); border-radius: 5px; margin-left: 30px; margin-top: 30px; margin-right: 30px">

            <div class="flex justify-between items-center space-x-4" style="margin-left: 30px; margin-top: 15px; margin-right: 30px">
                <h2 class="titulo">
                    TCCs Antigos
                </h2>
                <button id="openModalTCCButton" type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 border border-red-600 rounded">
                    Adicionar TCC
                </button>
            </div>

            <!-- Modal TCC -->
            <div id="fileTCCModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
                <div class="bg-white p-4 rounded shadow-lg">
                    <h3 class="text-lg font-bold mb-4">Adicionar TCC</h3>
                    <input type="file" id="fileTCCInput" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-c-green file:text-white hover:file:bg-green-600">
                    <div class="flex justify-end mt-4 space-x-2">
                        <button id="closeModalTCCButton" type="button" class="bg-red-600 text-white text-lg font-bold py-1 px-2 rounded" style="margin-right: 10px;">Fechar</button>
                        <button id="confirmTCCButton" type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 rounded" style="margin-right: 10px;">Confirmar</button>
                    </div>
                </div>
            </div>

            <div class="table-container mt-6 px-6">
                <table class="w-full table-auto">
                    <thead class="thead">
                        <tr>
                            <th class="table-cell">Nome do Arquivo</th>
                            <th class="table-cell">Data de Modificação</th>
                            <th class="table-cell">Ação</th>
                        </tr>
                    </thead>
                    <tbody class="tbody" id="tccsTableBody">
                        <!-- Conteúdo será gerado pelo JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const openModalDocButton = document.getElementById('openModalDocButton');
                const openModalTCCButton = document.getElementById('openModalTCCButton');
                const closeModalDocButton = document.getElementById('closeModalDocButton');
                const closeModalTCCButton = document.getElementById('closeModalTCCButton');
                const confirmDocButton = document.getElementById('confirmDocButton');
                const confirmTCCButton = document.getElementById('confirmTCCButton');
                const fileDocModal = document.getElementById('fileDocModal');
                const fileTCCModal = document.getElementById('fileTCCModal');
                const fileDocInput = document.getElementById('fileDocInput');
                const fileTCCInput = document.getElementById('fileTCCInput');
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const openModal = (modal) => {
                    modal.classList.remove('hidden');
                };

                const closeModal = (modal) => {
                    modal.classList.add('hidden');
                };

                const updateTable = (tableId) => {
                    fetch('{{ route("files.list") }}')
                        .then(response => response.json())
                        .then(data => {
                            const tableBody = document.getElementById(tableId);
                            tableBody.innerHTML = '';

                            // Filtrar os arquivos de acordo com a tabela
                            const filteredData = data.filter(file => {
                                if (tableId === 'filesTableBody') {
                                    return file.type_id === 1; // Filtrar por type_id 1 para Documentos
                                } else if (tableId === 'tccsTableBody') {
                                    return file.type_id === 3; // Filtrar por type_id 3 para TCCs
                                }
                            });

                            filteredData.forEach(append => {
                                const row = document.createElement('tr');
                                row.classList.add('table-row', 'table-row-hover');
                                row.innerHTML = `
                                <td class="table-cell">${append.name}</td>
                                <td class="table-cell">${new Date(append.updated_at).toLocaleString()}</td>
                                <td class="table-cell">
                                    <button class="download-button" data-id="${append.append_id}">
                                        <span class="material-icons-outlined download-icon">file_download</span>
                                    </button>
                                    <button class="delete-button" data-id="${append.append_id}">
                                        <span class="material-icons-outlined delete-icon">delete</span>
                                    </button>
                                </td>                 `;
                                tableBody.appendChild(row);
                            });
                        });
                };


                openModalDocButton.addEventListener('click', () => openModal(fileDocModal));
                openModalTCCButton.addEventListener('click', () => openModal(fileTCCModal));

                closeModalDocButton.addEventListener('click', () => closeModal(fileDocModal));
                closeModalTCCButton.addEventListener('click', () => closeModal(fileTCCModal));

                confirmDocButton.addEventListener('click', () => {
                    const formData = new FormData();
                    formData.append('file', fileDocInput.files[0]);
                    formData.append('_token', csrfToken);
                    formData.append('type_id', 1); // type_id para Documentos

                    fetch('{{ route("upload.file") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                closeModal(fileDocModal);
                                updateTable('filesTableBody', 1);
                            } else {
                                alert('Erro ao fazer upload do arquivo.');
                            }
                        });
                });

                confirmTCCButton.addEventListener('click', () => {
                    const formData = new FormData();
                    formData.append('file', fileTCCInput.files[0]);
                    formData.append('_token', csrfToken);
                    formData.append('type_id', 3); // type_id para TCCs

                    fetch('{{ route("upload.file") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                closeModal(fileTCCModal);
                                updateTable('tccsTableBody', 3);
                            } else {
                                alert('Erro ao fazer upload do arquivo.');
                            }
                        });
                });

                // Função para excluir um arquivo
                const deleteFile = (fileId, tableId) => {
                    fetch(`/files/delete/${fileId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Content-Type': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert(data.message);
                                updateTable(tableId);
                            } else {
                                alert('Erro ao excluir o arquivo.');
                            }
                        })
                        .catch(error => {
                            console.error('Erro:', error);
                            alert('Erro ao excluir o arquivo.');
                        });
                };

                // Função para baixar um arquivo
                const downloadFile = (fileId) => {
                    window.location.href = `/download/${fileId}`;
                };

                // Adicionar um listener para os botões de exclusão e download
                document.getElementById('filesTableBody').addEventListener('click', function(event) {
                    if (event.target.classList.contains('delete-button') || event.target.classList.contains('delete-icon')) {
                        const fileId = event.target.closest('.delete-button').getAttribute('data-id');
                        deleteFile(fileId, 'filesTableBody');
                    } else if (event.target.classList.contains('download-button') || event.target.classList.contains('download-icon')) {
                        const fileId = event.target.closest('.download-button').getAttribute('data-id');
                        downloadFile(fileId);
                    }
                });

                document.getElementById('tccsTableBody').addEventListener('click', function(event) {
                    if (event.target.classList.contains('delete-button') || event.target.classList.contains('delete-icon')) {
                        const fileId = event.target.closest('.delete-button').getAttribute('data-id');
                        deleteFile(fileId, 'tccsTableBody');
                    } else if (event.target.classList.contains('download-button') || event.target.classList.contains('download-icon')) {
                        const fileId = event.target.closest('.download-button').getAttribute('data-id');
                        downloadFile(fileId);
                    }
                });

                // Inicializa as tabelas na carga da página
                updateTable('filesTableBody', 1); // 1 para Documentos
                updateTable('tccsTableBody', 3); // 3 para TCCs
            });
        </script>


</x-app-layout>