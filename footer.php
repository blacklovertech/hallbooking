<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.0
  </div>
  <strong>Designed and Maintained by <a href="#">Software Development Team, KARE</a>.</strong>
</footer>

  
<script src="js/bootstrap.min.js"></script>
  <script src="plugins/fastclick/fastclick.min.js"></script>
<script src="plugins/pace/pace.min.js"></script>
<script src="js/app.min.js"></script>

<script>
    $("#changepassword").on("show.bs.modal", function(e) {
       var link = $(e.relatedTarget);
      $(this).find(".modal-content").load(link.attr("href"));
    });
    
    </script>
<script src="js/datatables.min.js"></script>
<script>
    $(function () {
        $('#view-table').DataTable({
		columnDefs: [
        //{ targets: [0,1,2,3,5,6 ], visible: true},
        { targets: [], visible: false }
    ],
	buttons: [    'copy', 'csv',  'print', 'colvis' ],
       responsive: true,
       ajax: "",
			"lengthMenu": [
                    [5,10,20, 30, 50, 100, -1],
                    [5,10,20, 30, 50, 100, "All"] // change per page values here
            ],
            "pageLength": 5, // default record count per page

            columns: [
              {data: 'id',render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      }},
      {data: 'created_at'},
                {data: 'course_code'},
				{data: 'course_name'},

     
				    
        {data: 'status',render: function (data, type, row, meta) {

if (row.status == 0) { return "<small class='label label-info'>Processing</small>"; }
else if(row.status==1) { return "<small class='label label-success'>Approved</small>"; }
else if(row.status==5) { 
return "<small class='label label-danger'>Rejected</small><br>" + row.description;
}
}},	
            ],
			"sDom": '<"row"<"col-sm-6"B><"col-sm-6"f>><"clear">rt<"row"<"col-sm-5"li><"col-sm-7"p>>',
        });
    });
</script>
</body>
</html>