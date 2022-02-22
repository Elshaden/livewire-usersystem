<div>
    <x-close-modal/>
    <div class="font-amiri">
        <x-page-heading>
            <x-slot name="title">
                فرق العمل
            </x-slot>
        </x-page-heading>

        <div class="md:col-span-1 ">
            <div class="px-4 sm:px-10 flex justify-end ">

                <div>
                    <button type="submit" wire:click.prevent="AddNewTeam"
                            class="inline-flex justify-center py-0.5 px-4 border border-transparent shadow-sm text-lgmd font-medium rounded-md text-white bg-prime-600 hover:bg-prime-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-prime-500">
                        إضافة فريق
                    </button>
                </div>
            </div>
        </div>

        @if($AddNew)
            <div class="mt-1 md:mt-0 md:col-span-3">
                <form>
                    <div class="shadow sm:rounded-md sm:overflow-hidden" dir="rtl">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div class="grid grid-cols-3 gap-6 mt-5">


                                <div class="col-span-3 sm:col-span-2">
                                    <label for="name"
                                           class="block text-md font-medium text-gray-700 text-center">الفريق </label>

                                    <div class="mt-1 flex rounded-md shadow-sm">

                                        <select id="team_id" name="team_id"
                                                class="max-w-lg block focus:ring-prime-500 focus:border-prime-500 w-full shadow-sm sm:max-w-xs sm:text-sm border-gray-300 rounded-md @error('role_id') border border-red-500 @enderror"
                                                wire:model.defer="team_id"
                                        >
                                            <option></option>
                                            @forelse($AllTeams as $id=>$option )
                                                <div wire:key="option.{{$id}}"/>
                                                <option value="{{$id}}">{{$option[app()->getLocale()]}}</option>

                                            @empty
                                                <option></option>
                                            @endforelse
                                        </select>

                                    </div>
                                </div>


                            </div>

                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">

                                <x-form.subnit_button action="Save" label="حفظ" wire:click.prevent="Save"
                                                      wire:loading.remove/>
                                <x-form.submit_loading_button label="لحظات " wire:loading wire:target="Save"/>

                            </div>
                        </div>

                    </div>


                </form>
            </div>
        @endif

        <div class="flex flex-col px-10 py-1">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-sm font-medium text-gray-700 uppercase tracking-wider">
                                    الفريق
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-sm font-medium text-gray-700 uppercase tracking-wider">
                                    التعريف
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-sm font-medium text-gray-700 uppercase tracking-wider">
                                </th>

                                <th scope="col"
                                    class="px-6 py-3 text-right text-sm font-medium text-gray-700 uppercase tracking-wider">
                                    الصلاحيات
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-sm font-medium text-gray-700 uppercase tracking-wider">

                                </th>


                            </tr>
                            </thead>
                            <tbody>
                            @forelse($UserTeams as $team)
                                <tr class="bg-white" wire:key="team{{$team['id']}}">
                                    <td class="px-6 py-3 text-right  whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{$team['name']}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{$team['translation']?$team['translation'][app()->getLocale()]: $team['name']}}
                                    </td>
                                    <td class="px-6 py-3 text-right whitespace-nowrap text-sm text-gray-700">

                                    </td>


                                    <td class="px-6 py-3 text-center whitespace-nowrap text-right text-sm ">
                                        <div class="text-gray-500 text-center cursor-pointer"
                                             wire:click='$emit("openModal", "team-permissions", {{ json_encode(["Team_id" =>$team['id']]) }})'
                                        >
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                      clip-rule="evenodd"></path>
                                            </svg>

                                        </div>
                                    </td>
                                    <td class="px-6 py-3 text-center whitespace-nowrap text-right text-sm   ">
                                        <div class=" cursor-pointer text-red-500" wire:click.prevent="Revoke({{$team['id']}})">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M6.707 4.879A3 3 0 018.828 4H15a3 3 0 013 3v6a3 3 0 01-3 3H8.828a3 3 0 01-2.12-.879l-4.415-4.414a1 1 0 010-1.414l4.414-4.414zm4 2.414a1 1 0 00-1.414 1.414L10.586 10l-1.293 1.293a1 1 0 101.414 1.414L12 11.414l1.293 1.293a1 1 0 001.414-1.414L13.414 10l1.293-1.293a1 1 0 00-1.414-1.414L12 8.586l-1.293-1.293z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-sm text-gray-700  py-5 px-5">
                                        المستخدم لا ينتمي الى اي فريق
                                    </td>
                                </tr>

                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
