{{-- jQuery --}}
<script src="{{ URL::asset('js/jquery-2.1.4.min.js') }}"></script>

{{-- Bootstrap Core JavaScript --}}
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>

{{-- FormValidation v.0.6.1 plugin and the class supports validating Bootstrap form --}}
{{-- <script src="{{ URL::asset('js/formvalidation/formValidation-0.6.1.min.js') }}"></script>
<script src="{{ URL::asset('js/formvalidation/framework/bootstrap-fv-0.6.1.min.js')}}"></script> --}}

{{-- FormValidation v.0.7.1-dev plugin and the class supports validating Bootstrap form --}}
<script src="{{ URL::asset('js/formvalidation/formValidation.min-0.7.1-dev.js') }}"></script>
<script src="{{ URL::asset('js/formvalidation/framework/bootstrap.min-fv-0.7.1-dev.js')}}"></script>

{{-- nprogress.js --}}
<script src="{{ URL::asset('js/nprogress/nprogress.js')}}"></script>

{{-- bootstrap-table.js --}}
<script src="{{ URL::asset('js/bootstrap-table/bootstrap-table.min.js')}}"></script>
<script src="{{ URL::asset('js/bootstrap-table/bootstrap-table-mk-MK.js')}}"></script>
<script src="{{ URL::asset('js/bootstrap-table/bootstrap-table-contextmenu.min.js')}}"></script>

{{-- moment.js --}}
<script src="{{ URL::asset('js/moment/moment.js')}}"></script>

{{-- bootstrap-datepicker --}}
<script src="{{ URL::asset('js/bootstrap-datepicker/bootstrap-datetimepicker.js')}}"></script>
{{-- <script src="{{ URL::asset('js/bootstrap-datepicker/bootstrap-datepicker.mk.min.js')}}"></script> --}}

{{-- setup meta token for ajax requests --}}
<script type="text/javascript">
$.ajaxSetup({
   headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
})

</script>
