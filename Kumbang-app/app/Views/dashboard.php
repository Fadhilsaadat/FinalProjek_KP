<?= $this->extend('layout/template') ?>

<?= $this->section('stylesheet') ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css" rel='stylesheet' type='text/css'>

<style type="text/css">
    .dt-buttons {
        width: 100%;
    }
</style>

<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container">
    <div class="row">
        <div class="col">
            <div>
                <p class="fw-bold px-2 py-3">Kalender Penggunaan Sarana</p>
            </div>
        </div>
        <div class="col">
            <div>
                <p class="fw-bold px-2 py-3">Chart Penggunaan Sarana</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col hero2">
            <div>
                <div id='calendar' class='px-2'></div>
            </div>
        </div>
        <div class="col hero2">
            <div>
                <div id="chart" class="chart" dir="ltr"></div>
            </div>
        </div>
    </div>
</div>
<div class="table-responsive hero">
    <table id="example" class="display table-bordered">
        <thead>
            <tr style="background:#ECF2FF">
                <th class="text-center">No</th>
                <th class="text-center">Penanggung Jawab</th>
                <th class="text-center">Orang Terlibat</th>
                <th class="text-center">Hari Tanggal</th>
                <th class="text-center">Waktu Awal</th>
                <th class="text-center">Waktu Akhir</th>
                <th class="text-center">Tempat yang dipakai</th>
                <th class="text-center">Peralatan</th>
                <th class="text-center">Kegunaan</th>
                <!-- <th class="text-center">Status</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($pengajuan as $row) : ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $row['penanggung_jawab'] ?></td>
                    <td><?= $row['orang_terlibat'] ?></td>
                    <td><?= $row['hari_tanggal'] ?></td>
                    <td><?= $row['waktu_awal'] ?></td>
                    <td><?= $row['waktu_akhir'] ?></td>
                    <td><?= $row['Tempat_yang_dipakai'] ?></td>
                    <td><?= $row['peralatan'] ?></td>
                    <td><?= $row['kegunaan'] ?></td>
                    <!-- <td><?= $row['status'] ?></td> -->
                    <!-- <td>
                        <a href="<?= base_url('pengajuan/edit/' . $row['id_pengajuan']) ?>" class="btn btn-primary btn-sm">

                            <i class="bi bi-pencil-fill"></i> Edit
                        </a>
                    </td> -->
                </tr>
            <?php $i++;
            endforeach; ?>
        </tbody>
    </table>
    <div id="eventModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div id="eventInfo"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('script') ?>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <!-- jQuery Library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Datatable JS -->
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>

    <script>
        // table search
        $(document).ready(function() {
            $('#example').DataTable({
                columnDefs: [{
                        targets: [0, 1, 2, 4, 5, 6, 7, 8],
                        orderable: false
                    } // Menggunakan indeks kolom (dimulai dari 0) untuk menentukan kolom yang akan dinonaktifkan pengurutannya
                ],
                dom: 'Blfrtip',
                buttons: [{
                    extend: 'copy'
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 4, 5, 6, 7, 8] // Column index which needs to export
                    }
                },
                {
                    extend: 'csv',
                },
                {
                    extend: 'excel',
                }]
            });

            var calendarEl = document.getElementById('calendar');
            moment.locale('id'); // Mengatur lokalitas (locale) ke bahasa Indonesia
            
            var calendar = new FullCalendar.Calendar(calendarEl, {
                headerToolbar: {
                    // start: 'dayGridMonth,timeGridWeek,timeGridDay',
                    start: 'title',
                    end: 'prevYear,prev,next,nextYear today'
                    // end: 'prev,next today'
                },
                dayMaxEventRows: true, // for all non-TimeGrid views
                views: {
                    timeGrid: {
                        dayMaxEventRows: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                    }
                },
                titleFormat: {
                    year: 'numeric',
                    month: 'long'
                },
                editable: true,
                // selectable: true,
                // select: function(info) {
                //     window.location.href = '/event/add';
                // },
                eventClick: function(info) {
                    var startDateFormat = moment(info.event.start);
                    var endDateFormat = moment(info.event.end);

                    var startDate = startDateFormat.format('D MMM YYYY'); // Mengambil tanggal awal
                    var endDate = endDateFormat.format('D MMM YYYY'); // Mengambil tanggal akhir
                    // console.log
                    var startTime = startDateFormat.isValid() ? startDateFormat.format('HH:mm') : ''; // Mengambil jam awal
                    var endTime = endDateFormat.isValid() ? endDateFormat.format('HH:mm') : ''; // Mengambil jam akhir

                    var eventTitle = info.event.title; // Judul acara
                    var penanggungJawab = info.event.extendedProps.penanggung_jawab; // Judul acara

                    // console.log(info.event);
                    var eventDateTime = '';
                    if (startDate === endDate) {
                        // Acara berlangsung hanya pada satu hari
                        eventDateTime = startDate + ' ' + startTime + ' - ' + endTime;
                    } else {
                        // Acara berlangsung lebih dari satu hari
                        eventDateTime = startDate + ' ' + startTime + ' - ' + endDate + ' ' + endTime;
                    }

                    // Membuat modal dengan menggunakan Bootstrap
                    // Membuat konten info event dengan HTML dan gaya CSS
                    var eventInfo = '<div class="event-info">' +
                        '<h5><strong>Tempat Yang Dipakai :</strong></h5>' +
                        '<p class="event-title">' + eventTitle + '</p>' +
                        '<div class="event-details">' +
                        '<h5><strong>Tanggal dan Waktu :</strong></h5>' +
                        '<p>' + eventDateTime + '</p>' +
                        '<h5><strong>Penanggung Jawab :</strong></h5>' +
                        '<p>' + penanggungJawab + '</p>' +
                        '</div>' +
                        '</div>';

                    // Menambahkan modal ke dalam elemen body
                    $('#eventInfo').html(eventInfo);
                    $('#eventModal').modal('show');
                },
                eventTimeFormat: {
                    hour: 'numeric',
                    minute: '2-digit',
                    meridiem: false
                },
                eventContent: function(info) {
                    var startDateFormat = moment(info.event.start);
                    var endDateFormat = moment(info.event.end);

                    var startDate = startDateFormat.format('D MMM YYYY'); // Mengambil tanggal awal
                    var endDate = endDateFormat.format('D MMM YYYY'); // Mengambil tanggal akhir
                    // console.log
                    var startTime = startDateFormat.isValid() ? startDateFormat.format('HH:mm') : ''; // Mengambil jam awal
                    var endTime = endDateFormat.isValid() ? endDateFormat.format('HH:mm') : ''; // Mengambil jam akhir

                    var dateContent = '';
                    // Acara berlangsung hanya pada satu hari
                    dateContent = startTime + ' - ' + endTime;

                    var eventTitle = info.event.title; // Judul acara
                    return {
                        html: '<div class="fc-event-content">' + dateContent + ' | ' + eventTitle + '</div>'
                    };
                },
                events: <?= json_encode($calender_event) ?>,
                // events: events,
                height: 450,
                // contentHeight: 400
            });
            calendar.render();

            // chart
            var options = {
                chart: {
                    height: 450,
                    type: "area",
                    stacked: false,
                    zoom: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                markers: {
                    size: 0,
                },
                series: [
                    // {
                    //     name: 'Ruang Spare Room 1',
                    //     data: <?= json_encode(@$ruang_spare_room_1) ?>
                    // },
                    // {
                    //     name: 'Ruang Spare Room 2',
                    //     data: <?= json_encode(@$ruang_spare_room_2) ?>
                    // },
                    // {
                    //     name: 'Kelas XI.1',
                    //     data: <?= json_encode(@$kelas_xi_1) ?>
                    // },
                    // {
                    //     name: 'Kelas XI.2',
                    //     data: <?= json_encode(@$kelas_xi_2) ?>
                    // },
                    // {
                    //     name: 'Kelas XI.3',
                    //     data: <?= json_encode(@$kelas_xi_3) ?>
                    // },
                    // {
                    //     name: 'Kelas XI.4',
                    //     data: <?= json_encode(@$kelas_xi_4) ?>
                    // },
                    // {
                    //     name: 'Kelas XI.5',
                    //     data: <?= json_encode(@$kelas_xi_5) ?>
                    // },
                    // {
                    //     name: 'Kelas XII.1',
                    //     data: <?= json_encode(@$kelas_xii_1) ?>
                    // },
                    // {
                    //     name: 'Kelas XII.2',
                    //     data: <?= json_encode(@$kelas_xii_2) ?>
                    // },
                    // {
                    //     name: 'Kelas XII.3',
                    //     data: <?= json_encode(@$kelas_xii_3) ?>
                    // },
                    // {
                    //     name: 'Kelas XII.4',
                    //     data: <?= json_encode(@$kelas_xii_4) ?>
                    // },
                    // {
                    //     name: 'Kelas XII.5',
                    //     data: <?= json_encode(@$kelas_xii_5) ?>
                    // },
                    // {
                    //     name: 'Teater',
                    //     data: <?= json_encode(@$teater) ?>
                    // },
                    // {
                    //     name: 'Ruang OSIS/Wakasis',
                    //     data: <?= json_encode(@$ruang_osis_wakasis) ?>
                    // },
                    // {
                    //     name: 'Ruang Laboratorium',
                    //     data: <?= json_encode(@$ruang_laboratorium) ?>
                    // },
                    {
                        name: 'Laboratorium Kimia',
                        data: <?= json_encode(@$laboratorium_kimia) ?>
                    },
                    {
                        name: 'Laboratorium Fisika',
                        data: <?= json_encode(@$laboratorium_fisika) ?>
                    },
                    {
                        name: 'Laboratorium Komputer',
                        data: <?= json_encode(@$laboratorium_komputer) ?>
                    },
                    {
                        name: 'Laboratorium Biologi',
                        data: <?= json_encode(@$laboratorium_biologi) ?>
                    }, {
                        name: 'Laboratorium Bahasa',
                        data: <?= json_encode(@$laboratorium_bahasa) ?>
                    },
                    // {
                    //     name: 'Ruang Tamu',
                    //     data: <?= json_encode(@$ruang_tamu) ?>
                    // },
                    // {
                    //     name: 'IT, Multimedia & Marketing',
                    //     data: <?= json_encode(@$it_multimedia_marketing) ?>
                    // },
                    // {
                    //     name: 'Ruang UKS',
                    //     data: <?= json_encode(@$ruang_uks) ?>
                    // },
                    // {
                    //     name: 'Ruang Yayasan',
                    //     data: <?= json_encode(@$ruang_yayasan) ?>
                    // },
                    // {
                    //     name: 'Ruang Tamu',
                    //     data: <?= json_encode(@$ruang_tamu) ?>
                    // },
                    // {
                    //     name: 'Ruang Guru',
                    //     data: <?= json_encode(@$ruang_guru) ?>
                    // },
                    // {
                    //     name: 'Ruang Kepsek',
                    //     data: <?= json_encode(@$ruang_kepsek) ?>
                    // },
                    // {
                    //     name: 'Ruang Wakakur',
                    //     data: <?= json_encode(@$ruang_wakakur) ?>
                    // },
                    // {
                    //     name: 'Ruang Wakasar',
                    //     data: <?= json_encode(@$ruang_wakasar) ?>
                    // },
                    // {
                    //     name: 'Ruang Serbaguna SMA',
                    //     data: <?= json_encode(@$ruang_serbaguna_sma) ?>
                    // },
                    // {
                    //     name: 'Ruang Kuliner',
                    //     data: <?= json_encode(@$ruang_kuliner) ?>
                    // },
                    // {
                    //     name: 'Ruang musik',
                    //     data: <?= json_encode(@$ruang_musik) ?>
                    // },
                    // {
                    //     name: 'Perpustakaan',
                    //     data: <?= json_encode(@$perpustakaan) ?>
                    // },
                    // {
                    //     name: 'Kantin',
                    //     data: <?= json_encode(@$kantin) ?>
                    // },
                    {
                        name: 'Lapangan Badminton',
                        data: <?= json_encode(@$lapangan_badminton) ?>
                    },
                    {
                        name: 'Lapangan Tenis Meja',
                        data: <?= json_encode(@$lapangan_tenis_meja) ?>
                    },
                    // {
                    //     name: 'Kolam Renang',
                    //     data: <?= json_encode(@$kolam_renang) ?>
                    // },
                    {
                        name: 'Lapangan Basket',
                        data: <?= json_encode(@$lapangan_basket) ?>
                    },
                    {
                        name: 'Lapangan Voli',
                        data: <?= json_encode(@$lapangan_voli) ?>
                    },
                    {
                        name: 'Lapangan Tenis',
                        data: <?= json_encode(@$lapangan_tenis) ?>
                    },
                    {
                        name: 'Lapangan Senam',
                        data: <?= json_encode(@$lapangan_senam) ?>
                    },
                    {
                        name: 'Lapangan Futsal',
                        data: <?= json_encode(@$lapangan_futsal) ?>
                    },
                ],
                colors: ['#2E93fA', '#66DA26', '#546E7A', '#E91E63', '#FF9800', '#53B3C9', '#FF4081', '#4CAF50', '#FF5722', '#9C27B0', '#8BC34A', '#F44336', '#2196F3', '#FFEB3B', '#607D8B', '#CDDC39', '#795548', '#00BCD4', '#FFC107', '#9E9E9E', '#03A9F4', '#FF5722', '#673AB7', '#8BC34A', '#FF9800', '#9C27B0', '#4CAF50', '#E91E63', '#2196F3', '#FFEB3B', '#9E9E9E', '#607D8B', '#CDDC39', '#795548', '#FF4081', '#00BCD4', '#FFC107', '#FF5722', '#673AB7'],
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                },
                xaxis: {
                    type: 'datetime',
                    tickAmount: 8,
                    labels: {
                        format: 'MMM yyyy',
                        // rotate: 0,
                        // rotateAlways: true,
                    },     
                    tickPlacement: 'on'
                    // axisBorder: {
                    //     show: false
                    // },
                    // axisTicks: {
                    //     show: false
                    // }
                },
                yaxis: {
                    tickAmount: 3,
                    // floating: false,
                    type: 'datetime',
                    x: {
                        format: 'MMM yyyy' // Format bulan dan tahun, misalnya "May 2023"
                    },
                    labels: {
                        style: {
                            colors: '#8e8da4',
                        },
                        offsetY: 0,
                        offsetX: 0,
                    },
                    // axisBorder: {
                    //     show: false,
                    // },
                    // axisTicks: {
                    //     show: false
                    // },
                    labels: {
                        formatter: function(val, index) {
                            return val.toFixed(0) + ' pengguna';
                        }
                    }
                },
                // stroke: {
                //     curve: 'straight'
                // },
                // fill: {
                //     opacity: 0.5
                // },
                tooltip: {
                    shared: true,
                    type: 'datetime',
                    x: {
                        format: 'MMM yyyy' // Format bulan dan tahun, misalnya "May 2023"
                    },
                    y: {
                        formatter: function(val) {
                            return val.toFixed(0) + ' pengguna';
                        }
                    },
                    // fixed: {
                    //     enabled: false,
                    //     position: 'topRight',
                    //     // offsetX: 0,
                    //     // offsetY: 0,
                    // },
                    // enabled: true,
                    // style: {
                    //     fontSize: '12px',
                    //     fontFamily: 'Arial, sans-serif',
                    //     maxWidth: '200px',
                    //     textAlign: 'left'
                    // },
                    // overflow: 'hidden'
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'left',
                    offsetX: 0,
                    offsetY: 0,
                },
                // itemMargin: {
                //     horizontal: 0,
                //     vertical: 0
                // },
                // grid: {
                //     yaxis: {
                //         lines: {
                //             offsetX: -30
                //         }
                //     },
                //     padding: {
                //         left: 20
                //     }
                // }
            };
            var chart = new ApexCharts(document.querySelector("#chart"), options);
            chart.render();
        });
        // document.addEventListener('DOMContentLoaded', function() {
        // });
    </script>

<?= $this->endSection() ?>