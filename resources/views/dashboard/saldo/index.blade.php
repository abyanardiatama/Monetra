@extends('dashboard.layouts.main')
@include('dashboard.partials.sidebar')
{{-- <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" /> --}}
<link rel="stylesheet" href="{{ asset('main/styles.css') }}">
@section('container')
<h3>Rekap Saldo Bulanan</h3>

{{-- Search --}}
<form action="/dashboard/saldo" method="GET" style="margin-bottom: 20px">
    @csrf
    <div class="summary_container">
        <div class="card-search-container search_input">
            <input type="text" id="default-search" class="search__input" placeholder="Cari Saldo" name="search">
        </div>
        <div class="card-search-button search_button">
            <button class="search__button" type="submit" id="button-addon3">Cari</button>
        </div>
    </div>
</form>

@if (session('empty'))
    <div class="session-empty">
        <span><i class='bx bxs-error-circle' ></i>
            {{ session('empty') }}
        </span>
    </div>
@endif

{{-- Tabel Saldo --}}
<div class="table_responsive">
    <table id="default-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Tahun</th>
                <th>Sisa Saldo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($saldo as $saldo)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $saldo['bulan'] }}</td>
                <td>{{ $saldo['tahun'] }}</td>
                <td>{{ number_format($saldo['sisaSaldo'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Search Bar
        const searchBar = document.getElementById('default-search');
        searchBar.addEventListener('input', searchTable);

        function searchTable() {
            const input = searchBar.value.toLowerCase();
            const table = document.getElementById('default-table');
            const rows = table.getElementsByTagName('tr');
            // var noEventDataDiv = document.getElementById("no-event-data");

            const hasResult = false;

            for (var i = 0; i < rows.length; i++) {
                var rowData = rows[i].textContent.toLowerCase();

                if (rowData.includes(input)) {
                    rows[i].style.display = "";
                    hasResults = true;
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    });

</script>
@endsection