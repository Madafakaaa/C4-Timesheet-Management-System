<!-- Java Script Content -->
<script src="/assets/bundles/lib.vendor.bundle.js"></script>
<script src="/assets/bundles/counterup.bundle.js"></script>
<script src="/assets/bundles/apexcharts.bundle.js"></script>
<script src="/assets/bundles/jvectormap2.bundle.js"></script>
<script src="/assets/js/core.js"></script>
<script src="/assets/js/form/form-advanced.js"></script>

<!-- Plugin Java Script Content -->
<script src="/assets/plugins/animate-css/animate.min.css"></script>
<script src="/assets/plugins/bootstrap-notify-master/bootstrap-notify.min.js"></script>
<script src="/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script src="/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="/assets/plugins/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="/assets/plugins/multi-select/js/jquery.multi-select.js"></script>
<script src="/assets/plugins/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="/assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script>
<script src="/assets/plugins/dropify/js/dropify.min.js"></script>
<script src="/assets/plugins/dragula-master/dist/dragula.min.js"></script>

<!-- My Java Script Content -->
<script src="/assets/js/scripts.js"></script>

<!-- Bootstrap Notify -->
<script>
  @if (session('notify'))
      notify('{{session("title")}}','{{session("message")}}','{{session("type")}}');
  @endif
</script>
