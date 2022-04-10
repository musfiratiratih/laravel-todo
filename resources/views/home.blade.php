<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel - Todo</title>

  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="overflow-y-hidden">
  <div class="w-screen h-screen bg-slate-700">
    <div class="relative flex flex-col items-stretch justify-between mx-auto max-w-md pt-12 h-full bg-slate-200">
      <div class="absolute top-0 right-0 left-0 flex items-center justify-center h-12 w-full bg-teal-500 shadow-lg">
        <div class="py-3 text-center text-white text-xl font-bold uppercase">Laravel Todo</div>
      </div>

      <div class="w-full p-4 bg-white border shadow-lg">
        <form action="{{ $todo ? route('todos.edit', $todo->id) : route('todos.store') }}" method="post" class="flex items-center justify-between">
          @method($todo ? 'put' : 'post') @csrf
          <input type="text" name="things" placeholder="What todo next today ?" value="{{ $todo->things ?? '' }}"
            class="px-4 py-2 w-full border rounded-lg outline-none text-slate-700 focus:border-teal-500">
          <button type="submit"
            class="ml-4 px-4 py-2 bg-teal-500 text-white text-sm font-bold uppercase rounded-lg hover:bg-teal-400">{{ $todo ? 'Update' : 'Add' }}</button>
        </form>
      </div>

      <div class="relative flex-1 pb-16 overflow-y-auto">
        @foreach ($todos as $todo)
        <div class="w-full p-4 mt-4 {{ $todo->done ? 'bg-gray-100 shadow' : 'bg-white shadow-lg border' }}">
          <div class="flex items-center justify-between">
            <div class="mr-4  {{ $todo->done ? 'line-through text-slate-400' : 'text-slate-700' }}">{{ $todo->things }}</div>
            <div class="flex items-center justify-center">
              @if (!$todo->done)
              <form action="{{ route('todos.index') }}" method="get">
                <button type="submit" name="id" value="{{ $todo->id }}" class="flex items-center justify-center h-8 w-8 rounded-full text-amber-500 hover:bg-amber-50">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                  </svg>
                </button>
              </form>
              <form action="{{ route('todos.done', $todo->id) }}" method="post">@csrf
                <button type="submit" class="flex items-center justify-center h-8 w-8 rounded-full text-teal-500 hover:bg-teal-50">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                  </svg>
                </button>
              </form>
              @endif
              <form action="{{ route('todos.delete', $todo->id) }}" method="post">
                @method('delete') @csrf
                <button type="submit" class="flex items-center justify-center h-8 w-8 rounded-full {{ $todo->done ? 'text-rose-300' : 'text-rose-500' }} hover:bg-rose-50">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                  </svg>
                </button>
              </form>
            </div>
          </div>
        </div>
        @endforeach

        @if (Request::has('id')) <div class="absolute inset-0 w-full h-full backdrop-blur"></div> @endif
      </div>

      <div class="absolute bottom-0 right-0 left-0 flex items-center justify-center h-10 w-full bg-teal-500 shadow-lg">
        <div class="py-3 text-center text-white font-bold uppercase">© 2021</div>
      </div>
    </div>
  </div>
</body>

</html>
