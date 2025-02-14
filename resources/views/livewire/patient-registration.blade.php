<div>
    <button x-data x-on:click="$dispatch('open-modal', { name : 'Register' })" type="button" class="py-3 p-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-teal-500 text-white hover:bg-teal-600 focus:outline-none focus:bg-teal-600 disabled:opacity-50 disabled:pointer-events-none">
        Register Patient
    </button>
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
                    <th style="cursor: pointer" wire:click="sortingBy('contact')" scope="col" class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Contact @include('partials.sort-icon',['field'=>'contact'])</th>
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
                            <button wire:click="viewPatient({{$patient->id}})" type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-gray-500 hover:text-gray-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">View</button>
                            <button wire:click="editPatient({{$patient->id}})"  type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-gray-500 hover:text-gray-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Edit</button>
                            <button wire:click="deletePatient({{$patient->id}})" type="button" class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent text-red-400 hover:text-red-700 focus:outline-none focus:text-blue-800 disabled:opacity-50 disabled:pointer-events-none dark:text-blue-500 dark:hover:text-blue-400 dark:focus:text-blue-400">Delete</button>
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

    @if ($this->editPatients)
    <x-custom-modal name="Register" title="Edit Patient">
      <x-slot:body>
          <form wire:submit.prevent="saveEditPatient">
              <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                  <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Hospital Record Number</label>
                  <div class="mt-2 mb-5">
                      <input type="text" wire:model="hrn" id="hrn" disabled class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                  </div>
                  @error('hrn') <span class="text-red-500">{{ $message }}</span> @enderror
                  <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
                  <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                      <label for="firstname" class="block text-sm/6 font-medium text-gray-900">First name</label>
                      <div class="mt-2">
                        <input type="text" wire:model="firstname" id="firstname" autocomplete="firstname" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('firstname')<p class="text-danger">This field is needed</p>@enderror
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="lastname" class="block text-sm/6 font-medium text-gray-900">Last name</label>
                      <div class="mt-2">
                        <input type="text" wire:model="lastname" id="lastname" autocomplete="lastname" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('lastname')<p class="text-danger">This field is needed</p>@enderror
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="middlename" class="block text-sm/6 font-medium text-gray-900">Middle Name</label>
                      <div class="mt-2">
                        <input id="middlename" wire:model="middlename" type="text" autocomplete="middlename" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('middlename')<p class="text-danger">This field is needed</p>@enderror
                    </div>

                    <div class="sm:col-span-3">
                      <label for="dob" class="block text-sm/6 font-medium text-gray-900">Date of Birth</label>
                      <div class="mt-2">
                        <input id="dob" wire:model="dob" type="date" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('dob')<p class="text-danger">This field is needed</p>@enderror
                    </div>

                    <div class="sm:col-span-3">
                      <label for="civilstatus" class="block text-sm/6 font-medium text-gray-900">Civil Status</label>
                      <div class="mt-2 grid grid-cols-1">
                        <select id="civilstatus" wire:model="civilstatus" autocomplete="civilstatus" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                          <option value="">Select</option>
                          <option value="Single">Single</option>
                          <option value="Married">Married</option>
                          <option value="Divorced">Divorced</option>
                          <option value="Widowed">Widowed</option>
                          <option value="Seperated">Seperated</option>
                        </select>
                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      @error('civilstatus')<p class="text-danger">This field is needed</p>@enderror
                    </div>

                    <div class="sm:col-span-3">
                      <label for="sex" class="block text-sm/6 font-medium text-gray-900">Sex</label>
                      <div class="mt-2 grid grid-cols-1">
                        <select id="sex" wire:model="sex" autocomplete="sex" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                          <option value="">Select</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      @error('sex')<p class="text-danger">This field is needed</p>@enderror
                    </div>

                    <div class="sm:col-span-3">
                      <label for="contact" class="block text-sm/6 font-medium text-gray-900">Contact </label>
                      <div class="mt-2">
                        <input id="contact" wire:model="contact" type="text" autocomplete="contact" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('contact')<p class="text-danger">This field is needed</p>@enderror
                    </div>
            
                    <div class="col-span-full">
                      <label for="street" class="block text-sm/6 font-medium text-gray-900">Street address</label>
                      <div class="mt-2">
                        <input type="text" wire:model="street" id="street" autocomplete="street" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('street')<p class="text-danger">This field is needed</p>@enderror
                    </div>
            
                    <div class="sm:col-span-3 sm:col-start-1">
                      <label for="citymun" class="block text-sm/6 font-medium text-gray-900">City/Municipality</label>
                      <div class="mt-2">
                        <input type="text" wire:model="citymun" id="citymun" autocomplete="citymun" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('citymun')<p class="text-danger">This field is needed</p>@enderror
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="barangay" class="block text-sm/6 font-medium text-gray-900">Barangay</label>
                      <div class="mt-2">
                        <input type="text" wire:model="barangay" id="barangay" autocomplete="barangay" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('barangay')<p class="text-danger">This field is needed</p>@enderror
                    </div>

                    <div class="sm:col-span-3">
                      <label for="district" class="block text-sm/6 font-medium text-gray-900">District</label>
                      <div class="mt-2">
                        <input type="text" wire:model="district" id="district" autocomplete="district" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('district')<p class="text-danger">This field is needed</p>@enderror
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="zipcode" class="block text-sm/6 font-medium text-gray-900">ZIP / Postal code</label>
                      <div class="mt-2">
                        <input type="text" wire:model="zipcode" id="zipcode" autocomplete="zipcode" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('zipcode')<p class="text-danger">This field is needed</p>@enderror
                    </div>
                  </div>
                </div>
            
              <div class="mt-6 flex items-center justify-end gap-x-6">
                <button wire:click="closePatient()" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save Changes</button>
              </div>
          </form>              
      </x-slot:body>
    </x-custom-modal>
    @elseif ($this->viewPatients)
    <x-custom-modal name="Register" title="View Patient">
      <x-slot:body>
              <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                  <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Hospital Record Number</label>
                  <div class="mt-2 mb-5">
                      <input type="text" wire:model="hrn" id="hrn" disabled class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                  </div>
                  @error('hrn') <span class="text-red-500">{{ $message }}</span> @enderror
                  <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
                  <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                      <label for="firstname" class="block text-sm/6 font-medium text-gray-900">First name</label>
                      <div class="mt-2">
                        <input type="text" wire:model="firstname" id="firstname" disabled autocomplete="firstname" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="lastname" class="block text-sm/6 font-medium text-gray-900">Last name</label>
                      <div class="mt-2">
                        <input type="text" wire:model="lastname" id="lastname" disabled autocomplete="lastname" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="middlename" class="block text-sm/6 font-medium text-gray-900">Middle Name</label>
                      <div class="mt-2">
                        <input id="middlename" wire:model="middlename" type="text" disabled autocomplete="middlename" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="dob" class="block text-sm/6 font-medium text-gray-900">Date of Birth</label>
                      <div class="mt-2">
                        <input id="dob" wire:model="dob" type="date" disabled class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="civilstatus" class="block text-sm/6 font-medium text-gray-900">Civil Status</label>
                      <div class="mt-2 grid grid-cols-1">
                        <select id="civilstatus" wire:model="civilstatus" disabled autocomplete="civilstatus" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                          <option value="">Select</option>
                          <option value="Single">Single</option>
                          <option value="Married">Married</option>
                          <option value="Divorced">Divorced</option>
                          <option value="Widowed">Widowed</option>
                          <option value="Seperated">Seperated</option>
                        </select>
                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="sex" class="block text-sm/6 font-medium text-gray-900">Sex</label>
                      <div class="mt-2 grid grid-cols-1">
                        <select id="sex" wire:model="sex" disabled autocomplete="sex" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                          <option value="">Select</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="contact" class="block text-sm/6 font-medium text-gray-900">Contact </label>
                      <div class="mt-2">
                        <input id="contact" wire:model="contact" disabled type="text" autocomplete="contact" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                    </div>
            
                    <div class="col-span-full">
                      <label for="street" class="block text-sm/6 font-medium text-gray-900">Street address</label>
                      <div class="mt-2">
                        <input type="text" wire:model="street" id="street" disabled autocomplete="street" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                    </div>
            
                    <div class="sm:col-span-3 sm:col-start-1">
                      <label for="citymun" class="block text-sm/6 font-medium text-gray-900">City/Municipality</label>
                      <div class="mt-2">
                        <input type="text" wire:model="citymun" id="citymun" disabled autocomplete="citymun" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="barangay" class="block text-sm/6 font-medium text-gray-900">Barangay</label>
                      <div class="mt-2">
                        <input type="text" wire:model="barangay" id="barangay" disabled autocomplete="barangay" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                    </div>

                    <div class="sm:col-span-3">
                      <label for="district" class="block text-sm/6 font-medium text-gray-900">District</label>
                      <div class="mt-2">
                        <input type="text" wire:model="district" id="district" disabled autocomplete="district" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="zipcode" class="block text-sm/6 font-medium text-gray-900">ZIP / Postal code</label>
                      <div class="mt-2">
                        <input type="text" wire:model="zipcode" id="zipcode" disabled autocomplete="zipcode" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                    </div>
                  </div>
                </div>
            
              <div class="mt-6 flex items-center justify-end gap-x-6">
                <button wire:click="closePatient()" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
              </div>           
      </x-slot:body>
    </x-custom-modal>
    @elseif ($this->deletePatients)
    <x-custom-modal name="Register" title="Delete Patient">
      <x-slot:body>
              <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                  <p for="first-name" class="block text-2xl font-medium text-red-500">Patient {{$this->firstname;}} {{$this->middlename;}} {{$this->lastname;}} with Hospital Record Number {{$this->hrn;}} will be transfered to Trash</p>
                </div>
            
                <div class="mt-6 flex items-center justify-end gap-x-6">
                  <button wire:click="closePatient()" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                  <button wire:click="softDeletePatient()" type="submit" class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Confirm</button>
                </div>
            </div>              
      </x-slot:body>
    </x-custom-modal>
    @else
    <x-custom-modal name="Register" title="Register Patient">
      <x-slot:body>
          <form wire:submit.prevent="createPatient">
              <div class="space-y-12">
                <div class="border-b border-gray-900/10 pb-12">
                  <label for="first-name" class="block text-sm/6 font-medium text-gray-900">Hospital Record Number</label>
                  <div class="mt-2 mb-5">
                      <input type="text" wire:model="hrn" id="hrn" disabled value="SC{{date("YmdHism")}}" placeholder="SC{{date("YmdHism")}}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                  </div>
                  @error('hrn') <span class="text-red-500">{{ $message }}</span> @enderror
                  <h2 class="text-base/7 font-semibold text-gray-900">Personal Information</h2>
                  <div class="mt-5 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                      <label for="firstname" class="block text-sm/6 font-medium text-gray-900">First name</label>
                      <div class="mt-2">
                        <input type="text" wire:model="firstname" id="firstname" autocomplete="firstname" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('firstname') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="lastname" class="block text-sm/6 font-medium text-gray-900">Last name</label>
                      <div class="mt-2">
                        <input type="text" wire:model="lastname" id="lastname" autocomplete="lastname" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('lastname') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="middlename" class="block text-sm/6 font-medium text-gray-900">Middle Name</label>
                      <div class="mt-2">
                        <input id="middlename" wire:model="middlename" type="text" autocomplete="middlename" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('middlename') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-3">
                      <label for="dob" class="block text-sm/6 font-medium text-gray-900">Date of Birth</label>
                      <div class="mt-2">
                        <input id="dob" wire:model="dob" type="date" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('dob') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-3">
                      <label for="civilstatus" class="block text-sm/6 font-medium text-gray-900">Civil Status</label>
                      <div class="mt-2 grid grid-cols-1">
                        <select id="civilstatus" wire:model="civilstatus" autocomplete="civilstatus" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                          <option value="">Select</option>
                          <option value="Single">Single</option>
                          <option value="Married">Married</option>
                          <option value="Divorced">Divorced</option>
                          <option value="Widowed">Widowed</option>
                          <option value="Seperated">Seperated</option>
                        </select>
                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      @error('civilstatus') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-3">
                      <label for="sex" class="block text-sm/6 font-medium text-gray-900">Sex</label>
                      <div class="mt-2 grid grid-cols-1">
                        <select id="sex" wire:model="sex" autocomplete="sex" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                          <option value="">Select</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                        <svg class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                      </div>
                      @error('sex') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-3">
                      <label for="contact" class="block text-sm/6 font-medium text-gray-900">Contact </label>
                      <div class="mt-2">
                        <input id="contact" wire:model="contact" type="text" autocomplete="contact" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('contact') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
            
                    <div class="col-span-full">
                      <label for="street" class="block text-sm/6 font-medium text-gray-900">Street address</label>
                      <div class="mt-2">
                        <input type="text" wire:model="street" id="street" autocomplete="street" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('street') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
            
                    <div class="sm:col-span-3 sm:col-start-1">
                      <label for="citymun" class="block text-sm/6 font-medium text-gray-900">City/Municipality</label>
                      <div class="mt-2">
                        <input type="text" wire:model="citymun" id="citymun" autocomplete="citymun" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('citymun') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="barangay" class="block text-sm/6 font-medium text-gray-900">Barangay</label>
                      <div class="mt-2">
                        <input type="text" wire:model="barangay" id="barangay" autocomplete="barangay" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('barangay') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-3">
                      <label for="district" class="block text-sm/6 font-medium text-gray-900">District</label>
                      <div class="mt-2">
                        <input type="text" wire:model="district" id="district" autocomplete="district" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('district') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
            
                    <div class="sm:col-span-3">
                      <label for="zipcode" class="block text-sm/6 font-medium text-gray-900">ZIP / Postal code</label>
                      <div class="mt-2">
                        <input type="text" wire:model="zipcode" id="zipcode" autocomplete="zipcode" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                      </div>
                      @error('zipcode') <span class="text-red-500">{{ $message }}</span> @enderror
                    </div>
                  </div>
                </div>
            
              <div class="mt-6 flex items-center justify-end gap-x-6">
                <button wire:click="closePatient()" type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
                <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
              </div>
          </form>              
      </x-slot:body>
    </x-custom-modal>
    @endif

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
