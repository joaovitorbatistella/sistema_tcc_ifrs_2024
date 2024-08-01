<x-app-layout>
    <x-slot:header>
        <div class="flex justify-between items-center">
            <div class="flex-shrink-0">
                <h2 class="font-semibold text-xl text-black">
                    {{ __('Dashboard') }}
                </h2>
            </div>
        </div>
        </x-slot>

        <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />

        <style>
            .dashboard {
                display: flex;
                flex-wrap: wrap;
                gap: 20px;
                justify-content: space-between;
                margin-top: 30px;
                margin-bottom: 30px;
                margin-left: 30px;
                margin-right: 30px;
            }

            .shortcut {
                font-size: x-large;
                font-weight: bold;
                color: rgb(50, 50, 50);
                display: flex;
                justify-content: center;
                align-items: normal;
                text-align: center;
                border-radius: 10px;
                text-decoration: none;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                transition: background-color 0.3s, box-shadow 0.3s;
                position: relative;
            }

            .shortcut.atividades {
                width: 400px;
                height: 400px;
                background: linear-gradient(180deg, rgb(220, 180, 180), rgb(240, 220, 220));
                border-top: 10px solid rgb(130, 0, 0);
            }

            .shortcut.minhasturmas {
                width: 300px;
                height: 400px;
                background: linear-gradient(180deg, rgb(180, 180, 220), rgb(220, 220, 240));
                border-top: 10px solid rgb(0, 0, 130);
            }

            .shortcut.overview {
                width: 300px;
                height: 400px;
                background: linear-gradient(180deg, rgb(180, 220, 180), rgb(220, 240, 220));
                border-top: 10px solid rgb(0, 130, 0);
            }
        </style>

        <div class="dashboard">

            <a href="#" class="shortcut atividades">
                <div>
                    <div>Atividades Pendentes</div>
                </div>
            </a>
            <a href="#" class="shortcut minhasturmas">
                <div>
                    <div>Minhas Turmas</div>
                </div>
            </a>
            <a href="#" class="shortcut overview">
                <div>
                    <div>Overview</div>
                </div>
            </a>
        </div>

</x-app-layout>