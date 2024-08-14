<x-app-layout>
    <x-slot:header>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <div class="flex justify-between items-center">
            <div class="flex-shrink-0">
                <h2 class="font-semibold text-xl text-black">
                    {{ __('Meus Arquivos') }}
                </h2>
            </div>
            <div class="flex items-center space-x-4">
                <form action="{{ route('files.search') }}" method="GET">
                    <div>
                        <div class="relative">
                            <input type="text" name="search" size="20" class="peer w-full text-gray-600 bg-gray-300 p-2 pl-10 pr-10 rounded shadow-sm border border-gray-300 focus:outline-none focus:bg-white mt-2 mb-2" placeholder="Buscar">
                            <i class="material-icons absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400" style="top: 20px; right: 5px;">
                                search
                            </i>
                        </div>
                    </div>
                </form>
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
            </x-slot>

            <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />

            <div class="flex justify-between items-center space-x-4" style="margin-left: 30px; margin-top: 15px; margin-right: 30px">
                <h2 class="titulo">
                    Recentes
                </h2>
                <button id="openModalButton" type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 border border-red-600 rounded">
                    Adicionar Documento
                </button>
            </div>

            <style>
                .file-container {
                    display: flex;
                    flex-wrap: wrap;
                    gap: 16px;
                    margin-left: 30px;
                    margin-top: 30px;
                }

                .file-box {
                    position: relative;
                    width: 200px;
                    height: 200px;
                    border: 1px solid #ddd;
                    border-radius: 8px;
                    padding: 16px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    text-align: center;
                    background: #f9f9f9;
                    margin-bottom: 16px;
                }

                .file-box p {
                    margin: 0;
                    font-size: 14px;
                    color: #333;
                }

                .image {
                    position: relative;
                    width: 200px;
                    height: 200px;
                    border-radius: 8px;
                    padding: 16px;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    align-items: center;
                    text-align: center;
                }

                .image img {
                    max-width: 100%;
                    max-height: 100%;
                    object-fit: contain;
                }

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

                .file-content {
                    position: relative;
                    width: 100%;
                    height: 100%;
                }

                .options-menu {
                    position: absolute;
                    top: 8px;
                    right: 8px;
                    display: flex;
                    flex-direction: column;
                    align-items: flex-end;
                }

                .options-button {
                    background: none;
                    border: none;
                    cursor: pointer;
                    color: #555;
                    font-size: 24px;
                }

                .options-dropdown {
                    position: absolute;
                    top: 30px;
                    right: 0;
                    background: white;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
                    display: flex;
                    flex-direction: column;
                    gap: 8px;
                    padding: 8px;
                    z-index: 1000;
                    min-width: 120px;
                }

                .options-dropdown button {
                    background: none;
                    border: none;
                    cursor: pointer;
                    color: #555;
                    padding: 8px;
                    text-align: left;
                    width: 100%;
                }

                .options-dropdown button:hover {
                    background: #f0f0f0;
                }

                .options.hidden {
                    display: none;
                }
            </style>

            <div class="container">

                <meta name="csrf-token" content="{{ csrf_token() }}">

                <div id="recent-files" class="file-container" style="margin-left: 30px; margin-top: 30px;">
                    <!-- Arquivos recentes serão inseridos aqui -->
                </div>

                <hr style="border: 2px solid rgb(215, 215, 215); border-radius: 5px; margin-left: 30px; margin-top: 30px; margin-right: 30px">

                <div class="flex justify-between items-center space-x-4" style="margin-left: 30px; margin-top: 15px; margin-right: 30px">
                    <h2 class="titulo">
                        Meus Arquivos
                    </h2>
                </div>

                <div class="table-container mt-6 px-6">
                    <table class="w-full table-auto">
                        <thead class="thead">
                            <tr>
                                <th class="table-cell">Nome do Arquivo</th>
                                <th class="table-cell">Tipo de Arquivo</th>
                                <th class="table-cell">Data de Modificação</th>
                                <th class="table-cell">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="tbody" id="filesTableBody">
                            <!-- Conteúdo será gerado pelo JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- Modal Arquivo-->
                <div id="fileModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center hidden">
                    <div class="bg-white p-4 rounded shadow-lg">
                        <h3 class="text-lg font-bold mb-4">Adicionar Arquivo</h3>
                        <input type="file" id="fileInput" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-c-green file:text-white hover:file:bg-green-600">
                        <div class="flex justify-end mt-4 space-x-2">
                            <button id="closeModalButton" type="button" class="bg-red-600 text-white text-lg font-bold py-1 px-2 rounded" style="margin-right: 10px;">Fechar</button>
                            <button id="confirmButton" type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 rounded" style="margin-right: 10px;">Confirmar</button>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const openModalButton = document.getElementById('openModalButton');
                        const closeModalButton = document.getElementById('closeModalButton');
                        const confirmButton = document.getElementById('confirmButton');
                        const fileModal = document.getElementById('fileModal');
                        const fileInput = document.getElementById('fileInput');
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        const searchInput = document.querySelector('input[name="search"]');
                        const orderBySelect = document.getElementById('order_by');

                        const openModal = (modal) => {
                            modal.classList.remove('hidden');
                        };

                        const closeModal = (modal) => {
                            modal.classList.add('hidden');
                        };

                        function getFileTypeString(typeId) {
                            switch (typeId) {
                                case 1:
                                    return 'Documento';
                                case 2:
                                    return 'Imagem';
                                case 3:
                                    return 'TCC';
                                default:
                                    return 'Desconhecido';
                            }
                        }

                        const updateTable = (tableId, searchQuery = '', typeId = null, orderBy = 'name') => {
                            fetch(`{{ route('files.search') }}?search=${encodeURIComponent(searchQuery)}${typeId ? `&type_id=${typeId}` : ''}&order_by=${orderBy}`)
                                .then(response => response.json())
                                .then(data => {
                                    const tableBody = document.getElementById(tableId);
                                    tableBody.innerHTML = '';

                                    data.forEach(file => {
                                        const row = document.createElement('tr');
                                        row.classList.add('table-row');
                                        row.innerHTML = `
                                            <td class="table-cell">${file.name}</td>
                                            <td class="table-cell">${getFileTypeString(file.type_id)}</td>
                                            <td class="table-cell">${new Date(file.updated_at).toLocaleString()}</td>
                                            <td class="table-cell">
                                                <button class="download-button" data-id="${file.append_id}">
                                                    <span class="material-icons-outlined download-icon">file_download</span>
                                                </button>
                                                <button class="delete-button" data-id="${file.append_id}">
                                                    <span class="material-icons-outlined delete-icon">delete</span>
                                                </button>
                                            </td>
                                        `;
                                        tableBody.appendChild(row);
                                    });
                                })
                                .catch(error => {
                                    console.error('Erro ao buscar arquivos:', error);
                                });
                        };

                        function updateRecentFiles(typeId = null) {
                            fetch('{{ route("recent.files") }}')
                                .then(response => response.json())
                                .then(files => {
                                    const container = document.getElementById('recent-files');
                                    container.innerHTML = '';

                                    files.forEach(file => {
                                        const fileDiv = document.createElement('div');
                                        fileDiv.className = 'image';
                                        fileDiv.style.marginLeft = '30px';

                                        let icon;
                                        switch (file.type_id) {
                                            case 1: // doc
                                                icon = 'insert_drive_file';
                                                break;
                                            case 2: // img
                                                icon = 'image';
                                                break;
                                            case 3: // tcc
                                                icon = 'contact_page';
                                                break;
                                            default:
                                                icon = 'file_present';
                                                break;
                                        }

                                        fileDiv.innerHTML = `
                                            <div class="file-box">
                                                <div class="file-content">
                                                    <i class="material-icons" style="font-size: 64px; color: #555;">
                                                        ${icon}
                                                    </i>
                                                    <p>${file.name}</p>
                                                    <div class="options-menu">
                                                        <button class="options-button">
                                                            <span class="material-icons">more_vert</span>
                                                        </button>
                                                        <div class="options-dropdown options hidden">
                                                            <button class="download-button" data-id="${file.append_id}">
                                                                Download
                                                            </button>
                                                            <button class="delete-button" data-id="${file.append_id}">
                                                                Excluir
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `;

                                        container.appendChild(fileDiv);
                                    });
                                    // Adiciona event listeners para os botões
                                    document.querySelectorAll('.options-button').forEach(button => {
                                        button.addEventListener('click', (event) => {
                                            const dropdown = button.nextElementSibling;
                                            dropdown.classList.toggle('hidden');
                                        });
                                    });

                                    document.querySelectorAll('.download-button').forEach(button => {
                                        button.addEventListener('click', () => {
                                            const fileId = button.getAttribute('data-id');
                                            window.location.href = `/download/${fileId}`;
                                        });
                                    });

                                    document.querySelectorAll('.delete-button').forEach(button => {
                                        button.addEventListener('click', () => {
                                            const fileId = button.getAttribute('data-id');
                                            deleteFile(fileId);
                                        });
                                    });
                                })
                                .catch(error => {
                                    console.error('Erro ao buscar arquivos recentes:', error);
                                });
                        }

                        openModalButton.addEventListener('click', () => openModal(fileModal));
                        closeModalButton.addEventListener('click', () => closeModal(fileModal));

                        confirmButton.addEventListener('click', () => {
                            const formData = new FormData();
                            formData.append('file', fileInput.files[0]);
                            formData.append('_token', csrfToken);
                            formData.append('type_id', 1);

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
                                        closeModal(fileModal);
                                        updateTable('filesTableBody', '', '', 'name');
                                        updateRecentFiles();
                                    } else {
                                        alert('Erro ao fazer upload do arquivo.');
                                    }
                                });
                        });

                        searchInput.addEventListener('input', () => {
                            const searchQuery = searchInput.value;
                            const orderBy = orderBySelect.value;
                            updateTable('filesTableBody', searchQuery, '', orderBy);
                            updateRecentFiles();
                        });

                        orderBySelect.addEventListener('change', () => {
                            const searchQuery = searchInput.value;
                            const orderBy = orderBySelect.value;
                            updateTable('filesTableBody', searchQuery, '', orderBy);
                            updateRecentFiles();
                        });

                        const deleteFile = (fileId) => {
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
                                        updateTable('filesTableBody', '', '', 'name');
                                        updateRecentFiles();
                                    } else {
                                        alert('Erro ao excluir o arquivo.');
                                    }
                                })
                                .catch(error => {
                                    console.error('Erro:', error);
                                    alert('Erro ao excluir o arquivo.');
                                });
                        };

                        const downloadFile = (fileId) => {
                            window.location.href = `/download/${fileId}`;
                        };

                        document.getElementById('filesTableBody').addEventListener('click', function(event) {
                            if (event.target.classList.contains('delete-button') || event.target.classList.contains('delete-icon')) {
                                const fileId = event.target.closest('.delete-button').getAttribute('data-id');
                                deleteFile(fileId);
                            } else if (event.target.classList.contains('download-button') || event.target.classList.contains('download-icon')) {
                                const fileId = event.target.closest('.download-button').getAttribute('data-id');
                                downloadFile(fileId);
                            }
                        });

                        updateTable('filesTableBody', '', '', 'name');
                        updateRecentFiles();

                    });
                </script>
</x-app-layout>