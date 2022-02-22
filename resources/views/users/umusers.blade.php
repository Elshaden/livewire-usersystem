<div>


    <x-page-heading>
        <x-slot name="title">
            Users
        </x-slot>
    </x-page-heading>


        <div class="flex flex-col px-10 py-1">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    المستخدم
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    الإيميل
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    الصلاحية
                                </th>


                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">

                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-700 uppercase tracking-wider">
                                    فرق العمل
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @forelse($Users as $user)
                                <tr class="bg-white" :key="{{$user->id}}">
                                    <td class="px-6 py-4 whitespace-nowrap text-xs font-medium text-gray-900">
                                        {{$user->name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-700">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-700">
                                        {{ $user->roles }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-right text-xs ">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-xs ">
                                        <div class="text-gray-500 text-center cursor-pointer"
                                             wire:click='$emit("openModal", "user-teams", {{ json_encode(["User_id" =>$user['id']]) }})'
                                        >
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                      d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                                      clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-xs text-gray-700">
                                        لا يوجد اي مستخدمين بالنظام
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
