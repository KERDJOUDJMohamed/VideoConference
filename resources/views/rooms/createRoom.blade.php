<form class="w-full max-w-sm" method="POST" action="{{route('rooms.create')}}">
    @csrf
  <div class="md:flex md:items-center mb-6">
    <div class="md:w-1/3">
      <label class="block text-white-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="Description">
        Room Description
      </label>
    </div>
    <div class="md:w-2/3">
      <input class="bg-white-200 appearance-none border-2 border-gray-200 rounded w-2 py-2 px-4 text-gray-400 leading-tight focus:outline-none focus:bg-white focus:border-purple-500" name="description" type="text" value="">
    </div>
  </div>

  <div class="md:flex md:items-center">
    <div class="md:w-1/3"></div>
    <div class="md:w-2/3">
      <button class="btn shadow bg-current bg-purple-500 hover:bg-purple-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit" style="background-color: indigo;">
        Create Room
      </button>
    </div>
  </div>
</form>