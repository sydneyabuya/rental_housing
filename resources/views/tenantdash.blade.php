<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard for Tenant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 font-semibold">
                    You're logged in as a tenant!
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-flow-col grid-rows-2 grid-cols-3 gap-4 px-12">
        <div class="bg-red-500">
          1
          <figure class="md:flex bg-gray-100 rounded-xl p-8 md:p-0">
            <img class="w-32 h-32 md:w-48 md:h-auto md:rounded-none rounded-full mx-auto" src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8aG91c2UlMjBleHRlcmlvcnxlbnwwfHwwfHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" alt="" width="384" height="512">
            <div class="pt-6 md:p-8 text-center md:text-left space-y-4">
              <blockquote>
                <p class="text-lg font-semibold">
                  “Tailwind CSS is the only framework that I've seen scale
                  on large teams. It’s easy to customize, adapts to any design,
                  and the build size is tiny.”
                </p>
              </blockquote>
              <figcaption class="font-medium">
                <div class="text-cyan-600">
                  Sarah Dayan
                </div>
                <div class="text-gray-500">
                  Staff Engineer, Algolia
                </div>
              </figcaption>
            </div>
        </figure>
        </div>
        <div class="col-start-3 bg-red-800">
          2
        </div>
        <div class="bg-green-400">
          3
        </div>
        <div class="bg-blue-700">
          4
        </div>
        <div class="row-start-1 col-start-2 col-span-2 bg-yellow-500">
          5
        </div>
    </div>
</x-app-layout>
