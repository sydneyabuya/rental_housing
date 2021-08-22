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
    
    <div class="grid grid-cols-3 gap-4 px-24 border-l-2 border-blue-600 ">
      
      <div class="col-span-2 bg-white rounded-xl shadow-lg border-l-2 border-blue-600">
        <div class=" p-3 max-w-sm mx-auto bg-white rounded-xl flex items-center space-x-4 py-10">
          
          <div>
            <div class=" text-2xl font-medium text-black">Your Current Balance is</div>
            <p class="text-gray-500 text-2xl">$0.00</p>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-lg border-l-2 border-blue-600">
        <div class="col-span-2 bg-white rounded-xl shadow-lg">
          <div class=" p-3 max-w-sm mx-auto bg-white rounded-xl flex items-center space-x-4">
            
            <div>
              <div class=" text-lg font-medium text-black">Account Information</div>
              <div class=" text-sm font-medium text-gray-500">Account Number</div>
              <p class="text-black font-normal text-xs">2345678</p>
              <div class=" text-sm font-medium text-gray-500">Account Number</div>
              <p class="text-black font-normal text-xs">2345678</p>
              <div class=" text-sm font-medium text-gray-500">Account Number</div>
              <p class="text-black font-normal text-xs">2345678</p>
              <div class=" text-sm font-medium text-gray-500">Account Number</div>
              <p class="text-black font-normal text-xs">2345678</p>
              <div class=" text-sm font-medium text-gray-500">Account Number</div>
              <p class="text-black font-normal text-xs">2345678</p>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-xl shadow-lg border-l-2 border-blue-600">2
        <div class="col-span-2 bg-white rounded-xl shadow-lg">
        <div class=" p-3 max-w-sm mx-auto bg-white rounded-xl flex items-center space-x-4">
          
          <div class="px-5 py-1">
            <div class=" text-lg font-bold text-black">Open Requests</div>
              <div class="h-12 w-1/3">
                <img src="https://fonts.gstatic.com/s/i/materialiconsoutlined/build/v11/24px.svg" alt="ertyu">
              </div>
              <div class=" text-lg font-semibold text-black">How can we help you?</div>
              <p class="text-black font-normal text-xs"></p>
              <button class="bg-green-500 active:bg-green-700 rounded-full py-3 px-6 hover:bg-green-600">
                Create Request
              </button>
          </div>
        </div>
      </div>

      </div>
      <div class="bg-white rounded-xl shadow-lg border-l-2 border-blue-600">3
        <div class="col-span-2 bg-white rounded-xl shadow-lg">
          <div class=" p-3 max-w-sm mx-auto bg-white rounded-xl flex items-center space-x-4">
            
            <div class="px-5 py-1">
              <div class=" text-base font-bold text-black">Announcements</div>
              <br>
              <div class="  text-base font-medium text-black">View your Announcements here</div>
              <br>
              <div class=" text-base font-medium text-black"></div>
              <button class="bg-green-500 active:bg-green-700 rounded-full py-3 px-6 hover:bg-green-600">
                Announcements
              </button>
            </div>
          </div>
        </div>
      </div>

</x-app-layout>
