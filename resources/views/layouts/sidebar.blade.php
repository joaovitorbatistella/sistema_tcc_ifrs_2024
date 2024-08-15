<link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
<aside id="logo-sidebar" class="top-0 left-0 z-40 h-screen pt-0 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 pb-4 overflow-y-auto bg-E9E9E9 ">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="{{route('dashboard')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
               <i class="material-icons-outlined text-base text-gray-500">dashboard</i>
               <span class="ms-3">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="{{route('biblioteca')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
               <i class="material-icons-outlined text-base text-gray-500">menu_book</i>
               <span class="flex-1 ms-3 whitespace-nowrap">Biblioteca</span>
            </a>
         </li>
         <li>
            <a href="{{route('arquivos')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
               <i class="material-icons-outlined text-base text-gray-500">file_present</i>
               <span class="flex-1 ms-3 whitespace-nowrap">Meus Arquivos</span>
            </a>
         </li>
         @if(Auth::user()->group()->first()->able_to_create_users)
            <li>
               <a href="{{route('alunos-controller.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                  <i class="material-icons-outlined text-base text-gray-500">group</i>
                  <span class="flex-1 ms-3 whitespace-nowrap">Alunos</span>
               </a>
            </li>
            <li>
               <a href="{{route('professores-controller.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                  <i class="material-icons-outlined text-base text-gray-500">school</i>
                  <span class="flex-1 ms-3 whitespace-nowrap">Professores</span>
               </a>
            </li>
         @endif
         <li>
            <a href="{{route('class-controller.index')}}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
               <i class="material-icons-outlined text-base text-gray-500">groups</i>
               <span class="flex-1 ms-3 whitespace-nowrap">Turmas</span>
            </a>
         </li>
      </ul>
   </div>
</aside>

<style>
   .bg-E9E9E9 {
      background: #E9E9E9
   }
</style>