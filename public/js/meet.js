function joinRoom(user_email,user_name,room_id){
    const domain = 'meet.jit.si';
    const options = {
        roomName: room_id,
        width: 700,
        height: 700,
        parentNode: document.querySelector('#meet'),
        userInfo:{
            email:user_email,
            displayName:user_name
        }
    };

const api = new JitsiMeetExternalAPI(domain, options);

}

