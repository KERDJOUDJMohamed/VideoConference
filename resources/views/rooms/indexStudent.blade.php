
<!--meet script-->
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Room List') }}
        </h2>
    </x-slot>


      <div class="py-12">
        
          <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          
              <!-- This example requires Tailwind CSS v2.0+ -->
  <div class="flex flex-col">
  
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
    
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-10">
      
        <table class="w-full divide-y divide-gray-200 ">
        
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Section Description
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Room Description
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Invited by
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Invited Date
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Link
              </th>
              
            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Section
            </th>
            
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
          @foreach($invited as $invite)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center justify-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      {{$invite->section_description}}
                    </div>
                    <div class="text-sm text-gray-500">
                      
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="text-sm justify-center text-gray-900">
                {{$invite->room_description}}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="text-sm justify-center text-gray-900">
                {{$invite->teacher_name}}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-center justify-center text-gray-500">
                {{$invite->date}}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                <a href="/rooms/{{$invite->room_id}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Join</a>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                  
                
                <form method="post" class="delete_form" action="{{ url('/invite.kickoutStudent',[Auth::user()->id,$invite->section_id]) }}"> 
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Leave</button>
                </form>
                
              </td>

            </tr>
            @endforeach
            
            <!-- More people... -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

        </div>
        
    </div>

</x-app-layout>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  $(document).ready(function(){
      $('.delete_form').on('submit', function(){
         if(confirm("Are you sure you want to delete it?"))
         {
             return true;
         }
         else
         {
             return false;
         }
      });
  });
</script>
