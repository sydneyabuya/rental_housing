<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard for Tenant') }}
        </h2>
    </x-slot>

    
    <div class="grid grid-cols-3 gap-4 sm:px-6 lg:px-24 border-l-2 border-blue-600 py-12">
      
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
              <div class="h-20 w-20">
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
              <x-button>
                here
              </x-button>
            </div>
          </div>
        </div>
      </div>

</x-app-layout>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/612c3c0bd6e7610a49b29def/1feacl3n4';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
