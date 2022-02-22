<div>

    <x-close-modal/>
    <!--livewire('permissions-table', [$TeamId]) -->

    <div class="flex flex-col p-3" dir="ltr">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <div class="inline-block min-w-full align-middle dark:bg-gray-800">
                <div class="flex justify-between">

                    <div class="p-4 ml-1 mr-1 ">
                        <div class="flex justify-between font-amiri mt-5">
                            <div class="relative mt-1">
                                <button type="submit" wire:click.prevent="RevokeAllParentPermissions"
                                        class=" mr-1.5 ml-1.5 inline-flex justify-center py-2 px-2 border border-transparent shadow-sm text-lgmd font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-prime-500">
                                    حذف جميع الصلاحيات
                                </button>
                            </div>
                            <div class="relative mt-1">
                                <x-form.subnit_button label="منح جميع الصلاحيات"
                                                      wire:click.prevent="GiveAllParentPermissions"/>
                            </div>

                        </div>
                    </div>


                    <div class="p-4">
                        <div class="flex justify-start font-amiri">
                            <div class="px-2 mt-8">
                                <button type="button" class="bg-gray-200 p-2 rounded-full shadow-lg"
                                        wire:click.prevent="TeamPermissions">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                              d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z"
                                              clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                            <div>
                                <label for="Items"
                                       class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">إختار
                                    المجموعة</label>
                                <select wire:model="SelectedParent" id="Items"
                                        class="bg-gray-50 border w-1/3 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option></option>
                                    @foreach($ListGroup as $item)
                                        <div wire:key="item-{{$item['id']}}">
                                            <option value="{{$item['id']}}"><span class="px-3 "> {{ $item['name'] }}  </span>
                                            </option>
                                        </div>
                                    @endforeach

                                </select>
                            </div>

                        </div>
                    </div>
                    <div class="p-4">

                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">إختار
                            التصنيف</label>
                        <select wire:model="SelectGroup"
                                id="countries"
                                class="bg-gray-50 border w-1/3 border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option></option>
                            @foreach($Groups->where('parent', Null) as $group)
                                <div wire:key="{{$group->id}}">
                                    <option value="{{$group['id']}}"><span class="px-3 ">  {{ $group['name'] }}  </span></option>
                                </div>
                            @endforeach

                        </select>

                    </div>


                </div>
                <div>
                    @if($ShowTable)
                        <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700" dir="rtl">
                            <thead class="bg-gray-100 dark:bg-gray-700 font-amiri">
                            <tr>
                                <th scope="col" class="p-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-search-all" type="checkbox" wire:model="List.selected"
                                               class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-search-all" class="sr-only">checkbox</label>
                                    </div>
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-right text-gray-700 uppercase dark:text-gray-400">
                                    الصلاحية
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-right text-gray-700 uppercase dark:text-gray-400">
                                    التعريف
                                </th>
                                <th scope="col"
                                    class="py-3 px-6 text-xs font-medium tracking-wider text-right text-gray-700 uppercase dark:text-gray-400">
                                    المجموعة
                                </th>
                                <th scope="col" class="p-4">

                                </th>
                            </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @forelse($PermissionsList as $permission)
                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700 font-amiri"
                                    wire:key="perm-{{$permission->id}}">
                                    <td class="p-4 w-4">
                                        <div class="flex items-center">
                                            <input id="checkbox-search-1" type="checkbox"
                                                   wire:model="SelectedCheckbox.{{ $permission->id }}"
                                                   value="{{ $permission->id }}"
                                                   class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="checkbox-search-1" class="sr-only">checkbox</label>
                                        </div>
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900 text-right whitespace-nowrap dark:text-white">
                                        {{$permission['name']}}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900  text-right whitespace-nowrap dark:text-white">
                                        {{$permission['translation']?$permission['translation'][app()->getLocale()]: $permission['name']}}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900  text-right whitespace-nowrap dark:text-white">
                                        {{$permission['display']['name']}}
                                    </td>
                                    <td class="py-4 px-6 text-sm font-medium text-right whitespace-nowrap">

                                    </td>
                                </tr>
                            @empty
                                <div> No Permissions</div>
                            @endforelse
                            </tbody>
                        </table>
                        <div class=" mt-2 p-5 bg-gray-100">
                        <x-form.subnit_button label="حفظ " wire:click.prevent="SyncThePermissions"/>
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>

</div>
</div>
