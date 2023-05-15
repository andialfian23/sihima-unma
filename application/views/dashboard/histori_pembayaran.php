<table width="100%" class="table responsive table-striped table-bordered table-hover no-wrap" id="dataTables-sihima">
    <thead>
        <tr>
            <th>Tanggal Bayar</th>
            <th>Nama</th>
            <th>Nama Tagihan</th>
            <th>Nominal</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
        <tr>
            <th>Tanggal Bayar</th>
            <th>Nama</th>
            <th>Nama Tagihan</th>
            <th>Nominal</th>
            <th>Aksi</th>
        </tr>
    </tfoot>
</table>

<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTables-sihima').DataTable({
            language: {
                url: "<?= base_url('assets/ID.json') ?>",
            },
            serverSide: true,
            processing: true,
            ajax: {
                url: "<?= base_url('Datatable/histori_pembayaran') ?>",
                type: "POST",
            },
            order: [0, 'desc'],
            columns: [{
                    data: 'tgl_bayar',
                },
                {
                    data: 'nama'
                },
                {
                    data: 'nama_tagihan'
                },
                {
                    data: 'nominal_bayar',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
                },
                {
                    data: 'aksi',
                },
            ],
            "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                    data;
                var numFormat = $.fn.dataTable.render.number('.', ',', 0, 'Rp ').display;
                // Remove the formatting to get integer data for summation
                var intVal = function(i) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '') * 1 :
                        typeof i === 'number' ?
                        i : 0;
                };

                // Total over all pages
                total = api
                    .column(3)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(3, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(3).footer()).html(
                    numFormat(total)
                );
            }
        });
    });

    function hapus(no_pb) {
        if (confirm('Apakah anda yakin ingin menghapus data tersebut ???') == true) {
            toastr.success('Data pembayaran akan segera di Hapus');
            setTimeout(function() {
                window.location.assign('<?= base_url("Pembayaran/hapus/") ?>' + no_pb);
            }, 2000);
        }
    }
</script>