<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DeboksKas</title>
    <link rel="stylesheet" href="/css/home.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"
        integrity="sha256-ErZ09KkZnzjpqcane4SCyyHsKAXMvID9/xwbl/Aq1pc=" crossorigin="anonymous"></script>
</head>

<body>
    <nav>
        <div class="title">
            <span class="material-icons">arrow_back</span>
            <h2>Data Warung</h2>
        </div>
        <div class="month">
            <h2>Bulan Januari - 2022</h2>
        </div>
        <div class="account">
            <div class="account-name-role">
                <h3 style="margin: 0">{{ auth()->user()->nama }}</h3>
                @if(auth()->user()->is_admin)
                    <p style="margin: 0">Admin</p>
                @else
                    <p style="margin: 0">Karyawan</p>
                @endif
            </div>
            @if(auth()->user()->foto_profil)
                <div class="profile-photo" style="background-image: url({{ asset('storage/'.auth()->user()->foto_profil) }});"></div>
            @else
                <div class="profile-photo" style="background-image: url({{ asset('storage/images/user-profile/default_profile.png') }});"></div>
            @endif
            <div id="account-dropdown">
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
        <aside class="nav">
            @if(auth()->user()->is_admin)
                <a href="/karyawan">Data Karyawan</a>
            @else
                <a href="/produk">Data Produk</a>
            @endif
            <a href="/warung">Data Warung</a>
        </aside>
        <div class="main-data">
            <!-- <div class="warung">
                <h3>Warung terlaris</h3>
                <div class="card">
                    <h3>Warung Aminah</h3>
                    <p>081234567890</p>
                    <p>Jalan Raden Patah no 10 Kediri</p>
                    <button>PENCATATAN</button>
                </div>
            </div>
            <div class="produk-terbeli">produk</div>
            <div class="grafik">grafik</div>
            <div class="pemasukan">masuk</div>
            <div class="pengeluaran">keluar</div>
            <div class="laba">laba</div> -->
            <div class="warung-grafik">
                <div class="warung">
                    <h3>Warung terlaris</h3>
                    <div class="card">
                        <h3>{{ $warung->nama }}</h3>
                        <p>{{ $warung->nohp }}</p>
                        <p>{{ $warung->alamat }}</p>
                        <a class="btn-warung" href="/pencatatan/{{ $warung->id }}/{{ idate('Y') }}/{{ idate('m') }}">PENCATATAN</a>
                    </div>
                </div>
                <div class="produk">
                    <h3>Jumlah Produk Terbeli</h3>
                    <div class="data">
                        <div class="total">
                            <p>Total</p>
                            <h3>{{ $pencatatan_total->sum('produk_terbeli') }} <span>pcs</span></h3>
                        </div>
                        <div class="bulan-ini">
                            <p>Bulan ini</p>
                            <h4>{{ $pencatatan_bulanini->sum('produk_terbeli') }} <span>pcs</span></h4>
                        </div>
                    </div>
                </div>
                <div class="grafik">
                    <h3>Grafik Produk Terbeli (Bulan ini)</h3>
                    <canvas id="myChart" width="310" height="200"></canvas>
                </div>
            </div>
            <div class="keuangan">
                <div class="data-keuangan pemasukan">
                    <div class="total">
                        <p>Total Pemasukan</p>
                        <h3>Rp {{ $pencatatan_total->sum('pemasukan') }}</h3>
                    </div>
                    <div class="bulan-ini">
                        <p>Bulan ini</p>
                        <h4>Rp {{ $pencatatan_bulanini->sum('pemasukan') }}</h4>
                    </div>
                </div>
                <div class="data-keuangan pengeluaran">
                    <div class="total">
                        <p>Total Pengeluaran</p>
                        <h3>Rp {{ $pencatatan_total->sum('pengeluaran') }}</h3>
                    </div>
                    <div class="bulan-ini">
                        <p>Bulan ini</p>
                        <h4>Rp {{ $pencatatan_bulanini->sum('pengeluaran') }}</h4>
                    </div>
                </div>
                <div class="data-keuangan laba">
                    <div class="total">
                        <p>Total Laba</p>
                        <h3>Rp {{ $pencatatan_total->sum('pemasukan')-$pencatatan_total->sum('pengeluaran') }}</h3>
                    </div>
                    <div class="bulan-ini">
                        <p>Bulan ini</p>
                        <h4>Rp {{ $pencatatan_bulanini->sum('pemasukan')-$pencatatan_bulanini->sum('pengeluaran') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/js/home.js"></script>
</body>

</html>