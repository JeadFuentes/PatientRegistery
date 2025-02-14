<div>
    <div class="flex flex-col pt-5">
        <div class="-m-1.5 overflow-x-auto">
          <div class="p-1.5 min-w-full inline-block align-middle">
            <!-- Search Bar -->
            <div class="sm:col-span-3">
                <div class="mb-5 w-80">
                  <input type="text" id="searchTxt" placeholder="search" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
              </div>
            <div class="overflow-hidden">
              <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                <thead>
                  <tr>
                    <th style="cursor: pointer" wire:click="sortingBy('hrn')" scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">HRN &ensp; @include('partials.sort-icon',['field'=>'hrn'])</th>
                    <th style="cursor: pointer" wire:click="sortingBy('firstname')" scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Full Name &ensp; @include('partials.sort-icon',['field'=>'firstname'])</th>
                    <th style="cursor: pointer" wire:click="sortingBy('dob')" scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">DOB &ensp; @include('partials.sort-icon',['field'=>'dob'])</th>
                    <th style="cursor: pointer" wire:click="sortingBy('civilstatus')" scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Civil Status @include('partials.sort-icon',['field'=>'civilstatus'])</th>
                    <th style="cursor: pointer" wire:click="sortingBy('sex')" scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Sex &ensp; @include('partials.sort-icon',['field'=>'sex'])</th>
                    <th style="cursor: pointer" wire:click="sortingBy('contact')" scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Contact &ensp; @include('partials.sort-icon',['field'=>'contact'])</th>
                    <th style="cursor: pointer" wire:click="sortingBy('street')" scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Address &ensp; @include('partials.sort-icon',['field'=>'street'])</th>
                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Action</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                    @foreach ($patients as $patient)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-neutral-200">{{$patient->hrn}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{$patient->firstname." ".$patient->middlename." ".$patient->lastname}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{$patient->dob}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{$patient->civilstatus}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{$patient->sex}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-neutral-200">{{$patient->contact}}</td>
                        <td class="overflow-hidden text-ellipsis px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">{{$patient->street.", ".$patient->barangay.", ". $patient->citymun.", ".$patient->district." ".$patient->zipcode}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                            <button wire:click="restorePatient({{$patient->id}})" type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-green-600 hover:text-gray-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Restore</button>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
              </table>
              <div class="flex">
                <div class="w-20 flex-none">
                    <p class="px-3 text-xs">Per Page:</p>
                    <select wire:model="perPage" wire:change='perPages()' class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        <option>5</option>
                        <option>10</option>
                        <option>15</option>
                        <option>20</option>
                        <option>25</option>
                    </select>
                </div>
                <div class="px-4 w-14 flex-1">
                    {{$patients->links()}}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@script
<script>
    $(document).ready(function(){
      $('#searchTxt').on('keyup',function(){
        @this.search = $(this).val();
        @this.call('perPages');
      })
    });
</script>
@endscript