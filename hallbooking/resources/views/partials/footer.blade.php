<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.0
  </div>
  <strong>Designed and Maintained by <a href="#">Software Development Team, KARE</a>.</strong>
</footer>

<script>
  // Modal Handling Script
  $("#changepassword").on("show.bs.modal", function (e) {
      var link = $(e.relatedTarget);
      $(this).find(".modal-content").load(link.attr("href"));
  });
</script>
