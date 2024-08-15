<!-- resources/views/activities.blade.php -->
<x-app-layout>
    <x-slot:header>
        <div class="sm:flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-xl text-black">
                    {{ __('Atividades do TCC') }}
                </h2>
            </div>
            @if($group->able_to_create_tcc)
                <div>
                    <button type="button" class="bg-c-green text-white text-lg font-bold py-1 px-2 rounded">
                    <a href="{{route('class-controller-new.index')}}">Adicionar Turma</a>
                    </button>
                </div>
            @endif
        </div>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <div class="mt-8 text-2xl">
                        {{ __('Em andamento') }}
                    </div>
                    <div class="mt-6 text-gray-500">
                        <!-- Lista de atividades em andamento -->
                        @foreach ($ongoingActivities as $activity)
                            <a href="{{ route('activity-controller.show', ['id' => $activity->user_class_activity_id]) }}" class="flex justify-between p-4 mb-4 {{ $activity->due_at < now() ? 'bg-gray-100 text-red-600' : 'bg-gray-100' }} rounded-lg">
                                <span>{{ $activity->name }}</span>
                                <span>{{ $activity->due_at }}</span>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8 text-2xl">
                        {{ __('Futuras') }}
                    </div>
                    <div class="mt-6 text-gray-500">
                        <!-- Lista de atividades futuras -->
                        @foreach ($futureActivities as $activity)
                            <a href="{{ route('activity-controller.show', ['id' => $activity->user_class_activity_id]) }}" class="flex justify-between p-4 mb-4 {{ $activity->due_at < now() ? 'bg-red-100 text-red-600' : 'bg-gray-100' }} rounded-lg">
                                <span>{{ $activity->name }}</span>
                                <span>{{ $activity->due_at}}</span>
                            </a>
                        @endforeach
                    </div>

                    <div class="mt-8 text-2xl">
                        {{ __('Histórico') }}
                    </div>
                    <div class="mt-6 text-gray-500">
                        <!-- Lista de atividades históricas -->
                        @foreach ($historicalActivities as $activity)
                            <a href="{{ route('activity-controller.show', ['id' => $activity->user_class_activity_id]) }}" class="flex justify-between p-4 mb-4 bg-gray-100 rounded-lg">
                                <span>{{ $activity->name }}</span>
                                <span>{{ $activity->due_at }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
