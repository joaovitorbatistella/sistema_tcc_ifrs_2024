<x-app-layout>
    <x-slot:header>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <div class="flex justify-between items-center">
            <div class="flex-shrink-0">
                <h2 class="font-semibold text-xl text-black">
                    {{ __('Dashboard') }}
                </h2>
            </div>
            </x-slot>

            <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">

            <div class="flex justify-between items-center space-x-4" style="margin-left: 30px; margin-top: 15px; margin-right: 30px">
                <h2 class="titulo">
                    Últimos Anexos Enviados
                </h2>
                <button type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 rounded">
                    <a href="{{route('arquivos')}}">Ver Todos</a>
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

                .titulo {
                    font-weight: bold;
                    color: rgb(50, 50, 50);
                    border-bottom: 1px solid lightgray;
                }

                .file-content {
                    position: relative;
                    width: 100%;
                    height: 100%;
                }

                .calendar {
                    width: 100%;
                    max-width: 1000px;
                    height: 600px;
                    margin-left: 50px;
                    padding: 0;
                    box-sizing: border-box;
                }

                .calendar-container {
                    width: 100%;
                    padding: 0;
                    margin-left: 15px;
                    margin-top: 15px;
                    margin-bottom: 15px;
                    text-align: left;
                }

                .fc-col-header-cell {
                    background-color: #f0f0f0;
                    color: #333;
                    text-transform: uppercase;
                }

                .fc-event {
                    background-color: #007bff;
                    color: white;
                    border-radius: 4px;
                    text-transform: uppercase;
                }

                .fc-event:hover {
                    background-color: #0e4581;
                }

                .fc-header-toolbar {
                    background-color: #343a40;
                    color: white;
                    text-transform: uppercase;
                }

                .fc-button {
                    background-color: #ffffff;
                    color: #28a745;
                    border: 1px solid #28a745;
                    text-transform: uppercase;
                }

                .fc-button:hover {
                    background-color: #28a745;
                    color: #343a40;
                }

                .fc-toolbar-title {
                    font-weight: bold;
                    text-transform: uppercase;
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
                        Calendário
                    </h2>
                </div>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/locale/pt-br.min.js"></script>

                <div class="calendar-container">
                    <div class="calendar" id="calendar"></div>
                </div>

                <script>
                    $(document).ready(function() {
                        $('#calendar').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month,agendaWeek,agendaDay'
                            },
                            locale: 'pt-br',
                            editable: true,
                            droppable: true,
                            events: [{
                                    id: 1,
                                    title: 'Tarefa 1',
                                    start: '2024-08-05',
                                    end: '2024-08-09'
                                },
                                {
                                    id: 2,
                                    title: 'Tarefa 2',
                                    start: '2024-08-19',
                                    end: '2024-08-22'
                                }
                            ],
                            eventDrop: function(event) {
                                alert('Evento movido para: ' + event.start.format());
                            },
                            eventClick: function(event) {
                                alert('Evento: ' + event.title);
                            }
                        });
                    });

                    document.addEventListener('DOMContentLoaded', function() {
                        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
                                                <p>${new Date(file.updated_at).toLocaleString()}</p>
                                            </div>
                                        </div>
                                        `;
                                        container.appendChild(fileDiv);
                                    });
                                })
                                .catch(error => {
                                    console.error('Erro ao buscar arquivos recentes:', error);
                                });
                        }
                        updateRecentFiles();
                    });
                </script>
</x-app-layout>