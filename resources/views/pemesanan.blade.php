@extends('layouts.layout')
@section('content')
    <div class="flex flex-col sm:flex-row justify-center items-center w-screen h-screen">
        <di class="w-[80%] h-[80%] flex flex-col sm:flex-row justify-center items-center">

            <div class="w-1/2 h-full flex justify-center items-center flex-col">
                <h1 class="">
                    List Pemesanan lapangan
                </h1>
                <a class="border-2 p-2 bg-gray-200 font-bold" href="{{ route('pesanView') }}">*Pemesanan Baru</a>
                <p>Filter</p>
                <div class="flex justify-center items-center w-full">
                    <div class="w-1/2 flex flex-col justify-center items-center">Nomor Lapangan
                        <select id="laps" class="border-2 w-full">
                            <option selected disabled name="" id="">Semua Lapangan
                            </option>
                            <option name="" id="" value="1">1
                            </option>
                            <option name="" id="" value="2">2
                            </option>
                        </select>
                    </div>
                    <div class="w-1/2 flex flex-col justify-center items-center">Jam Pemakaian
                        <select id="laps"class="border-2 w-full">
                            <option selected disabled name="" id="">Semua Jam Pemakaian
                            </option>
                            <option name="" id="" value="09">09:00-11:00
                            </option>
                            <option name="" id="" value="11">11:00-13:00</option>
                            <option name="" id="" value="13">13:00-15:00</option>
                            <option name="" id="" value="15">15:00-17:00</option>
                            <option name="" id="" value="17">17:00-19:00</option>
                            <option name="" id="" value="19">19:00-21:00</option>
                        </select>
                    </div>
                </div>
                <div>Semua Tanggal Booking?</div>
                <div class="border-2 p-2 bg-gray-200 font-bold cursor-pointer">Tampilkan</div>
                <table class="border-2">
                    <tr class="border-2 divide-x-2">
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>Nomor Whatsapp</th>
                        <th>Tanggal Booking</th>
                        <th>Nomor Lapangan</th>
                        <th>Jam Pemakaian</th>
                        <th>Tindakan</th>
                    </tr>
                    @php
                        $counter = 1;
                    @endphp

                    @foreach ($pesanan as $pesan)
                        <tr class="border-2 divide-x-2">
                            <td>
                                {{ $counter }}
                            </td>
                            <td>{{ $pesan->nama_pemesan }}</td>
                            <td>{{ $pesan->wa_pemesan }}</td>
                            <td>{{ $pesan->tanggal }}</td>
                            <td>{{ $pesan->jadwal->nomor_lapangan }}</td>
                            <td>{{ $pesan->jadwal->jam_mulai . '-' . $pesan->jadwal->jam_selesai }}</td>
                            <td>
                                <a 
                                href="{{ ('/edit/'.$pesan->id ) }}"
                                >Edit</a>
                                <a 
                                href="{{ ('/edit/'.$pesan->id ) }}"
                                >Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
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
