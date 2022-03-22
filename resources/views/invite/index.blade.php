
<!--meet script-->
<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inviting Student to join a room') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col">
                <form class="w-full max-w-sm" method="POST" action="{{route('invite.create')}}">
                    @csrf
                    <!--
                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label class="block text-white-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="section_id">
                            Section
                        </label>
                        </div>
                        <div class="md:w-2/3">
                        <input class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-2 py-2 px-4 text-gray-400 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="room_id" type="text" value="">
                        </div>
                    </div>
                     -->
    

                    
                    <div class="md:flex md:items-center mb-6">
                        <x-jet-label for="section_id" value="{{ __('Section ID') }}" />
                        <div class="block text-white-500 font-bold md:text-right mb-1 md:mb-0 pr-4"> 
                            <select name="section_id" class="block mt-1 w-fit border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm">
                                @foreach ( $sections as $section )
                                    <option value="{{$section->id}}">{{$section->Description}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    

                    <div class="md:flex md:items-center mb-6">
                        <div class="md:w-1/3">
                        <label class="block text-white-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="student_email">
                            Student Email
                        </label>
                        </div>
                        <div class="md:w-2/3">
                        <input class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-2 py-2 px-4 text-gray-400 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="student_email" type="email" value="">
                        </div>
                    </div>

                    <div class="md:flex md:items-center">
                        <div class="md:w-1/3"></div>
                        <div class="md:w-2/3">
                        <button class="btn shadow bg-current bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" style="background-color: indigo;">
                            Invite
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('invite.liste')
</x-app-layout>
