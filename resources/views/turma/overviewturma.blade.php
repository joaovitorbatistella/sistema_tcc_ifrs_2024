<!-- resources/views/activities.blade.php -->
<x-app-layout>
    <x-slot:header>
        <div class="sm:flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-black">
                    {{ __('Atividades do TCC') }}
                </h2>
            </div>
            <div>
                <button type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 rounded">
                <a href="{{route('class-controller-new.index')}}">Adicionar Turma</a>
                </button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        {{ __('A fazer') }}
                    </div>
                    <div class="mt-6 text-gray-500">
                        <!-- Lista de atividades a fazer? -->
                        @foreach ($todoActivities as $activity)
                            <div class="mb-4">
                                <span class="text-xs text-gray-400">TCC: {{$activity->tcc()->name}}</span>
                                <a href="{{ route('activity-controller.show', ['id' => $activity->user_class_activity_id]) }}" class="flex justify-between p-4 mb-4 {{ $activity->due_at < now() ? 'bg-red-100 text-gray-600' : 'bg-gray-100' }} rounded-lg">
                                    <span>{{ $activity->name }}</span>
                                    <span>{{ $activity->due_at }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-8 text-2xl">
                        {{ __('Histórico') }}
                    </div>
                    <div class="mt-6 text-gray-500">
                        <!-- Lista de atividades históricas -->
                        @foreach ($historicalActivities as $activity)
                            <div class="mb-4">
                                <span class="text-xs text-gray-400">TCC: {{$tcc[0]->name}}</span>
                                <a href="{{ route('activity-controller.show', ['id' => $activity->user_class_activity_id]) }}" class="flex justify-between p-4 mb-4 bg-gray-100 rounded-lg">
                                    <span>{{ $activity->name }}</span>
                                    <span>{{ $activity->due_at }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
