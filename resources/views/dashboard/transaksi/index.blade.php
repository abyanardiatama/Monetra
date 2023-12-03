@extends('dashboard.layouts.main')
@extends('dashboard.partials.sidebar')
@section('container')
{{-- <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" /> --}}
<div class="space-between">
    <div>
        <h3>Transaksi</h3>
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
<form action="/dashboard/transaksi" method="GET" style="margin-bottom: 20px">
    @csrf
    <div class="summary_container">
        <div class="card-search-container search_input">
            <input type="text" id="default-search" class="search__input" placeholder="Cari Transaksi" name="search">
        </div>
        <div class="card-search-button search_button">
            <button class="search__button" type="submit" id="button-addon2">Cari</button>
        </div>
    </div>
</form>
<div class="table_responsive">
    <table id="default-table">
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Kategori</th>
            <th>Jumlah</th>
            <th>Edit</th>
            <th>Hapus</th>
        </tr>
        @foreach ($transaksi as $transaksi)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $transaksi->tanggal }}</td>
            <td>{{ $transaksi->keterangan }}</td>
            <td>{{ $transaksi->kategori }}</td>
            @if ($transaksi->jumlahPengeluaran !=null )
                <td style="color: #ff0000;">- Rp {{ number_format($transaksi->jumlahPengeluaran, 0, ',', '.') }}</td>
            @else
                <td style="color: #00b300;">+ Rp {{ number_format($transaksi->jumlahPemasukan, 0, ',', '.') }}</td>
            @endif
            <td>
                <a href="javascript:void(0)" id="open-modalEditPengeluaran-{{ $transaksi->id }}" class="open-modal-edit" onclick="showModal('open-modalEditPengeluaran-{{ $transaksi->id }}', 'modal-containerEditPengeluaran-{{ $transaksi->id }}')">
                    <i class='bx bxs-edit-alt addButton' style="text-align: center; font-size: 24px"></i>
                </a>
                <div class="modal__container" id="modal-containerEditPengeluaran-{{ $transaksi->id }}" >
                    <!-- Your modal content here -->
                    <div class="modal__content" style="top:0%">
                        <div class="modal__close close-modal" title="Close" id="close-modalEditPengeluaran-{{ $transaksi->id }}" onclick="closeModal('close-modalEditPengeluaran-{{ $transaksi->id }}', 'modal-containerEditPengeluaran-{{ $transaksi->id }}')">
                            <i class='bx bx-x' style="font-size: 25px"></i>
                        </div>
                        <h4 class="modal__title" style="margin-bottom: 10px">Edit Transaksi</h4>
                        @if ($transaksi->jumlahPengeluaran !=null )
                            <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="POST">
                                @csrf
                                @method('put')
                                <div class="form-group">
                                    <label for="kategoriDiv" class="modal__description">Kategori</label>
                                    <div name="kategoriDiv" id="kategoriDiv" class="modal__input">
                                        <select name="kategori" id="kategoriSelect" required>
                                            @foreach ($kategoriPengeluaran as $kategori)
                                                <option value="{{ $kategori->nama }}" {{ $transaksi->kategori == $kategori->nama ? 'selected' : ''}}>{{ $kategori->nama }}</option>                                        
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>                                          
                                <div class="form-group">
                                    <label for="keterangan" class="modal__description">Keterangan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="modal__input" placeholder="Keterangan" value="{{ $transaksi->keterangan }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal" class="modal__description">Tanggal</label>
                                    <input type="date" name="tanggal" id="tanggal" class="modal__input" placeholder="Tanggal" value="{{ $transaksi->tanggal }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah" class="modal__description">Jumlah</label>
                                    <input type="text" name="jumlahPengeluaran" id="jumlahPengeluaran-{{ $transaksi->id }}" class="modal__input" placeholder="Jumlah Pengeluaran" value="{{ number_format($transaksi->jumlahPengeluaran, 0, ',', '.') }}" oninput="formatNumber('jumlahPengeluaran-{{ $transaksi->id }}')" required>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="modal__button">
                                        Edit
                                    </button>
                                </div>
                            </form>
                        @elseif ($transaksi->jumlahPemasukan !=null)
                        <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="kategoriDiv" class="modal__description">Kategori</label>
                                <div name="kategoriDiv" id="kategoriDiv" class="modal__input">
                                    <select name="kategori" id="kategoriSelect" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategoriPemasukan as $kategori)
                                        <option value="{{ $kategori->nama }}" {{ $transaksi->kategori == $kategori->nama ? 'selected' : ''}}>{{ $kategori->nama }}</option>
                                        @endforeach
                                    </select>
                                </div> 
                            </div>                                          
                            <div class="form-group">
                                <label for="keterangan" class="modal__description">Keterangan</label>
                                <input type="text" name="keterangan" id="keterangan" class="modal__input" placeholder="Keterangan" value="{{ $transaksi->keterangan }}" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal" class="modal__description">Tanggal</label>
                                <input type="date" name="tanggal" id="tanggal" class="modal__input" placeholder="Tanggal" value="{{ $transaksi->tanggal }}" required>
                            </div>
                            <div class="form-group">
                                <label for="jumlah" class="modal__description">Jumlah</label>
                                <input type="text" name="jumlahPemasukan" id="jumlahPemasukan-{{ $transaksi->id }}" class="modal__input" placeholder="Jumlah Pemasukan" value="{{ number_format($transaksi->jumlahPemasukan, 0, ',', '.') }}" oninput="formatNumber('jumlahPemasukan-{{ $transaksi->id }}')" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="modal__button">
                                    Submit
                                </button>
                            </div>
                        </form>
                        @endif
                    </div>
                </div>
            </td>
            <td>
                <a href="javascript:void(0)" id="open-modalDeletePengeluaran-{{ $transaksi->id }}" class="open-modal-delete" onclick="showModal('open-modalDeletePengeluaran-{{ $transaksi->id }}', 'modal-containerDeletePengeluaran-{{ $transaksi->id }}')">
                    <i class='bx bxs-trash-alt' style="text-align: center; font-size: 22px; color:black;"></i>
                </a>
                <div class="modal__container" id="modal-containerDeletePengeluaran-{{ $transaksi->id }}">
                    <!-- Your modal content here -->
                    <div class="modal__content">
                        <div class="modal__close close-modal" title="Close" id="close-modalDeletePengeluaran-{{ $transaksi->id }}" onclick="closeModal('close-modalDeletePengeluaran-{{ $transaksi->id }}', 'modal-containerDeletePengeluaran-{{ $transaksi->id }}')">
                            <i class='bx bx-x' style="font-size: 25px"></i>
                        </div>
                        <h3 style="text-align: center">Yakin Menghapus Transaksi ?</h3>
                        <div class="flex justify-center" style="gap: 10px">
                            <div>
                                <button class="modal__button" style="background-color: gray" id="cancel-modalDeletePengeluaran-{{ $transaksi->id }}" onclick="closeModal('cancel-modalDeletePengeluaran-{{ $transaksi->id }}', 'modal-containerDeletePengeluaran-{{ $transaksi->id }}')">No</button>
                            </div>
                            <div>
                                <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="modal__button">Yes</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </table>

    {{-- Pagination --}}
    <div class="pagination">
        {{-- {{ $transaksi->links() }} --}}
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