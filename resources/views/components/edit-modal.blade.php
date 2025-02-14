@props(['name','title'])

<div 

x-data = "{ show : false, name : '{{$name}}' }"
x-show = "show"
x-on:open-editmodal.window = "show = ($event.detail.name === name)"
x-on:close-editmodal.window = "show = false"
x-transition.duration
style="display:none"
class="fixed z-5 inset-0">
    <div class="fixed inset-0 bg-gray-100 opacity-40"></div>
    <div class="rounded bg-white m-auto fixed inset-0 max-w-4xl h-auto overflow-scroll">
        <div class="flex justify-between items-center py-3 px-4 border-b dark:border-neutral-700">
            <h3 id="hs-scale-animation-modal-label" class="font-bold text-gray-800 dark:text-white">
              {{$title}}
            </h3>
            <button x-on:click="show = false" type="button" class="size-8 inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:hover:bg-neutral-600 dark:text-neutral-400 dark:focus:bg-neutral-600" aria-label="Close" data-hs-overlay="#hs-scale-animation-modal">
              <span class="sr-only">Close</span>
              <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6 6 18"></path>
                <path d="m6 6 12 12"></path>
              </svg>
            </button>
        </div>
        <div class="p-4 overflow-y-auto">
            {{$body}}
        </div>
    </div>
</div>
