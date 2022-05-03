
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('TaskIndex') }}
        </h2>
    </x-slot>

    <div class="table-responsive">
<table class="table" style="width: 1400px; max-width: 0 auto;">
   <tr class="table-info">
    
     <th scope="col" width="30%">ユーザーID</th>
     <th scope="col" width="40%">タスク</th>
     <th scope="col" width="30%">期日</th>
    
   </tr>

   
   <tr>
      <th scope="row">acceldss@gmail.xmo</th>
      <th scope="row">tasukjfao</th>
      <th scope="row">2022/2/2</th>
      
   </tr>
  
   </table>
   </div>


</x-app-layout>
