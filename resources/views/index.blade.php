<x-app-layout>
  <div class="w-3/4 mx-auto p-[5%]">
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
    @auth
    <p class="mb-[20px] text-[1.6rem]">
      ようこそ&nbsp;<strong>{{ Auth::user()->name }}さん</strong>
    </p>
    @endauth
    <div class="flex gap-[30px]">
      <figure class="w-1/2">
        <img src="{{ asset('/images/img_front01.png') }}" alt="front image" />
      </figure>
      <div class="w-1/2">
        <h2 class="font-bold text-[2.8rem] mb-[5%]">
          見知らぬ誰かと<br />チャットを楽しめる<br />Webサービス。
        </h2>
        <p class="text-[1.6rem] mb-[2%] leading-[1.8]">
          <span class="text-[#EB005E]">「チャットを開始する」</span
          >をクリックすると、<br />
          利用登録済の誰か一人と<br />
          チャットを開始する事が出来ます。<br />
          チャットの内容は公開されません。<br />
          見知らぬ誰かと何を話すかは皆さんの自由です。
        </p>
        @auth
        <a
          href="{{ route('users.show_all') }}"
          class="bg-[#EE0964] text-white block text-center w-[250px] rounded-[5px] text-[2rem] font-bold px-[1em] py-[0.5em] relative chat-button"
          >チャットを開始する</a
        >
        @else
        <a
          href="{{ route('login') }}"
          class="bg-[#EE0964] text-white block text-center w-[250px] rounded-[5px] text-[2rem] font-bold px-[1em] py-[0.5em]"
          >ログインする</a
        >
        @endauth
      </div>
    </div>
  </div>

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
