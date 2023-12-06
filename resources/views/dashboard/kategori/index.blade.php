@extends('dashboard.layouts.main')
@extends('dashboard.partials.sidebar')
@section('container')
<div class="space-between">
    <div class="flex">
        <div>
            <h3>Kategori</h3>
        </div>
        <div style="padding: 32px 0 32px 10px">
            <a href="javascript:void(0)" id="open-modalAddKategori" onclick="showModal('open-modalAddKategori', 'modal-containerAddKategori')">
                <i class='bx bxs-plus-circle addButton' style="font-size: 32px"></i>
            </a>
            
        </div>
    </div>
    <div>
        @if (session('success'))
            <div class="session-success" role="alert">
                <span><i class='bx bxs-info-circle' ></i>
                    {{ session('success') }}
                </span>
            </div>
        @elseif (session('error'))
            <div class="session-error" role="alert">
                <span><i class='bx bxs-error-circle' ></i>
                    {{ session('error') }}
                </span>
            </div>
        @endif
    </div>
</div>


{{-- Search --}}
<form action="/dashboard/kategori" method="GET" style="margin-bottom: 20px">
    @csrf
    <div class="summary_container">
        <div class="card-search-container search_input">
            <input type="text" id="default-search" class="search__input" placeholder="Cari Kategori" name="search">
        </div>
        <div class="card-search-button search_button">
            <button class="search__button" type="submit" id="button-addon3">Cari</button>
        </div>
    </div>
</form>

{{-- Modal Add Kategori --}}
<div class="modal__container" id="modal-containerAddKategori">
    <div class="modal__content" style="top: -25%">
        <div class="modal__close close-modal" title="Close" id="close-modalAddKategori" onclick="closeModal('close-modalAddKategori', 'modal-containerAddKategori')">
            <i class='bx bx-x' style="font-size: 25px"></i>
        </div>
        <h4 class="modal__title" style="margin-bottom: 10px">Tambah Kategori</h4>
        <form action="/dashboard/kategori" method="post">
            @csrf
            <div class="form-group">
                <label for="nama" class="modal__description">Nama Kategori</label>
                <input type="text" class="modal__input" id="nama" name="nama" placeholder="Nama Kategori">
            </div>
            <div class="form-group">
                <label for="jenis" class="modal__description">Jenis</label>
                <select class="modal__input" id="jenis" name="jenis">
                    <option value="">Pilih Jenis Kategori</option>
                    <option value="Pemasukan">Pemasukan</option>
                    <option value="Pengeluaran">Pengeluaran</option>
                </select>
            </div>
            <div class="form-group">
                <button type="submit" class="modal__button">Tambah</button>
            </div>
        </form>
    </div>
</div>

@if (session('empty'))
    <div class="session-empty">
        <span><i class='bx bxs-error-circle' ></i>
            {{ session('empty') }}
        </span>
    </div>
@endif

{{-- Tabel Kategori --}}
<div class="table_responsive">
    <table id="default-table">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jenis</th>
                <th>Edit</th>
                <th>Hapus</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kategori as $k)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k->nama }}</td>
                <td>{{ $k->jenis }}</td>
                <td>
                    <a href="javascript:void(0)" id="open-modalEditKategori-{{ $k->id }}" class="open-modal-edit" onclick="showModal('open-modalEditKategori-{{ $k->id }}', 'modal-containerEditKategori-{{ $k->id }}')">
                        <i class='bx bxs-edit-alt addButton' style="text-align: center; font-size: 24px"></i>
                    </a>
                    <div class="modal__container" id="modal-containerEditKategori-{{ $k->id }}">
                        <!-- Your modal content here -->
                        <div class="modal__content" style="top: -25%">
                            <div class="modal__close close-modal" title="Close" id="close-modalEditKategori-{{ $k->id }}" onclick="closeModal('close-modalEditKategori-{{ $k->id }}', 'modal-containerEditKategori-{{ $k->id }}')">
                                <i class='bx bx-x' style="font-size: 25px"></i>
                            </div>
                            <h4 class="modal__title" style="margin-bottom: 10px">Edit Kategori</h4>
                            <form action="/dashboard/kategori/{{ $k->id }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="nama" class="modal__description">Nama Kategori</label>
                                    <input type="text" class="modal__input" id="nama" name="nama" value="{{ $k->nama }}">
                                </div>
                                <div class="form-group">
                                    <label for="jenis" class="modal__description">Jenis</label>
                                    <select class="modal__input" id="jenis" name="jenis">
                                        <option value="Pemasukan" {{ $k->jenis == 'Pemasukan' ? 'selected' : '' }}>Pemasukan</option>
                                        <option value="Pengeluaran" {{ $k->jenis == 'Pengeluaran' ? 'selected' : '' }}>Pengeluaran</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="modal__button">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </td>
                <td>
                    <a href="javascript:void(0)" id="open-modalDeleteKategori-{{ $k->id }}" class="open-modal-delete" onclick="showModal('open-modalDeleteKategori-{{ $k->id }}', 'modal-containerDeleteKategori-{{ $k->id }}')">
                        <i class='bx bxs-trash-alt' style="text-align: center; font-size: 22px; color:black;"></i>
                    </a>
                    <div class="modal__container" id="modal-containerDeleteKategori-{{ $k->id }}">
                        <!-- Your modal content here -->
                        <div class="modal__content" style="top: -25%">
                            <div class="modal__close close-modal" title="Close" id="close-modalDeleteKategori-{{ $k->id }}" onclick="closeModal('close-modalDeleteKategori-{{ $k->id }}', 'modal-containerDeleteKategori-{{ $k->id }}')">
                                <i class='bx bx-x' style="font-size: 25px"></i>
                            </div>
                            <h3 style="text-align: center; margin: 32px 0 0 0;">Yakin Menghapus Kategori ?</h3>
                            <p style="text-align: center; margin: 0 0 32px 0;">Transaksi dengan kategori ini juga akan ikut terhapus</p>
                            <div class="flex justify-center" style="gap: 10px">
                                <div>
                                    <button class="modal__button" style="background-color: gray" id="cancel-modalDeleteKategori-{{ $k->id }}" onclick="closeModal('cancel-modalDeleteKategori-{{ $k->id }}', 'modal-containerDeleteKategori-{{ $k->id }}')">No</button>
                                </div>
                                <div>
                                    <form action="/dashboard/kategori/{{ $k->id }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="modal__button">Yes</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{-- Pagination --}}
    <div class="pagination">
        {{-- {{ $kategori->links() }} --}}
    </div>
</div>


<script>
    const showModal = (openButton, modalContent) =>{
        const openBtn = document.getElementById(openButton),
        modalContainer = document.getElementById(modalContent)
        
        if(openBtn && modalContainer){
            openBtn.addEventListener('click', ()=>{
                modalContainer.classList.add('show-modal')
            })
        }
    }
    const closeModal = (closeButton, modalContent) =>{
        const closeBtn = document.getElementById(closeButton),
        modalContainer = document.getElementById(modalContent)
        
        if(closeBtn && modalContainer){
            closeBtn.addEventListener('click', ()=>{
                modalContainer.classList.remove('show-modal')
            })
        }
    }
    function formatNumber(elementId) {
        let input = document.getElementById(elementId);
        let value = input.value.replace(/[^\d]/g, ''); // Remove non-numeric characters
        if (!value) {
            input.value = ''; // If input is not numeric, clear the field
        } else {
            input.value = formatWithCommas(value);
        }
    }

    function formatWithCommas(value) {
        return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
    }

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