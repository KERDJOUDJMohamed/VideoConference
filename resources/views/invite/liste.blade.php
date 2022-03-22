<div class="flex flex-col ">
  
  <div class="my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    @foreach ($sections as $key=>$section)
    
    
    <div class="py-2  bg-gray-100 align-middle inline-block min-w-full sm:px-6 lg:px-8">
    
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg mt-10">
    
    
        
    
      <h1 class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">{{$section->Description}}</h1>
        <table class="w-full divide-y divide-gray-200 ">
        
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Student Name
              </th>
              <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                Student Email
              </th>
                <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Drop
                </th>
            </tr>
          </thead>

          <tbody class="bg-white divide-y divide-gray-200">
          @foreach($students[$key] as $student)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="flex items-center justify-center">
                  <div class="ml-4">
                    <div class="text-sm font-medium text-gray-900">
                      {{$student->name}}
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
                        {{$student->email}}
                    </div>
                    <div class="text-sm text-gray-500">
                    </div>
                  </div>
                </div>
              </td>
            
              <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
              
                <form method="post" class="delete_form" action="{{ url('/invite.kickoutStudent',[$student->user_id,$section->id])}}"> 
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                </form>
              </td>
        
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
@endforeach     

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
