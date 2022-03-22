
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
  
    @include('rooms.createRoom')
  
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
    
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-10">
      
        <table class="w-full divide-y divide-gray-200 ">
        
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Room ID
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Description
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Created At
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Link
              </th>
              @if ($user->role == 1)
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Drop
                </th>
              @endif
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
          @foreach($user->getRooms as $room)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center justify-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      {{$room->room_id}}
                    </div>
                    <div class="text-sm text-gray-500">
                      
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="text-sm justify-center text-gray-900">
                {{$room->Description}}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-center justify-center text-gray-500">
                {{$room->created_at}}
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                <a href="/rooms/{{$room->room_id}}" target="_blank" class="text-indigo-600 hover:text-indigo-900">Join</a>
              </td>
              @if ($user->role == 1)
              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
              
                <form method="post" class="delete_form" action="{{ url('/rooms.destroy',$room->room_id) }}"> 
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                </form>
              </td>
              @endif
        
              <!--
                <a href="/rooms/{{$room->room_id}}" target="_blank" class="text-red-600 hover:text-red-900">Delete</a>
                -->
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
