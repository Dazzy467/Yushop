<x-home-layout>

    <div class="py-12">
        <div class="px-10">
            <div class="flex flex-wrap bg-gray-300 py-2">
                @foreach ($Barang as $val)
                    @if ($val->status === 1)
                        <div class="bg-white rounded p-5 mx-2">
                            <img src="{{ Storage::url('public/images/'.$val->id.'/'.$val->image_path) }}" style="height: 100px;width:100px;">

                            <div>
                                <p>
                                    {{ $val->namaBarang }}
                                </p>
                                <p class="font-bold font-sans">
                                    Rp.{{ $val->hargaBarang }}
                                </p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

    </div>

</x-home-layout>