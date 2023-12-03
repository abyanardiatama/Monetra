@extends('dashboard.layouts.main')
@extends('dashboard.partials.sidebar')
{{-- <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" /> --}}
{{-- <link rel="stylesheet" href="{{ asset('main/modal.css') }}"> --}}
<!--=============== MAIN ===============-->
@section('container')
<div class="space-between">
    <div>
        <h3>Dashboard</h3>
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

{{-- Modal Add Pengeluaran --}}
<div class="modal__container" id="modal-containerPengeluaran">
    <div class="modal__content">
        <div class="modal__close close-modal" title="Close">
            <i class='bx bx-x' style="font-size: 25px"></i>
        </div>
        <h4 class="modal__title" style="margin-bottom: 10px">Pengeluaran</h4>
        <form action="/pengeluaran" method="POST">
            @csrf
            <div class="form-group">
                <label for="kategoriDiv" class="modal__description">Kategori</label>
                <select name="kategori" id="kategoriSelect" class="modal__input" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($kategoriPengeluaran as $kategori)
                        <option value="{{ $kategori->nama }}">{{ $kategori->nama }}</option>                                        
                    @endforeach
                </select> 
            </div>                                          
            <div class="form-group">
                <label for="keterangan" class="modal__description">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="modal__input" placeholder="Keterangan" required>
            </div>
            <div class="form-group">
                <label for="tanggal" class="modal__description">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="modal__input" placeholder="Tanggal" required>
            </div>
            <div class="form-group">
                <label for="jumlah" class="modal__description">Jumlah</label>
                <input type="text" name="jumlahPengeluaran" id="jumlahPengeluaran" class="modal__input" placeholder="Jumlah Pengeluaran" oninput="formatNumber('jumlahPengeluaran')" required>
            </div>
            <div class="form-group">
                <button type="submit" class="modal__button">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>

<div class="summary_container">
    <div class="card-small">
        <div class="icon">
            <img src="../assets/img/icons/saldo.png" alt="saldo">
        </div>
        <div class="card_sub_title">Total Saldo</div>
        <div class="card_title">Rp {{ $totalSaldo }}</div>
    </div>
    <div class="card-small">
        <div class="icon">
            <img src="../assets/img/icons/pengeluaran.png" alt="pengeluaran">
            <a href="javascript:void(0)"><i class='bx bxs-plus-circle addButton' id="open-modalPengeluaran" style="font-size: 32px"></i></a>
            
        </div>
        <div class="card_sub_title">Pengeluaran</div>
        <div class="card_title">Rp {{ $totalPengeluaran }}</div>
    </div>
    <div class="card-small">
        <div class="icon">
            <img src="../assets/img/icons/pemasukan.png" alt="pemasukan">
            <a href="javascript:void(0)"><i class='bx bxs-plus-circle addButton' id="open-modalPemasukan" style="font-size: 32px"></i></a>
            <div class="modal__container" id="modal-containerPemasukan">
                <div class="modal__content">
                    <div class="modal__close close-modal" title="Close">
                        <i class='bx bx-x' style="font-size: 25px"></i>
                    </div>
                    <h4 class="modal__title" style="margin-bottom: 10px">Pemasukan</h4>
                    <form action="/pemasukan" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kategoriDiv" class="modal__description">Kategori</label>
                            <select name="kategori" id="kategoriSelect" class="modal__input" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoriPemasukan as $kategori)
                                    <option value="{{ $kategori->nama }}">{{ $kategori->nama }}</option>
                                @endforeach
                            </select>
                        </div>                                          
                        <div class="form-group">
                            <label for="keterangan" class="modal__description">Keterangan</label>
                            <input type="text" name="keterangan" id="keterangan" class="modal__input" placeholder="Keterangan" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal" class="modal__description">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal" class="modal__input" placeholder="Tanggal" required>
                        </div>
                        <div class="form-group">
                            <label for="jumlah" class="modal__description">Jumlah</label>
                            <input type="text" name="jumlahPemasukan" id="jumlahPemasukan" class="modal__input" placeholder="Jumlah Pemasukan" oninput="formatNumber('jumlahPemasukan')" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="modal__button">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card_sub_title">Pemasukan</div>
        <div class="card_title">Rp {{ $totalPemasukan }}</div>
    </div>
    <div class="card-medium">
        <div class="card_sub_title" style="padding: 20px">Transaksi</div>
        <div class="table_container">
            <table>
                <tr>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                </tr>
                @foreach ($transaksiAll as $transaksi)
                    <tr>
                        <td style="display: flex">
                            @if ($transaksi->jumlahPengeluaran !=null )
                                <img src="../assets/img/icons/pengeluaran.png" alt="saldo" style="width: 27px; height: 27px; margin-right:15px">
                            @else
                                <img src="../assets/img/icons/pemasukan.png" alt="saldo" style="width: 30px; height: 30px; margin-right:15px">
                            @endif
                            {{ $transaksi->kategori }}
                        </td>
                        <td>{{ $transaksi->keterangan }}</td>
                        <td>{{ $transaksi->tanggal }}</td>
                        @if ($transaksi->jumlahPengeluaran !=null )
                            <td style="color: #ff0000;">- Rp {{ number_format($transaksi->jumlahPengeluaran, 0, ',', '.') }}</td>
                        @else
                            <td style="color: #00b300;">+ Rp {{ number_format($transaksi->jumlahPemasukan, 0, ',', '.') }}</td>
                        @endif
                    </tr>
                @endforeach
                @empty($transaksiAll)
                    <tr>
                        <td colspan="4" style="text-align: center; background-color: rgb(0, 0, 0, 0.1)">Belum ada transaksi</td>
                    </tr>
                @endempty
            </table>
        </div>
    </div>
    <div class="card-medium behind">
        <div class="card_sub_title" style="padding: 20px">Grafik Pengeluaran</div>
        <div class="center">
            {!! $chart->container() !!}
            <script src="{{ $chart->cdn() }}"></script>
            {{ $chart->script() }}
        </div>
    </div>
</div>



<!--=============== MAIN JS ===============-->
<script src="{{ asset('sidebar/js/main.js') }}"></script>
<script>
    /*=============== SHOW MODAL ===============*/
    const showModal = (openButton, modalContent) =>{
        const openBtn = document.getElementById(openButton),
        modalContainer = document.getElementById(modalContent)
        
        if(openBtn && modalContainer){
            openBtn.addEventListener('click', ()=>{
                modalContainer.classList.add('show-modal')
            })
        }
    }
    showModal('open-modalPengeluaran','modal-containerPengeluaran')
    showModal('open-modalPemasukan','modal-containerPemasukan')

    /*=============== CLOSE MODAL ===============*/
    const closeBtn = document.querySelectorAll('.close-modal')

    function closeModal(modalCont){
        const modalContainer = document.getElementById(modalCont)
        modalContainer.classList.remove('show-modal')
    }
    closeBtn.forEach(btn=>{
        btn.addEventListener('click', ()=>{
            closeModal('modal-containerPengeluaran');
            closeModal('modal-containerPemasukan');

        })
    })
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

</script>
@endsection