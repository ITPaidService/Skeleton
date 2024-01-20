<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Billing') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if(!Auth::user()->subscribed())
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1 flex justify-between">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium text-gray-900">{{ __('Płatny dostęp') }}</h3>

                            <p class="mt-1 text-sm text-gray-600">
                                Aktywacja dostępu do płatnych części serwisu.
                            </p>
                        </div>
                    </div>

                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                            <div class="max-w-xl text-sm text-gray-600">
                                Uzyskaj dostęp do wszelkich płatnych dostępów. W każdej chwili możesz anulować
                                subskrypcję. W ciągu 14 bez przyczyny możesz wystąpić o zwrot środków.
                            </div>

                            <div class="flex items-center mt-5">
                                <a href="{{$checkout1->redirect()->getTargetUrl()}}"
                                   class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Subskrybuj za 50 zł miesięcznie
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            @elseif(Auth::user()->subscribed())
                @if(!Auth::user()->subscription()->canceled())
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1 flex justify-between">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Aktywna subskrypcja') }}</h3>

                                <p class="mt-1 text-sm text-gray-600">
                                    Aktualnie masz aktywną subskrypcję oraz aktywny dostęp do płatnych zawartości.
                                </p>
                            </div>

                            <div class="px-4 sm:px-0">

                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl text-sm text-gray-600">
                                   Twoja subskrypcja jest aktywna. Po zakończeniu obecnego okresu rozliczeniowego, kolejna
                                    opłata przedłużająca dostęp zostanie automatycznie pobrana.
                                </div>

                                <div class="mt-5 space-y-6">
                                    <div class="flex items-center">
                                        <div class="text-sm text-gray-600">
                                            Kolejny okres rozliczeniowy: <span class="text-green-500 font-semibold">{{Carbon\Carbon::createFromTimestamp(Auth::user()->subscription()->asStripeSubscription()->current_period_end)}}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center mt-5">
                                    <a href="{{route('billing.cancel')}}"
                                       class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Anuluj subskrypcję
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden sm:block">
                        <div class="py-8">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>
                @else
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1 flex justify-between">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium text-gray-900">{{ __('Wznowienie subskrypcji') }}</h3>

                                <p class="mt-1 text-sm text-gray-600">
                                    Twoja subskrypcja jest nieaktywna, ale masz dostęp do końca opłaconego już rozliczenia.
                                </p>
                            </div>

                            <div class="px-4 sm:px-0">

                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="px-4 py-5 sm:p-6 bg-white shadow sm:rounded-lg">
                                <div class="max-w-xl text-sm text-gray-600">
                                Twoja subskrypcja jest anulowana, to znaczy, że nie będzie pobierana automatycznie opłata. Możesz wznowić subskrypcję,
                                    aby opłata została pobrana przy najbliższym okresie rozliczeniowym.
                                </div>

                                <div class="mt-5 space-y-6">
                                     <div class="flex items-center">
                                         <div class="text-sm text-gray-600">
                                             Dostęp wygaśnie: <span class="text-green-500 font-semibold">{{Auth::user()->subscription()->ends_at}}</span>
                                         </div>
                                    </div>
                                </div>

                                <div class="flex items-center mt-5">
                                    <a href="{{route('billing.resume')}}"
                                       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        Wznów subskrypcję
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hidden sm:block">
                        <div class="py-8">
                            <div class="border-t border-gray-200"></div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-app-layout>
