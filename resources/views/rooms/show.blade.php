<x-default>
  <!-- component -->
  <link
    rel="stylesheet"
    href="https://unpkg.com/flowbite@1.4.4/dist/flowbite.min.css"
  />

  <!-- This is an example component -->
  <div class="w-[80%] mx-auto">
    <div class="pt-[3%]" id="vue-app"></div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://unpkg.com/flowbite@1.4.0/dist/flowbite.js"></script>
    <script>
      var roomId = @json($room);
      var userId = @json($user);
      var partnerId = @json($partner);
    </script>
  </div>
</x-default>
