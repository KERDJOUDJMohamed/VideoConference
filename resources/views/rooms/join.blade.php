
<!--meet script-->
<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Joining a room') }}
        </h2>
        <div class="md:flex md:items-center">
            <div class="md:w-1/3"></div>
            <div class="md:w-2/3">
              <a  class="click" href="#">Display Participants List</a>
            </div>
        </div>
        
    </x-slot>
    <div  id='meet' style="display: flex;flex-flow: column;height: 100vh;width:100%">
        
    </div>
    
    <script src='https://meet.jit.si/external_api.js'></script>
    <script>
        const element = document.querySelector(".click");
        element.addEventListener("click", () => {
            const participants = api.getParticipantsInfo();
            let list = "";
                for(let i=0 ;i<participants.length ; ++i)
            {
                list =  list + participants[i]['displayName'] +  "\n";
            }
                alert(list);
            
        });
        
    </script>
    <script>

        let room = document.querySelector('#meet');
        let width =document.getElementById("meet").offsetWidth
        let height = document.getElementById("meet").offsetHeight

        let user_email="<?=$user_email?>";
        let  user_name="<?=$user_name?>";
        let room_id="<?$room_id?>";

        const domain = 'meet.jit.si';
        const options = {
            roomName: room_id,
            width: width,
            height: height,
            parentNode: document.querySelector('#meet'),
            userInfo:{
                email:user_email,
                displayName:user_name
            }
        }
        let api = new JitsiMeetExternalAPI(domain, options);
    </script>



</x-app-layout>
