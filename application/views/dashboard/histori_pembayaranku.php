<table width="100%" class="table responsive table-striped table-bordered table-hover no-wrap" id="dataTables-sihima">
    <thead>
        <tr>
            <th>Tanggal Bayar</th>
            <th>Nama Tagihan</th>
            <th>Nominal</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
    <tfoot>
        <tr>
            <th>Tanggal Bayar</th>
            <th>Nama Tagihan</th>
            <th>Nominal</th>
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
                url: "<?= base_url('Datatable/histori_pembayaranku') ?>",
                type: "POST",
            },
            order: [0, 'desc'],
            columns: [{
                    data: 'tgl_bayar',
                },
                {
                    data: 'nama_tagihan'
                },
                {
                    data: 'nominal_bayar',
                    render: $.fn.dataTable.render.number('.', ',', 0, 'Rp ')
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
                    .column(2)
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Total over this page
                pageTotal = api
                    .column(2, {
                        page: 'current'
                    })
                    .data()
                    .reduce(function(a, b) {
                        return intVal(a) + intVal(b);
                    }, 0);

                // Update footer
                $(api.column(2).footer()).html(
                    numFormat(total)
                );
            }
        });
    });
</script>