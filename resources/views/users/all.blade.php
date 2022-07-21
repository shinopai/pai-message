<x-app-layout>
  <div class="w-3/4 mx-auto p-[5%] pb-[2%]">
    <x-slot name="header">
      <a href="{{ url('/') }}" class="contents">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
          <img
            src="{{ asset('images/logo_site01.png') }}"
            alt="site logo"
            srcset=""
            class="mx-auto"
          />
        </h1>
      </a>
    </x-slot>
    @forelse($users as $user)
    <section class="text-gray-600 body-font mb-[25px]">
      <div class="container px-5 mx-auto">
        <div
          class="lg:w-2/3 flex justify-center gap-[20px] sm:flex-row sm:items-center items-start mx-auto"
        >
          <h2
            class="flex-grow sm:pr-16 text-[2rem] font-medium title-font text-gray-900"
          >
            {{ $user->name }}
          </h2>
          <form
            action="{{ route('rooms.store_room', ['user' => Auth::id(), 'partner_id' => $user->id]) }}"
            method="post"
          >
            @csrf
            <button
              type="submit"
              class="bg-[#EE0964] text-white block text-center w-[200px] rounded-[5px] text-[1.6rem] font-bold p-[0.5em] relative chat-button"
            >
              チャットする
            </button>
          </form>
        </div>
      </div>
    </section>
    @empty
    <p class="text-center text-[1.6rem]">登録済みユーザーはいません</p>
    @endforelse
  </div>
  {{ $users->links() }}

  <style>
    .chat-button::before {
      content: "";
      background-image: url(../images/ico_front01.png);
      background-size: contain;
      display: inline-block;
      width: 16px;
      height: 16px;
      position: absolute;
      left: 1.5em;
      top: calc(50% - 16px / 2);
    }
  </style>
</x-app-layout>
