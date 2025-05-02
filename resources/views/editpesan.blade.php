@extends('layouts.layout')
@section('content')
    <div class="flex flex-col sm:flex-row justify-center items-center w-screen h-screen">
        <di class="w-[80%] h-[80%] flex flex-col sm:flex-row justify-center items-center">

            <div class="w-1/2 h-full flex justify-center items-center flex-col">
                <h1 class="">
                    Pemesanan lapangan
                </h1>
                <form class="flex w-full h-full justify-center items-center flex-col" method="POST"
                    action="{{ route('pesanLap') }}">
                    @csrf

                    <label for="nama">Nama :</label>
                    <input type="text" name="nama" id="nama" class="p-2 border rounded">
                    <label for="wa">Whatsapp :</label>
                    <input type="text" name="wa" id="wa" class="p-2 border rounded">

                    <label for="tanggalBook">Tanggal Booking :</label>
                    <input type="date" name="tanggalBook" id="tanggalBook" class="p-2 border rounded" />

                    <label for="nomorLap">Nomor Lapangan :</label>
                    <select name="nomorLap" id="nomorLap"
                        class="transition-all ease-in-out p-3 duration-300 w-full text-center bg-[#EBE7E3] text-[#63237B] hover:bg-[#63237B] hover:text-[#EBE7E3] rounded-xl focus:outline-none focus:ring focus:ring-indigo-500 overflow-y-scroll">
                        <option class="w-full text-center text-sm sm:text-base bg-[#EBE7E3] text-[#63237B]" value=""
                            disabled selected>
                            Nomor Lapangan
                        </option>

                        {{ $tes = $laps->unique('nomor_lapangan') }}
                        @foreach ($tes as $te)
                            <option
                                class="focus:bg-[#63237B] focus:text-[#EBE7E3] cursor-pointer font-return-grid w-full text-shadow-blue text-center text-sm sm:text-base text-[#EBE7E3]"
                                value="{{ $te['nomor_lapangan'] }}">{{ $te['nomor_lapangan'] }}</option>
                        @endforeach
                    </select>

                    <select name="jamBook" id="jamBook"
                        class="transition-all ease-in-out p-3 duration-300 w-full text-center bg-[#EBE7E3] text-[#63237B] hover:bg-[#63237B] hover:text-[#EBE7E3] rounded-xl focus:outline-none focus:ring focus:ring-indigo-500 overflow-y-scroll">
                        <option class="w-full text-center text-sm sm:text-base bg-[#EBE7E3] text-[#63237B]" value=""
                            disabled selected>
                            Jam Booking
                        </option>

                        {{ $tesJam = $laps->unique('jam_mulai') }}

                        @foreach ($tesJam as $te)
                            <option
                                class="focus:bg-[#63237B] focus:text-[#EBE7E3] cursor-pointer font-return-grid w-full text-shadow-blue text-center text-sm sm:text-base text-[#EBE7E3]"
                                value="{{ $te['jam_mulai'] }}">
                                {{ $te['jam_mulai'] . '-' . (int) substr($te['jam_mulai'], 0, 2) + 2 . ':00' }}
                            </option>
                        @endforeach
                    </select>
                    <div id="submitDiv">
                        <button type="submit" class="">
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
    </div>
    </div>
@endsection

@if (session('success'))
    <script>
        alert('{{ session('success') }}');
        // Swal.fire({
        //     icon: 'success',
        //     title: '{{ session('success') }}',
        // });
    </script>
@endif

@if (session('error'))
    <script>
        alert('{{ session('error') }}');
        // Swal.fire({
        //     icon: 'error',
        //     title: '{{ session('error') }}',
        // });
    </script>
@endif
