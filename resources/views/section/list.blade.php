

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
                Room ID
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Number of student
              </th>
              @if ($user->role == 1)
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Drop
                </th>
              @endif
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
          @foreach($sections as $section)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center justify-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      {{$section->Description}}
                    </div>
                    <div class="text-sm text-gray-500">
                      
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center justify-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      @php
                        $room_description = DB::select("select description from  rooms where room_id='{$section->room_id}'");        
                        echo($room_description[0]->description);
                      @endphp
                    </div>
                    <div class="text-sm text-gray-500">
                      
                    </div>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-center">
                <div class="text-sm justify-center text-gray-900">
                {{$section->room_id}}
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-center justify-center text-gray-500">
                    @php
                        $count  = 0;
                        $count = (DB::selectOne("select count(user_id) as count from invites where section_id = '{$section->id}'"))->count;        
                        
                        echo($count);
                    @endphp
              </td>
            
              @if ($user->role == 1)
              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
              
                <form method="post" class="delete_form" action="{{ url('/sections.destroy',$section->room_id) }}"> 
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                </form>
              </td>
              @endif
        
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
